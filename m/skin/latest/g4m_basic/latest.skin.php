<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
/*
 * g4m Basic
 */
$list_count = count($list);
?>
<div class="g4m_latest">
    <h2>
        <a href='<?php echo $g4['g4m_bbs_path'] ?>/board.php?bo_table=<?php echo $bo_table ?>'><?php echo $board['bo_subject'] ?></a>
        <a href='<?php echo $g4['g4m_bbs_path'] ?>/board.php?bo_table=<?php echo $bo_table ?>' class="more">more</a>
    </h2>

    <ul class="li1">
        <?php for ($i = 0; $i < $list_count; $i++) { ?>
        <li>
            <?php echo "<a href=\"{$list[$i]['href']}\">";
            echo $list[$i]['icon_reply'] . " ";     //답글

            //공지
            if ($list[$i]['is_notice']){
                echo "<span class=\"lt_notice\">{$list[$i]['subject']}</span>";
            }else{
                echo "{$list[$i]['subject']}";
            }

            //댓글수
            if ($list[$i]['comment_cnt']){
                echo " <span class='lt_cmt'>{$list[$i]['comment_cnt']}</span>";
            }

            // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
            // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

            echo " " . $list[$i]['icon_new'];
            echo " " . $list[$i]['icon_file'];
            echo " " . $list[$i]['icon_link'];
            echo " " . $list[$i]['icon_hot'];
            echo " " . $list[$i]['icon_secret'];
            echo "</a>";
            ?>
        </li>
    <?php } ?>

    <?php if ($list_count == 0) { ?><li class="empty"><p>게시물이 없습니다.</p></li><?php } ?>
    </ul>
</div>
