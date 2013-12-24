<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
$list_count = count($list);
?>
<script type="text/javascript">
</script>
<div class="wr_title">
    <h1>쪽지함</h1>
    <p class="l">
        <a href="./memo.php?kind=recv" class="btn" title="받은쪽지">받음</a>
        <a href="./memo.php?kind=send" class="btn" title="보낸쪽지">보냄</a>
    </p>
    <p class="r">
        <a href="./memo_form.php" class="btn2" title="쪽지보내기">보내기</a>
    </p>
</div>
<div class="noticebox">
    전체 <?php echo $kind_title?> 쪽지 [ <B><?php echo $total_count?></B> ]통
    쪽지 보관일수는 최장 <?php echo $config['cf_memo_del']?>일 입니다.
</div>
<ul class="memo">
    <?php 
    for ($i = 0; $i < $list_count; $i++) { 
        if($list[$i]['me_read_datetime'] == "0000-00-00 00:00:00"){
            $chk_read = "background-color:#efefef";
        }else{
            $chk_read = "";
        }
    ?>
    <li style="<?php echo $chk_read?>">
        <a href="<?php echo $list[$i]['view_href'] ?>">
            <span><?php echo cut_str($list[$i]['me_memo'], '46') ?></span>
            <br />
            <span class="se">보낸이 : <?php echo $list[$i]['mb_nick'] ?></span>
            <span class="se_date"><?php echo $list[$i]['send_datetime'] ?></span>            
        </a>
        <p class="me_del"><button  onclick="del('<?php echo $list[$i][del_href] ?>');" class="btn">삭제</button></p>
    </li>
    <?php } ?>

<?php if ($list_count == 0) {
    echo "<li>자료가 없습니다.</li>";
} 
?>
</ul>

<div id="paging">
    <?php
    $page = str_replace("처음", "&lt;&lt;", $page);
    $page = str_replace("이전", "&lt;", $page);
    $page = str_replace("다음", "&gt;", $page);
    $page = str_replace("맨끝", "&gt;&gt;", $page);
    echo $page;
    ?>
</div>
