<?php if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

if (!$board[bo_1])
	$img_width = 120;
else
	$img_width = $board[bo_1]; //alert("게시판 설정 : 여분 필드 1 에 목록에서 보여질 이미지의 가로사이즈를 설정하십시오. (예)120)"); //120
if (!$board[bo_2])
	$img_height = 90;
else
	$img_height = $board[bo_2]; //alert("게시판 설정 : 여분 필드 2 에 목록에서 보여질 이미지의 세로사이즈를 비율로 설정하십시오. (예)150)"); //80
if (!$board[bo_3])
	$img_quality = 95;
else
	$img_quality = $board[bo_3]; //alert("게시판 설정 : 여분 필드 9 에 목록에서 보여질 이미지의 질(quality)을 비율로 설정하십시오. (100 이하)"); //100
if (!function_exists("imagecopyresampled")) alert("GD 2.0.1 이상 버전이 설치되어 있어야 사용할 수 있는 갤러리 게시판 입니다.");

$data_path = $g4[path]."/data/file/$bo_table";
$thumb_path = $data_path.'/thumb';

@mkdir($thumb_path, 0707);
@chmod($thumb_path, 0707);

$mod = $board[bo_gallery_cols];
$td_width = (int)(100 / $mod);

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

//if ($is_category) $colspan++;
if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// 제목이 두줄로 표시되는 경우 이 코드를 사용해 보세요.
// <nobr style='display:block; overflow:hidden; width:000px;'>제목</nobr>
?>
<script type="text/javascript">
function view_photo(img_url,wr)
{
	window.open("<?=$board_skin_path?>/imgOpen.php?bo_table=<?=$bo_table?>&wr_id=" + wr + "&img_url=" + img_url, "photo", "toolbar=no, location=no, directories=no,status=no, menubar=no, scrollbars=no, resizable=yes");
}
//onClick=\"view_photo('{$photo_view}','{$list[$i][wr_id]}');\"
</script>
<div style="height:12px; line-height:1px; font-size:1px;">&nbsp;</div>

<!-- 게시판 목록 시작 -->
<table width="<?=$width?>" align=center cellpadding=0 cellspacing=0><tr><td>

<!-- 분류 셀렉트 박스, 게시물 몇건, 관리자화면 링크 -->
<table border=0 width="100%" cellspacing="0" cellpadding="0">
<tr height="25">
    <td width="50%">
        <form name="fcategory" method="get" style="margin:0; padding:0;">
        <?php if ($is_category) { ?>
        <select name=sca onchange="location='<?=$category_location?>'+this.value;">
        <option value=''>전체</option>
        <?=$category_option?>
        </select>
        <?php } ?>
        </form>
    </td>
    <td align="right">
        <img src="<?=$board_skin_path?>/img/icon_total.gif" align=absmiddle>
        <span style="color:#888888; font-weight:bold;">Total <?=number_format($total_count)?></span>
        <?php if ($rss_href) { ?><a href='<?=$rss_href?>'><img src='<?=$board_skin_path?>/img/btn_rss.gif' border=0 align=absmiddle></a><?php }?>
        <?php if ($admin_href) { ?><a href="<?=$admin_href?>"><img src="<?=$board_skin_path?>/img/btn_admin.gif" title="관리자" align="absmiddle"></a><?php }?>
    </td>
</tr>
<tr><td height=5></td></tr>
</table>

<!-- 제목 -->
<form name="fboardlist" method="post" style="margin:0;">
<input type='hidden' name='bo_table' value='<?=$bo_table?>'>
<input type='hidden' name='sfl'  value='<?=$sfl?>'>
<input type='hidden' name='stx'  value='<?=$stx?>'>
<input type='hidden' name='spt'  value='<?=$spt?>'>
<input type='hidden' name='page' value='<?=$page?>'>
<input type='hidden' name='sw'   value=''>

<div><?php if ($is_checkbox) { ?><input onclick="if (this.checked) all_checked(true); else all_checked(false);" type=checkbox> 전체 선택<?php }?></div>
<div style="height:3px; background:url(<?=$board_skin_path?>/img/title_shadow.gif) repeat-x; line-height:1px; font-size:1px;"></div>

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr>
<!-- 목록 -->
<?php for ($i=0; $i<count($list); $i++) {
   $img = "<img src='$board_skin_path/img/noimage.gif' border=0 width='$img_width' height='$img_height' title='이미지 없음' align=left style='margin-right:5px; border:1 solid #CCCCCC; padding:3px;'>";
    $thumb = $thumb_path.'/'.$list[$i][wr_id];
    // 썸네일 이미지가 존재하지 않는다면
    if (!file_exists($thumb)) {
        $file = $list[$i][file][0][path] .'/'. $list[$i][file][0][file];
        // 업로드된 파일이 이미지라면
        if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file) && file_exists($file)) {
            $size = getimagesize($file);
            if ($size[2] == 1)
                $src = imagecreatefromgif($file);
            else if ($size[2] == 2)
                $src = imagecreatefromjpeg($file);
            else if ($size[2] == 3)
                $src = imagecreatefrompng($file);
            else
                break;

            $rate = $img_width / $size[0];
            $height = (int)($size[1] * $rate);

            // 계산된 썸네일 이미지의 높이가 설정된 이미지의 높이보다 작다면
            if ($height < $img_height)
                // 계산된 이미지 높이로 복사본 이미지 생성
                $dst = imagecreatetruecolor($img_width, $height);
            else
                // 설정된 이미지 높이로 복사본 이미지 생성
                $dst = imagecreatetruecolor($img_width, $img_height);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $img_width, $height, $size[0], $size[1]);
            //imagepng($dst, $thumb_path.'/'.$list[$i][wr_id], $img_quality);
						imagejpeg($dst, $thumb_path.'/'.$list[$i][wr_id], $img_quality);
            chmod($thumb_path.'/'.$list[$i][wr_id], 0606);
        }
    }

    if (file_exists($thumb))
        $img = "<img src='$thumb' border=0 style='border:1px solid #CCCCCC; padding:3px;'>";
		else
			if(preg_match("/\.(swf|wma|asf)$/i","$file") && file_exists($file))
				{ $img = "<script>doc_write(flash_movie('$file', 'flash$i', '$img_width', '$img_height', 'transparent'));</script>"; }
?>
<!--<tr align=center> -->
        <?php if ($i && $i%$mod==0)
					echo "</tr><tr align=center>";
						
				echo "<td width='{$td_width}%' valign=top align=center style='word-break:break-all;'>";
				echo "<table width='98%' border='0' cellspacing='0' cellpadding='0' style='margin-top:10px;'>";
				echo "<tr><td height='90' align='center' valign='middle'><div style='width:{$img_width}px; height:{$img_height}px; padding:4px; border:solid 1px #CCC;' align=center><a href='{$list[$i][href]}'>$img</a></div></td></tr>";
				echo "<tr><td height='5'></td></tr>";
				echo "<td height='20' align='center'>";
				if ($is_checkbox) { ?><input type=checkbox name=chk_wr_id[] value="<?=$list[$i][wr_id]?>"><?php }
        if ($is_category && $list[$i][ca_name]) { 
            echo "<span class=small><font color=gray>[<a href='{$list[$i][ca_name_href]}'>{$list[$i][ca_name]}</a>]</font></span> ";
        }
        echo "<a href='{$list[$i][href]}' $style>";
        echo $list[$i][subject];
        echo "</a>";
				echo "</td></tr></table>";
				echo "</td>\n";
				/*
				echo "<div style='clear:both'>";
        echo "<div style='padding:5px;'><a href='{$list[$i][href]}'>$img</a></div>";
				echo "<div style='padding-top:5px; text-align:center;'>";
        echo $nobr_begin;
				if ($is_checkbox) { ?><input type=checkbox name=chk_wr_id[] value="<?=$list[$i][wr_id]?>"><?php }
        if ($is_category && $list[$i][ca_name]) { 
            echo "<span class=small><font color=gray>[<a href='{$list[$i][ca_name_href]}'>{$list[$i][ca_name]}</a>]</font></span> ";
        }
        $style = "";
        if ($list[$i][is_notice]) $style = " style='font-weight:bold;'";

        echo "<a href='{$list[$i][href]}' $style>";
        echo $list[$i][subject];
        echo "</a>";

        if ($list[$i][comment_cnt]) 
            echo " <a href=\"{$list[$i][comment_href]}\"><span style='font-family:Tahoma;font-size:10px;color:#EE5A00;'>{$list[$i][comment_cnt]}</span></a>";

        echo $nobr_end;
				echo "</div></div>";
				*/
}
// 나머지 td
$cnt = $i%$mod;
if ($cnt)
    for ($i=$cnt; $i<$mod; $i++)
        echo "<td width='{$td_width}%'>&nbsp;</td>";
        ?>
</tr>
<tr><td colspan=<?=$colspan?> height=1 bgcolor=#eeeeee></td></tr>
<?php if (count($list) == 0) { echo "<tr><td colspan='$colspan' height=100 align=center>게시물이 없습니다.</td></tr>"; } ?>
</table>
</form>


<div style="clear:both; margin-top:7px; height:31px;">
    <div style="float:left;">
    <?php if ($list_href) { ?>
    <a href="<?=$list_href?>"><img src="<?=$board_skin_path?>/img/btn_list.gif" align=absmiddle></a>
    <?php } ?>
    <?php if ($is_checkbox) { ?>
    <a href="javascript:select_delete();"><img src="<?=$board_skin_path?>/img/btn_select_delete.gif" align=absmiddle></a>
    <a href="javascript:select_copy('copy');"><img src="<?=$board_skin_path?>/img/btn_select_copy.gif" align=absmiddle></a>
    <a href="javascript:select_copy('move');"><img src="<?=$board_skin_path?>/img/btn_select_move.gif" align=absmiddle></a>
    <?php } ?>
    </div>

    <div style="float:right;">
    <?php if ($write_href) { ?><a href="<?=$write_href?>"><img src="<?=$board_skin_path?>/img/btn_write.gif" border="0"></a><?php } ?>
    </div>
</div>

<div style="height:1px; line-height:1px; font-size:1px; background-color:#eee; clear:both;">&nbsp;</div>
<div style="height:1px; line-height:1px; font-size:1px; background-color:#ddd; clear:both;">&nbsp;</div>

<!-- 페이지 -->
<div style="text-align:center; line-height:30px; clear:both; margin:5px 0 10px 0; padding:5px 0; font-family:gulim;">

    <?php if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$board_skin_path/img/page_search_prev.gif' border=0 align=absmiddle title='이전검색'></a>"; } ?>
    <?php
// 기본으로 넘어오는 페이지를 아래와 같이 변환하여 이미지로도 출력할 수 있습니다.
    //echo $write_pages;
    $write_pages = str_replace("처음", "<img src='$board_skin_path/img/page_begin.gif' border='0' align='absmiddle' title='처음'>", $write_pages);
    $write_pages = str_replace("이전", "<img src='$board_skin_path/img/page_prev.gif' border='0' align='absmiddle' title='이전'>", $write_pages);
    $write_pages = str_replace("다음", "<img src='$board_skin_path/img/page_next.gif' border='0' align='absmiddle' title='다음'>", $write_pages);
    $write_pages = str_replace("맨끝", "<img src='$board_skin_path/img/page_end.gif' border='0' align='absmiddle' title='맨끝'>", $write_pages);
    $write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "<b><span style=\"color:#B3B3B3; font-size:12px;\">$1</span></b>", $write_pages);
    $write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<b><span style=\"color:#4D6185; font-size:12px; text-decoration:underline;\">$1</span></b>", $write_pages);
    ?>
    <?=$write_pages?>
    <?php if ($next_part_href) { echo "<a href='$next_part_href'><img src='$board_skin_path/img/page_search_next.gif' border=0 align=absmiddle title='다음검색'></a>"; } ?>

</div>

<!-- 링크 버튼, 검색 -->
<div style="text-align:center;">
<form name=fsearch method=get style="margin:0px;">
<input type=hidden name=bo_table value="<?=$bo_table?>">
<input type=hidden name=sca      value="<?=$sca?>">
<select name=sfl style="background-color:#f6f6f6; border:1px solid #7f9db9; height:21px;">
    <option value='wr_subject'>제목</option>
    <option value='wr_content'>내용</option>
    <option value='wr_subject||wr_content'>제목+내용</option>
    <option value='mb_id,1'>회원아이디</option>
    <option value='mb_id,0'>회원아이디(코)</option>
    <option value='wr_name,1'>글쓴이</option>
    <option value='wr_name,0'>글쓴이(코)</option>
</select>
<input name=stx maxlength=15 itemname="검색어" required value='<?=$stx?>' style="width:204px; background-color:#f6f6f6; border:1px solid #7f9db9; height:21px;">
<input type=image src="<?=$board_skin_path?>/img/btn_search.gif" border=0 align=absmiddle>
<input type=radio name=sop value=and>and
<input type=radio name=sop value=or>or

</form>
</div>

</td></tr></table>

<script language="JavaScript">
if ('<?=$sca?>') document.fcategory.sca.value = '<?=$sca?>';
if ('<?=$stx?>') {
    document.fsearch.sfl.value = '<?=$sfl?>';

    if ('<?=$sop?>' == 'and') 
        document.fsearch.sop[0].checked = true;

    if ('<?=$sop?>' == 'or')
        document.fsearch.sop[1].checked = true;
} else {
    document.fsearch.sop[0].checked = true;
}
</script>

<?php if ($is_checkbox) { ?>
<script language="JavaScript">
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function check_confirm(str) {
    var f = document.fboardlist;
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(str + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }
    return true;
}

// 선택한 게시물 삭제
function select_delete() {
    var f = document.fboardlist;

    str = "삭제";
    if (!check_confirm(str))
        return;

    if (!confirm("선택한 게시물을 정말 "+str+" 하시겠습니까?\n\n한번 "+str+"한 자료는 복구할 수 없습니다"))
        return;

    f.action = "./delete_all.php";
    f.submit();
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";
                       
    if (!check_confirm(str))
        return;

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<?php } ?>
<!-- 게시판 목록 끝 -->
