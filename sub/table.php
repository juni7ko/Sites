<?php $g4_path = ".."; // common.php 의 상대 경로
include_once("$g4_path/common.php");
$background = "class=bg-ptn1";
include_once("$g4[path]/head.php");
include_once("$g4[path]/head.sub.php");
$bo_table = 'bbs34';
$write_table = 'g4_write_bbs34';
include_once ("config_func.php");
$sca = $_GET[sca];
if(!$sca) { $sca = '솔향기(101)'; $on1 = 'on';}
if($sca == '솔향기(101)') $on1 = 'on';
if($sca == '개구리울음소리(102)') $on2 = 'on';
if($sca == '오죽(103)') $on3 = 'on';
if($sca == '해향(201)') $on4 = 'on';
if($sca == '달빛사냥(202)') $on5 = 'on';
if($sca == '은빛고요(203)') $on6 = 'on';
if($sca == '강릉이래요(204)') $on7 = 'on';
if($sca == '배나무골(독채별관)') $on8 = 'on';
?>

<link rel="stylesheet" href="css/pay_info.css" type="text/css">



<div id="container">
	<div class="content-title">
		<h1>RESERVATION</h1>
		<span>요금안내</span>
	</div>


<div class="pay_info">
	<ul>
		<li><a href="?sca=솔향기(101)" class="<?=$on1?>">솔향기</a></li>
		<li><a href="?sca=개구리울음소리(102)" class="<?=$on2?>">개구리울음소리</a></li>
		<li><a href="?sca=오죽(103)" class="<?=$on3?>">오죽</a></li>
		<li><a href="?sca=해향(201)" class="<?=$on4?>">해향</a></li>
		<li><a href="?sca=달빛사냥(202)" class="<?=$on5?>">달빛사냥</a></li>
		<li><a href="?sca=은빛고요(203)" class="<?=$on6?>">은빛고요</a></li>
		<li><a href="?sca=강릉이래요(204)" class="<?=$on7?>">강릉이래요</a></li>
		<li><a href="?sca=배나무골(독채별관)" class="<?=$on8?>">별관(80평)</a></li>
	</ul>
</div>



<!--  객실 요금표 1. VIP -->

<table width="100%" class="pay_info_tbl mb30">
<thead>
<tr>
	<th>방이름</th>
	<th width="110">평수</th>
	<th width="110">기준인원</th>
	<th width="110">최대인원</th>
	<th width="110">추가가능인원</th>
	<th width="110">추가요금</th>
</tr>
</thead>

<tbody>
<tr class="first">
    <td><?=Get_Room_Info_One($bo_table, $sca, 'name')?></td>
    <td><?=Get_Room_Info_One($bo_table, $sca, 'area')?></td>
    <td><?=number_format(Get_Room_Info_One($bo_table, $sca, 'person1'))?></td>
    <td><?=number_format(Get_Room_Info_One($bo_table, $sca, 'person2'))?></td>
    <td><?=number_format(Get_Room_Info_One($bo_table, $sca, 'person3'))?></td>
    <td><?=number_format(Get_Room_Info_One($bo_table, $sca, 'person_add'))?></td>
</tr>
</tbody>
</table>




<table width="100%" class="pay_info_tbl">
<thead>
<tr>
	<th>구분</th>
	<th width="100">평일 (월~목)</th>
	<th width="100">금요일</th>
	<th width="100">토요일</th>
	<th width="100">일요일</th>
	<th width="100">공휴일전날</th>
</tr>
</thead>

<tbody>
<tr class="first">
	<td>기본요금</td>
    <td><?=number_format(Get_Room_Cost_One($bo_table, $sca, 11))?></td>
    <td><?=number_format(Get_Room_Cost_One($bo_table, $sca, 12))?></td>
    <td><?=number_format(Get_Room_Cost_One($bo_table, $sca, 13))?></td>
    <td><?=number_format(Get_Room_Cost_One($bo_table, $sca, 14))?></td>
    <td><?=number_format(Get_Room_Cost_One($bo_table, $sca, 15))?></td>
</tr>

<?php $write_table ="g4_write_bbs34";
$sql = " SELECT * FROM {$write_table}_r_date ORDER BY r_date_sdate ASC ";
$result = sql_query($sql);
for ($i=0; $r_date = sql_fetch_array($result); $i++)  {
	$info_id = sql_fetch("SELECT r_info_id FROM {$write_table}_r_info WHERE r_info_name='$sca'");
	$date_cost = sql_fetch("SELECT * FROM {$write_table}_r_date_cost WHERE r_date_idx = '$r_date[r_date_idx]' and r_info_id = '$info_id[r_info_id]'");
	$j=($i+1)%2;
	if($j == '1') $j = "class='bg'";
?>
<tr <?=$j?>>
    <td><?=$r_date[r_date_name]?>
        <div><?=date("Y.m.d", $r_date[r_date_sdate])?>-<?=date("Y.m.d", $r_date[r_date_edate])?></div></td>
    <td><?=number_format($date_cost[r_date_cost_1])?></td>
    <td><?=number_format($date_cost[r_date_cost_2])?></td>
    <td><?=number_format($date_cost[r_date_cost_3])?></td>
    <td><?=number_format($date_cost[r_date_cost_4])?></td>
    <td><?=number_format($date_cost[r_date_cost_5])?></td>
  </tr>

<?php }?>

</tbody>

</table>
</div><!-- container -->

<br>

<?php include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php"); 
?>
