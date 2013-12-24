<?php
if (!defined("_GNUBOARD_")) exit;
?>
</div><!--//#ct-->
<hr>
<div class="ft">
    <p class="ft1">
        <?php if($is_member){?>
        <a class="f" href="<?php echo $g4['g4m_path']?>/logout.php?url=<?=urlencode($_SERVER['REQUEST_URI'])?>">로그아웃</a>
        <?php }else{ ?>
        <a class="f" href="<?php echo $g4['g4m_path']?>/login.php?url=<?=urlencode($_SERVER['REQUEST_URI'])?>">로그인</a>
        <?php } ?>
        <a href="#">PC버전</a>
    </p>
    <p class="ft3">
        <a href="#">이용약관</a> <span class="dv">|</span> <a href="#">개인정보보호정책</a> <span class="dv">|</span> <a href="#">개인정보취급방침</a>
    </p>
</div>
<address class="cr">&copy; <a href="http://www.g4m.kr/">GnuBoard Mobile</a></address>
<script type='text/javascript' src='<?php echo $g4['admin_path']?>/admin.js'></script>
<?php include_once "{$g4['g4m_path']}/tail.sub.php";
?>
