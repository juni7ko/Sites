<?php
$area_sql = "select * from ci_area order by area_no desc ";
$nav_sql = mysql_query($area_sql);
?>
	<ul id="nav">
<?php while ($navi_area = sql_fetch_array($nav_sql)){?>
		<li<?=($navi_area['area_id'] == $stx) ? " class='on'" : "";?>><a href="<?=$g4['bbs_path']?>/board.php?bo_table=pension_info&sfl=area_id&stx=<?=$navi_area['area_id']?>"><?=$navi_area['area_name']?></a></li>
<?php }?>
		<li><a href="<?=$g4['path']?>/sub.php">sub.php</a></li>
		<li><a href="<?=$g4['path']?>/list.html">list.html</a></li>
	</ul>
	<ul id="nav" style="display:none;">
		<li class="on"><a href="<?=$g4['bbs_path']?>/board.php?bo_table=pension_info&sfl=area_id&stx=1">강릉/경포대</a></li>
		<li><a href="<?=$g4['bbs_path']?>/board.php?bo_table=pension_info&sfl=area_id&stx=2">인천/강화도</a></li>
		<li><a href="<?=$g4['path']?>/sub.php">가평/양평</a></li>
		<li><a href="<?=$g4['path']?>/list.html">태안/안면도</a></li>
	</ul>
