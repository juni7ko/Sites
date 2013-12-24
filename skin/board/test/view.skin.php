<?php if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<link rel="stylesheet"  type="text/css" href="<?=$board_skin_path?>/css/skin.css">

<table width="<?=$width?>" align="center" cellpadding="0" cellspacing="0"><tr><td>


<div class="board_view_title">
	<?php if ($is_category) { echo ($category_name ? "[$view[ca_name]] " : ""); } ?>
	<?=cut_hangul_last(get_text($view[wr_subject]))?>
</div>

<div class="board_view_hit">
조회수: <?=number_format($view[wr_hit])?> &nbsp;&nbsp;&nbsp; 작성일: <?=date("y-m-d H:i", strtotime($view[wr_datetime]))?>
</div>



<?php
// 가변 파일
$cnt = 0;
for ($i=0; $i<count($view[file]); $i++) {
    if ($view[file][$i][source] && !$view[file][$i][view]) {
        $cnt++;
		
		echo "<div class=\"board_view_wrd\">";

		echo "첨부파일: <a href=\"javascript:file_download('{$view[file][$i][href]}', '{$view[file][$i][source]}');\" title='{$view[file][$i][content]}'> ";

        echo "&nbsp;{$view[file][$i][source]} ({$view[file][$i][size]})";
        echo "&nbsp;[{$view[file][$i][download]}]";
        echo "&nbsp;date : {$view[file][$i][datetime]}</a>";

		echo "</div>";

    }
}

// 링크
$cnt = 0;
for ($i=1; $i<=$g4[link_count]; $i++) {
    if ($view[link][$i]) {
        $cnt++;
        $link = cut_str($view[link][$i], 70);

		echo "<div class=\"board_view_wrd\">";
		echo "링크: ";
        echo "<a href='{$view[link_href][$i]}' target=_blank>";
        echo "&nbsp;{$link}";
        echo "&nbsp;[{$view[link_hit][$i]}]</a>";

		echo "</div>";
   }
}
?>




<div class="board_contents">

        <?php
// 파일 출력
        for ($i=0; $i<=count($view[file]); $i++) {
            if ($view[file][$i][view]) 
                echo $view[file][$i][view]."<p></p>";
        }
        ?>


        <!-- 내용 출력 -->
        <span id="writeContents"><?=$view[content];?></span>
        
        <?php
//echo $view[rich_content]; // {이미지:0} 과 같은 코드를 사용할 경우?>
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


<?php if ($is_signature) { echo "<div>$signature</div>"; } // 서명 출력 ?>




</div>

        <div class="board_view_writer">
        &nbsp;글쓴이 : 
        <?=$view[name]?><?php if ($is_ip_view) { echo "&nbsp;($ip)"; } ?>

        <?php if ($is_good) { ?>&nbsp;<img src="<?=$board_skin_path?>/img/icon_good.gif" border='0' align="absmiddle"> 추천 : <?=number_format($view[wr_good])?><?php } ?>
        <?php if ($is_nogood) { ?>&nbsp;<img src="<?=$board_skin_path?>/img/icon_nogood.gif" border='0' align="absmiddle"> 비추천 : <?=number_format($view[wr_nogood])?><?php } ?>
		</div>




<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
			
		<?php if ($copy_href) { echo "<span class=\"button\"><a href=\"$copy_href\">복사</a></span> "; } ?>
		<?php if ($move_href) { echo "<span class=\"button\"><a href=\"$move_href\">이동</a></span> "; } ?>

		<?php if ($search_href) { echo "<span class=\"button\"><a href=\"$search_href\">검색목록</a></span> "; } ?>
		
		<?php if ($update_href) { echo "<span class=\"button\"><a href=\"$update_href\">수정</a></span> "; } ?>
		<?php if ($delete_href) { echo "<span class=\"button\"><a href=\"$delete_href\">삭제</a></span> "; } ?>
		<?php if ($reply_href) { echo "<span class=\"button\"><a href=\"$reply_href\">답변</a></span> "; } ?>
		<?php
// if ($write_href) { echo "<span class=\"button\"><a href=\"$write_href\">글쓰기</a></span> "; } ?>		
		
		
		</td>
		<td width="20%" align="right"><?php echo "<span class=\"button\"><a href=\"$list_href\">목록</a></span>"; ?></td>

	</tr>
</table>




<br>


<?php
// 코멘트 입출력
include_once("./view_comment.php");
?>


<!-- 
<div style="clear:both; height:43px;">
    <div style="float:left; margin-top:10px;">
    <?php if ($prev_href) { echo "<span class=\"button\"><a href=\"$prev_href\" title=\"$prev_wr_subject\">이전</a></span>&nbsp;"; } ?>
    <?php if ($next_href) { echo "<span class=\"button\"><a href=\"$next_href\" title=\"$next_wr_subject\">다음</a></span>&nbsp;"; } ?>
    </div>
</div>
 -->

</td></tr></table><br>

<script type="text/javascript">
function file_download(link, file) {
    <?php if ($board[bo_download_point] < 0) { ?>if (confirm("'"+file+"' 파일을 다운로드 하시면 포인트가 차감(<?=number_format($board[bo_download_point])?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?"))<?php }?>
    document.location.href=link;
}
</script>

<script type="text/javascript" src="<?="$g4[path]/js/board.js"?>"></script>
<script type="text/javascript">
window.onload=function() {
    resizeBoardImage(<?=(int)$board[bo_image_width]?>);
    drawFont();
}
</script>
<!-- 게시글 보기 끝 -->
