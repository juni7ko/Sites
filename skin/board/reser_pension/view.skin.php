<?php if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once ("$board_skin_path/config.php");
?>
<link rel="stylesheet" href="<?=$board_skin_path?>/jQuery/jquery-ui-1.7.1.css" type="text/css">
<link rel="stylesheet" href="<?=$board_skin_path?>/mstyle.css" type="text/css">
<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jquery.js"></script>
<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jquery-ui-1.7.1.js"></script>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left top;"></td>
        <td bgcolor="#ffffff">&nbsp;</td>
        <td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right top;"></td>
    </tr>
    <tr>
        <td colspan="3" valign="top" style="background:#FFF; padding:10px;"><?php include_once("{$board_skin_path}/inc_top_menu.php"); ?>
            <div class="ui-state-highlight ui-corner-all" style="margin: 20px 0 5px; padding: 5px .7em;"> <span class="ui-icon ui-icon-power" style="float: left; margin-right: .3em;"></span> <strong><span style='color:#000;'>
                <?=$view[subject]?>
                - 작성자 :
                <?=$view[wr_name]?>
                </strong> </div>
            <!-- 원글 내용 -->
            <table width="100%" border="0" cellpadding="3" cellspacing="1" align="center" class="<?=$css[table]?>">
                <tr>
                    <td>
<?php
$from_date = str_replace("http://","",$view[link][1]);
$to_date = str_replace("http://","",$view[link][2]);
$from_date = substr($from_date,0,4)."년 ".sprintf("%2d",substr($from_date,4,2))."월 ".sprintf("%2d",substr($from_date,6,2))."일";
$to_date   = substr($to_date,0,4)."년 ".sprintf("%2d",substr($to_date,4,2))."월 ".sprintf("%2d",substr($to_date,6,2))."일";
?>
                        <table width="100%" border=0 cellpadding=3 cellspacing=1 class="<?=$css[table]?>">
                            <tr class="ht">
                                <td class="<?=$css[tr]?>" width="150">처리진행상황</td>
                                <td><?php if($is_admin) { ?>
                                    <SCRIPT LANGUAGE="javascript">
                                    function fwrite_check(f)
                                    {
                                    	document.getElementById('btn_submit').disabled = true;

                                      if(confirm('정말로 수정 하시겠습니다.?')) {
                                    		f.action = '<?=$board_skin_path?>/res_update.php';
                                        f.submit();
                                    	}

                                    	document.getElementById('btn_submit').disabled = false;
                                    }
                                    </SCRIPT>
                                    <form name="fwrite" method="post" action="javascript:fwrite_check(document.fwrite);" enctype="multipart/form-data" style="margin:0px; padding:0px;">
                                        <input type=hidden name=null>
                                        <input type=hidden name=bo_table value="<?=$bo_table?>">
                                        <input type=hidden name=wr_id    value="<?=$wr_id?>">
                                        <select name=rResult itemname="처리진행상황">
                                            <option value="0010"<?=($view[rResult] == "0010" ? " selected":"")?>>예약대기
                                            <option value="0020"<?=($view[rResult] == "0020" ? " selected":"")?>>예약완료
                                            <option value="0030"<?=($view[rResult] == "0030" ? " selected":"")?>>예약취소
                                            <option value="0040"<?=($view[rResult] == "0040" ? " selected":"")?>>관리자예약
                                        </select>
                                        <input type=image id="btn_submit" src="<?=$board_skin_path?>/img/btn_wr_9.gif" border=0 accesskey='s' align="absmiddle">
                                    </form>
                                    <?php } else { ?>
                                    <font color=red>
                                    <?=$view[wr_4]?>
                                    </font>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr class="ht list1">
                                <td class="<?=$css[tr]?>">예 약 코 드</td>
                                <td><?=$view[wr_3]?></td>
                            </tr>
                            <tr class="ht">
                                <td class="<?=$css[tr]?>">예약하신 방</td>
                                <td><?php if ($is_category) { echo ($category_name ? "$view[ca_name] " : ""); } ?>
                                    <?php if($view[wr_9] > 1) echo " X " . $view[wr_9] . "(객실수)";?></td>
                            </tr>
                            <tr class="ht list1">
                                <td class="<?=$css[tr]?>">예 약 인 원</td>
                                <td><?=$view[wr_1]?>
                                    명
                                    <?php if($view[wr_7]) { ?>
                                    (기준인원 :
                                    <?=Get_Room_Info_One($bo_table, $view[ca_name], 'person1')?>
                                    명 + 추가인원 :
                                    <?=$view[wr_7]?>
                                    명)
                                    <?php } ?></td>
                            </tr>
                            <tr class="ht">
                                <td class="<?=$css[tr]?>">예 약 일 정</td>
                                <td><?=$from_date?></td>
                            </tr>
                            <tr class="ht list1">
                                <td class="<?=$css[tr]?>">예 약 구 분</td>
                                <td>
<?php
if($view[wr_reserv]) {
	echo stripslashes($view[wr_reserv]);
} else {

    echo $times[$i]."일은 <font color=green>".$gigantype." ".$weektype."</font>이며 숙박료는 <font color=blue>".number_format($price11)."원</font> 입니다. <br>";
    $ad_price = $add_price * $view[wr_7] * $view[wr_8];
    $sum += $price11;

	echo "<br>";
	echo "추가요금 -> 추가인원:".$view[wr_7]."명 X 요금:".number_format($add_price)."원 X 숙박일수:".$view[wr_8]."박 = ".number_format($ad_price)."원 추가<br>";
	echo "<br>";
	echo "숙박료 총합 : ".number_format($sum)."원 + ".number_format($ad_price)."원 = <font color=red>".number_format($view[wr_10])."원</font> <br>";
}
?></td>
                            </tr>
                            <tr class="ht">
                                <td class="<?=$css[tr]?>">총 숙박요금</td>
                                <td><?=number_format($view[wr_10]);?>
                                    원</td>
                            </tr>
                            <tr class="ht list1">
                                <td class="<?=$css[tr]?>">E-mail주소</td>
                                <td><?=$view[wr_email]?></td>
                            </tr>
                            <tr class="ht">
                                <td class="<?=$css[tr]?>">휴대폰 번호</td>
                                <td><?=$view[wr_2]?></td>
                            </tr>
                            <tr class="ht list1">
                                <td class="<?=$css[tr]?>">추 가 사 항</td>
                                <td><span class=content>
                                    <?=$view[content];?>
                                    </span></td>
                            </tr>
                        </TABLE>
                        <?php include_once ("./view_comment.php");
?>
                        <!-- 링크 -->
                        <table width=100% align=center border=0 cellpadding=3 cellspacing=0>
                            <tr>
                                <td height=25><?php if ($search_href) { echo "<a href=\"{$search_href}&view_mode=list\"><img src='$board_skin_path/img/searchlist.gif' border=0 alt='검색목록'></a>"; } ?>
<?php if($is_admin) {
	echo "<a href=\"{$list_href}&view_mode=list\"><img src='$board_skin_path/img/list.gif' border=0 alt='목록'></a>";
} else {
	echo "<a href=\"{$list_href}\">완료</a>";
}

if ($write_href) { /*echo "<a href=\"$write_href&sca=$view[ca_name]\"><img src='$board_skin_path/img/write.gif' border=0 alt='글쓰기'></a>";*/ }

if ($reply_href && $admin_href) { /*echo "<a href=\"$reply_href&sca=$view[ca_name]\"><img src='$board_skin_path/img/reply.gif' border=0 alt='답변'></a>";*/ }

if ($update_href && $admin_href) { echo "<a href=\"res_modify.php?bo_table={$bo_table}&wr_id={$wr_id}&sca=$view[ca_name]\"><img src='$board_skin_path/img/edit.gif' border=0 alt='수정'></a>"; }
//if ($update_href && $admin_href) { echo "<a href=\"$update_href&sca=$view[ca_name]\"><img src='$board_skin_path/img/edit.gif' border=0 alt='수정'></a>"; }
if ($delete2_href && $admin_href) { echo "<a href=\"$delete2_href\"><img src='$board_skin_path/img/delete.gif' border=0 alt='삭제'></a>"; }
?></td>
                            </tr>
                        </table></TD>
                </TR>
            </TABLE></td>
    </tr>
    <tr>
        <td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left bottom;"></td>
        <td bgcolor="#ffffff">&nbsp;</td>
        <td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right bottom;"></td>
    </tr>
</table>
