<?php if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

if (!$board[bo_1]) $img_width = 150;
	else $img_width = $board[bo_1]; //alert("게시판 설정 : 여분 필드 1 에 목록에서 보여질 이미지의 가로사이즈를 설정하십시오. (예)120)"); //120
if (!$board[bo_2]) $img_height = 150;
	else $img_height = $board[bo_2]; //alert("게시판 설정 : 여분 필드 2 에 목록에서 보여질 이미지의 세로사이즈를 비율로 설정하십시오. (예)150)"); //80
if (!$board[bo_3]) $img_quality = 95;
	else $img_quality = $board[bo_3]; //alert("게시판 설정 : 여분 필드 9 에 목록에서 보여질 이미지의 질(quality)을 비율로 설정하십시오. (100 이하)"); //100
if (!function_exists("imagecopyresampled")) alert("GD 2.0.1 이상 버전이 설치되어 있어야 사용할 수 있는 갤러리 게시판 입니다.");

$data_path = $g4[path]."/data/file/$bo_table";
$thumb_path = $data_path.'/thumb';
$cheditor4_path = $g4[path]."/data/cheditor4";

@mkdir($thumb_path, 0707);
@chmod($thumb_path, 0707);

$mod = $board[bo_gallery_cols];
$td_width = (int)(100 / $mod);

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = $board[bo_gallery_cols];

// 제목이 두줄로 표시되는 경우 이 코드를 사용해 보세요.
// <nobr style='display:block; overflow:hidden; width:000px;'>제목</nobr>
$brd_text_color = "#333333";
$brd_line_color = "#ceb968";
?>

<style>
.board_top { clear:both; }

.board_list { clear:both; width:100%; table-layout:fixed; margin:5px 0 0 0; }
.board_list th { font-weight:bold; font-size:12px; color:<?=$brd_text_color?>; } 
.board_list th { white-space:nowrap; height:34px; overflow:hidden; text-align:center; } 
/*.board_list th { border-top:solid 1px <?=$brd_line_color?>; border-bottom:solid 1px <?=$brd_line_color?>; }*/

.board_list tr.bg0 { background-color:transparent; } 
.board_list tr.bg1 { background-color:transparent; } 

.board_list td { padding:.5em; color:<?=$brd_text_color?>; }
/*.board_list td { border-bottom:solid 1px <?=$brd_line_color?>; }*/
.board_list td.num { color:<?=$brd_text_color?>; text-align:center; }
.board_list td.checkbox { text-align:center; }
.board_list td.subject { overflow:hidden; }
.board_list td.name { padding:0 0 0 10px; }
.board_list td.datetime { font:normal 11px tahoma; color:<?=$brd_text_color?>; text-align:center; }
.board_list td.hit { font:normal 11px tahoma; color:<?=$brd_text_color?>; text-align:center; }
.board_list td.good { font:normal 11px tahoma; color:<?=$brd_text_color?>; text-align:center; }
.board_list td.nogood { font:normal 11px tahoma; color:<?=$brd_text_color?>; text-align:center; }

.board_list .notice { font-weight:normal; }
.board_list .current { font:bold 11px tahoma; color:<?=$brd_text_color?>; }
.board_list .comment { font-family:Tahoma; font-size:10px; color:<?=$brd_text_color?>; }

.board_button { clear:both; margin:10px 0 0 0; border-top:solid 1px <?=$brd_line_color?>; padding-top:5px; }

.board_page { clear:both; text-align:center; margin:3px 0 0 0; }
.board_page a:link { color:<?=$brd_text_color?>; }

.board_search { text-align:center; margin:10px 0 0 0; color:<?=$brd_text_color?>; }
.board_search .stx { height:21px; border:solid 1px <?=$brd_line_color?>; border-right:solid 1px <?=$brd_line_color?>; border-bottom:solid 1px <?=$brd_line_color?>; }

.color_white { color:<?=$brd_text_color?>; }
.board_list a:link, a:visited, a:active { text-decoration:none; color:<?=$brd_text_color?>; }
.board_list a:hover { text-decoration:underline; color:<?=$brd_text_color?>; }
</style>

<!-- 게시판 목록 시작 -->
<table width="<?=$width?>" align="center" cellpadding="0" cellspacing="0"><tr><td>

    <!-- 분류 셀렉트 박스, 게시물 몇건, 관리자화면 링크 -->
    <div class="board_top">
        <div style="float:left;">
            <form name="fcategory" method="get" style="margin:0px;">
            <?php if ($is_category) { ?>
            <select name=sca onchange="location='<?=$category_location?>'+<?=strtolower($g4[charset])=='utf-8' ? "encodeURIComponent(this.value)" : "this.value"?>;">
            <option value=''>전체</option>
            <?=$category_option?>
            </select>
            <?php } ?>
            </form>
        </div>
        <div style="float:right;">
            <img src="<?=$board_skin_path?>/img/icon_total.gif" align="absmiddle" border='0'>
            <span style="color:<?=$brd_text_color?>; font-weight:bold;">Total <?=number_format($total_count)?></span>
            <?php if ($rss_href) { ?><a href='<?=$rss_href?>'><img src='<?=$board_skin_path?>/img/btn_rss.gif' border='0' align="absmiddle"></a><?php }?>
            <?php if ($admin_href) { ?><a href="<?=$admin_href?>"><img src="<?=$board_skin_path?>/img/btn_admin.gif" border='0' title="관리자" align="absmiddle"></a><?php }?>
        </div>
    </div>

    <!-- 제목 -->
    <form name="fboardlist" method="post">
    <input type='hidden' name='bo_table' value='<?=$bo_table?>'>
    <input type='hidden' name='sfl'  value='<?=$sfl?>'>
    <input type='hidden' name='stx'  value='<?=$stx?>'>
    <input type='hidden' name='spt'  value='<?=$spt?>'>
    <input type='hidden' name='page' value='<?=$page?>'>
    <input type='hidden' name='sw'   value=''>

		<div class="color_white"><?php if ($is_checkbox) { ?><input onclick="if (this.checked) all_checked(true); else all_checked(false);" type=checkbox> 전체 선택<?php }?></div>
    
    <table cellspacing="0" cellpadding="0" class="board_list" style="border-top:solid 1px <?=$brd_line_color?>; padding-top:10px;">
		<tr>		
<?php for ($i=0; $i<count($list); $i++) {
   $img = "<img src='$board_skin_path/img/noimage.gif' border=0 width='$img_width' height='$img_height' title='이미지 없음' align=left style='margin-right:5px; border:1px solid {$brd_line_color}; padding:3px;'>";
    $thumb = $thumb_path.'/'.$list[$i][wr_id];
    // 썸네일 이미지가 존재하지 않는다면
    if (!file_exists($thumb)) {
        $file = $list[$i][file][0][path] .'/'. $list[$i][file][0][file];
				
				if(!$list[$i][file][0]) {
					//$ym = date("ym", $g4[server_time]);
					$ym = date("ym", strtotime($list[$i]['wr_datetime']));
					$edit_img = $list[$i]['wr_content'];
					if (eregi("data/cheditor4/{$ym}/[^<>]*\.(gif|jpg|png|bmp)", $edit_img, $tmp)) {
						$file = "../" . $tmp[0]; // 파일명
					}
				}

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
        $img = "<img src='$thumb' border=0 style='border:1px solid {$brd_line_color}; padding:3px;'>";
		else
			if(preg_match("/\.(swf|wma|asf)$/i","$file") && file_exists($file))
				{ $img = "<script>doc_write(flash_movie('$file', 'flash$i', '$img_width', '$img_height', 'transparent'));</script>"; }

		if ($i && $i%$mod==0)
			echo "</tr><tr align=center>";
				
		echo "<td width='{$td_width}%' valign=top align=left style='word-break:break-all; padding:5px;'>";
		echo "<div style='margin-top:3px; clear:both;'><a href='{$list[$i][href]}'>$img</a></div>";
		echo "<div style='margin-top:5px; clear:both;'>";
		if ($is_checkbox) { ?><input type=checkbox name=chk_wr_id[] value="<?=$list[$i][wr_id]?>"><?php }
		if ($is_category && $list[$i][ca_name]) { 
				echo "<span class='small color_white'>[<a href='{$list[$i][ca_name_href]}'>{$list[$i][ca_name]}</a>]</span> ";
		}
		echo "<a href='{$list[$i][href]}' $style>" . $list[$i][subject] . "</a>";
		echo "</div>";
		echo "</td>\n";
}
// 나머지 td
$cnt = $i%$mod;
if ($cnt)
    for ($i=$cnt; $i<$mod; $i++)
        echo "<td width='{$td_width}%'>&nbsp;</td>";
?>
    </tr>
    <?php if (count($list) == 0) { echo "<tr><td class='color_white' colspan='$colspan' height=100 align=center>게시물이 없습니다.</td></tr>"; } ?>
    </table>
    </form>

    <div class="board_button">
        <div style="float:left;">
        <?php if ($list_href) { ?>
        <a href="<?=$list_href?>"><img src="<?=$board_skin_path?>/img/btn_list.gif" align="absmiddle" border='0'></a>
        <?php } ?>
        <?php if ($is_checkbox) { ?>
        <a href="javascript:select_delete();"><img src="<?=$board_skin_path?>/img/btn_select_delete.gif" align="absmiddle" border='0'></a>
        <a href="javascript:select_copy('copy');"><img src="<?=$board_skin_path?>/img/btn_select_copy.gif" align="absmiddle" border='0'></a>
        <a href="javascript:select_copy('move');"><img src="<?=$board_skin_path?>/img/btn_select_move.gif" align="absmiddle" border='0'></a>
        <?php } ?>
        </div>

        <div style="float:right;">
        <?php if ($write_href) { ?><a href="<?=$write_href?>"><img src="<?=$board_skin_path?>/img/btn_write.gif" border='0'></a><?php } ?>
        </div>
    </div>

    <!-- 페이지 -->
    <div class="board_page">
        <?php if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$board_skin_path/img/page_search_prev.gif' border='0' align=absmiddle title='이전검색'></a>"; } ?>
        <?php
// 기본으로 넘어오는 페이지를 아래와 같이 변환하여 이미지로도 출력할 수 있습니다.
        //echo $write_pages;
        $write_pages = str_replace("처음", "<img src='$board_skin_path/img/page_begin.gif' border='0' align='absmiddle' title='처음'>", $write_pages);
        $write_pages = str_replace("이전", "<img src='$board_skin_path/img/page_prev.gif' border='0' align='absmiddle' title='이전'>", $write_pages);
        $write_pages = str_replace("다음", "<img src='$board_skin_path/img/page_next.gif' border='0' align='absmiddle' title='다음'>", $write_pages);
        $write_pages = str_replace("맨끝", "<img src='$board_skin_path/img/page_end.gif' border='0' align='absmiddle' title='맨끝'>", $write_pages);
        //$write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "$1", $write_pages);
        $write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<b><span style=\"color:{$brd_text_color}; font-size:12px; text-decoration:underline;\">$1</span></b>", $write_pages);
        ?>
        <?=$write_pages?>
        <?php if ($next_part_href) { echo "<a href='$next_part_href'><img src='$board_skin_path/img/page_search_next.gif' border='0' align=absmiddle title='다음검색'></a>"; } ?>
    </div>

    <!-- 검색 -->
    <div class="board_search">
        <form name="fsearch" method="get">
        <input type="hidden" name="bo_table" value="<?=$bo_table?>">
        <input type="hidden" name="sca"      value="<?=$sca?>">
        <select name="sfl">
            <option value="wr_subject">제목</option>
            <option value="wr_content">내용</option>
            <option value="wr_subject||wr_content">제목+내용</option>
            <option value="mb_id,1">회원아이디</option>
            <option value="mb_id,0">회원아이디(코)</option>
            <option value="wr_name,1">글쓴이</option>
            <option value="wr_name,0">글쓴이(코)</option>
        </select>
        <input name="stx" class="stx" maxlength="15" itemname="검색어" required value='<?=$stx?>'>
        <input type="image" src="<?=$board_skin_path?>/img/btn_search.gif" border='0' align="absmiddle">
        <input type="radio" name="sop" value="and">and
        <input type="radio" name="sop" value="or">or
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
