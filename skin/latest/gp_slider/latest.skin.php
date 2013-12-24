<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

//썸네일 기본값 설정
$thumb_w = '64'; //썸네일넓이
$thumb_h = '64';   //썸네일높이

$data_path = $g4['path'] . "/data/file/" . $bo_table;
$thumb_path = $data_path . "/thumb_" . $skin_dir;

if (!is_dir($thumb_path)){
  @mkdir($thumb_path, 0707);
  @chmod($thumb_path, 0707);
}
?>

<script type="text/javascript" src="<?php echo $g4['path']?>/skin/latest/gp_slider/js/jquery.slider.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$('#slider1').bxSlider({
		pause: 3500,
		mode: 'fade',
		auto: true,
		autoHover:true,
		autoControls: false,
		autoControlsCombine:true,
		controls:true,
		pagerCustom: '#slider1-pager'
	});
});
</script>

<div class="gp-slider">
	<ul id="slider1">
	<?php
	for ($i=0; $i<count($list); $i++) {
		$li = $list[$i];

		$content_img_array = "";
		$content_img_array = hd_get_content_img($list[$i][wr_content]);

		$thumb = array();

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

		<li><img src="<?php echo $image_file;?>"></li>

<?php }    // for end

	if ($i==0) { echo "<li style='width:100%; text-align:center; padding:10px 0; border-top:1px solid #ddd;'>게시물이 없습니다.</li>"; }
    ?>
	</ul>

	<ul id="slider1-pager">
		<?php for ($num = 0; $num < $rows; $num++) {	?>
		<li><a data-slide-index="<?=$num?>" href=""><img src="<?php echo $tm['tm'][$num];?>" alt="" /></a></li>
		<?php }?>
	</ul>

	</div>
