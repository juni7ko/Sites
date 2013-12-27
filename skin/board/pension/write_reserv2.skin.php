<?php
include_once("view.skin.lib.php");
$background = "class=bg-ptn1";
?>
<link rel="stylesheet" type="text/css" href="<?=$g4[path]?>/sub/css/reservation.css">

<form name="resForm" method="post" enctype="multipart/form-data" style="margin:0px;" autocomplete="off">
	<input type=hidden name=bo_table value="<?=$_POST[bo_table]?>" />
	<input type=hidden name=pension_id value="<?=$res_pension_id?>" />

	<div id="container">
		<div class="content-title">
			<h1>RESERVATION</h1>
			<span>예약 2단계</span>
		</div>
		<div class="content-area">

			<div class="reservation-area">
				<div class="res-contents">
					<div>
						<ul>
							<li>선택객실 목록</li>
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
/*--------------------
예약상태 값
0010 : 예약대기
0020 : 예약완료
0030 : 예약취소
0040 : 관리자예약
----------------------*/
for($row=0; $row < $res1_roomCount; $row++)
{
	/*
	$chkReser['r_info_id'] = $r_info_id[$row];
	$chkReser['rDate'] = $rDate[$row];

	$rDate2 = date("Y-m-d", $chkReser['rDate']);
	$weekChk = date("w", $chkReser['rDate']);
	$rWeek = GetDateWeek($weekChk);
	$rWeekType = pDateType2($chkReser['rDate']);

	$r_info_sql = " SELECT * FROM {$write_table2}_r_info WHERE pension_id = '$pension_id' AND r_info_id =  '{$chkReser['r_info_id']}' LIMIT 1 ";
	$r_info = sql_fetch($r_info_sql);

	$viewDateType = viewDateType($_POST[pension_id], $chkReser['rDate']);
	$viewDateCost = viewCostRow($chkReser['r_info_id'], $_POST[pension_id], $rWeek, $chkReser['rDate']);
	$typeCost2 = round( ($viewDateCost['typeCost1'] * ($viewDateCost['typeCost2'] * 0.01)), -2 );
	*/
	$res2[r_info_id][$row] = $res1_r_info_id[$row];
?>
								<tr>
									<td class="first"><?=$res1_r_info_name[$row]?></td>
									<td><?=$res1_r_info_person1[$row]?>명/<?=$res1_r_info_person2[$row]?>명</td>
									<td><span class="highlight-pink"><?=$res1_rDate[$row]?>(<?=$res1_rWeek[$row]?>)</span></td>
									<td>
										<input type="hidden" name="res2_r_info_id[<?=$row?>]" value="<?=$res1_r_info_id[$row]?>" />
										<input type="hidden" name="res2_r_info_name[<?=$row?>]" value="<?=$res1_r_info_name[$row]?>" />
										<input type="hidden" name="res2_rDateTmp[<?=$row?>]" value="<?=$res1_rDateTmp[$row]?>" />
										<input type="hidden" name="res2_rDate[<?=$row?>]" value="<?=$res1_rDate[$row]?>" />
										<input type="hidden" name="res2_rWeek[<?=$row?>]" value="<?=$res1_rWeek[$row]?>" />
										<input type="hidden" name="res2_rResult[<?=$row?>]" value="<?=$res1_rResult[$row]?>" />
										<input type="hidden" name="res2_person_max[<?=$row?>]" value="<?=$res1_person_max[$row]?>" />
										<input type="hidden" name="res2_typeCost1[<?=$row?>]" value="<?=$res1_typeCost1[$row]?>" />
										<input type="hidden" name="res2_typeCost2[<?=$row?>]" value="<?=$res1_typeCost2[$row]?>" />
										<input type="hidden" name="res2_typeCost3[<?=$row?>]" value="<?=$res1_typeCost3[$row]?>" />
										<input type="hidden" name="res2_r_info_person1[<?=$row?>]" value="<?=$res1_r_info_person1[$row]?>" />
										<input type="hidden" name="res2_r_info_person2[<?=$row?>]" value="<?=$res1_r_info_person2[$row]?>" />
										<input type="hidden" name="res2_r_info_person3[<?=$row?>]" value="<?=$res1_r_info_person3[$row]?>" />
										<input type="hidden" name="res2_person1[<?=$row?>]" value="<?=$res1_person1[$row]?>" />
										<input type="hidden" name="res2_person2[<?=$row?>]" value="<?=$res1_person2[$row]?>" />
										<input type="hidden" name="res2_person3[<?=$row?>]" value="<?=$res1_person3[$row]?>" />
										<input type="hidden" name="res2_dateType[<?=$row?>]" value="<?=$res1_dateType[$row]?>" />
										<input type="hidden" name="res2_weekType[<?=$row?>]" value="<?=$res1_weekType[$row]?>" />
										<?=$res1_person1[$row]?> 명
									</td>
									<td>
										<?=$res1_person2[$row]?> 명
									</td>
									<td>
										<?=$res1_person3[$row]?> 명
									</td>
									<td><?=$res1_dateType[$row]?>/<?=$res1_weekType[$row]?></td>
									<td>
										<div>기본가 <?=number_format($res1_typeCost1[$row])?>원</div>
										<div><span class="highlight-blue">기본 객실할인</span> - <?=number_format($res1_typeCost2[$row])?>원</div>
									</td>
									<td class="last"><?=number_format($res1_typeCost3[$row])?>원</td>
								</tr>
<?php
};
?>
							<tr>
								<td class="first" colspan="8">객실요금 합계</td>
								<td class="last">
									<input type="hidden" name="roomCount" value="<?=$row?>" />
									<input type="hidden" name="totalCost" value="<?=$totalCost?>" />
									<?=number_format($totalCost)?>원
								</td>
							</tr>
<?php
/*
							<tr>
								<td class="first" colspan="2">바베큐 그릴 신청</td>
								<td colspan="4">
									<select name="person_1">
										<option value="2">신청안함</option>
										<option value="3">바베큐 그릴신청 小 : 10,000원</option>
										<option value="4">바베큐 그릴신청 大 : 20,000원</option>
									</select>
								</td>
								<td colspan="3" class="last">바베큐 그릴,숯,석쇠 1세트</td>
							</tr>
*/
?>
						</tbody>
					</table>

					<table cellpadding="0" cellspacing="0">
						<caption>예약자정보</caption>
						<thead>
							<tr>
								<th class="first" colspan="2">예약정보를 입력해 주세요 *항목은 필수사항으로 입력하셔야 합니다.</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="first">예약자명</td>
								<td class="last left">
									<input name="wr_name" type="hidden" value="<?=$wr_name?>" /><?=$wr_name?>
								</td>
							</tr>
							<tr>
								<td class="first">비밀번호</td>
								<td class="last left">
									<input name="wr_password" type="hidden" vlaue="<?=$wr_password?>" /><?=$wr_password?>
								</td>
							</tr>
							<tr>
								<td class="first">연락처</td>
								<td class="last left">
									<input name="wr_tel1" type="hidden" value="<?=$wr_tel1?>" />
									<input name="wr_tel2" type="hidden" value="<?=$wr_tel2?>" />
									<input name="wr_tel3" type="hidden" value="<?=$wr_tel3?>" />
									<?=$wr_tel1?>-<?=$wr_tel2?>-<?=$wr_tel3?>
								</td>
							</tr>
							<tr>
								<td class="first">이메일</td>
								<td class="last left">
									<input name="wr_email" type="hidden" value="<?=$email?>" /><?=$wr_email?>
								</td>
							</tr>
							<tr>
								<td class="first">출발지역</td>
								<td class="last left">
									<input name="wr_area" type="hidden" value="<?=$wr_area?>" /><?=$wr_area?>
								</td>
							</tr>
							<tr>
								<td class="first">결제방법</td>
								<td class="last left">
									<input name="paycheck" type="hidden" value="<?=$paycheck?>" />
									<?php
										switch ($paycheck) {
											case '1':
												echo "무통장입금";
												break;
											case '2':
												echo "실시간계좌이체";
												break;
											case '3':
												echo "신용카드";
												break;
											default:
												echo "무통장입금";
												break;
										}
									?>
								</td>
							</tr>
							<tr>
								<td class="first">기타사항</td>
								<td class="last left">
									<textarea name="wr_content" cols="50" rows="4" class="w100p" disabled><?=$wr_content?></textarea>
								</td>
							</tr>
						</tbody>
					</table>
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

	if(!f.wr_name.value) {
		alert("이름을 입력하세요!");
		f.wr_name.focus();
		return false;
	}

	if(!f.wr_password.value) {
		alert("패스워드를 입력하세요!");
		f.wr_password.focus();
		return false;
	}

	if(!f.wr_tel2.value || !f.wr_tel3.value) {
		alert("연락처를 입력하세요!");
		f.wr_tel2.focus();
		return false;
	}

	if(!f.agree.checked) {
		alert("유의사항과 환불기준에 동의하셔야 합니다.");
		return false;
	}

	f.action = "./write_reserv2.php";
	f.submit();
}
</script>
