<?php
$sub_menu = "400100";
include_once("./_common.php");
include_once("./admin.head.php");

if(!$mode) $mode = "reg";

if($pension_id){
	$sql = " SELECT * from g4_write_pension_info where wr_is_comment = 0 and wr_id = '$pension_id' ";
	$result = sql_query($sql);
	$write = sql_fetch_array($result);
	$w = "u";   // 수정
}

// echo $mode;
// echo $pension_id;

include_once("./pen.sub.php");

switch ($mode) {
	case 'list':
		include_once ("./pen_list.php");
		break;
	case 'reserhome' :
		include_once ("./pen_reserhome.php");
		break;
	case 'reg' :
		include_once ("./pen_reg.php");
		break;
	case 'room' :
	case 'date' :
	case 'off' :
	case 'close' :
	case 'tel' :
	case 'option' :
		include_once ("./pen_config.php");
		break;
	default:
		include_once ("./pen_reg.php");
		break;
}

include_once ("./admin.tail.php");
?>
