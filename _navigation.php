<?php
$area_sql = "select * from ci_area order by area_no desc ";
$nav_sql = mysql_query($area_sql);
?>
	<ul id="nav">
<?php while ($navi_area = sql_fetch_array($nav_sql)){?>
		<li<?=($navi_area['area_id'] == $stx) ? " class='on'" : "";?>><a href="<?=$g4['bbs_path']?>/board.php?bo_table=pension_info&sfl=area_id&stx=<?=$navi_area['area_id']?>"><?=$navi_area['area_name']?></a></li>
<?php }?>
		<li><a href="<?=$g4['path']?>/reserv/chkReserv.php">예약확인</a></li>
		<li><a href="<?=$g4['path']?>/sub.php">sub.php</a></li>
		<li><a href="<?=$g4['path']?>/list.html">list.html</a></li>
	</ul>
