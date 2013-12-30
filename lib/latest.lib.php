<?php if (!defined('_GNUBOARD_')) exit;

// 최신글 추출
function latest($skin_dir="", $bo_table, $rows=10, $subject_len=40, $options="")
{
    global $g4;

    if ($skin_dir)
        $latest_skin_path = "$g4[path]/skin/latest/$skin_dir";
    else
        $latest_skin_path = "$g4[path]/skin/latest/basic";

    $list = array();

    $sql = " select * from $g4[board_table] where bo_table = '$bo_table'";
    $board = sql_fetch($sql);

    $tmp_write_table = $g4['write_prefix'] . $bo_table; // 게시판 테이블 전체이름
    //$sql = " select * from $tmp_write_table where wr_is_comment = 0 order by wr_id desc limit 0, $rows ";
    // 위의 코드 보다 속도가 빠름
    $sql = " select * from $tmp_write_table where wr_is_comment = 0 order by wr_num limit 0, $rows ";
    //explain($sql);
    $result = sql_query($sql);
    for ($i=0; $row = sql_fetch_array($result); $i++)
        $list[$i] = get_list($row, $board, $latest_skin_path, $subject_len);

    ob_start();
    include "$latest_skin_path/latest.skin.php";
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}




/*
이름 : make_thumnail

용도 : 원본을 조건에 따라 리사이즈, 크롭, 워터마크를 처리하여 파일로 저장함

성공시 리턴값 : true

실패시 리턴값 : false

인자 :
==> $path_src_file : 원본파일의 절대경로 또는 상대경로
==> $path_save_file : 썸네일을 저장할 절대경로 또는 상대경로
==> $save_w : 만들 썸네일의 너비
==> $save_h : 만들 썸네일의 높이, 생략 가능하며 생략시 기본값은 0
==> $options : 함수 내부에 정의된 변수들의 값을 변경할때 사용, 배열형태, 생략가능하며 생략시 기본값은 빈배열(Array())
                ==> $options['save_quality'] : 파일로 저장시 저장될 파일의 품질, 100 이하의 양의 정수만 사용, gif는 의미 없음
                ==> $options['save_force'] : 이미 동일한 경로에 동일이름의 파일이 존재할때의 처리 결정
                                                            0 이면 false 반환, 1 이면 더이상 실행안하고 true 반환, 2 이면 기존거는 지우고 새로 저장
                ==> $options['crop_use'] : 크롭 사용 여부, 0 은 사용안함, 1은 사용함
                ==> $options['crop_pos_width'] : 너비 기준으로 크롭할때 기준부위 결정, 1은 왼쪽, 2는 가운데, 3은 오른쪽
                ==> $options['crop_pos_height'] : 높이 기준으로 크롭할때 기준부위 결정, 1은 상단, 2는 중단, 3은 하단
                ==> $options['watermark_path_file'] : 워터마크 이미지 파일의 절대경로 또는 상대경로
                ==> $options['watermark_pos'] : 워터마크 찍는 위치 결정, 1 은 상단 왼쪽, 2는 상단 오른쪽, 3은 하단 왼쪽, 4는 하단 오른쪽, 5는 중앙, 10 은 전체에 반복
                ==> $options['watermark_sharpness'] : 워터마크의 선명도, 100 이하의 양의 정수만 사용
                                                                     ==> 100 일경우에는 투명이미지 사용가능
                ==> $options['watermark_padding'] : 워터마크의 여백, 0이상의 양의 정수, 패딩의 크기는 워터마크이미지의 너비나 높이보다 클수 없음
*/

function make_thumnail($path_src_file, $path_save_file, $save_w, $save_h=0, $options=Array()){

  //기본값 설정
  $save_quality = 70;//저장 품질 : 70 %
  $save_force = 2;//저장형태 : 파일 덮어씌움

  $unsharpmask_use = 1;//언샵마스크 사용여부
  $unsharpmask_amount = 100;
  $unsharpmask_radius = 1;
  $unsharpmask_threshold = 2;

  $crop_use = 0;//크롭 사용여부
  $crop_pos_width = 2;//너비 기준 크롭시 중앙을 기준
  $crop_pos_height = 1;//높이 기준 크롭시 상단을 기준

  $watermark_path_file = '';//워터마크로 사용할 파일 경로 : 없음
  $watermark_pos = 4;//워터마크 찍는 위치 : 하단 오른쪽
  $watermark_sharpness = 30;//워터마크 이미지의 선명도 : 30 %
  $watermark_padding = 10;//원본과 워터마크 사이의 여백 : 10px

  //기본값 재설정
  if (!empty($options)) @extract($options);

  //불필요한 처리를 막기 위해 먼저 저장가능한지 여부와 동일한 경로의 파일 존재유무 체크
  $result_writable = check_savable($path_save_file);
  if (empty($result_writable)) return false;

  if (is_file($path_save_file)) {

      if ($save_force == 1) {//새로 저장하지 않고 true 반환

          return true;
      }
      else if ($save_force != 2){//0 이거나 정해지지 않은 값일때 false를 반환

     //     $GLOBALS['errormsg'] = $path_save_file . '은 이미 같은 이름의 파일이 존재합니다.';

          return false;
      }
  }

  //원본 리소스 생성
  list($src, $src_w, $src_h) = get_image_resource_from_file($path_src_file);
  if (empty($src)) return false;

  //리사이즈 또는 크롭 리사이즈
  if ($crop_use == 1) {//크롭 리사이즈

    $dst = get_image_cropresize($src, $src_w, $src_h, $save_w, $save_h, $crop_pos_width, $crop_pos_height);

  }
  else {//리사이즈

    $dst = get_image_resize($src, $src_w, $src_h, $save_w, $save_h);
  }

  @imagedestroy($src);
  if (empty($dst)) return false;

  $save_w = imagesx($dst);//생성된 썸네일 리소스에서 실제 너비를 구한다.
  $save_h = imagesy($dst);//생성된 썸네일 리소스에서 실제 높이를 구한다.

  //언샵마스크 처리
  if ($unsharpmask_use == 1) {

      $result_unsharpmask = proc_unsharpmask($dst, $save_w, $save_h, $unsharpmask_amount, $unsharpmask_radius, $unsharpmask_threshold);

      if (empty($result_unsharpmask)) return false;
  }

  //워터마크 이미지가 파일일 경우, 워터마크 처리
  if (!empty($watermark_path_file) && is_file($watermark_path_file)) {

    $result_watermark = proc_watermark($dst, $save_w, $save_h, $watermark_path_file, $watermark_pos, $watermark_sharpness, $watermark_padding);

    if (empty($result_watermark)) return false;
  }

  $result_save = save_image_from_resource ($dst, $path_save_file, $save_quality, $save_force);

  @imagedestroy($dst);

  return $result_save;
}

// 이미지의 src 부분만 파싱
function hd_get_content_img($src) {
  $re = '/src[ =]+[\'"]([^\'"]+\.(?:gif|jpg|jpeg|png|bmp))[\'"]/i';
  preg_match_all($re, $src, $match, PREG_PATTERN_ORDER);
  return $match[1];
}


// URL 의 파일명만 읽어드림
function hd_get_imgname($url) {
	preg_match("`/([^/]+)$`i", $url, $m);
	return $m;
}


function proc_unsharpmask($src, $src_w, $src_h, $amount, $radius, $threshold) {

    if (empty($src))    {//원본의 리소스 id 가 빈값일 경우

        $GLOBALS['errormsg'] = '원본 리소스가 없습니다.';

        return false;
    }

    //정수형이 아니라면 정수형으로 강제 형변환
    if (!is_int($src_w)) settype($src_w, 'int');
    if (!is_int($src_h)) settype($src_h, 'int');

    if ($src_w < 1 || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우

        $GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";

        return false;
    }

    if (!is_int($amount)) settype($amount, 'int');
    if ($amount > 500) $amount = 500;
    else if ($amount < 1) $amount = 1;
    $amount = $amount * 0.016;

    if (!is_int($radius) && !is_float($radius)) settype($radius, 'int');
    if ($radius > 50) $radius = 50;
    else if ($radius < 0.5) $radius = 0.5;
    $radius = $radius * 2;
    $radius = abs(round($radius));

    if (!is_int($threshold)) settype($threshold, 'int');
    if ($threshold > 255) $threshold = 255;
    else if ($threshold < 1) $threshold = 1;

    $src_canvas = $src;
    $src_canvas2 = $src;
    $src_blur = imagecreatetruecolor($src_w, $src_h);

    for ($i = 0; $i < $radius; $i++) {

        imagecopy($src_blur, $src_canvas, 0, 0, 1, 1, $src_w - 1, $src_h - 1); // up left
        imagecopymerge($src_blur, $src_canvas, 1, 1, 0, 0, $src_w, $src_h, 50); // down right
        imagecopymerge($src_blur, $src_canvas, 0, 1, 1, 0, $src_w - 1, $src_h, 33.33333); // down left
        imagecopymerge($src_blur, $src_canvas, 1, 0, 0, 1, $src_w, $src_h - 1, 25); // up right
        imagecopymerge($src_blur, $src_canvas, 0, 0, 1, 0, $src_w - 1, $src_h, 33.33333); // left
        imagecopymerge($src_blur, $src_canvas, 1, 0, 0, 0, $src_w, $src_h, 25); // right
        imagecopymerge($src_blur, $src_canvas, 0, 0, 0, 1, $src_w, $src_h - 1, 20 ); // up
        imagecopymerge($src_blur, $src_canvas, 0, 1, 0, 0, $src_w, $src_h, 16.666667); // down
        imagecopymerge($src_blur, $src_canvas, 0, 0, 0, 0, $src_w, $src_h, 50); // center
    }
    $src_canvas = $src_blur;

    for ($x = 0; $x < $src_w; $x++) { // each row

        for ($y = 0; $y < $src_h; $y++) { // each pixel

            $rgbOrig = imagecolorat($src_canvas2, $x, $y);
            $rOrig = (($rgbOrig >> 16) & 0xFF);
            $gOrig = (($rgbOrig >> 8) & 0xFF);
            $bOrig = ($rgbOrig & 0xFF);
            $rgbBlur = imagecolorat($src_canvas, $x, $y);
            $rBlur = (($rgbBlur >> 16) & 0xFF);
            $gBlur = (($rgbBlur >> 8) & 0xFF);
            $bBlur = ($rgbBlur & 0xFF);

            $rNew = (abs($rOrig - $rBlur) >= $threshold) ? max(0, min(255, ($amount * ($rOrig - $rBlur)) + $rOrig)) : $rOrig;
            $gNew = (abs($gOrig - $gBlur) >= $threshold) ? max(0, min(255, ($amount * ($gOrig - $gBlur)) + $gOrig)) : $gOrig;
            $bNew = (abs($bOrig - $bBlur) >= $threshold) ? max(0, min(255, ($amount * ($bOrig - $bBlur)) + $bOrig)) : $bOrig;

            if (($rOrig != $rNew) || ($gOrig != $gNew) || ($bOrig != $bNew)) {

                $pixCol = imagecolorallocate($src, $rNew, $gNew, $bNew);
                imagesetpixel($src, $x, $y, $pixCol);
            }
        }
    }

    @imagedestroy($src_blur);

    return true;
}



// 이미지 태그을 받아서 썸네일
function hd_get_content_resize($str) {
	global $g4, $reseize_config;

    $thumb_w = $reseize_config[width];
    $thumb_h = $reseize_config[height];
    $thumb_path = $reseize_config[thumb_path];

	$img_src = hd_get_content_img($str[0]);

	$image_file = (preg_match("`^(/|http)`i", trim($img_src[0]))) ? str_replace(dirname(__FILE__), '', $_SERVER['DOCUMENT_ROOT'] . preg_replace("`https?://[^/]+`i", '', trim($img_src[0]))) : trim($img_src[0]);

	if(file_exists($image_file)){ //원본 파일이 서버내에 존재하면

		$Imgfilename = hd_get_imgname($img_src[0]);
		$temp_thumb = $thumb_path."/". $Imgfilename[1]; // 썸네일 경로와 파일명

		$size = @getimagesize($image_file); // 원본 가로사이즈

		if($size[0] > $thumb_w){ // 원본사이즈가 썸네일 사이즈 보다 크면 실행
			if(!file_exists($thumb_path."/". $Imgfilename[1])){
				if(make_thumnail($image_file, $temp_thumb, $thumb_w, $thumb_h))  // 썸네일만 생성
					$thumb = $thumb_path."/". $Imgfilename[1]; // 썸네일이 생성되면 경로를 넣음
			}else{
				$thumb = $thumb_path."/". $Imgfilename[1]; // 썸네일이 있어도 경로를 넣음
			}
		}else{
				$thumb = $img_src[0]; // 썸네일 사이즈가 원본보다 작으면 원본 경로를 넣음
		}

		$img_tag = preg_replace("/\<img[^\<\>]*\>/i", "<a rel='image_zoom' href='{$img_src[0]}'><img src=\"$thumb\"></a>", $str[0]);

	}else{
		$img_tag = $str[0];
		// 외부이미지가 내용 보다 클경우 별도로 처리 하는 부분이 필요함
	}


	return $img_tag;
}

// 콘텐츠에서 이미지를 찾아서 콜백
function hd_get_content_imgcall($content, $thumb_w, $thumb_h=0)
{
	global $g4, $reseize_config, $bo_table;

	$data_path = $g4['path'] . "/data/file/" . $bo_table;
	$thumb_path = $data_path . "/thumbView";

	if (!is_dir($thumb_path)){
	  @mkdir($thumb_path, 0707);
	  @chmod($thumb_path, 0707);
	}
    $reseize_config = array();
    $reseize_config[width] = $thumb_w;
    $reseize_config[height] = $thumb_h;
    $reseize_config[thumb_path] = $thumb_path;

    return preg_replace_callback('/\<img[^\<\>]*\>/i', 'hd_get_content_resize', $content);
}






/*
이름 : check_savable

용도 : 인자로 받은 파일 경로로 저장가능한지 여부 확인

성공시 리턴값 : true

실패시 리턴값 : false

인자 :
==> $path_save_file : 저장될 파일의 절대 경로 또는 상대경로
*/

function check_savable($path_save_file){

    $path_save_dir = dirname($path_save_file);//저장 파일 경로에서 상위 디렉토리 경로를 가져옴
    if (!is_dir($path_save_dir)) {//상위디렉토리가 디렉토리가 아니라면

   //     $GLOBALS['errormsg'] = $path_save_dir . '은 디렉토리가 아닙니다.';

        return false;
    }

    if (!is_writable($path_save_dir)){//해당 디렉토리에 파일을 저장할 권한이 없다면

   //     $GLOBALS['errormsg'] = $path_save_dir . '에 이미지를 저장할 권한이 없습니다.';

        return false;
    }

    if (is_dir($path_save_file)) {//같은 이름의 디렉토리가 존재하면

   //     $GLOBALS['errormsg'] = $path_save_file . '은 이미 같은 이름의 디렉토리가 존재합니다.';

        return false;
    }

    return true;
}









/*
이름 : get_image_cropresize

용도 : 원본의 리소스를 가지고 주어진 조건으로 크롭 후 리사이즈 처리한 이미지 리소스를 생성

성공시 리턴값 : 썸네일 리소스 id

실패시 리턴값 : false

인자 :
==> $src : 원본의 리소스 id
==> $src_w : 원본의 너비
==> $src_h : 원본의 높이
==> $dst_w : 생성할 썸네일의 너비, 0 이상의 정수
==> $dst_h : 생성할 썸네일의 높이, 0 이상의 정수
             ==> 생략 가능하며 생략시에는 자동으로 0으로 값이 들어감
==> $pos_width : 너비를 기준으로 크롭할때 어느부분을 크롭할지 지정
                   ==> 1 일경우에는 왼쪽을 기준으로 크롭
                   ==> 2 일경우에는 중앙을 기준으로 크롭
                   ==> 3 일경우에는 오른쪽을 기준으로 크롭
                   ==> 생략가능하며 생략시에는 자동으로 2 로 값이 들어감
==> $pos_height : 높이를 기준으로 크롭할때 어느부분을 크롭할지 지정
                   ==> 1 일경우에는 상단을 기준으로 크롭
                   ==> 2 일경우에는 가운데를 기준으로 크롭
                   ==> 3 일경우에는 하단을 기준으로 크롭
                   ==> 생략가능하며 생략시에는 자동으로 2 로 값이 들어감

참고 :
==> $dst_w 와 $dst_h 모두 값이 0이 될수 없음
==> 둘다 0보다 클 경우, 강제 리사이즈하여 썸네일 리소스 생성
==> 둘중 하나가 0 이면, 0이 아닌 쪽을 기준으로 정비율로 리사이즈 하여 썸네일 생성
*/

function get_image_cropresize($src, $src_w, $src_h, $dst_w, $dst_h=0, $pos_width=2, $pos_height=2){

  if (empty($src))  {//원본의 리소스 id 가 빈값일 경우

  //  $GLOBALS['errormsg'] = '원본 리소스가 없습니다.';

    return false;
  }

  //정수형이 아니라면 정수형으로 강제 형변환
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($dst_w)) settype($dst_w, 'int');
  if (!is_int($dst_h)) settype($dst_h, 'int');

  if ($src_w < 1 || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우

//    $GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";

    return false;
  }

  if (empty($dst_w) && empty($dst_h)) {//썸네일의 너비와 높이 둘다 없을 경우

//    $GLOBALS['errormsg'] = '썸네일의 너비와 높이는 둘중에 하나는 반듯이 있어야 합니다.';

    return false;
  }

  if (!empty($dst_w) && $dst_w < 1){//썸네일의 너비가 존재하는데 0보다 큰 정수가 아닐경우

 //   $GLOBALS['errormsg'] = "썸네일의 너비가 0보다 큰 정수가 아닙니다. ($dst_w)";

    return false;
  }

  if (!empty($dst_h) && $dst_h < 1){//썸네일의 높이가 존재하는데 0보다 큰 정수가 아닐경우

//    $GLOBALS['errormsg'] = "썸네일의 높이가 0보다 큰 정수가 아닙니다. ($dst_h)";

    return false;
  }


  //썸네일의 너비와 높이가 둘중에 하나가 없는 경우에는 정비율을 의미하며, 비율데로 너비와 높이를 결정한다.
  if (empty($dst_w) || empty($dst_h)) {

    if (empty($dst_h)) $dst_h = get_size_by_rule($src_w, $src_h, $dst_w, 'width');
    else $dst_w = get_size_by_rule($src_w, $src_h, $dst_h, 'height');
  }


  //$dst_w , $dst_h 크기의 썸네일 리소스를 생성한다.
  $dst = @imagecreatetruecolor ($dst_w , $dst_h);
  if ($dst === false) {

//    $GLOBALS['errormsg'] = "$dst_w , $dst_h 크기의 썸네일 리소스를 생성하지 못했습니다.";

    return false;
  }


  //썸네일의 너비를 기준으로 정비율의 썸네일의 높이를 구한다.
  $s_w = $dst_w;
  $s_h = get_size_by_rule($src_w, $src_h, $s_w, 'width');


  //기본값
  $src_x = 0;
  $src_y = 0;
  $src_nw = $src_w;
  $src_nh = $src_h;


  if ($dst_h != $s_h) {//높이가 다름, 즉, 크롭을 해야 한다는 뜻

    if ($dst_h < $s_h) {//지정된 높이가 정비율 높이 보다 작을경우, 높이를 기준으로 $pos_height 로 크롭

      //썸네일의 너비와 높이를 가지고 정비율의 큰이미지의 높이를 구한다.
      $src_nh = get_bigsize_by_rule($dst_w, $dst_h, $src_w, 'width');

      $src_x = 0;

      if ($pos_height == 1) $src_y = 0;//상단 기준점 y좌표 구함
      else if ($pos_height == 2) $src_y = ceil(($src_h - $src_nh) / 2);//가운데 기준점 y좌표 구함
      else $src_y = $src_h - $src_nh;//하단 기준점 y좌표 구함
    }
    else {//지정된 높이가 정비율 높이 보다 큰경우, 너비를 기준으로 $pos_width 크롭

      ////썸네일의 너비와 높이를 가지고 정비율의 원본 너비를 구한다.
      $src_nw = get_bigsize_by_rule($dst_w, $dst_h, $src_h, 'height');

      if ($pos_width == 1) $src_x = 0;//왼쪽 기준점 y좌표 구함
      else if ($pos_width == 2) $src_x = ceil(($src_w - $src_nw) / 2);//중앙 기준점 y좌표 구함
      else $src_x = $src_w - $src_nw;//오른쪽 기준점 y좌표 구함

      $src_y = 0;
    }
  }

  $result_resize = imagecopyresampled ($dst , $src , 0 , 0 , $src_x , $src_y , $dst_w , $dst_h , $src_nw , $src_nh );
  if ($result_resize === false) {

//    $GLOBALS['errormsg'] = "$dst_w , $dst_h 크기로 크롭 및 리사이즈에 실패하였습니다.";

    return false;
  }

  return $dst;
}



function get_bigsize_by_rule($dst_w, $dst_h, $src_size, $rule='width'){

  //정수형이 아니라면 정수형으로 강제 형변환
  if (!is_int($dst_w)) settype($dst_w, 'int');
  if (!is_int($dst_h)) settype($dst_h, 'int');
  if (!is_int($src_size)) settype($src_size, 'int');

  if ($dst_w < 1 || $dst_h < 1){//썸네일의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우

//    $GLOBALS['errormsg'] = "썸네일의 너비와 높이가 0보다 큰 정수가 아닙니다. ($dst_w, $dst_h)";

    return false;
  }

  if ($src_size < 1){//원본의 사이즈가 0보다 큰 정수가 아닐경우

 //   $GLOBALS['errormsg'] = "원본의 사이즈가 0보다 큰 정수가 아닙니다. ($src_size)";

    return false;
  }

  if ($rule != 'height') {//기준값이 너비일 경우, 값이 height 가 아니면 전부 width 로 판단

    return ceil($src_size / $dst_w * $dst_h);
  }
  else {//기준값이 높이일 경우

    return ceil($src_size / $dst_h * $dst_w);
  }
}






function get_size_by_rule($src_w, $src_h, $dst_size, $rule='width'){

  //정수형이 아니라면 정수형으로 강제 형변환
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($dst_size)) settype($dst_size, 'int');

  if ($src_w < 1 || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우

 //   $GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";

    return false;
  }

  if ($dst_size < 1){//리사이즈 될 사이즈가 0보다 큰 정수가 아닐경우

//    $GLOBALS['errormsg'] = "리사이즈될 사이즈가 0보다 큰 정수가 아닙니다. ($dst_size)";

    return false;
  }

  if ($rule != 'height') {//기준값이 너비일 경우, 값이 height 가 아니면 전부 width 로 판단

    return ceil($dst_size / $src_w * $src_h);
  }
  else {//기준값이 높이일 경우

    return ceil($dst_size / $src_h * $src_w);
  }
}




function get_image_resource_from_file($path_file){

  // memory limit 설정 변경
  @ini_set("memory_limit", -1);

  if (!is_file($path_file)) {//파일이 아니라면

 //   $GLOBALS['errormsg'] = $path_file . '은 파일이 아닙니다.';

    return Array();
  }

  $size = @getimagesize($path_file);

  if (empty($size[2])) {//이미지 타입이 없다면

//    $GLOBALS['errormsg'] = $path_file . '은 이미지 파일이 아닙니다.';

    return Array();
  }

  if ($size[2] != 1 && $size[2] != 2 && $size[2] != 3 && $size[2] != 6) {//지원하는 이미지 타입이 아니라면

 //   $GLOBALS['errormsg'] = $path_file . '은 gif 나 jpg, png, bmp 파일이 아닙니다.';

    return Array();
  }

  switch($size[2]){//image type에 따라 이미지 리소스를 생성한다.

    case 1 : //gif

      $im = @imagecreatefromgif($path_file);
      break;

    case 2 : //jpg

      $im = @imagecreatefromjpeg($path_file);
      break;

    case 3 : //png

      $im = @imagecreatefrompng($path_file);
      break;

    case 6 : //bmp

      $im = @imagecreatefrombmp($path_file);
      break;
  }

  if ($im === false) {//이미지 리소스를 가져오기에 실패하였다면
  //  $GLOBALS['errormsg'] = $path_file . ' 에서 이미지 리소스를 가져오는 것에 실패하였습니다.';

    return Array();
  }
  else {//이미지 리소스를 가져오기에 성공하였다면

    $return = $size;
    $return[0] = $im;
    $return[1] = $size[0];//너비
    $return[2] = $size[1];//높이
    $return[3] = $size[2];//이미지타입
    $return[4] = $size[3];//이미지 attribute

    return $return;
  }
}



function ConvertBMP2GD($src, $dest = false) {

  if(!($src_f = fopen($src, "rb"))) {

    return false;
  }

  if(!($dest_f = fopen($dest, "wb"))) {

    return false;
  }

  $header = unpack("vtype/Vsize/v2reserved/Voffset", fread($src_f, 14));
  $info = unpack("Vsize/Vwidth/Vheight/vplanes/vbits/Vcompression/Vimagesize/Vxres/Vyres/Vncolor/Vimportant",
  fread($src_f, 40));

  extract($info);
  extract($header);

  if($type != 0x4D42) { // signature "BM"

    return false;
  }

  $palette_size = $offset - 54;
  $ncolor = $palette_size / 4;
  $gd_header = "";
  // true-color vs. palette
  $gd_header .= ($palette_size == 0) ? "\xFF\xFE" : "\xFF\xFF";
  $gd_header .= pack("n2", $width, $height);
  $gd_header .= ($palette_size == 0) ? "\x01" : "\x00";
  if($palette_size) {

    $gd_header .= pack("n", $ncolor);
  }
  // no transparency
  $gd_header .= "\xFF\xFF\xFF\xFF";

  fwrite($dest_f, $gd_header);

  if($palette_size) {

    $palette = fread($src_f, $palette_size);
    $gd_palette = "";
    $j = 0;
    while($j < $palette_size) {

      $b = $palette{$j++};
      $g = $palette{$j++};
      $r = $palette{$j++};
      $a = $palette{$j++};
      $gd_palette .= "$r$g$b$a";
    }
    $gd_palette .= str_repeat("\x00\x00\x00\x00", 256 - $ncolor);
    fwrite($dest_f, $gd_palette);
  }

  $scan_line_size = (($bits * $width) + 7) >> 3;
  $scan_line_align = ($scan_line_size & 0x03) ? 4 - ($scan_line_size & 0x03) : 0;

  for($i = 0, $l = $height - 1; $i < $height; $i++, $l--) {

    // BMP stores scan lines starting from bottom
    fseek($src_f, $offset + (($scan_line_size + $scan_line_align) * $l));
    $scan_line = fread($src_f, $scan_line_size);
    if($bits == 24) {

      $gd_scan_line = "";
      $j = 0;
      while($j < $scan_line_size) {

        $b = $scan_line{$j++};
        $g = $scan_line{$j++};
        $r = $scan_line{$j++};
        $gd_scan_line .= "\x00$r$g$b";
      }
    }
    else if($bits == 8) {

      $gd_scan_line = $scan_line;
    }
    else if($bits == 4) {

      $gd_scan_line = "";
      $j = 0;
      while($j < $scan_line_size) {

        $byte = ord($scan_line{$j++});
        $p1 = chr($byte >> 4);
        $p2 = chr($byte & 0x0F);
        $gd_scan_line .= "$p1$p2";
      }

      $gd_scan_line = substr($gd_scan_line, 0, $width);
    }
    else if($bits == 1) {

      $gd_scan_line = "";
      $j = 0;
      while($j < $scan_line_size) {

        $byte = ord($scan_line{$j++});
        $p1 = chr((int) (($byte & 0x80) != 0));
        $p2 = chr((int) (($byte & 0x40) != 0));
        $p3 = chr((int) (($byte & 0x20) != 0));
        $p4 = chr((int) (($byte & 0x10) != 0));
        $p5 = chr((int) (($byte & 0x08) != 0));
        $p6 = chr((int) (($byte & 0x04) != 0));
        $p7 = chr((int) (($byte & 0x02) != 0));
        $p8 = chr((int) (($byte & 0x01) != 0));
        $gd_scan_line .= "$p1$p2$p3$p4$p5$p6$p7$p8";
      }
      $gd_scan_line = substr($gd_scan_line, 0, $width);
    }

    fwrite($dest_f, $gd_scan_line);
  }
  fclose($src_f);
  fclose($dest_f);
  return true;
}




function imagecreatefrombmp($filename) {

  $tmp_name = tempnam("/tmp", "GD");
  if(ConvertBMP2GD($filename, $tmp_name)) {

    $img = imagecreatefromgd($tmp_name);
    unlink($tmp_name);
    return $img;
  }
  return false;
}








function save_image_from_resource ($im, $path_save_file, $quality=70, $save_force=0){

  $path_save_dir = dirname($path_save_file);//저장 파일 경로에서 상위 디렉토리 경로를 가져옴
  if (!is_dir($path_save_dir)) {//상위디렉토리가 디렉토리가 아니라면

  //  $GLOBALS['errormsg'] = $path_save_dir . '은 디렉토리가 아닙니다.';

    return false;
  }

  if (!is_writable($path_save_dir)){//해당 디렉토리에 파일을 저장할 권한이 없다면

//    $GLOBALS['errormsg'] = $path_save_dir . '에 이미지를 저장할 권한이 없습니다.';

    return false;
  }

  if (is_dir($path_save_file)) {//같은 이름의 디렉토리가 존재하면

 //   $GLOBALS['errormsg'] = $path_save_file . '은 이미 같은 이름의 디렉토리가 존재합니다.';

    return false;
  }

  if (is_file($path_save_file)){//같은 이름의 파일이 존재하면

    if ($save_force == 1) {//새로 저장하지 않고 true 반환

      return true;
    }
    else if ($save_force == 2){//기존 파일은 삭제

      $result_unlink = @unlink($path_save_file);
      if ($result_unlink === false) {//기존 이미지 삭제에 실패

  //      $GLOBALS['errormsg'] = '기존에 존재하던 ' . $path_save_file . '의 삭제에 실패하였습니다.';

        return false;
      }
    }
    else {//0 이거나 정해지지 않은 값일때 false를 반환

//      $GLOBALS['errormsg'] = $path_save_file . '은 이미 같은 이름의 파일이 존재합니다.';

      return false;
    }

  }

  //파일명에서 마지막 . 을 기준으로 확장자를 가져와서 소문자로 변환
  $extension = strtolower(substr($path_save_file, strrpos($path_save_file, '.') + 1));

  switch($extension){//확장자에 따라 이미지 저장 처리

    case 'gif' :

      $result_save = @imagegif($im, $path_save_file);
      break;

    case 'jpg' :

    case 'jpeg' :

      $result_save = @imagejpeg($im, $path_save_file, $quality);
      break;

    default : //확장자 png 또는 확장자가 없는 경우, 정의되지 않는 확장자인 경우는 모두 png로 저장

      $result_save = @imagepng($im, $path_save_file);
  }

  if ($result_save === false) {//이미지 저장에 실패

//    $GLOBALS['errormsg'] = $path_save_file . '의 저장에 실패하였습니다.';

    return false;
  }
  else {//이미지 저장에 성공

    return true;
  }
}





function get_image_resize($src, $src_w, $src_h, $dst_w, $dst_h=0){

  if (empty($src))  {//원본의 리소스 id 가 빈값일 경우

    $GLOBALS['errormsg'] = '원본 리소스가 없습니다.';

    return false;
  }

  //정수형이 아니라면 정수형으로 강제 형변환
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($dst_w)) settype($dst_w, 'int');
  if (!is_int($dst_h)) settype($dst_h, 'int');

  if ($src_w < 1 || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우

 //   $GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";

    return false;
  }

  if (empty($dst_w) && empty($dst_h)) {//썸네일의 너비와 높이 둘다 없을 경우

 //   $GLOBALS['errormsg'] = '썸네일의 너비와 높이는 둘중에 하나는 반듯이 있어야 합니다.';

    return false;
  }

  if (!empty($dst_w) && $dst_w < 1){//썸네일의 너비가 존재하는데 0보다 큰 정수가 아닐경우

 //   $GLOBALS['errormsg'] = "썸네일의 너비가 0보다 큰 정수가 아닙니다. ($dst_w)";

    return false;
  }

  if (!empty($dst_h) && $dst_h < 1){//썸네일의 높이가 존재하는데 0보다 큰 정수가 아닐경우

//    $GLOBALS['errormsg'] = "썸네일의 높이가 0보다 큰 정수가 아닙니다. ($dst_h)";

    return false;
  }


  //썸네일의 너비와 높이가 둘중에 하나가 없는 경우에는 정비율을 의미하며, 비율데로 너비와 높이를 결정한다.
  if (empty($dst_w) || empty($dst_h)) {

    if (empty($dst_h)) $dst_h = get_size_by_rule($src_w, $src_h, $dst_w, 'width');
    else $dst_w = get_size_by_rule($src_w, $src_h, $dst_h, 'height');
  }


  //$dst_w , $dst_h 크기의 썸네일 리소스를 생성한다.
  $dst = @imagecreatetruecolor ($dst_w , $dst_h);
  if ($dst === false) {

//    $GLOBALS['errormsg'] = "$dst_w , $dst_h 크기의 썸네일 리소스를 생성하지 못했습니다.";

    return false;
  }


  //리사이즈 처리
  $result_resize = imagecopyresampled ($dst , $src , 0 , 0 , 0 , 0 , $dst_w , $dst_h , $src_w , $src_h );
  if ($result_resize === false) {

 //   $GLOBALS['errormsg'] = "$dst_w , $dst_h 크기로 리사이즈에 실패하였습니다.";

    return false;
  }

  return $dst;
}



//업로드 파일명 변경
function get_file_name($upload_dir, $file_name){

  global $g4;

  // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
  $file_name = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $file_name);

  // 접미사를 붙인 파일명
  //$upload[$i][file] = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr(md5(uniqid($jb2[server_time])),0,8).'_'.urlencode($filename);
  // 달빛온도님 수정 : 한글파일은 urlencode($filename) 처리를 할경우 '%'를 붙여주게 되는데 '%'표시는 미디어플레이어가 인식을 못하기 때문에 재생이 안됩니다. 그래서 변경한 파일명에서 '%'부분을 빼주면 해결됩니다.
  $file_name = abs(ip2long($_SERVER[REMOTE_ADDR])).'_'.substr(md5(uniqid($g4[server_time])),0,8).'_'.str_replace('%', '', urlencode($file_name));

  // duplicate check
  srand((double)microtime()*1000000);
  while (file_exists($upload_dir.$file_name)) {

    $seed = rand(100,999);
    $file_name=$seed."_".$file_name;
    if (!file_exists($upload_dir.$file_name)) break;
  }

  return $file_name;
}



// 업로드 확장자 체크
function allow_file_type($file_type, $allow_type){

  $rtn = false;
  $allow_type_array = explode(",", $allow_type);
  if (in_array($file_type, $allow_type_array))
  $rtn = true;

  return $rtn;
}
// 단일 업로드관련 끝






// PHP암호화 함수
function hd_encrypt($data,$k) {
  $encrypt_these_chars = "1234567890ABCDEFGHIJKLMNOPQRTSUVWXYZabcdefghijklmnopqrstuvwxyz.,/?!$@^*()_+-=:;~{}";
  $t = $data;
  $result2;
  $ki;
  $ti;
  $keylength = strlen($k);
  $textlength = strlen($t);
  $modulo = strlen($encrypt_these_chars);
  $dbg_key;
  $dbg_inp;
  $dbg_sum;
  for ($result2 = "", $ki = $ti = 0; $ti < $textlength; $ti++, $ki++) {
    if ($ki >= $keylength) {
      $ki = 0;
    }
    $dbg_inp += "["+$ti+"]="+strpos($encrypt_these_chars, substr($t, $ti,1))+" ";
    $dbg_key += "["+$ki+"]="+strpos($encrypt_these_chars, substr($k, $ki,1))+" ";
    $dbg_sum += "["+$ti+"]="+strpos($encrypt_these_chars, substr($k, $ki,1))+ strpos($encrypt_these_chars, substr($t, $ti,1)) % $modulo +" ";
    $c = strpos($encrypt_these_chars, substr($t, $ti,1));
    $d;
    $e;
    if ($c >= 0) {
      $c = ($c + strpos($encrypt_these_chars, substr($k, $ki,1))) % $modulo;
      $d = substr($encrypt_these_chars, $c,1);
      $e .= $d;
    } else {
      $e += $t.substr($ti,1);
    }
  }
  $key2 = $result2;
  $debug = "Key  : "+$k+"\n"+"Input: "+$t+"\n"+"Key  : "+$dbg_key+"\n"+"Input: "+$dbg_inp+"\n"+"Enc  : "+$dbg_sum;
  return $e . "";
}

// 쿠키 복호화
function hd_decrypt($key2,$secret) {
  $encrypt_these_chars = "1234567890ABCDEFGHIJKLMNOPQRTSUVWXYZabcdefghijklmnopqrstuvwxyz.,/?!$@^*()_+-=:;~{}";
  $input = $key2;
  $output = "";
  $debug = "";
  $k = $secret;
  $t = $input;
  $result;
  $ki;
  $ti;
  $keylength = strlen($k);
  $textlength = strlen($t);
  $modulo = strlen($encrypt_these_chars);
  $dbg_key;
  $dbg_inp;
  $dbg_sum;
  for ($result = "", $ki = $ti = 0; $ti < $textlength; $ti++, $ki++) {
    if ($ki >= $keylength){
      $ki = 0;
    }
    $c = strpos($encrypt_these_chars, substr($t, $ti,1));
    if ($c >= 0) {
      $c = ($c - strpos($encrypt_these_chars , substr($k, $ki,1)) + $modulo) % $modulo;
      $result .= substr($encrypt_these_chars , $c, 1);
    } else {
      $result += substr($t, $ti,1);
    }
  }
  return $result;
}




// filesize는 KB 단위로 저장
function hd_filesize2bytes($str) {
    $bytes = 0;

    $bytes_array = array(
        'B' => 1,
        'KB' => 1024,
        'MB' => 1024 * 1024,
        'GB' => 1024 * 1024 * 1024,
        'TB' => 1024 * 1024 * 1024 * 1024,
        'PB' => 1024 * 1024 * 1024 * 1024 * 1024,
    );

    $bytes = floatval($str);

    if (preg_match('#([KMGTP]?B)$#si', $str, $matches) && !empty($bytes_array[$matches[1]])) {
        $bytes *= $bytes_array[$matches[1]];
    }

    $bytes = intval(round($bytes, 2));

    return $bytes;
}

function latest2($skin_dir="", $bo_table, $rows=10, $subject_len=40, $options="")
{
    global $g4;

    if ($skin_dir)
        $latest_skin_path = "$g4[path]/skin/latest/$skin_dir";
    else
        $latest_skin_path = "$g4[path]/skin/latest/basic";

    $list = array();

    $sql = " select * from $g4[board_table] where bo_table = '$bo_table'";
    $board = sql_fetch($sql);

    $tmp_write_table = $g4['write_prefix'] . $bo_table; // 게시판 테이블 전체이름
    //$sql = " select * from $tmp_write_table where wr_is_comment = 0 order by wr_id desc limit 0, $rows ";
    // 위의 코드 보다 속도가 빠름
    if($options)
      $sql = " select * from $tmp_write_table where wr_is_comment = 0 $options order by wr_num limit 0, $rows ";
    else
      $sql = " select * from $tmp_write_table where wr_is_comment = 0 order by wr_num limit 0, $rows ";
    //explain($sql);
    $result = sql_query($sql);
    for ($i=0; $row = sql_fetch_array($result); $i++)
        $list[$i] = get_list($row, $board, $latest_skin_path, $subject_len);

    ob_start();
    include "$latest_skin_path/latest.skin.php";
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

function hotSale($skin_dir="", $bo_table, $rows=10, $subject_len=40, $options="")
{
    global $g4;

    if ($skin_dir)
        $latest_skin_path = "$g4[path]/skin/latest/$skin_dir";
    else
        $latest_skin_path = "$g4[path]/skin/latest/basic";

    $list = array();

    $sql = " select * from $g4[board_table] where bo_table = '$bo_table'";
    $board = sql_fetch($sql);

    $tmp_write_table = $g4['write_prefix'] . $bo_table; // 게시판 테이블 전체이름

    //explain($sql);
	// 1. 할인율 최대값을 구한다.
	$sql = " select * from $tmp_write_table where wr_is_comment = 0 order by discount desc limit 0, $rows ";

	$result = sql_query($sql);
    for ($i=0; $row = sql_fetch_array($result); $i++)
        $list[$i] = get_list($row, $board, $latest_skin_path, $subject_len);

    ob_start();
    include "$latest_skin_path/latest.skin.php";
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

function newStay($skin_dir="", $bo_table, $rows=10, $subject_len=40, $options="")
{
    global $g4;

    if ($skin_dir)
        $latest_skin_path = "$g4[path]/skin/latest/$skin_dir";
    else
        $latest_skin_path = "$g4[path]/skin/latest/basic";

    $list = array();

    $sql = " select * from $g4[board_table] where bo_table = '$bo_table'";
    $board = sql_fetch($sql);

    $tmp_write_table = $g4['write_prefix'] . $bo_table; // 게시판 테이블 전체이름

    //explain($sql);
	$sql = " select * from $tmp_write_table where wr_is_comment = 0 order by wr_num limit 0, $rows ";

	$result = sql_query($sql);
    for ($i=0; $row = sql_fetch_array($result); $i++)
        $list[$i] = get_list($row, $board, $latest_skin_path, $subject_len);

    ob_start();
    include "$latest_skin_path/latest.skin.php";
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
?>
