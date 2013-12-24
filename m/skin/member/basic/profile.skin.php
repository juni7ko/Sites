<?php
if (!defined("_GNUBOARD_"))
    exit; // 개별 페이지 접근 불가 
?>
<div class="wr_title">
    <h1><?php echo $g4['title']; ?></h>
        <p class="l"></p>
        <p class="r"></p>
</div>
<ul id="profile">
    <li>
        회원권한 : <?php echo $mb['mb_level'] ?>
    </li>
    <li>
        포인트 : <?php echo number_format($mb['mb_point']) ?> 점
    </li>
    <?php if ($mb_homepage) { ?>
    <li>
            홈페이지 : <a href="<?php echo $mb_homepage ?>" target="<?php echo $config['cf_link_target'] ?>"><?php echo $mb_homepage ?></a>
    </li>
    <?php } ?>
    <li>
        회원가입일 : <?php echo ($member['mb_level'] >= $mb['mb_level']) ? substr($mb['mb_datetime'], 0, 10) . " (" . $mb_reg_after . " 일)" : "알 수 없음"; ?>
    </li>
    <li>
        최종접속일 : <?php echo ($member['mb_level'] >= $mb['mb_level']) ? $mb['mb_today_login'] : "알 수 없음"; ?>
    </li>
    <li>
        소개 : <p><?php echo $mb_profile ?></p>
    </li>
</ul>
