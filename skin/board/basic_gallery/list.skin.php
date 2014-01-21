<?php if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가


$thumb_width = '150';  //썸네일 폭
$thumb_height = '150'; //썸네일 높이
$thumb_quality = '86'; //썸네일 퀄리티_100 이하

if (!function_exists("imagecopyresampled")) alert("GD 2.0.1 이상 버전이 설치되어 있어야 사용할 수 있는 갤러리 게시판 입니다.");

$data_path = $g4[path]."/data/file/$bo_table";
$thumb_path = $data_path.'/thumb';


@mkdir($thumb_path, 0707);
@chmod($thumb_path, 0707);

$mod = $board[bo_gallery_cols];
$td_width = (int)(100 / $mod);
?>

<link rel="stylesheet" type="text/css" href="<?=$board_skin_path?>/css/skin.css" media="screen" />
<!-- Arquivos utilizados pelo jQuery lightBox plugin -->
<?php /*
<link rel="stylesheet" type="text/css" href="<?=$board_skin_path?>/css/jquery.lightbox-0.5.css" media="screen" />
<script type="text/javascript" src="<?=$board_skin_path?>/js/jquery.lightbox-0.5.js"></script>
<script type="text/javascript">
$(function() {
   $('#gallery .gall a').lightBox();
});
</script>
*/ ?>

<!-- 게시판 목록 시작 -->
<table width="<?=$width?>" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <div style="text-align:right; padding:10px 0;">
                <?php if ($rss_href) { ?><span class="button"><a href='<?=$rss_href?>'>rss</a></span><?php }?>
                <?php if ($admin_href) { ?><span class="button"><a href="<?=$admin_href?>">관리자</a></span><?php }?>
                <?php if ($write_href) { ?><span class="button"><a href="<?=$write_href?>">글쓰기</a></span><?php } ?>
            </div>

            <?php if ($is_checkbox) { ?>
            <div>
                <span class="button"><a href="javascript:select_delete();">선택삭제</a></span>
                <span class="button"><a href="javascript:select_copy('copy');">선택복사</a></span>
                <span class="button"><a href="javascript:select_copy('move');">선택이동</a></span>
            </div>
            <?php } ?>

            <form name="fboardlist" method="post" style="margin:0px;">
                <input type="hidden" name="bo_table" value="<?=$bo_table?>">
                <input type="hidden" name="sfl"  value="<?=$sfl?>">
                <input type="hidden" name="stx"  value="<?=$stx?>">
                <input type="hidden" name="spt"  value="<?=$spt?>">
                <input type="hidden" name="page" value="<?=$page?>">
                <input type="hidden" name="sw"   value="">

                <div id="gallery">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <?php
                            for ($i=0; $i<count($list); $i++)
                            {

                                $list[$i][subject] = str_replace(" ","&nbsp;",$list[$i][subject]);

                                if ($i && $i%$mod==0)
                                    echo "</tr><tr><td colspan='{$mod}' height=20></td></tr><tr>";
                                $img = "<img src='$board_skin_path/img/noimage.gif' title='이미지 없음'>";
                                $image = $list[$i][file][0][file];
                                $thumb = $thumb_path.'/'.$list[$i][file][0][file];
                                if (!file_exists($thumb))
                                {
                                    $file = $list[$i][file][0][path] .'/'. $list[$i][file][0][file];
                                    if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file) && file_exists($file))
                                    {
                                        $size = @getimagesize($file);
                                        if ($size[2] == 1)
                                            $src = imagecreatefromgif($file);
                                        else if ($size[2] == 2)
                                            $src = imagecreatefromjpeg($file);
                                        else if ($size[2] == 3)
                                            $src = imagecreatefrompng($file);
                                        else
                                            continue;

                                        $rate = $thumb_width / $size[0];
                                        $height = (int)($size[1] * $rate);

                                        if ($height < $thumb_height)
                                            $dst = imagecreatetruecolor($thumb_width, $height);
                                        else
                                            $dst = imagecreatetruecolor($thumb_width, $thumb_height);

                                        imagecopyresampled($dst, $src, 0, 0, 0, 0, $thumb_width, $height, $size[0], $size[1]);
                                        imagejpeg($dst, $thumb_path.'/'.$list[$i][file][0][file], $thumb_quality);
                                        chmod($thumb_path.'/'.$list[$i][file][0][file], 0606);
                                        imagejpeg($dst, $thumb_path.'/'.$list[$i][wr_id], $thumb_quality);
                                        chmod($thumb_path.'/'.$list[$i][wr_id], 0606);
                                    }
                                }

                                if (file_exists($thumb) && $list[$i][file][0][file]) {
                                    $img = "<a href='{$list[$i][href]}' title=".$list[$i][subject]."><img src='{$thumb}' width='{$thumb_width}'></a>";
                                } else {
                                    preg_match("`<\s*img\s+src\s*=\s*['|\"]?([^'|\"\s]+://[^'|\"\s]+\.(gif|jpe?g|png))['|\"]?\s*[^>]+`i", $list[$i]['wr_content'], $images);

                                    if (!empty($images[1])) {
                                        $img_size = GetImageSize("$images[1]");
                                        if($img_size[0] >= $img_size[1]) {
                                            $imgper = $thumb_width/$img_size[0];
                                            $thumb_height = $img_size[1]*$imgper;
                                        }else{
                                            $imgper = $thumb_height/$img_size[1];
                                            $thumb_width = $img_size[0]*$imgper;
                                        }

                                        $img = "<a href='{$list[$i][href]}'><img src='{$images[1]}' width='{$thumb_width}'></a>";
                                    } else {
                                        echo "";
                                    }
                                }

                                $style = "";
                                if ($list[$i][icon_new])
                                    $style = " style='font-weight:bold;' ";
                                $subject = "<a href='{$list[$i][href]}'><span $style>".cut_str($list[$i][subject],40)."</span></a>";

                                $comment_cnt = "";
                                if ($list[$i][comment_cnt])
                                    $comment_cnt = " <a href=\"{$list[$i][comment_href]}\"><span style='font-size:7pt;'>{$list[$i][comment_cnt]}</span></a>";

                                echo "<td width='{$td_width}%'>\n";
                                echo "<table width='100%' cellpadding='0' cellspacing='0' border='0'>\n";
                                echo "<tr valign='top' ><td align='center'>
                                <div class='gall'>
                                    $img
                                </div>
                            </td></tr>\n";
                            echo "<tr><td align='center'>$subject<span style='font-family:Tahoma;font-size:10px;'>{$list[$i][comment_cnt]}</span></td></tr>\n";
                            if ($is_checkbox) echo "<tr><td align='center'><input type=checkbox name=chk_wr_id[] value='{$list[$i][wr_id]}'></td></tr>\n";

                            echo "</td></tr>\n";
                            echo "</table></td>\n";

                        }

                        $cnt = $i%$mod;
                        if ($cnt)
                            for ($i=$cnt; $i<$mod; $i++)
                                echo "<td width='{$td_width}%'>&nbsp;</td>";
                            ?>
                        </tr>
                        <tr><td colspan='<?=$mod?>' height=20></td></tr>
                        <?php if (count($list) == 0) { echo "<tr><td colspan='$mod' height=100 align=center>게시물이 없습니다.</td></tr>"; } ?>
                    </table>
                </div>

            </form>

            <div  style="margin-top:7px; height:31px;">
                <div style="float:left;">

                    <?php if ($is_checkbox) { ?>
                    <span class="button"><a href="javascript:select_delete();">선택삭제</a></span>
                    <span class="button"><a href="javascript:select_copy('copy');">선택복사</a></span>
                    <span class="button"><a href="javascript:select_copy('move');">선택이동</a></span>
                    <?php } ?>
                </div>

                <div style="float:right;">
                    <?php if ($admin_href) { ?><span class="button"><a href="<?=$admin_href?>">관리자</a></span><?php }?>
                    <?php if ($write_href) { ?><span class="button"><a href="<?=$write_href?>">글쓰기</a></span><?php } ?>

                </div>
                <div style="clear:both;"></div>
            </div>


            <!-- 페이지 -->
            <div style="text-align:center;  margin:5px 0 10px 0; padding:5px 0;">

                <?php if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$board_skin_path/img/page_search_prev.gif' border=0 align=absmiddle title='이전검색'></a>"; } ?>
                <?php
                $write_pages = str_replace("처음", "<img src='$board_skin_path/img/page_begin.gif' border='0' align='absmiddle' title='처음'>", $write_pages);
                $write_pages = str_replace("이전", "<img src='$board_skin_path/img/page_prev.gif' border='0' align='absmiddle' title='이전'>", $write_pages);
                $write_pages = str_replace("다음", "<img src='$board_skin_path/img/page_next.gif' border='0' align='absmiddle' title='다음'>", $write_pages);
                $write_pages = str_replace("맨끝", "<img src='$board_skin_path/img/page_end.gif' border='0' align='absmiddle' title='맨끝'>", $write_pages);
                $write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "<b><span style=\"color:#B3B3B3; font-size:12px;\">$1</span></b>", $write_pages);
                $write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<b><span style=\" font-size:12px; text-decoration:underline;\">$1</span></b>", $write_pages);
                ?>
                <?=$write_pages?>
                <?php if ($next_part_href) { echo "<a href='$next_part_href'><img src='$board_skin_path/img/page_search_next.gif' border=0 align=absmiddle title='다음검색'></a>"; } ?>

            </div>

            <!-- 검색 -->
            <div class="board_search">
                <form name="fsearch" method="get">
                    <input type="hidden" name="bo_table" value="<?=$bo_table?>">
                    <input type="hidden" name="sca"      value="<?=$sca?>">
                    <input type="hidden" name="sop"      value="and">
                    <select name="sfl">
                        <option value="wr_subject">제목</option>
                        <option value="wr_content">내용</option>
                        <option value="wr_subject||wr_content">제목+내용</option>
                    </select>
                    <input name="stx" style="height:16px; border:1px solid #ccc;" maxlength="15" itemname="검색어" required value='<?=stripslashes($stx)?>'>
                    <input type="image" src="<?=$board_skin_path?>/img/btn_search.gif" border='0' align="absmiddle">
                </form>
            </div>
        </td>
    </tr>
</table>

<?php
if ($is_checkbox) {
    ?>
    <script type="text/javascript">
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
    <?php
}
?>
<!-- 게시판 목록 끝 -->
