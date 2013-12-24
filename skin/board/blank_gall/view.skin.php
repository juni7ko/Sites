<?php if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

$brd_text_color = "#FFFFFF";
$brd_line_color = "#ceb968";
?>
<div style="height:12px; line-height:1px; font-size:1px;">&nbsp;</div>

<style type="text/css">
.color_white { color:<?=$brd_text_color?>; }
.bottom_white { border-bottom:dotted 1px <?=$brd_line_color?>; }
</style>

<!-- 게시글 보기 시작 -->
<table width="<?=$width?>" align="center" cellpadding="0" cellspacing="0"><tr><td>


<div style="clear:both; height:30px;">
    <div style="float:left; margin-top:6px;">
    <img src="<?=$board_skin_path?>/img/icon_date.gif" align=absmiddle border='0'>
    <span class="color_white">작성일 : <?=date("y-m-d H:i", strtotime($view[wr_datetime]))?></span>
    </div>

    <!-- 링크 버튼 -->
    <div style="float:right;">
    <? 
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
    <?php $link_buttons = ob_get_contents();
    ob_end_flush();
    ?>
    </div>
</div>

<div style="border:solid 1px <?=$brd_line_color?>; clear:both; height:34px;">
    <table border=0 cellpadding=0 cellspacing=0 width=100%>
    <tr>
        <td style="padding:8px 0 0 10px;">
            <div class="color_white" style="font-size:13px; font-weight:bold; word-break:break-all;">
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
<div style="height:3px; line-height:1px; font-size:1px;"></div>


<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
    <td class="color_white bottom_white" height=30>
        <div style="float:left;">
        &nbsp;글쓴이 : 
        <?=$view[name]?><?php if ($is_ip_view) { echo "&nbsp;($ip)"; } ?>
        </div>
        <div style="float:right;">
        <img src="<?=$board_skin_path?>/img/icon_view.gif" border='0' align=absmiddle> 조회 : <?=number_format($view[wr_hit])?>
        <?php if ($is_good) { ?>&nbsp;<img src="<?=$board_skin_path?>/img/icon_good.gif" border='0' align=absmiddle> 추천 : <?=number_format($view[wr_good])?><?php } ?>
        <?php if ($is_nogood) { ?>&nbsp;<img src="<?=$board_skin_path?>/img/icon_nogood.gif" border='0' align=absmiddle> 비추천 : <?=number_format($view[wr_nogood])?><?php } ?>
        &nbsp;
        </div>
    </td>
</tr>

<?php
// 가변 파일
$cnt = 0;
for ($i=0; $i<count($view[file]); $i++) {
    if ($view[file][$i][source] && !$view[file][$i][view]) {
        $cnt++;
        echo "<tr><td height=30 class='color_white bottom_white'>";
        echo "&nbsp;&nbsp;<img src='{$board_skin_path}/img/icon_file.gif' align=absmiddle border='0'>";
        echo "<a href=\"javascript:file_download('{$view[file][$i][href]}', '{$view[file][$i][source]}');\" title='{$view[file][$i][content]}'>";
        echo "&nbsp;<span class='color_white'>{$view[file][$i][source]} ({$view[file][$i][size]})</span>";
        echo "&nbsp;<span class='color_white' style=\"font-size:11px;\">[{$view[file][$i][download]}]</span>";
        echo "&nbsp;<span class='color_white' style=\"font-size:11px;\">DATE : {$view[file][$i][datetime]}</span>";
        echo "</a></td></tr>";
    }
}

// 링크
$cnt = 0;
for ($i=1; $i<=$g4[link_count]; $i++) {
    if ($view[link][$i]) {
        $cnt++;
        $link = cut_str($view[link][$i], 70);
        echo "<tr><td class='color_white bottom_white' height=30>";
        echo "&nbsp;&nbsp;<img src='{$board_skin_path}/img/icon_link.gif' align=absmiddle border='0'>";
        echo "<a href='{$view[link_href][$i]}' target=_blank>";
        echo "&nbsp;<span class='color_white'>{$link}</span>";
        echo "&nbsp;<span class='color_white' style=\"font-size:11px;\">[{$view[link_hit][$i]}]</span>";
        echo "</a></td></tr>";
    }
}
?>
<tr> 
    <td class='color_white bottom_white' height="150" style="word-break:break-all; padding:10px;">
        <?php
// 파일 출력
        for ($i=0; $i<=count($view[file]); $i++) {
            if ($view[file][$i][view]) 
                echo $view[file][$i][view] . "<p>";
        }
        ?>

        <!-- 내용 출력 -->
        <span id="writeContents"><?=$view[content];?></span>
        
        <?php
//echo $view[rich_content]; // {이미지:0} 과 같은 코드를 사용할 경우?>
        <!-- 테러 태그 방지용 --></xml></xmp><a href=""></a><a href=''></a>

        <?php if ($nogood_href) {?>
        <div style="width:72px; height:55px; background:url(<?=$board_skin_path?>/img/good_bg.gif) no-repeat; text-align:center; float:right;">
        <div class='color_white' style="margin:7px 0 5px 0;">비추천 : <?=number_format($view[wr_nogood])?></div>
        <div><a href="<?=$nogood_href?>" target="hiddenframe"><img src="<?=$board_skin_path?>/img/icon_nogood.gif" border='0' align="absmiddle"></a></div>
        </div>
        <?php } ?>

        <?php if ($good_href) {?>
        <div style="width:72px; height:55px; background:url(<?=$board_skin_path?>/img/good_bg.gif) no-repeat; text-align:center; float:right;">
        <div class='color_white' style="margin:7px 0 5px 0;"><span style='color:crimson;'>추천 : <?=number_format($view[wr_good])?></span></div>
        <div><a href="<?=$good_href?>" target="hiddenframe"><img src="<?=$board_skin_path?>/img/icon_good.gif" border='0' align="absmiddle"></a></div>
        </div>
        <?php } ?>

</td>
</tr>
<?php if ($is_signature) { echo "<tr><td class='color_white' align='center' style='border-bottom:solid 1px {$brd_line_color}; padding:5px 0;'>$signature</td></tr>"; } // 서명 출력 ?>
</table>
<br>

<?php
// 코멘트 입출력
include_once("./view_comment.php");
?>

<div style="height:1px; line-height:1px; font-size:1px; background-color:<?=$brd_line_color?>; clear:both;">&nbsp;</div>

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

<div style="height:2px; line-height:1px; font-size:1px; background-color:<?=$brd_line_color?>; clear:both;">&nbsp;</div>

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
