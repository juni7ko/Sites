<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>
<div style="height:12px; line-height:1px; font-size:1px;">&nbsp;</div>

<!-- 게시글 보기 시작 -->
<table width="<?=$width?>" align="center" cellpadding="0" cellspacing="0"><tr><td>


<div style="clear:both; height:30px;">
    <div style="float:left; margin-top:6px;">
    <img src="<?=$board_skin_path?>/img/icon_date.gif" align=absmiddle border='0'>
    <span style="color:#888888;">작성일 : <?=date("y-m-d H:i", strtotime($view[wr_datetime]))?></span>
    </div>

    <!-- 링크 버튼 -->
    <div style="float:right;">
    <?php
    ob_start();
    ?>
    <?php if ($copy_href) { echo "<a href=\"$copy_href\"><img src='$board_skin_path/img/btn_copy.gif' border='0' align='absmiddle'></a> "; } ?>
    <?php if ($move_href) { echo "<a href=\"$move_href\"><img src='$board_skin_path/img/btn_move.gif' border='0' align='absmiddle'></a> "; } ?>

    <?php if ($search_href) { echo "<a href=\"$search_href\"><img src='$board_skin_path/img/btn_list_search.gif' border='0' align='absmiddle'></a> "; } ?>
    <?php echo "<a href=\"$list_href\"><img src='$board_skin_path/img/btn_list.gif' border='0' align='absmiddle'></a> "; ?>
    <?php if ($update_href) { echo "<a href=\"$update_href\"><img src='$board_skin_path/img/btn_modify.gif' border='0' align='absmiddle'></a> "; } ?>
    <?php if ($delete_href) { echo "<a href=\"$delete_href\"><img src='$board_skin_path/img/btn_delete.gif' border='0' align='absmiddle'></a> "; } ?>
    <?php if ($reply_href) { echo "<a href=\"$reply_href\"><img src='$board_skin_path/img/btn_reply.gif' border='0' align='absmiddle'></a> "; } ?>
    <?php if ($write_href) { echo "<a href=\"$write_href\"><img src='$board_skin_path/img/btn_write.gif' border='0' align='absmiddle'></a> "; } ?>
    <?php
    $link_buttons = ob_get_contents();
    ob_end_flush();
    ?>
    </div>
</div>

<div style="border:1px solid #ddd; clear:both; height:34px; background:url(<?=$board_skin_path?>/img/title_bg.gif) repeat-x;">
    <table border=0 cellpadding=0 cellspacing=0 width=100%>
    <tr>
        <td style="padding:8px 0 0 10px;">
            <div style="color:#505050; font-size:13px; font-weight:bold; word-break:break-all;">
            <?php if ($is_category) { echo ($category_name ? "[$view[ca_name]] " : ""); } ?>
            <?=cut_hangul_last(get_text($view[wr_subject]))?>
            </div>
        </td>
        <td align="right" style="padding:6px 6px 0 0;" width=120>
            <?php if ($scrap_href) { echo "<a href=\"javascript:;\" onclick=\"win_scrap('$scrap_href');\"><img src='$board_skin_path/img/btn_scrap.gif' border='0' align='absmiddle'></a> "; } ?>
            <?php if ($trackback_url) { ?><a href="javascript:trackback_send_server('<?=$trackback_url?>');" style="letter-spacing:0;" title='주소 복사'><img src="<?=$board_skin_path?>/img/btn_trackback.gif" border='0' align="absmiddle"></a><?php }?>
        </td>
    </tr>
    </table>
</div>
<div style="height:3px; background:url(<?=$board_skin_path?>/img/title_shadow.gif) repeat-x; line-height:1px; font-size:1px;"></div>


<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>

<tr>
    <td height=30 background="<?=$board_skin_path?>/img/view_dot.gif">
        <div style="float:left;">&nbsp;<strong>처리진행상황</strong> :&nbsp;</div>
<div>
<?php if($is_admin) { ?>
<SCRIPT LANGUAGE="javascript">
function fwrite_check(f)
{
	document.getElementById('btn_submit').disabled = true;

  if(confirm('정말로 수정 하시겠습니까?')) {
		f.action = '<?=$board_skin_path?>/update_state.php';
    f.submit();
	}

	document.getElementById('btn_submit').disabled = false;
}
</SCRIPT>
  	<form name="fwrite" method="post" action="javascript:fwrite_check(document.fwrite);" enctype="multipart/form-data" style="margin:0px;">
    <input type=hidden name=null>
    <input type=hidden name=bo_table value="<?=$bo_table?>">
    <input type=hidden name=wr_id    value="<?=$wr_id?>">
    <select name=wr_link2 itemname="처리진행상황">
    <option value="접수"<?=($view[wr_link2] == "접수" ? " selected":"")?>>접수
    <option value="완료"<?=($view[wr_link2] == "완료" ? " selected":"")?>>완료
    <input type=image id="btn_submit" src="<?=$board_skin_path?>/img/btn_modify.gif" border=0 accesskey='s' align="absmiddle">
    </form>
<?php } else { ?>
	<font color=red><?=$view[wr_link2]?></font>
<?php } ?>
</div>
<br style="clear:both; line-height:0; font-size:0;" />
    </td>
</tr>
<tr>
    <td height=30 background="<?=$board_skin_path?>/img/view_dot.gif">
        &nbsp;<strong>예약자명</strong> : <?=$view[name]?><?php if ($is_ip_view) { echo "&nbsp;($ip)"; } ?>
    </td>
</tr>

<tr>
    <td height=30 background="<?=$board_skin_path?>/img/view_dot.gif">
        <div style="float:left;">
        &nbsp;<strong>연락처</strong> : <?=$view[wr_1]?>
        </div>
    </td>
</tr>

<tr>
    <td height="150" style="word-break:break-all; padding:10px;">
        <?php
        // 파일 출력
        for ($i=0; $i<=count($view[file]); $i++) {
            if ($view[file][$i][view])
                echo $view[file][$i][view] . "<p>";
        }
        ?>

        <!-- 내용 출력 -->
        <span id="writeContents"><?=$view[content];?></span>

        <?php //echo $view[rich_content]; // {이미지:0} 과 같은 코드를 사용할 경우?>
        <!-- 테러 태그 방지용 --></xml></xmp><a href=""></a><a href=''></a>

        <?php if ($nogood_href) {?>
        <div style="width:72px; height:55px; background:url(<?=$board_skin_path?>/img/good_bg.gif) no-repeat; text-align:center; float:right;">
        <div style="color:#888; margin:7px 0 5px 0;">비추천 : <?=number_format($view[wr_nogood])?></div>
        <div><a href="<?=$nogood_href?>" target="hiddenframe"><img src="<?=$board_skin_path?>/img/icon_nogood.gif" border='0' align="absmiddle"></a></div>
        </div>
        <?php } ?>

        <?php if ($good_href) {?>
        <div style="width:72px; height:55px; background:url(<?=$board_skin_path?>/img/good_bg.gif) no-repeat; text-align:center; float:right;">
        <div style="color:#888; margin:7px 0 5px 0;"><span style='color:crimson;'>추천 : <?=number_format($view[wr_good])?></span></div>
        <div><a href="<?=$good_href?>" target="hiddenframe"><img src="<?=$board_skin_path?>/img/icon_good.gif" border='0' align="absmiddle"></a></div>
        </div>
        <?php } ?>

</td>
</tr>
<?php if ($is_signature) { echo "<tr><td align='center' style='border-bottom:1px solid #E7E7E7; padding:5px 0;'>$signature</td></tr>"; } // 서명 출력 ?>
</table>
<br>

<?php
// 코멘트 입출력
include_once("./view_comment.php");
?>

<div style="height:1px; line-height:1px; font-size:1px; background-color:#ddd; clear:both;">&nbsp;</div>

<div style="clear:both; height:43px;">
    <div style="float:left; margin-top:10px;">
    <?php if ($prev_href) { echo "<a href=\"$prev_href\" title=\"$prev_wr_subject\"><img src='$board_skin_path/img/btn_prev.gif' border='0' align='absmiddle'></a>&nbsp;"; } ?>
    <?php if ($next_href) { echo "<a href=\"$next_href\" title=\"$next_wr_subject\"><img src='$board_skin_path/img/btn_next.gif' border='0' align='absmiddle'></a>&nbsp;"; } ?>
    </div>

    <!-- 링크 버튼 -->
    <div style="float:right; margin-top:10px;">
    <?=$link_buttons?>
    </div>
</div>

<div style="height:2px; line-height:1px; font-size:1px; background-color:#dedede; clear:both;">&nbsp;</div>

</td></tr></table><br>

<script language="JavaScript">
function file_download(link, file) {
    <?php if ($board[bo_download_point] < 0) { ?>if (confirm("'"+file+"' 파일을 다운로드 하시면 포인트가 차감(<?=number_format($board[bo_download_point])?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?"))<?php }?>
    document.location.href=link;
}
</script>

<script language="JavaScript" src="<?="$g4[path]/js/board.js"?>"></script>
<script language="JavaScript">
window.onload=function() {
    resizeBoardImage(<?=(int)$board[bo_image_width]?>);
    drawFont();
}
</script>
<!-- 게시글 보기 끝 -->