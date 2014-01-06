<?php
$g4_path = ".."; // common.php 의 상대 경로
include_once("$g4_path/common.php");
include_once($g4['path'].'/head.sub.php');

if(!$r_info_id) alert("잘못된 접근입니다.");

$file = get_file_room('bbs34_r_info', $r_info_id);

if($file[count]) {
?>
	<script type="text/javascript" src="<?=$g4[path]?>/js/jquery.photomatic.js"></script>
	<script type="text/javascript">
	$(function(){
		$('#roomThumb img').photomatic({
			photoElement: '#roomPhoto',
			previousControl: '#previousButton',
			nextControl: '#nextButton',
			firstControl: '#firstButton',
			lastControl: '#lastButton'
		});
	});
	</script>
	<style type="text/css">
	#roomPhoto {
		width:648px;
		height:433px;
	}

	#roomThumb div { padding:2px; }
	#roomThumb img {
		width:77px;
		height:41px;
	}
	</style>

	<div id="photoContainer">
		<img id="roomPhoto" src=""/>
	</div>
	<div class="small-thumb-area">
		<div id="roomThumb">
		<?php
		for($i=0; $i < $file[count]; $i++) {
			$fsql = " SELECT bf_file from $g4[pension_file_table] where bo_table = 'bbs34_r_info' and wr_id = '$r_info_id' and bf_no = '$i' order by bf_no ";
	    	$row = sql_fetch($fsql);
	    	if ($row[bf_file]) {
	            $imgList[$i] = "{$g4[path]}/data/file/roomFile/{$row[bf_file]}";
	            echo "<div style='float:left;'><img class='thumb' src='" . $imgList[$i] . "' /></div>";
	       }
	    }
		?>
			<br style="clear:both; line-heiht:0px; font-size:0;" />
		</div>
	</div>
<?php
}

$csql = " SELECT * FROM g4_write_bbs34_r_info WHERE r_info_id = '$r_info_id' LIMIT 1 ";
$rInfo = sql_fetch($csql);
if($rInfo[r_info_content]) {
?>
	<div id="roomContent" style="margin-top:5px;">
		<table class="tbl">
			<caption>객실정보</caption>
			<tr>
				<th width="150">객실명</th>
				<td class="alignLeft"><?=$rInfo[r_info_name];?></td>
			</tr>
			<tr>
				<th>구조/넓이</th>
				<td class="alignLeft">
					<?=$rInfo['r_info_area']?>평(<?=$rInfo['r_info_area'] * 3.3?>㎡)<br />
					<?=$rInfo['r_info_type']?>
				</td>
			</tr>
			<tr>
				<th>기준인원</th>
				<td class="alignLeft">
					기준<?=$rInfo['r_info_person1']?>명<br />
					최대<?=$rInfo['r_info_person2']?>명
				</td>
			</tr>
			<tr>
				<th>특이사항</th>
				<td class="alignLeft">
					<!-- 내용 출력 -->
					<span id="writeContents"><?=$rInfo[r_info_content];?></span>

					<?php//echo $view[rich_content]; // {이미지:0} 과 같은 코드를 사용할 경우?>
					<!-- 테러 태그 방지용 --></xml></xmp><a href=""></a><a href=''></a>
				</td>
			</tr>
		</table>
	</div>
<?php
}

include_once("$g4[path]/tail.sub.php");
?>