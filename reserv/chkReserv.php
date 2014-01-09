<?php
include_once("./_common.php");
$background = "class=bg-ptn1";
include_once("$g4[path]/head.php");

$wr_password = sql_password($wr_password);

function alert_and_back($msg){
    echo("<script language=javascript>
        <!--
            alert('$msg');
            history.back();
        //-->
        </script>");
}

function getRoomName($r_info_id) {
	global $write_table;
	$sql = " SELECT * FROM {$write_table}_r_info WHERE r_info_id = '$r_info_id' LIMIT 1; ";
	$result = sql_fetch($sql);
	return $result;
}

function GetDateWeek($week)
{
	switch($week) {
		case "1" :
			$weekP = "월";
			break;
		case "2" :
			$weekP = "화";
			break;
		case "3" :
			$weekP = "수";
			break;
		case "4" :
			$weekP = "목";
			break;
		case "5" :
			$weekP = "금";
			break;
		case "6" :
			$weekP = "토";
			break;
		case "0" :
			$weekP = "일";
			break;
		default :
			$weekP = "";
			break;
	}

	return $weekP;
}
?>

<link rel="stylesheet" type="text/css" href="css/reservation.css">

<div id="container">
	<div class="content-title">
		<h1>RESERVATION</h1>
		<span>예약확인</span>
	</div>
	<div class="content-area">

		<div class="reservation-area">
			<div class="res-header" style="display:none;">
				<div class="today">오늘 : 2013년 5월 28일 (화요일)</div>
				<div class="res-btn-area">
					<ul>
						<li><a href="<?=$g4['path']?>/reserv/chkReserv.php">예약확인</a></li>
						<li><a href="<?=$g4['path']?>/sub/reservation1_5.php">예약수정</a></li>
						<li><a href="<?=$g4['path']?>/sub/reservation1_6.php">예약취소</a></li>
					</ul>
				</div>
			</div>

			<div class="res-contents">

				<div class="res-comment">
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
// 예약내용이 있는지 확인
if($type == "code") {
	$query = " SELECT * from $write_table WHERE wr_3 = '$wr_3' AND wr_name = '$wr_name' AND wr_password = '$wr_password' ORDER BY wr_link1 ASC ";
} else {
	$res_error = 1;
}

$resultList = sql_query($query);

for ($i=0; $rList = sql_fetch_array($resultList); $i++)
{
	$rList2[$i] = getRoomName($rList['r_info_id']);
	$rList2['wr_name'] = $rList['wr_name'];
	$rList2['wr_10'] = $rList['wr_10'];
	$rList2['wr_2'] = $rList['wr_2'];
	$rList2['wr_8'] = $rList['wr_8']
?>
							<tr>
								<td class="first"><?=$rList2[$i][r_info_name]?></td>
								<td><?=$rList2[$i][r_info_person1]?>명/<?=$rList2[$i][r_info_person2]?>명</td>
								<td><span class="highlight-pink"><?=date("Y-m-d", $rList['wr_link2']);?>(<?=GetDateWeek(date("w", $rList['wr_link2']))?>)</span></td>
								<td>
									<?=$rList['person1']?> 명
								</td>
								<td>
									<?=$rList['person2']?> 명
								</td>
								<td>
									<?=$rList['person3']?> 명
								</td>
								<td><?=$rList['costType']?></td>
								<td>
									<div>기본가 <?=number_format($rList['cost1'])?>원</div>
									<?php if($rList['cost2']) { ?><div><span class="highlight-blue">기본 객실할인</span> - <?=number_format($rList['cost2'])?>원</div><?php } ?>
									<?php if($rList['overCount']) { ?><div><span class="highlight-blue">추가인원 <?=$rList['overCount']?> +</span> <?=number_format($rList['overCost'])?>원</div><?php } ?>
								</td>
								<td class="last"><?=number_format($rList['cost3'] + $rList['overCost'])?>원</td>
							</tr>


<?php
}
if(!$i) $res_error = 1;

if($res_error){
    $msg = '검색하신 것과 일치하는 예약내용이 없습니다. \n\n다시 확인해 주십시오. \n\n확인을 누르시면 뒤로 돌아갑니다';
    alert_and_back($msg);
    exit;
}

switch ($rList2['rResult']) {
	case '0010':
		$rResult = "예약대기";
		break;
	case '0020':
		$rResult = "예약완료";
		break;
	case '0030':
		$rResult = "예약취소";
		break;
	case '0040':
		$rResult = "관리자예약";
		break;

	default:
		$rResult = "예약대기";
		break;
}
?>
						</tbody>
					</table>
					<div class="res-comment">
						<ul>
							<li class="title"><h2>예약번호</h2>
								<ol>
									<li><span class="highlight-pink"><?=$wr_3?></span></li>
								</ol>
							</li>
						</ul>

						<ul>
							<li class="title"><h2>진행상태</h2>
								<ol>
									<li><span class="highlight-pink"><?=$rResult?></span></li>
								</ol>
							</li>
						</ul>

						<ul>
							<li class="title"><h2>예약자명</h2>
								<ol>
									<li><?=$rList2['wr_name']?></li>
								</ol>
							</li>
						</ul>

						<ul>
							<li class="title"><h2>결제금액</h2>
								<ol>
									<li>총 <span class="highlight-blue"><?=number_format($rList2['wr_10'])?></span> 원</li>
								</ol>
							</li>
						</ul>
<?php if($rList2['wr_8']) { ?>
						<ul>
							<li class="title"><h2>결제자명</h2>
								<ol>
									<li><?=$rList2['wr_8']?></li>
								</ol>
							</li>
						</ul>
<?php } ?>
						<ul>
							<li class="title"><h2>연락전화번호</h2>
								<ol>
									<li><?=$rList2['wr_2']?></li>
								</ol>
							</li>
						</ul>

						<ul>
							<li class="title"><h2>입금계좌</h2>
								<ol>
									<li>입금계좌: <?=get_text($config[cf_1])?></li>
									<li>문의 : <?=get_text($config[cf_2])?></li>
								</ol>
							</li>
						</ul>

						<ul>
							<li class="title"><h2>입금시간안내</h2>
								<table class="tbl">
								<tr>
									<th>예약 신청 시간</th>
									<th>입금 완료 시간</th>
								</tr>
								<tr>
									<td>당일 새벽 00시 부터 오전 8시 이전</td>
									<td>오전 10시 이전까지 입금</td>
								</tr>
								<tr>
									<td>오전 08시 부터 낮 12시 이전</td>
									<td>오후 2시 이전까지 입금</td>
								</tr>
								<tr>
									<td>오후 12시 부터 오후 4시 이전</td>
									<td>오후 6시 이전까지 입금</td>
								</tr>
								<tr>
									<td>오후 4시 부터 밤 8시 이전	</td>
									<td>오후 9시 이전까지 입금</td>
								</tr>
								<tr>
									<td>오후 8시 부터 밤 12시 이전</td>
									<td>다음날 오전 10시 이전까지 입금</td>
								</tr>
								</table>
								<ol>
									<li>지정된 시간까지 입금되지 않으면 자동으로 예약취소됩니다.</li>
									<li>입금시간후 입금하셨을 경우에는 확인절차를 거쳐 환불처리 됩니다.</li>
									<li>1일전예약 또는 당일예약일 경우는 예약후 바로 입금하셔야 예약완료가 됩니다. </li>
								</ol>
							</li>
						</ul>
					</div><!-- /res-comment -->
				</div><!-- /res-comment -->

			</div><!-- /res-contents -->


			<div class="res-footer">
				<div class="res-footer-btn-area">
					<a href="<?=$g4[url]?>/" class="res-footer-btn">홈으로</a>
				</div>
			</div>

		</div>

	</div>
</div><!-- container -->


<?php
include_once("$g4[path]/tail.php");
?>
