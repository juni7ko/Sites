<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
/*
 * http://www.g4m.kr
 * g4m mobile new.skin.php
 */
?>
<div class="new_title">
    <h2>최근 게시물</h2>
</div>
<div class="new_head">
    <!-- 분류 시작 -->
    <form name='fnew' method='get' action="" style="margin:0px;">
        <?php echo $group_select ?>
        <select id='view' name='view' onchange="select_change()">
            <option value=''>게시물</option>
            <option value='w'>원글</option>
            <option value='c'>코멘트</option>
        </select>
        ID : <input type='text' id='mb_id' name='mb_id' size="6" value='<?php echo $mb_id ?>'>
        <input type='submit' value='검색' class="btn">
        <script type="text/javascript">
            function select_change(){
                document.fnew.submit();
            }
            document.getElementById("gr_id").value = "<?php echo $gr_id ?>";
            document.getElementById("view").value = "<?php echo $view ?>";
        </script>
    </form>
</div>
<!-- 분류 끝 -->

<!-- 제목 시작 -->
<div class="new_list">
    <ul>
    <?php
        $list_count = count($list);
        for ($i = 0; $i < $list_count; $i++) {
            $gr_subject = cut_str($list[$i]['gr_subject'], 30);
            $bo_subject = cut_str($list[$i]['bo_subject'], 30);
            $wr_subject = get_text(cut_str($list[$i]['wr_subject'], 40));
    ?>
        <li>
            <a href='<?php echo $list[$i]['href']?>' title="제목" class="subj"> &middot; <?php echo $list[$i]['comment']?><?php echo $wr_subject?></a>
            <span class="wr">
                <a href="./new.php?gr_id=<?php echo $list[$i]['gr_id']?>" title="<?php echo $gr_subject?>" class="group">[<?php echo $gr_subject?>]</a>
                <a href='./board.php?bo_table=<?php echo $list[$i]['bo_table']?>' title="<?php echo $bo_subject?>"> <?php echo $bo_subject?></a>
                <?php echo $list[$i]['name']?> <?php echo $list[$i]['datetime2']?>
            </span>
        </li>
    <?php } //for?>
        <?php if ($list_count == 0) { ?>
        <li style="text-align:center; padding: 20px;">게시물이 없습니다.</li>
        <?php } ?>
    </ul>
    <div id="paging">
        <?php echo $write_pages?>
    </div>
</div>
