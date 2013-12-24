<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<div class="wr_title">
    <h1>보기</h1>
    <p class="l">
        <a href="./memo.php?kind=recv" class="btn" title="받은쪽지">받음</a>
        <a href="./memo.php?kind=send" class="btn" title="보낸쪽지">보냄</a>
    </p>
    <p class="r">
        <a href="./memo_form.php" class="btn2" title="쪽지보내기">보내기</a>
    </p>
</div>
<div class="noticebox">
    <?php
    $nick = get_sideview($mb['mb_id'], $mb['mb_nick'], $mb['mb_email'], $mb['mb_homepage']);
    if ($kind == "recv")
        echo "<span>$nick</span> 님께서 {$memo['me_send_datetime']}에 보내온 쪽지의 내용입니다.";

    if ($kind == "send")
        echo "<span>$nick</span> 님께 {$memo['me_send_datetime']}에 보낸 쪽지의 내용입니다.";
    ?>
    
</div>
<div class="me_btn">
    <a href="<?php echo $prev_link?>" class='btn2 l' title="이전">이전</a>
    <a href="<?php echo $next_link?>" class='btn2 r' title="다음">다음</a>
</div>
<article>
    <div class="me_content">
        <?php echo conv_content($memo['me_memo'], 0)?>
    </div>
</article>
<div class="me_btn">
    <?php if ($kind == "recv") echo "<a href='./memo_form.php?me_recv_mb_id={$mb['mb_id']}&me_id={$memo['me_id']}' class='btn2 l' title='답장'>답장</a>"; ?>
    <a href="./memo.php?kind=<?php echo $kind?>" class='btn2 r' title="목록">목록</a>
</div>
