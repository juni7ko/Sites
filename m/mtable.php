<?php
include_once "./_common.php";
if($_GET['from'] == 'pc'){
    set_session("frommoblie", "");
}
include_once './_head.php';


$bo_table = 'bbs34';
$write_table = 'g4_write_bbs34';
include_once ("config_func.php");
$sca = $_GET[sca];
if(!$sca) { $sca = 'VIP'; $on1 = 'on';}
if($sca == 'VIP') $on1 = 'on';
if($sca == '펜션스위트') $on2 = 'on';
if($sca == '스위트') $on3 = 'on';
if($sca == '럭셔리') $on4 = 'on';
if($sca == '디럭스') $on5 = 'on';
if($sca == '일반룸大') $on6 = 'on';
if($sca == '일반룸小') $on7 = 'on';
?>

<link rel="stylesheet" href="./css/mpay_info.css" type="text/css">






<div class="pay_info">
	<ul>
		<li><a href="?sca=VIP" class="<?=$on1?>">VIP</a></li>
		<li>|</li>
		<li><a href="?sca=펜션스위트" class="<?=$on2?>">펜션스위트</a></li>
		<li>|</li>
		<li><a href="?sca=스위트" class="<?=$on3?>">스위트</a></li>
		<li>|</li>
		<li><a href="?sca=럭셔리" class="<?=$on4?>">럭셔리</a></li>
		<li>|</li>
		<li><a href="?sca=디럭스" class="<?=$on5?>">디럭스</a></li>
		<li>|</li>
		<li><a href="?sca=일반룸大" class="<?=$on6?>">일반룸大</a></li>
		<li>|</li>
		<li><a href="?sca=일반룸小" class="<?=$on7?>">일반룸小</a></li>
	</ul>
</div>



<!--  객실 요금표 1. VIP -->

<table width="100%" class="pay_info_tbl mb30">
<thead>
<tr>
	<th width="25%">방이름</th>
	<th width="15%">타입</th>
	<th  width="15%">기준인원</th>
	<th  width="15%">최대인원</th>
	<th  width="15%">추가가능인원</th>
	<th  width="15%">추가요금</th>
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
	<th  width="25%">구분</th>
	<th  width="15%">평일 (월~목)</th>
	<th  width="15%">금요일</th>
	<th  width="15%">토요일</th>
	<th  width="15%">일요일</th>
	<th  width="15%">공휴일전날</th>
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

<?php include_once './_tail.php';
?>
