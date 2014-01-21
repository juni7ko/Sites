<?php
$menu["menu400"] = array (
    array("400000", "펜션관리", ""),
    array("400100", "펜션등록", "$g4[admin_path]/pen_admin.php?mode=reg"),
    array("-"),
	array("400300", "예약관리", "$g4[admin_path]/pen_admin.php?mode=reserhome&pension_id={$pension_id}"),
	array("-"),
	array("400310", "입금현황", "$g4[admin_path]/admin.stats.php?pension_id={$pension_id}")
);
?>


