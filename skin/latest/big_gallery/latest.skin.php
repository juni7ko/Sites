<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

//썸네일 기본값 설정
$thumb_w = '690'; //썸네일넓이
$thumb_h = '290';   //썸네일높이

$data_path = $g4['path'] . "/data/file/" . $bo_table;
$thumb_path = $data_path . "/thumb_" . $skin_dir;

if (!is_dir($thumb_path)){
  @mkdir($thumb_path, 0707);
  @chmod($thumb_path, 0707);
}
?>

	<?php
	for ($i=0; $i<count($list); $i++) {
		$li = $list[$i];

		$content_img_array = "";
		$content_img_array = hd_get_content_img($list[$i][wr_content]);

		$thumb = array();

		// 컨텐츠 내용 삽입
		$wr_content = preg_replace("/<(.*?)\>/"," ",$list[$i][wr_content]); 
		$wr_content = preg_replace("/&nbsp;/"," ",$wr_content); 
		$wr_content = str_replace("//##", " ", $wr_content); 
		$wr_content = cut_str(get_text($wr_content), 50, '…');


		// 파일첨부 이미지 썸네일
		if (is_array($list[$i]['file'])) {
			foreach($list[$i]['file'] as $k => $v){

				$temp_thumb = $thumb_path."/". $v['file']; // 썸네일 경로와 파일명
				$image_file = $data_path . '/' . $v['file']; // 원본 경로와 파일명
				if(!file_exists($thumb_path."/". $v['file'])){
					if(make_thumnail($image_file, $temp_thumb, $thumb_w, $thumb_h))  // 썸네일만 생성
						$thumb[] = $thumb_path."/". $v['file']; // 썸네일이 생성되면 배열에 썸네일 경로를 넣음
				}else if($list[$i][file][$k][view]){
					$thumb[] = $thumb_path."/". $v['file']; // 썸네일이 생성되면 배열에 썸네일 경로를 넣음
				}
                
			}
		}

		// 에디터 이미지 썸네일
		foreach($content_img_array as $k => $v){

			$Imgfilename = hd_get_imgname($v);
			$temp_thumb = $thumb_path."/". $Imgfilename[1]; // 썸네일 경로와 파일명
			$v = trim($v);
			$image_file = (preg_match("`^(/|http)`i", $v)) ? str_replace(dirname(__FILE__), '', $_SERVER['DOCUMENT_ROOT'] . preg_replace("`https?://[^/]+`i", '', $v)) : $v;
			if(!file_exists($thumb_path."/". $Imgfilename[1])){
			//	if(make_thumnail($image_file, $temp_thumb, $thumb_w, $thumb_h,$crop_use = 1,$crop_pos_width = 2,$crop_pos_height = 2))  // 썸네일만 생성
					$thumb[] = $thumb_path."/". $Imgfilename[1]; // 썸네일이 생성되면 배열에 썸네일 경로를 넣음
			}else{
				$thumb[] = $thumb_path."/". $Imgfilename[1]; // 썸네일이 생성되면 배열에 썸네일 경로를 넣음
			}
		}
		if($thumb[0]){
			$thumb = $thumb[0];
		} else {
			$thumb = "{$latest_skin_path}/img/no-image.gif";
		}

$tm['tm'][$i] = $thumb;

?>


				<div class="gallery-area">
					<a href="<?php echo $list[$i]['href']?>">
						<img src="<?=$thumb?>" class="image" alt="<?=$list[$i]['subject']?>" />
						<div class="gallery_box">
							<div class="ps_info">
								<img src="<?=$thumb?>" width=100 height=100 alt="펜션프로필사진">
								<div class="title">
									<h2><?=$list[$i]['subject']?></h2>
									<span><?=$list[$i][wr_content]?></span>
								</div>
	
								<ul class="section1">
									<li class="location">LOCATION</li>
									<li><h3><?=$list[$i]['mb_addr1']?></h3></li>
									<li class="view">CLICK TO</li>
									<li><h3><?=$list[$i]['wr_hit'] ?></h3></li>
									<li class="comment">COMMENT</li>
									<li><h3><?=$list[$i]['wr_comment'] ?></h3></li>
								</ul>
								
							</div><!-- ps_info -->
						</div><!-- /gallery_box -->
					</a>
				</div><!-- /gallery-area -->

<?php }    // for end

	if ($i==0) { echo '<div>컨텐츠가 없습니다.</div>'; }
    ?>
