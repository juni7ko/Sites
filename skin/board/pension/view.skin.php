<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>
<script type="text/javascript" src="<?=$board_skin_path?>/view.skin.js"></script>
<script type="text/javascript" src="<?=$g4[path]?>/js/jquery.photomatic.js"></script>
<script type="text/javascript">
$(function(){
	$('#thumbnails img').photomatic({
		photoElement: '#photo',
		previousControl: '#previousButton',
		nextControl: '#nextButton',
		firstControl: '#firstButton',
		lastControl: '#lastButton'
	});
});
</script>
<style type="text/css">
#photo {
	width:370px;
	height:246px;
}
</style>
<!-- 게시글 보기 시작 -->
<div id="section">
	<div class="row">
		<div class="container">

			<div class="detail-gallery-area">
				<div id="photoContainer">
					<img id="photo" src=""/>
				</div>
				<div class="small-thumb-area">
					<ul id="thumbnails">
					<?php
						for ($i=0; $i<=count($view[file]); $i++) {
							if ($view[file][$i][view_small])
							echo "<li>" . $view[file][$i][view_small] . "</li>";
							if($i >= 4) break;
						}
					?>
					</ul>
				</div>
				<div class="gallery-view-btn"><a href="#detail" class="btn">상세보기</a></div>
			</div><!-- ./detail-slide-gallery -->

			<div class="detail-pension-info">
				<table class="tbl-detail">
					<caption>Detail Info</caption>
						<tr>
							<th width="60">펜션명</th>
							<td><?=$view[wr_subject]?></td>
						</tr>
						<tr>
							<th>펜션주소</th>
							<td>
								<?=$view[mb_addr1]?>
								<?=$view[mb_addr2]?>
							</td>
						</tr>
						<tr>
							<th>대표번호</th>
							<td><?=$view[wr_phone1]?></td>
						</tr>
						<?php if($view[payment1] || $view[payment2] || $view[payment3]) {?>
						<tr>
							<th>결제방법</th>
							<td>
								<?=($view[payment1]) ? "<span style='color:blue;'>무통장입금</span>":"";?>
								<?=($view[payment2]) ? "<span style='color:green'>실시간계좌이체</span>":"";?>
								<?=($view[payment3]) ? "<span style='color:red'>신용카드</span>":"";?>
							</td>
						</tr>
						<?php }?>
						<tr>
							<th>무통장계좌</th>
							<td><?=get_text($config[cf_1])?></td>
						</tr>
						<?php /*if($view[payment1] == "1") {?>
						<tr>
							<th>무통장계좌</th>
							<td>
								<?=$view[bank_name]?>
								<?=$view[bank_number]?>
								<?=$view[bank_username]?>
							</td>
						</tr>
						<?php } */ ?>
						<?php if($view[checkin]) {?>
						<tr>
							<th>입실안내</th>
							<td><?=$view[checkin]?></td>
						</tr>
						<?php }?>
						<?php if($view[checkout]) {?>
						<tr>
							<th>퇴실안내</th>
							<td><?=$view[checkout]?></td>
						</tr>
						<?php }?>
						<?php if($view[pickup]) {?>
						<tr>
							<th>픽업안내</th>
							<td><?=$view[pickup]?></td>
						</tr>
						<?php }?>
						<?php if($view[domain_name]) {?>
						<tr>
							<th>홈페이지</th>
							<td><?=$view[domain_name]?></td>
						</tr>
						<?php }?>
						<tr>
							<th>서비스</th>
							<td><span style="">
<?php
echo $view[cf1] ? "바다. " : NULL;
echo $view[cf2] ? "계곡. " : NULL;
echo $view[cf3] ? "강/호수. " : NULL;
echo $view[cf4] ? "산. " : NULL;
echo $view[cf5] ? "섬. " : NULL;
echo $view[cf21] ? "해수욕장. " : NULL;
echo $view[cf22] ? "레프팅. " : NULL;
echo $view[cf23] ? "MT/워크샵. " : NULL;
echo $view[cf24] ? "갯벌. " : NULL;
echo $view[cf25] ? "스키장. " : NULL;
echo $view[cf26] ? "수상레저. " : NULL;
echo $view[cf27] ? "스파. " : NULL;
echo $view[cf28] ? "풍산/수목원/휴양림. " : NULL;
echo $view[cf29] ? "낚시. " : NULL;
echo $view[cf31] ? "골프장주변. " : NULL;
echo $view[cf32] ? "커플전용. " : NULL;
echo $view[cf33] ? "전망(바다/강). " : NULL;
echo $view[cf34] ? "복층구조. " : NULL;
echo $view[cf35] ? "독채. " : NULL;
echo $view[cf36] ? "소규모(10인이상). " : NULL;
echo $view[cf37] ? "대규모(50인이상). " : NULL;
echo $view[cf38] ? "계곡주변. " : NULL;
echo $view[cf51] ? "매점. " : NULL;
echo $view[cf52] ? "식사가능. " : NULL;
echo $view[cf53] ? "애완견동반. " : NULL;
echo $view[cf54] ? "파티/이벤트. " : NULL;
echo $view[cf55] ? "보드게임. " : NULL;
echo $view[cf56] ? "픽업가능. " : NULL;
echo $view[cf57] ? "인터넷. " : NULL;
echo $view[cf58] ? "영화관람. " : NULL;
echo $view[cf59] ? "카페. " : NULL;
echo $view[cf60] ? "셔틀버스. " : NULL;
echo $view[cf71] ? "간이축구장. " : NULL;
echo $view[cf72] ? "족구장. " : NULL;
echo $view[cf73] ? "바베큐장. " : NULL;
echo $view[cf74] ? "캠프파이어. " : NULL;
echo $view[cf75] ? "노래방. " : NULL;
echo $view[cf76] ? "수영장. " : NULL;
echo $view[cf77] ? "농구장. " : NULL;
echo $view[cf78] ? "세미나실. " : NULL;
echo $view[cf79] ? "스파. " : NULL;
echo $view[cf80] ? "자전거. " : NULL;
echo $view[cf81] ? "4륜오토바이. " : NULL;
echo $view[cf82] ? "서바이벌. " : NULL;
echo $view[cf91] ? "목조형. " : NULL;
echo $view[cf92] ? "통나무형. " : NULL;
echo $view[cf93] ? "황토형. " : NULL;
echo $view[cf94] ? "벽돌형. " : NULL;
/*
if($view[cf1]) $cfArr[] = "바다";
if($view[cf2]) $cfArr[] = "계곡";
if($view[cf3]) $cfArr[] = "강/호수";
if($view[cf4]) $cfArr[] = "산";
if($view[cf5]) $cfArr[] = "섬";
if($view[cf21]) $cfArr[] = "해수욕장";
if($view[cf22]) $cfArr[] = "레프팅";
if($view[cf23]) $cfArr[] = "MT/워크샵";
if($view[cf24]) $cfArr[] = "갯벌";
if($view[cf25]) $cfArr[] = "스키장";
if($view[cf26]) $cfArr[] = "수상레저";
if($view[cf27]) $cfArr[] = "스파";
if($view[cf28]) $cfArr[] = "풍산/수목원/휴양림";
if($view[cf29]) $cfArr[] = "낚시";
if($view[cf31]) $cfArr[] = "골프장주변";
if($view[cf32]) $cfArr[] = "커플전용";
if($view[cf33]) $cfArr[] = "전망(바다/강)";
if($view[cf34]) $cfArr[] = "복층구조";
if($view[cf35]) $cfArr[] = "독채";
if($view[cf36]) $cfArr[] = "소규모(10인이상)";
if($view[cf37]) $cfArr[] = "대규모(50인이상)";
if($view[cf38]) $cfArr[] = "계곡주변";
if($view[cf51]) $cfArr[] = "매점";
if($view[cf52]) $cfArr[] = "식사가능";
if($view[cf53]) $cfArr[] = "애완견동반";
if($view[cf54]) $cfArr[] = "파티/이벤트";
if($view[cf55]) $cfArr[] = "보드게임";
if($view[cf56]) $cfArr[] = "픽업가능";
if($view[cf57]) $cfArr[] = "인터넷";
if($view[cf58]) $cfArr[] = "영화관람";
if($view[cf59]) $cfArr[] = "카페";
if($view[cf60]) $cfArr[] = "셔틀버스";
if($view[cf71]) $cfArr[] = "간이축구장";
if($view[cf72]) $cfArr[] = "족구장";
if($view[cf73]) $cfArr[] = "바베큐장";
if($view[cf74]) $cfArr[] = "캠프파이어";
if($view[cf75]) $cfArr[] = "노래방";
if($view[cf76]) $cfArr[] = "수영장";
if($view[cf77]) $cfArr[] = "농구장";
if($view[cf78]) $cfArr[] = "세미나실";
if($view[cf79]) $cfArr[] = "스파";
if($view[cf80]) $cfArr[] = "자전거";
if($view[cf81]) $cfArr[] = "4륜오토바이";
if($view[cf82]) $cfArr[] = "서바이벌";
if($view[cf91]) $cfArr[] = "목조형";
if($view[cf92]) $cfArr[] = "통나무형";
if($view[cf93]) $cfArr[] = "황토형";
if($view[cf94]) $cfArr[] = "벽돌형";

echo "cfArr = " . count($cfArr[]);
foreach($cfArr[] as $cfValue) :
	echo $cfValue . ", ";
endforeach;
*/
?>
								</span>
							</td>
						</tr>
					</table>

					<ul class="pension-info-btn">
						<li class="cols50 cart-add"><a href="#" class="btn">관심등록</a></li>
						<li class="cols50 fav-add"><a href="#" onClick="window.external.AddFavorite('http://pension.interfo.com/', 'Stay Store')" class="btn">즐겨찾기</a></li>
					</ul>

			</div>
			<div class="detail-search-area">
				<a href="#" class="powersearch"><img src="<?=$g4['path']?>/layout/images/power_search_btn.gif" alt="POWER SEARCH" /></a>

				<h3>SPEED SEARCH</h3>
				<div class="speed-search-area">
					<table cellpadding="0" cellspacing="0">
					<caption>Speed Search Option</caption>
					<tbody>
					<tr>
						<th><span>지역</span></th>
						<td>
							<select name="location">
								<option value="지역선택">지역선택</option>
								<option value="강릉/경포대">강릉/경포대</option>
								<option value="강릉/경포대">강릉/경포대</option>
								<option value="강릉/경포대">강릉/경포대</option>
								<option value="강릉/경포대">강릉/경포대</option>
							</select>
						</td>
						<td rowspan="5" class="tbl_banner">
							<!-- banner width 140px , height 150px -->
							<img src="<?=$g4['path']?>/layout/images/ex_banner.gif" alt="banner" />
							<!-- ./banner width 140px , height 150px -->
						</td>
					</tr>
					<tr>
						<th><span>기간</span></th>
						<td>
							<select name="period">
								<option value="기간선택">기간선택</option>
								<option value="1박2일">1박2일</option>
								<option value="2박3일">2박3일</option>
								<option value="3박4일">3박4일</option>
								<option value="4박5일">4박5일</option>
							</select>
						</td>
					</tr>
					<tr>
						<th><span>날짜</span></th>
						<td>
							<input type="text" maxlength="8" style="width:100%;" id='searchDate' name='searchDate' />
							<!-- 레이어를 이용한 캘런더 표시를 위해 주석처리됨.
							<select name="year">
								<option value="년도선택">년도선택</option>
								<option value="2013년">2013년</option>
								<option value="2014년">2014년</option>
							</select>

							<select name="month">
								<option value="월선택">월선택</option>
								<option value="01월">01월</option>
								<option value="02월">02월</option>
								<option value="03월">03월</option>
								<option value="04월">04월</option>
								<option value="05월">05월</option>
								<option value="06월">06월</option>
								<option value="07월">07월</option>
								<option value="08월">08월</option>
								<option value="09월">09월</option>
								<option value="10월">10월</option>
								<option value="11월">11월</option>
								<option value="12월">12월</option>
							</select>

							<select name="day">
								<option value="일선택">일선택</option>
								<option value="01일">01일</option>
								<option value="02일">02일</option>
								<option value="03일">03일</option>
								<option value="04일">04일</option>
								<option value="05일">05일</option>
								<option value="06일">06일</option>
								<option value="07일">07일</option>
								<option value="08일">08일</option>
								<option value="09일">09일</option>
								<option value="10일">10일</option>
								<option value="11일">11일</option>
								<option value="12일">12일</option>
								<option value="13일">13일</option>
								<option value="14일">14일</option>
								<option value="15일">15일</option>
								<option value="16일">16일</option>
								<option value="17일">17일</option>
								<option value="18일">18일</option>
								<option value="19일">19일</option>
								<option value="20일">20일</option>
								<option value="21일">21일</option>
								<option value="22일">22일</option>
								<option value="23일">23일</option>
								<option value="24일">24일</option>
								<option value="25일">25일</option>
								<option value="26일">26일</option>
								<option value="27일">27일</option>
								<option value="28일">28일</option>
								<option value="29일">29일</option>
								<option value="30일">30일</option>
								<option value="31일">31일</option>
							</select>

							<input type="image" src="<?=$g4['path']?>/layout/images/speed_search_calendar.gif" width="17" />
							./레이어를 이용한 캘런더 표시를 위해 주석처리됨. -->
						</td>
					</tr>
					<tr>
						<th><span>객실수</span></th>
						<td>
							<select name="location">
								<option value="객실수선택">객실수선택</option>
								<option value="객실수무관">객실수무관</option>
								<option value="1개">1개</option>
								<option value="2개">2개</option>
								<option value="3개">3개</option>
							</select>
						</td>
					</tr>
					<tr>
						<th><span>화장실</span></th>
						<td>
							<select name="location">
								<option value="화장실수선택">화장실수선택</option>
								<option value="화장실수무관">화장실수무관</option>
								<option value="1개">1개</option>
								<option value="2개">2개</option>
								<option value="3개">3개</option>
							</select>
						</td>
					</tr>
					</tbody>
					</table>

				</div><!-- ./speed-search-area -->

				<div class="speed-search-btn">
					<a href="#" class="btn1">펜션검색</a>
					<a href="#" class="btn2">빈방검색</a>
				</div>

			</div><!-- ./detail-search-area -->

		</div><!-- ./container -->
	</div><!-- ./row -->
</div>
<!-- ./section -->

<div id="section">
	<div class="container">
	<div class="detail-readme">
			<span class="red">예약완료(결제완료)시 예약자 휴대폰으로 예약내역 및 펜션주연락처가 자동 전송되며, 동시에 펜션주의 휴대폰으로도 예약내역 및 예약자정보(연락처)가 자동 전송됩니다.</span><br />
			픽업 및 찾아가는길은 예약후 전송된 펜션연락처로 전화하셔서 시간 약속 잡으시면 됩니다.<br />
			예약취소시 취소수수료가 존재합니다. 신중하게 예약하세요. <a href="#">취소수수료보기</a><br />
			예약변경시는 이용일 7일전 1회에 한하여 펜션주와 합의하에만 가능합니다.<br />
			예약금을 무통장입금 하실경우 : 성수기에는 예약후 3시간내에 입금완료 하지 않는 경우 강제 취소 처리 될수 있습니다.
		</div><!-- /detail-readme -->

		<div class="cols">
			<div class="row title-bg">
				<h3 class="cal-title">객실현황&amp;예약하기</h3>
				<div class="tright t12">
					예약할 객실을 체크하고 이용인원을 입력한후 예약하기 버튼을 클릭하세요.
				</div>
			</div><!-- row -->
			<form name="formLoadReser" method="post" style="margin:0px;">
			<?php include_once("view.skin.ajax.php"); ?>
			<input type="hidden" name="bo_table" value="<?=$bo_table?>" />
			<input type="hidden" name="pension_id" value="<?=$pension_id?>" />
				<div id="ajLoadReser">

				</div>
				<div class="row reserve-wrap">
					<ul class="span80">
						<li>기준인원 초가시 추가요금이 있습니다.</li>
						<li>최대인원 초과로 인한 입실 거부시 환불도 되지 않으니 유의하시기 바랍니다.</li>
						<li>아동불가 또는 유아불가인 경우 어떠한 사유에도 입실이 허락되지 않습니다.</li>
					</ul>
					<div class="span20">
						<a onClick="Process();" class="btn-reserve">예약하기</a>
					</div>
				</div><!-- reserve-wrap -->
			</form><!-- span12 -->
		</div>

		<div class="cols">
			<div class="row title-bg">
				<h3 class="cal-title">펜션 상세 정보</h3>
				<div class="tright t12"></div>
			</div><!-- row -->
		</div>
		<div>
			<div class="detail-readme">
				<!-- 내용 출력 -->
				<span id="writeContents"><?=$view[content];?></span>

				<?php//echo $view[rich_content]; // {이미지:0} 과 같은 코드를 사용할 경우?>
				<!-- 테러 태그 방지용 --></xml></xmp><a href=""></a><a href=''></a>
			</div>
		</div>
<a name="detail" />
		<div class="cols">
			<div class="row title-bg">
				<h3 class="cal-title">객실 사진 및 소개</h3>
				<div class="tright t12"></div>
			</div><!-- row -->
		</div>
		<div>
			<div class="detail-readme">
			<?php foreach($viewDateRow['rInfoIdRow'] as $i) : ?>
				<label><input type="radio" onClick="roomFrameGo(0,'<?=$viewDateRow['rInfoId'][$i]?>','<?=$pension_id?>');" name='rInfo0' value='<?=$viewDateRow['rInfoId'][$i]?>' <?=(!$i) ? "checked":NULL;?> />&nbsp;<?=$viewDateRow['rInfoName'][$i]?></label>&nbsp;&nbsp;&nbsp;
			<?php endforeach; ?>
				<br class="blank" />
				<iframe id="roomFrame0" width="100%" src="<?=$g4[path]?>/reserv/roomView.php?rid=<?=$viewDateRow['rInfoId'][0]?>&pId=<?=$pension_id?>" frameborder='0' marginwidth='0' marginheight='0' scrolling='no' onload="resizeFrame(this);" style="height:100px; margin-top:3px;"></iframe>
			</div>
		</div>

<?php if($view[wr_map] || $view[wr_map2]) { ?>
		<div class="cols">
			<div class="row title-bg">
				<h3 class="cal-title">지 도 / 오시는 길</h3>
				<div class="tright t12"></div>
			</div><!-- row -->
		</div>
		<div>
			<div class="detail-readme">
				<label><input type="radio" onClick="viewMap(1,2);" name='rInfo1' checked />&nbsp;지도</label>&nbsp;&nbsp;&nbsp;
				<label><input type="radio" onClick="viewMap(2,1);" name='rInfo1' />&nbsp;오시는길</label>&nbsp;&nbsp;&nbsp;
				<div class="blank" style="margin-top:5px;"></div>
				<div id="penMap1" style="display:block; text-align:center;">
					<span id="writeContents"><?=$view[wr_map];?></span>
				</div>
				<div id="penMap2" style="display:none; text-align:center;">
					<span id="writeContents"><?=$view[wr_map2];?></span>
				</div>
			</div>
		</div>
<?php } ?>
		<div class="cols">
			<div class="row title-bg">
				<h3 class="cal-title">게시판</h3>
				<div class="tright t12"></div>
			</div><!-- row -->
		</div>
<?php
$gr_id = "pen_" . $pension_id; // 그룹 ID
$br_id = $gr_id . "_1"; // 게시판 ID

$chkGrp = sql_fetch(" SELECT count(*) as cnt FROM g4_group WHERE gr_id = '$gr_id' ");

if(!$chkGrp[cnt]) {
	$penBoard = "penBoard2";
	$brd_url = "/reserv/chkBoard.php?rId=1&pId=" . $pension_id;
} else {
	$penBoard = "penBoard";
	$brd_url = "/bbs/board.php?bo_table=pen_" . $pension_id . "_1";
}
?>
		<div>
			<div class="detail-readme">
				<label><input type="radio" onClick="<?=$penBoard?>(1, <?=$pension_id?>);" name='rInfo2' checked />&nbsp;이용후기</label>&nbsp;&nbsp;&nbsp;
				<label><input type="radio" onClick="<?=$penBoard?>(2, <?=$pension_id?>);" name='rInfo2' />&nbsp;질문답변</label>&nbsp;&nbsp;&nbsp;
				<label><input type="radio" onClick="<?=$penBoard?>(3, <?=$pension_id?>);" name='rInfo2' />&nbsp;포토갤러리</label>&nbsp;&nbsp;&nbsp;
				<label><input type="radio" onClick="<?=$penBoard?>(4, <?=$pension_id?>);" name='rInfo2' />&nbsp;공지사항</label>
				<br class="blank" />
				<iframe id="penBoard" width="100%" src="<?=$brd_url?>" frameborder='0' marginwidth='0' marginheight='0' scrolling='no' onload="resizeFrame(this);" style="height:100px; margin-top:3px;"></iframe>
			</div>
		</div>
	</div>
</div>

<!-- 게시글 보기 끝 -->
<?php if($member['mb_level'] >= 9 ){?>
<div style="clear:both; height:30px;text-align:center;">
    <!-- 링크 버튼 -->
    <!-- <?php echo "<a href=\"$list_href\"><img src='$board_skin_path/img/btn_list.gif' border='0' align='absmiddle'></a> "; ?> -->
    <?php //if ($update_href) { echo "<a href=\"$update_href\"><img src='$board_skin_path/img/btn_modify.gif' border='0' align='absmiddle'></a> "; } ?>
    <!-- <?php if ($delete_href) { echo "<a href=\"$delete_href\"><img src='$board_skin_path/img/btn_delete.gif' border='0' align='absmiddle'></a> "; } ?> -->
    <!-- <?php if ($write_href) { echo "<a href=\"$write_href\"><img src='$board_skin_path/img/btn_write.gif' border='0' align='absmiddle'></a> "; } ?> -->
</div>
<?php }?>
