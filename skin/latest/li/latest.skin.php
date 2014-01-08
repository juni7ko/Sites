<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

for ($i=0; $i<count($list); $i++) {
    echo "<li>";
    echo $list[$i]['icon_reply'] . " ";
    echo "<a href='{$list[$i]['href']}'>";
    if ($list[$i]['is_notice'])
        echo "<strong>{$list[$i]['subject']}</strong>";
    else
        echo $list[$i]['subject'];
    echo "</a>";

    if ($list[$i]['comment_cnt'])
        echo " <a href=\"{$list[$i]['comment_href']}\"><span style='font-family:돋움; font-size:8pt; color:#9A9A9A;'>{$list[$i]['comment_cnt']}</span></a>";

    //echo " " . $list[$i]['icon_new'];
    //echo " " . $list[$i]['icon_file'];
    //echo " " . $list[$i]['icon_link'];
    //echo " " . $list[$i]['icon_hot'];
    //echo " " . $list[$i]['icon_secret'];
    echo "</li>";
}

if (count($list) == 0) {
    echo "<font color=#6A6A6A>게시물이 없습니다.</font>";
}
?>
