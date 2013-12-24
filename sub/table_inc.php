
<?php $g4_path = ".."; // common.php 의 상대 경로
include_once("$g4_path/common.php");
$background = "class=bg-ptn1";
include_once("$g4[path]/head.php");


?>
<link rel="stylesheet" href="css/pay_info.css" type="text/css">

<table width="100%" class="pay_info_tbl2">
<thead>
<tr>
	<th>구분</th>
	<th width="120">평일 (월~목)</th>
	<th width="120">금요일</th>
	<th width="120">토요일</th>
	<th width="120">일요일</th>
	<th width="120">공휴일전날</th>
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
