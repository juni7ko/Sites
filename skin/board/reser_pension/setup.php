<?php include_once "_common.php"; 
include_once("$g4[path]/head.sub.php"); 
include_once("$board_skin_path/config.php"); 

// 설정부분 시작 
$ss_gi = "07|19|08|16|12|23|12|23|12|31|12|31"; //성수기 3기간 까지
$js_gi = "07|11|07|18|08|17|08|31||||||||||||"; //준성수기 5기간까지

// ###중요### 방이름부터는 모두 방이름 순서에 따라 배열해야 함
$room_n = Get_Room($bo_table); //방이름

//방가격     방1   방2   방3   방4   방5   방6
$price_1 = Get_Room_Cost($bo_table, 11); //각방의 비수기 주중 가격을 순서대로 배열
$price_7 = Get_Room_Cost($bo_table, 12); //각방의 비수기 금요일 가격을 순서대로 배열
$price_2 = Get_Room_Cost($bo_table, 13); //각방의 비수기 토요일 가격을 순서대로 배열
$price_3 = Get_Room_Cost($bo_table, 21); //각방의 준성수기 주중 가격을 순서대로 배열
$price_8 = Get_Room_Cost($bo_table, 22); //각방의 준성수기 금요일 가격을 순서대로 배열
$price_4 = Get_Room_Cost($bo_table, 23); //각방의 준성수기 토요일 가격을 순서대로 배열
$price_5 = Get_Room_Cost($bo_table, 31); //각방의 성수기 주중 가격을 순서대로 배열
$price_9 = Get_Room_Cost($bo_table, 32); //각방의 성수기 금요일 가격을 순서대로 배열
$price_6 = Get_Room_Cost($bo_table, 33); //각방의 성수기 토요일 가격을 순서대로 배열

//Get_Room_Person($bo_table, "person1");
//Get_Room_Person($bo_table, "person2");
//Get_Room_Person($bo_table, "person3");
$person11 = "4|2|2|2|2"; //기준인원
$person22 = "8|5|3|3|3"; //최대인원
$person33 = "4|3|1|1|1"; //추가가능인원

$add_price = "10000"; //추가인원에 대한 요금


$p_name = ""; //패키지 이름배열
$p_price = ""; //패키지 가격배열

//설정부분 끝 아래부분은 손 안대도 됨!!


// 방목록 카테고리로 뽑기
$default_cat = explode("|",$board[bo_category_list]); // 게시판설정에서 뽑은 카테고리


$ss_date = explode("|",$ss_gi);
$sm_1 = $ss_date[0];
$sd_1 = $ss_date[1];
$sm_2 = $ss_date[2];
$sd_2 = $ss_date[3];
$sm_3 = $ss_date[4];
$sd_3 = $ss_date[5];
$sm_4 = $ss_date[6];
$sd_4 = $ss_date[7];
$sm_5 = $ss_date[8];
$sd_5 = $ss_date[9];
$sm_6 = $ss_date[10];
$sd_6 = $ss_date[11];

$js_date = explode("|",$js_gi);
$jm_1 = $js_date[0];
$jd_1 = $js_date[1];
$jm_2 = $js_date[2];
$jd_2 = $js_date[3];
$jm_3 = $js_date[4];
$jd_3 = $js_date[5];
$jm_4 = $js_date[6];
$jd_4 = $js_date[7];
$jm_5 = $js_date[8];
$jd_5 = $js_date[9];
$jm_6 = $js_date[10];
$jd_6 = $js_date[11];
$jm_7 = $js_date[12];
$jd_7 = $js_date[13];
$jm_8 = $js_date[14];
$jd_8 = $js_date[15];
$jm_9 = $js_date[16];
$jd_9 = $js_date[17];
$jm_10 = $js_date[18];
$jd_10 = $js_date[19];


$ss_gigan_1 = mktime(0,0,0,$sm_1,$sd_1,0);
$se_gigan_1 = mktime(0,0,0,$sm_2,$sd_2,0);

$ss_gigan_2 = mktime(0,0,0,$sm_3,$sd_3,0);
$se_gigan_2 = mktime(0,0,0,$sm_4,$sd_4,0);

$ss_gigan_3 = mktime(0,0,0,$sm_5,$sd_5,0);
$se_gigan_3 = mktime(0,0,0,$sm_6,$sd_6,0);


$js_gigan_1 = mktime(0,0,0,$jm_1,$jd_1,0);
$je_gigan_1 = mktime(0,0,0,$jm_2,$jd_2,0);

$js_gigan_2 = mktime(0,0,0,$jm_3,$jd_3,0);
$je_gigan_2 = mktime(0,0,0,$jm_4,$jd_4,0);

$js_gigan_3 = mktime(0,0,0,$jm_5,$jd_5,0);
$je_gigan_3 = mktime(0,0,0,$jm_6,$jd_6,0);

$js_gigan_4 = mktime(0,0,0,$jm_7,$jd_7,0);
$je_gigan_4 = mktime(0,0,0,$jm_8,$jd_8,0);

$js_gigan_5 = mktime(0,0,0,$jm_9,$jd_9,0);
$je_gigan_5 = mktime(0,0,0,$jm_10,$jd_10,0);


$price_1_room = explode("|",$price_1);
$price_2_room = explode("|",$price_2);
$price_3_room = explode("|",$price_3);
$price_4_room = explode("|",$price_4);
$price_5_room = explode("|",$price_5);
$price_6_room = explode("|",$price_6);
$price_7_room = explode("|",$price_7);
$price_8_room = explode("|",$price_8);
$price_9_room = explode("|",$price_9);


$roomname = explode("|",$room_n);

$room_name = "";
for($i=0; $i <= count($default_cat); $i++){
  if($sca == $default_cat[$i]){
    $room_name = $roomname[$i];
  }
}


$person1 = explode("|",$person11);
$person2 = explode("|",$person22);
$person3 = explode("|",$person33);

$person111 = "";
for($i=0; $i<count($default_cat); $i++){
  if($sca == $default_cat[$i]){
    $person111 = $person1[$i];
  }
}


if(strlen($wr_link1)>0 && strlen($wr_link2)>0) {  // 받은 날짜 argument 가 있을때..
 $f_year = substr($wr_link1,0,4);
 $f_mon = substr($wr_link1,4,2);
 $f_day = substr($wr_link1,6,2);
 $t_year = substr($wr_link2,0,4);
 $t_mon = substr($wr_link2,4,2);
 $t_day = substr($wr_link2,6,2);
 $f_date = date("Ymd", mktime(0,0,0,$f_mon,$f_day,$f_year));
 $t_date = date("Ymd", mktime(0,0,0,$t_mon,$t_day,$t_year));
 
}  elseif(strlen($f_date)>0 && strlen($t_date)>0) { // 받은 날짜 argument 가 없거나, 이상할 때 오늘날짜로 세팅...
 $f_year = substr($f_date,0,4);
 $f_mon = substr($f_date,4,2);
 $f_day = substr($f_date,6,2);
 $t_year = substr($t_date,0,4);
 $t_mon = substr($t_date,4,2);
 $t_day = substr($t_date,6,2);
 $f_date = date("Ymd", mktime(0,0,0,$f_mon,$f_day,$f_year));
 $t_date = date("Ymd", mktime(0,0,0,$t_mon,$t_day,$t_year));
}  else {                                    // 받은 날짜 argument 가 없거나, 이상할 때 오늘날짜로 세팅...
 $today = getdate();
 $f_mon = $today['mon'];$f_day = $today['mday'];$f_year = $today['year'];
 $t_mon = $today['mon'];$t_day = $today['mday'];$t_year = $today['year'];   

 $f_date = date("Ymd", mktime(0,0,0,$f_mon,$f_day,$f_year));
 $t_date = date("Ymd", mktime(0,0,0,$t_mon,$t_day+1,$t_year));
}


$check_gigan = mktime(0,0,0,$f_mon,$f_day,0);


$gigan_type = "";
if (($check_gigan >=$ss_gigan_1 && $check_gigan <= $se_gigan_1 )||($check_gigan >=$ss_gigan_2 && $check_gigan <= $se_gigan_2)||($check_gigan >=$ss_gigan_3 && $check_gigan <= $se_gigan_3)) {
  $gigan_type = "성수기";
} elseif (($check_gigan >=$js_gigan_1 && $check_gigan <= $je_gigan_1)||($check_gigan >=$js_gigan_2 && $check_gigan <= $je_gigan_2)||($check_gigan >=$js_gigan_3 && $check_gigan <= $je_gigan_3)||($check_gigan >=$js_gigan_4 && $check_gigan <= $je_gigan_4)||($check_gigan >=$js_gigan_5 && $check_gigan <= $je_gigan_5)) {
  $gigan_type = "준성수기";
} else  {
  $gigan_type = "비수기";
}


$check_week = date("w",mktime(0,0,0,$f_mon,$f_day,$f_year));


$week_type = "";
if($check_week == "5") { 
	$week_type = "금요일";
} elseif($check_week == "6") {
	$week_type = "토요일";
} else {
	$week_type = "주중";
}


$price = "0";
for($i=0; $i<count($default_cat); $i++){
    if($sca == $default_cat[$i] && $gigan_type == 비수기 && $week_type == 주중){
      $price = $price_1_room[$i];
    } elseif($sca == $default_cat[$i] && $gigan_type == 비수기 && $week_type == 토요일){
      $price = $price_2_room[$i];
    } elseif($sca == $default_cat[$i] && $gigan_type == 준성수기 && $week_type == 주중){
      $price = $price_3_room[$i];
    } elseif($sca == $default_cat[$i] && $gigan_type == 준성수기 && $week_type == 토요일){
      $price = $price_4_room[$i];
    } elseif($sca == $default_cat[$i] && $gigan_type == 성수기 && $week_type == 주중){
      $price = $price_5_room[$i];
    } elseif($sca == $default_cat[$i] && $gigan_type == 성수기 && $week_type == 토요일){
      $price = $price_6_room[$i];
    } elseif($sca == $default_cat[$i] && $gigan_type == 비성수기 && $week_type == 금요일){
			$price = $price_7_room[$i];
		} elseif($sca == $default_cat[$i] && $gigan_type == 준성수기 && $week_type == 금요일){
			$price = $price_8_room[$i];
		} elseif($sca == $default_cat[$i] && $gigan_type == 성수기 && $week_type == 금요일){
			$price = $price_9_room[$i];
		}
}


$price_2 = $price * $sl_day;

$price_3 = $add_price * $wr_7 * $sl_day;


$total_price = $price_2 + $price_3;



$tel = explode("-",$write[wr_2]); 
$tel1  = $tel[0]; 
$tel2  = $tel[1]; 
$tel3  = $tel[2]; 

$room_cnt = count($default_cat);
?>

