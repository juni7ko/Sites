<?php
$area_sql = "SELECT * from ci_area order by area_no desc ";
$nav_sql = mysql_query($area_sql);
?>
	<ul id="nav">
<?php while ( $navi_area = sql_fetch_array($nav_sql) ) :?>
		<li<?=($navi_area['area_id'] == $stx) ? " class='on'" : NULL;?>><a href="<?=$g4['bbs_path']?>/board.php?bo_table=pension_info&sfl=area_id&stx=<?=$navi_area['area_id']?>"><?=$navi_area['area_name']?></a></li>
<?php endwhile;?>
	</ul>
