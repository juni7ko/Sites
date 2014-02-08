<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

//썸네일 기본값 설정
$thumb_w = '270'; //썸네일넓이
$thumb_h = '180';   //썸네일높이

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

				<div class="section-group">
					<div class="left">
						<div class="discount-contents"><h6><?=$list[$i]['discount']?></h6></div>
						<a href="<?php echo $list[$i]['href']?>"><img src="<?=$thumb?>" class="image" alt="<?=$list[$i]['subject']?>" /></a>
					</div>
					<div class="right">
						<h1><?=$list[$i]['subject']?></h1>
						<h5>
<?php
echo $list[$i][cf1] ? "바다. " : NULL;
echo $list[$i][cf2] ? "계곡. " : NULL;
echo $list[$i][cf3] ? "강/호수. " : NULL;
echo $list[$i][cf4] ? "산. " : NULL;
echo $list[$i][cf5] ? "섬. " : NULL;
echo $list[$i][cf21] ? "해수욕장. " : NULL;
echo $list[$i][cf22] ? "레프팅. " : NULL;
echo $list[$i][cf23] ? "MT/워크샵. " : NULL;
echo $list[$i][cf24] ? "갯벌. " : NULL;
echo $list[$i][cf25] ? "스키장. " : NULL;
echo $list[$i][cf26] ? "수상레저. " : NULL;
echo $list[$i][cf27] ? "스파. " : NULL;
echo $list[$i][cf28] ? "풍산/수목원/휴양림. " : NULL;
echo $list[$i][cf29] ? "낚시. " : NULL;
echo $list[$i][cf31] ? "골프장주변. " : NULL;
echo $list[$i][cf32] ? "커플전용. " : NULL;
echo $list[$i][cf33] ? "전망(바다/강). " : NULL;
echo $list[$i][cf34] ? "복층구조. " : NULL;
echo $list[$i][cf35] ? "독채. " : NULL;
echo $list[$i][cf36] ? "소규모(10인이상). " : NULL;
echo $list[$i][cf37] ? "대규모(50인이상). " : NULL;
echo $list[$i][cf38] ? "계곡주변. " : NULL;
echo $list[$i][cf51] ? "매점. " : NULL;
echo $list[$i][cf52] ? "식사가능. " : NULL;
echo $list[$i][cf53] ? "애완견동반. " : NULL;
echo $list[$i][cf54] ? "파티/이벤트. " : NULL;
echo $list[$i][cf55] ? "보드게임. " : NULL;
echo $list[$i][cf56] ? "픽업가능. " : NULL;
echo $list[$i][cf57] ? "인터넷. " : NULL;
echo $list[$i][cf58] ? "영화관람. " : NULL;
echo $list[$i][cf59] ? "카페. " : NULL;
echo $list[$i][cf60] ? "셔틀버스. " : NULL;
echo $list[$i][cf71] ? "간이축구장. " : NULL;
echo $list[$i][cf72] ? "족구장. " : NULL;
echo $list[$i][cf73] ? "바베큐장. " : NULL;
echo $list[$i][cf74] ? "캠프파이어. " : NULL;
echo $list[$i][cf75] ? "노래방. " : NULL;
echo $list[$i][cf76] ? "수영장. " : NULL;
echo $list[$i][cf77] ? "농구장. " : NULL;
echo $list[$i][cf78] ? "세미나실. " : NULL;
echo $list[$i][cf79] ? "스파. " : NULL;
echo $list[$i][cf80] ? "자전거. " : NULL;
echo $list[$i][cf81] ? "4륜오토바이. " : NULL;
echo $list[$i][cf82] ? "서바이벌. " : NULL;
echo $list[$i][cf91] ? "목조형. " : NULL;
echo $list[$i][cf92] ? "통나무형. " : NULL;
echo $list[$i][cf93] ? "황토형. " : NULL;
echo $list[$i][cf94] ? "벽돌형. " : NULL;
?>
						</h5>
						<h3>[<?=$list[$i]['location1'] ." ". $list[$i]['location2']; ?>] <?=$list[$i]['subject'] ?></h3>
						<h4><span class="pink"><?=number_format($list[$i]['lowPrice'])?>원</span></h4>
					</div>
				</div><!-- ./section-group -->

<?php }    // for end
	if ($i==0) { echo '<div>컨텐츠가 없습니다.</div>'; }
?>
