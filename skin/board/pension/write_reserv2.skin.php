<?php
include_once("view.skin.lib.php");

$background = "class=bg-ptn1";
?>
<link rel="stylesheet" type="text/css" href="<?=$g4[path]?>/sub/css/reservation.css">

<form name="resForm" method="post" enctype="multipart/form-data" style="margin:0px;" autocomplete="off">
	<input type=hidden name=null>
	<input type=hidden name=w            value="<?=$w?>">
	<input type=hidden name=bo_table     value="<?=$_POST[bo_table]?>" />
	<input type=hidden name=write_table2 value="<?=$write_table2?>" />
	<input type=hidden name=pension_id   value="<?=$pension_id?>" />

	<div id="container">
		<div class="content-title">
			<h1>RESERVATION</h1>
			<span>예약 2단계</span>
		</div>
		<div class="content-area">

			<div class="reservation-area">
				<div class="res-contents">
					<div class="res-comment">
						<ul>
							<li class="title"><h2>선택객실</h2></li>
						</ul>
					</div>

					<table cellpadding="0" cellspacing="0">
						<caption>예약신청</caption>
						<thead>
							<tr>
								<th class="first">객실명</th>
								<th>기준/최대</th>
								<th>이용일</th>
								<th>성인</th>
								<th>아동</th>
								<th>유아</th>
								<th>요금타입</th>
								<th>이용요금</th>
								<th class="last">결제액</th>
							</tr>
						</thead>
						<tbody>
<?php
	$res2_totalCost = 0;
	for($row=0; $row < $res1_roomCount; $row++)
	{
		// 예약인원 합계 체크, 추가금액 산
		$res1_totalPerson = $res1_person1[$row] + $res1_person2[$row] + $res1_person3[$row];
		if($res1_totalPerson > $res1_r_info_person2[$row]) {
			alert("최대인원 초과");
		} else if($res1_totalPerson > $res1_r_info_person1[$row]) {
			$overCount[$row] = $res1_totalPerson - $res1_r_info_person1[$row];
			$addCost[$row] = $res1_r_info_person_add[$row] * $overCount[$row];
		}
?>
							<tr>
								<td class="first"><?=$res1_r_info_name[$row]?></td>
								<td><?=$res1_r_info_person1[$row]?>명/<?=$res1_r_info_person2[$row]?>명</td>
								<td><span class="highlight-pink"><?=$res1_rDate[$row]?>(<?=$res1_rWeek[$row]?>)</span></td>
								<td>
									<input type="hidden" name="res2_r_info_id[<?=$row?>]"      value="<?=$res1_r_info_id[$row]?>" />
									<input type="hidden" name="res2_r_info_name[<?=$row?>]"    value="<?=$res1_r_info_name[$row]?>" />
									<input type="hidden" name="res2_rDateTmp[<?=$row?>]"       value="<?=$res1_rDateTmp[$row]?>" />
									<input type="hidden" name="res2_rDate[<?=$row?>]"          value="<?=$res1_rDate[$row]?>" />
									<input type="hidden" name="res2_rWeek[<?=$row?>]"          value="<?=$res1_rWeek[$row]?>" />
									<input type="hidden" name="res2_typeCost1[<?=$row?>]"      value="<?=$res1_typeCost1[$row]?>" />
									<input type="hidden" name="res2_typeCost2[<?=$row?>]"      value="<?=$res1_typeCost2[$row]?>" />
									<input type="hidden" name="res2_typeCost3[<?=$row?>]"      value="<?=$res1_typeCost3[$row]?>" />
									<input type="hidden" name="res2_r_info_person1[<?=$row?>]" value="<?=$res1_r_info_person1[$row]?>" />
									<input type="hidden" name="res2_r_info_person2[<?=$row?>]" value="<?=$res1_r_info_person2[$row]?>" />
									<input type="hidden" name="res2_r_info_person3[<?=$row?>]" value="<?=$res1_r_info_person3[$row]?>" />
									<input type="hidden" name="res2_person1[<?=$row?>]"        value="<?=$res1_person1[$row]?>" />
									<input type="hidden" name="res2_person2[<?=$row?>]"        value="<?=$res1_person2[$row]?>" />
									<input type="hidden" name="res2_person3[<?=$row?>]"        value="<?=$res1_person3[$row]?>" />
									<input type="hidden" name="res2_dateType[<?=$row?>]"       value="<?=$res1_dateType[$row]?>" />
									<input type="hidden" name="res2_weekType2[<?=$row?>]"      value="<?=$res1_weekType2[$row]?>" />
									<input type="hidden" name="res2_personOver[<?=$row?>]"     value="<?=$overCount[$row]?>" />
									<input type="hidden" name="res2_personOverCost[<?=$row?>]"  value="<?=$addCost[$row]?>" />
									<?=$res1_person1[$row]?> 명
								</td>
								<td>
									<?=$res1_person2[$row]?> 명
								</td>
								<td>
									<?=$res1_person3[$row]?> 명
								</td>
								<td><?=$res1_dateType[$row]?>/<?=$res1_weekType2[$row]?></td>
								<td>
									<div>기본가 <?=number_format($res1_typeCost1[$row])?>원</div>
									<?php if($res1_typeCost2[$row]) { ?><div><span class="highlight-blue">기본 객실할인</span> - <?=number_format($res1_typeCost2[$row])?>원</div><?php } ?>
									<?php if($addCost[$row]) { ?><div><span class="highlight-blue">추가인원 <?=$overCount[$row]?> +</span> <?=number_format($addCost[$row])?>원</div><?php } ?>
								</td>
								<td class="last"><?=number_format($res1_typeCost3[$row] + $addCost[$row])?>원</td>
							</tr>
<?php
		$res2_totalCost += $res1_typeCost3[$row] + $addCost[$row];
	};
?>
						</tbody>
					</table>

					<input type="hidden" name="res2_roomCount" value="<?=$res1_roomCount?>" />
					<input type="hidden" name="res2_totalCost" value="<?=$res2_totalCost?>" />
					<input type="hidden" name="res2_wr_name"        value="<?=$wr_name?>" />
					<input type="hidden" name="res2_wr_password"    vlaue="<?=$wr_password?>" />
					<input type="hidden" name="wr_tel1"        value="<?=$wr_tel1?>" />
					<input type="hidden" name="wr_tel2"        value="<?=$wr_tel2?>" />
					<input type="hidden" name="wr_tel3"        value="<?=$wr_tel3?>" />
					<input type="hidden" name="res2_wr_email"       value="<?=$wr_email?>" />
					<input type="hidden" name="wr_area"        value="<?=$wr_area?>" />
					<input type="hidden" name="paycheck"       value="<?=$paycheck?>" />
					<input type="hidden" name="payName"        value="<?=$payName?>" />
					<input type="hidden" name="wr_content"     value="<?=$wr_content?>" />
					<input type="hidden" name="res2_rResult"   value="0010" />
					<div class="res-comment">
						<ul>
							<li class="title"><h2>예약자명</h2>
								<ol>
									<li><?=$wr_name?></li>
								</ol>
							</li>
						</ul>

						<ul>
							<li class="title"><h2>결제금액</h2>
								<ol>
									<li>총 <span class="highlight-blue"><?=number_format($res2_totalCost)?></span> 원</li>
								</ol>
							</li>
						</ul>
<?php if($payName) { ?>
						<ul>
							<li class="title"><h2>결제자명</h2>
								<ol>
									<li><?=$payName?></li>
								</ol>
							</li>
						</ul>
<?php } ?>
						<ul>
							<li class="title"><h2>연락전화번호</h2>
								<ol>
									<li><?=$wr_tel1?>-<?=$wr_tel2?>-<?=$wr_tel3?></li>
								</ol>
							</li>
						</ul>

						<ul>
							<li class="title"><h2>입금계좌</h2>
								<ol>
									<li>농협 301-0081-3040-81 조용만</li>
								</ol>
							</li>
						</ul>

						<ul>
							<li class="title"><h2>입금시간안내</h2>
								<ol>
									<li>2013년 05월 29일 22시 30분까지 (예약후 24시간 이내)</li>
									<li>지정된 시간까지 입금되지 않으면 자동으로 예약취소됩니다.</li>
									<li>입금시간후 입금하셨을 경우에는 확인절차를 거쳐 환불처리 됩니다.</li>
									<li>1일전예약 또는 당일예약일 경우는 예약후 바로 입금하셔야 예약완료가 됩니다. </li>
								</ol>
							</li>
						</ul>
					</div><!-- /res-comment -->
				</div><!-- /res-contents -->

				<div class="res-footer">
					<div class="highlight-blue">
						<label><input type="checkbox" name="agree" value="1" /> 위 내용이 맞다면 <span class="highlight-pink">체크</span>하신후 다음단계로 진행해 주세요!</label>
					</div>
					<div class="res-footer-btn-area">
						<a onClick="resForm_submit();" class="res-footer-btn">다음</a>
					</div>
				</div>

			</div>

		</div>
	</div><!-- container -->
</form>

<script type="text/javascript">
function resForm_submit()
{
	f = document.resForm;

	if(!f.agree.checked) {
		alert("예약내용 확인에 체크해 주세요!");
		return false;
	}

	f.action = "./write_update_reserv.php";
	f.submit();
}
</script>
