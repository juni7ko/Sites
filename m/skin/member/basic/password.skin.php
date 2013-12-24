<?php
if (!defined("_GNUBOARD_"))
    exit; // 개별 페이지 접근 불가 
?>

<script type="text/javascript" src="<?php echo $g4['path'] ?>/js/capslock.js"></script>

<form name="fboardpassword" method=post onsubmit="return fboardpassword_submit(this);" action="">
    <fieldset>
        <legend class="hc">패스워드 입력</legend>    
        <input type='hidden' name='w'           value="<?php echo $w ?>">
        <input type='hidden' name='bo_table'    value="<?php echo $bo_table ?>">
        <input type='hidden' name='wr_id'       value="<?php echo $wr_id ?>">
        <input type='hidden' name='comment_id'  value="<?php echo $comment_id ?>">
        <input type='hidden' name='sfl'         value="<?php echo $sfl ?>">
        <input type='hidden' name='stx'         value="<?php echo $stx ?>">
        <input type='hidden' name='page'        value="<?php echo $page ?>">
        <div style="border: 1px solid #ccc; padding:10px; margin: 10px; text-align: center; border-radius:8px;">
            <input type='password' maxLength='20' size='15' name="wr_password" id="password_wr_password" itemname="패스워드" required onkeypress="check_capslock(event, 'password_wr_password');" style="border:1px solid #666;">
            <button type="submit">확인</button>
            <p class="noticebox">
                이 게시물의 패스워드를 입력하십시오.
            </p>
        </div>
    </fieldset>
</form>

<script type='text/javascript'>
    document.fboardpassword.wr_password.focus();

    function fboardpassword_submit(f)
    {
        f.action = "<?php echo $action ?>";
        return true;
    }
</script>
