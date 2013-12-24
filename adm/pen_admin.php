<?php $sub_menu = "400100";
include_once("./_common.php");
include_once("./admin.head.php");

if(!$mode) $mode = "reg";

if($pension_id){
	$sql = " select * from g4_write_pension_info where wr_is_comment = 0 and wr_id = '$pension_id' ";
	$result = sql_query($sql);
	$write = sql_fetch_array($result);
	$w = "u";   // 수정
}

// echo $mode;
// echo $pension_id;

include_once("./pen.sub.php");

if ($mode == "list"){
	include_once ("./pen_list.php");
}else if ($mode == "reserhome") {
	include ("./pen_reserhome.php");
} else if ($mode == "reg") {
	include_once ("./pen_reg.php");
} else if ($mode == "room") {
	include ("./pen_config.php");
} else if ($mode == "date") {
	include ("./pen_config.php");
}else if ($mode == "off") {
	include ("./pen_config.php");
}else if ($mode == "close") {
	include ("./pen_config.php");
}else if ($mode == "tel") {
	include ("./pen_config.php");
}else if ($mode == "option") {
	include ("./pen_config.php");
} else {
	include_once ("./pen_reg.php");
}




include_once ("./admin.tail.php");
?>
