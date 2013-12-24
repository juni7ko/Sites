<?php
if (!defined("_GNUBOARD_"))
    exit; // 개별 페이지 접근 불가
/*
 * g4m gallery skin
 */
$width = "80";
$height = "60";
$crop = "1"; // 잘라서 썸네일 생성
$quality = "90"; //품질 1~100
$list_count = count($list);
?>
<style type="text/css">
div.g4m_gallery ul li{float: left; width: <?php echo $width + 10?>px; height: <?php echo $height + 25?>px;  overflow: hidden; margin: 5px 5px 5px; text-align: center;}
</style>
<div class="g4m_gallery">
    <h3>
        <span><?php echo $board['bo_subject'] ?></span>
        <a href='<?php echo $g4['g4m_bbs_path'] ?>/board.php?bo_table=<?php echo $bo_table ?>' class="more">more</a>
    </h3>
    <div style="display: table;margin:0 auto; text-align: center; overflow: hidden">
        <ul>
            <?php for ($i = 0; $i < $list_count; $i++) { 
             //댓글수
                if ($list[$i]['comment_cnt']) {
                    $cmt_count = " <span class='lt_cmt'>{$list[$i]['comment_cnt']}</span>";
                }

				$immg = $list[$i]['file']['0']['file'];
				if(!$immg) $immg = "2042355175_XJ30fRP4_C0DBBEF701.jpg";
            ?>
                <li>
                    <a href='<?php echo $list[$i]['href'] ?>' class="thumb_img">
                        <img src="<?php echo "{$g4['thumb']}?bo_table={$board['bo_table']}&amp;img={$immg}&amp;w={$width}&amp;h={$height}&amp;crop={$crop}&amp;q={$quality}"?>"/>
                    </a>
                    <a href='<?php echo $list[$i]['href'] ?>' class="subject">
                        <?php echo cut_str($list[$i]['subject'],'21') ?> <?php echo $cmt_count ?>
                    </a>
                    <?php
                    // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
                    // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }
                    /*
                    echo " " . $list[$i]['icon_new'];
                    echo " " . $list[$i]['icon_file'];
                    echo " " . $list[$i]['icon_link'];
                    echo " " . $list[$i]['icon_hot'];
                    echo " " . $list[$i]['icon_secret'];
                     * 
                     */
                    ?>
                </li>
            <?php } ?>

            <?php if ($list_count == 0) { ?><li class="empty"><p>게시물이 없습니다.</p></li><?php } ?>
        </ul>
    </div>
</div>
