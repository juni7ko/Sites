<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once('../search.php');   // 검색 include

if($where) $where2 = " and " . $where;

$img_width   = 220;
$img_height  = 180;
$img_quality = 95;

if (!$img_width) alert("게시판 설정 : 여분 필드 1 에 목록에서 보여질 이미지의 폭을 설정하십시오. (픽셀 단위)");
if (!$img_height) alert("게시판 설정 : 여분 필드 2 에 목록에서 보여질 이미지의 높이를 설정하십시오. (픽셀 단위)");
if (!$img_quality) alert("게시판 설정 : 여분 필드 3 에 목록에서 보여질 이미지의 질(quality)을 비율로 설정하십시오. (100 이하)");
if (!function_exists("imagecopyresampled")) alert("GD 2.0.1 이상 버전이 설치되어 있어야 사용할 수 있는 갤러리 게시판 입니다.");

$data_path = $g4[path]."/data/file/$bo_table";
$thumb_path = $data_path.'/thumb';

@mkdir($thumb_path, 0707);
@chmod($thumb_path, 0707);

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 6;

//if ($is_category) $colspan++;
// if ($is_checkbox) $colspan++;
// if ($is_good) $colspan++;
// if ($is_nogood) $colspan++;

// 제목이 두줄로 표시되는 경우 이 코드를 사용해 보세요.
// <nobr style='display:block; overflow:hidden; width:000px;'>제목</nobr>
?>
<style type="text/css">
span.reser_name {
	padding:2px 0;
	margin-top:5px;
	float:left;
}
span.reser_btn a {
	width: 35px;
	display: inline-block;
	padding: 2px 0;
	margin-top: 5px;
	background: #f47a98;
	border: 1px solid #e23660;
	color: #fff;
	font-size: 11px;
	font-weight: bold;
	text-decoration: none;
	max-width: 50px;
	text-align:center;
	float:right;
}

span.reser_btn a:hover {
	background: #84cfd6;
	border: 1px solid #00aebd;
}
</style>

<!-- 게시판 목록 시작 -->

<!-- 분류 셀렉트 박스, 게시물 몇건, 관리자화면 링크 -->
<table width="980" cellspacing="0" cellpadding="0" border=0 style="margin:0 auto;">
	<tr height="27">
		<td><span style="font-size:8pt;"><font face="Tahoma" color="#999999">Total. <?=number_format(count($list))?></font></span></td>
	</tr>
</table>

<div id="section">
	<div class="container">
		<form name="fboardlist" method="post" style="margin:0;">
			<input type='hidden' name='bo_table' value='<?=$bo_table?>'>
			<input type='hidden' name='sfl'  value='<?=$sfl?>'>
			<input type='hidden' name='stx'  value='<?=$stx?>'>
			<input type='hidden' name='spt'  value='<?=$spt?>'>
			<input type='hidden' name='page' value='<?=$page?>'>
			<input type='hidden' name='sw'   value=''>
			<table class="tbl">
				<caption>객실정보검색</caption>
				<thead>
					<tr>
						<th width="350">업소명</th>
						<th width="180">객실</th>
						<th width="100">구조</th>
						<th width="80">인원</th>
						<th width="120">추가금액</th>
						<th width="150">요금(원)</th>
					</tr>
				</thead>
				<tbody>
					<?php
					for ($i=0; $i < count($list); $i++) :
						?>
						<tr>
							<?php if($list[$i]['rowspan']) : ?>
							<td class="gallery" rowspan="<?=$list[$i]['rowspan']?>">
								<?php
								$img = "<img src='$board_skin_path/img/noimage.gif' border=0 width='$img_width' height='$img_height' title='이미지 없음' align=left style='border:1 solid #cccccc; padding:0px;'>";
								$thumb = $thumb_path.'/'.$list[$i][wr_id];
								// 썸네일 이미지가 존재하지 않는다면
								if (!file_exists($thumb)) {
									$file = $list[$i][file][0][path] .'/'. $list[$i][file][0][file];
									// 업로드된 파일이 이미지라면
									if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file) && file_exists($file)) {
										$size = getimagesize($file);
										if ($size[2] == 1)
											$src = imagecreatefromgif($file);
										else if ($size[2] == 2)
											$src = imagecreatefromjpeg($file);
										else if ($size[2] == 3)
											$src = imagecreatefrompng($file);
										else
											break;

										$rate = $img_width / $size[0];
										$height = (int)($size[1] * $rate);

										// 계산된 썸네일 이미지의 높이가 설정된 이미지의 높이보다 작다면
										if ($height < $img_height) {
											// 계산된 이미지 높이로 복사본 이미지 생성
											$dst = imagecreatetruecolor($img_width, $height);
										} else {
											// 설정된 이미지 높이로 복사본 이미지 생성
											$dst = imagecreatetruecolor($img_width, $img_height);
										}
										imagecopyresampled($dst, $src, 0, 0, 0, 0, $img_width, $height, $size[0], $size[1]);
										imagejpeg($dst, $thumb_path.'/'.$list[$i][wr_id], $img_quality);
										chmod($thumb_path.'/'.$list[$i][wr_id], 0606);
									}
								}

								if (file_exists($thumb)) {
									$img = "<img src='$thumb' border=0 align=left style='border:1px solid #CCCCCC; padding:0px;'>";
								} else {
									if(preg_match("/\.(swf|wma|asf)$/i","$file") && file_exists($file))
									{
										$img = "<script>doc_write(flash_movie('$file', 'flash$i', '$img_width', '$img_height', 'transparent'));</script>";
									}
								}

								echo "<a href='{$list[$i][href]}' alt='{$list[$i][wr_subject]}' >";
								echo $img;
								echo "</a>";
								?>
								<h3><?php echo  $list[$i]['mb_addr1'] ." ". $list[$i]['mb_addr2'];?> </h3>

								<?php
								$style = "";
								if ( $list[$i]['is_notice'] ) $style = " style='font-weight:bold;'";
								echo "<font color=#777777> <a href='{$list[$i][href]}' $style><strong>";
								echo $list[$i]['subject'];
								echo "</a></strong> </font>";
								?>
								<div><span><a href="<?=$list[$i][href]?>">미리보기</a></span></div>
							</td>
							<?php endif; ?>
							<!-- <tr onmouseover="this.style.backgroundColor='#cAcAcA'" onmouseout="this.style.backgroundColor=''"> -->
							<td>
								<a href="<?=$list[$i][href]?>&rid=<?=$list[$i]['r_info_id']?>&sDate=<?=$schDateTmp?>"><span class="reser_name"><?=$list[$i]['r_info_name']?></span></a>
								<span class="reser_btn"><a href="<?=$list[$i][href]?>&rid=<?=$list[$i]['r_info_id']?>&sDate=<?=$schDateTmp?>">예약</a></span>
							</td>
							<td>
								<?=$list[$i]['r_info_area']?>평(<?=$list[$i]['r_info_area'] * 3.3?>㎡)<br />
								<?=$list[$i]['r_info_type']?>
							</td>
							<td>
								기준<?=$list[$i]['r_info_person1']?>명<br />
								최대<?=$list[$i]['r_info_person2']?>명
							</td>
							<td>
								<?=$list[$i]['r_info_person1']?>명 초과시<br />
								인원당 <?=number_format($list[$i]['r_info_person_add'])?>원
							</td>
							<td class="last">
								<?php
								if($list[$i]['minCost2']) :
									?>
									<div class='blue'>할인 <?=number_format($list[$i]['minCost2'])?>%</div>
									<span style="text-decoration: line-through;"><?=number_format($list[$i]['minCost1'])?>원</span> → <span class="pink"><?=number_format($list[$i]['minCost3'])?>원</span>
									<?php
								else :
									?>
									<span class="pink"><?=number_format($list[$i]['minCost3'])?>원</span>
									<?php
								endif;
								?>
							</td>
						</tr>
						<?php
					endfor;

					if (count($list) == 0) { echo "<tr><td colspan='$colspan' height=100 align=center>게시물이 없습니다.</td></tr>"; }
					?>
				</tbody>

			</table>

		</form>

		<!-- 버튼 링크 -->
		<!-- 게시판 리스트 끝 -->

		<!-- 검색 -->
		<table cellSpacing=1 cellPadding="10" width="100%" bgColor=#dfe4e9 border=0 height="21">
			<tr>
				<td align=middle bgColor=#f6f9fb>
					<form name="fsearch" method="get">
						<input type="hidden" name="bo_table" value="<?=$bo_table?>">
						<input type="hidden" name="sca"      value="<?=$sca?>">
						<select name="sfl" class="sel">
							<option value="wr_subject">펜션이름</option>
							<!-- <option value="area_id">지역</option> -->
							<!--<option value="wr_content">지역</option>-->
							<!-- <option value="wr_subject||wr_content">펜션+지역</option> -->
						</select>
						<input name="stx" class="stx" maxlength="28" itemname="검색어" required value=''>
						<input type="image" src="<?=$board_skin_path?>/img/btn_search.gif" border='0' align="absmiddle">
						<input type="hidden" name="sop" value="or">
					</form>
				</td>
			</tr>
		</table>

		<script language="JavaScript">
			if ('<?=$sca?>') document.fcategory.sca.value = '<?=$sca?>';
		</script>

		<?php
		if ($is_checkbox) {
			?>
			<script language="JavaScript">
				function all_checked(sw) {
					var f = document.fboardlist;

					for (var i=0; i<f.length; i++) {
						if (f.elements[i].name == "chk_wr_id[]")
							f.elements[i].checked = sw;
					}
				}

				function check_confirm(str) {
					var f = document.fboardlist;
					var chk_count = 0;

					for (var i=0; i<f.length; i++) {
						if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
							chk_count++;
					}

					if (!chk_count) {
						alert(str + "할 게시물을 하나 이상 선택하세요.");
						return false;
					}
					return true;
				}

				function select_delete() {
					var f = document.fboardlist;

					str = "삭제";
					if (!check_confirm(str))
						return;

					if (!confirm("선택한 게시물을 정말 "+str+" 하시겠습니까?\n\n한번 "+str+"한 자료는 복구할 수 없습니다"))
						return;

					f.action = "./delete_all.php";
					f.submit();
				}

				function select_copy(sw) {
					var f = document.fboardlist;

					if (sw == "copy")
						str = "복사";
					else
						str = "이동";

					if (!check_confirm(str))
						return;

					var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

					f.sw.value = sw;
					f.target = "move";
					f.action = "./move.php";
					f.submit();
				}
			</script>
			<?php
		}
		?>
		<!-- 게시판 목록 끝 -->
	</div>
</div>