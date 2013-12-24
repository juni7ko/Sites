<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<div class="wr_title">
    <h1>보내기</h1>
    <p class="l">
        <a href="./memo.php?kind=recv" class="btn" title="받은쪽지">받음</a>
        <a href="./memo.php?kind=send" class="btn" title="보낸쪽지">보냄</a>
    </p>
    <p class="r">
        <a href="./memo.php" class="btn2" title="쪽지보내기">취소</a>
    </p>
</div>

<form class="me_form" name='fmemoform' method='post' onsubmit="return fmemoform_submit(this);" autocomplete="off" action="">
    <fieldset>
        <legend class="hc">쪽지 보내기</legend>
        <dl class="me1">
            <dt></dt>
            <dd>
                <p>받는 회원아이디</p>
                <input type=text name="me_recv_mb_id" required itemname="받는 회원아이디" value="<?=$me_recv_mb_id?>" style="width:100%;">
                <p class="noticebox">※여러 회원에게 보낼때는 컴마(,)로 구분</p>
            </dd>
        </dl>
        <dl class="me1">
            <dt></dt>
            <dd>
                <textarea name=me_memo rows=10 style='width:100%;' required itemname='내용'><?=$content?></textarea>
            </dd>
        </dl>
        <dl class="me2">
            <dt><img id='kcaptcha_image' class="kcaptcha_image"/></dt>
            <dd><input type="input" size='10' name='wr_key' itemname="자동등록방지" required style="height:60px;">왼쪽글자입력</dd>
        </dl>
    <div class="me_btn" style="text-align: center">
        <button id='btn_submit' type='submit' class='btn'/>보내기</button>
    </div>
    </fieldset>
</form>

<script type="text/javascript" src="<?php echo $g4['path']?>/js/md5.js"></script>
<script type="text/javascript" src="<?php echo "{$g4['g4m_path']}/js/jquery.kcaptcha.js"?>"></script>
<script type="text/javascript">
with (document.fmemoform) {
    if (me_recv_mb_id.value == "")
        me_recv_mb_id.focus();
    else
        me_memo.focus();
}

function fmemoform_submit(f)
{
    if (!check_kcaptcha(f.wr_key)) {
        return false;
    }

    document.getElementById("btn_submit").disabled = true;

    f.action = "./memo_form_update.php";
    return true;
}
</script>
