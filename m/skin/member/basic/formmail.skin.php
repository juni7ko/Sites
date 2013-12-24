<?php
if (!defined("_GNUBOARD_"))
    exit; // 개별 페이지 접근 불가 
?>
<div class="wr_title">
    <h1><?php echo $g4['title']; ?></h>
        <p class="l"></p>
        <p class="r"></p>
</div>

<p class="noticebox"><?php echo $name ?></b>님께 메일보내기</p>
    
<form name="fformmail" method="post" onsubmit="return fformmail_submit(this);" enctype="multipart/form-data" style="margin:0px;" action="" class="me_form">
    <fieldset>
        <input type="hidden" name="to"     value="<?php echo $email ?>">
        <input type="hidden" name="attach" value="2">
        <input type="hidden" name="token"  value="<?php echo $token ?>">
        <legend class="hc">메일 보내기</legend>
        
        <?php if ($is_member) { // 회원이면  ?>    
            <input type='hidden' name='fnick'  value='<?php echo $member['mb_nick'] ?>'>
            <input type='hidden' name='fmail'  value='<?php echo $member['mb_email'] ?>'>
        <?php } else { ?>
            <dl class="me1">
                <dt></dt>
                <dd>
                    <p>이름</p>
                    <input type=text style='width:100%;' name='fnick' required minlength=2 itemname='이름'>
                    <p>E-mail</p>
                    <input type="text" style='width:100%;' name='fmail' required email itemname='E-mail'>
                </dd>
            </dl>
        <?php } ?>

        <dl class="me1">
            <dt></dt>
            <dd>
                <p>제 목</p>
                <input type="text" style='width:100%;' name='subject' required itemname='제목'>
            </dd>
            <dd>
                <span>선택</span>
                <input type='radio' name='type' value='0' checked id="mail_0"> <label for="mail_0">TEXT</label>
                <input type='radio' name='type' value='1' id="mail_1" > <label for="mail_1"> HTML</label>
                <input type='radio' name='type' value='2' id="mail_2" > <label for="mail_2"> TEXT+HTML</label>
            </dd>
        </dl>
        <dl class="me1">
            <dt></dt>
            <dd>
                <p>내용</p>
                <textarea name="content" style='width:100%;' rows='9' required itemname='내용'></textarea>
            </dd>
            <dl>
                <p>
                첨부파일 #1
                <input type=file style='width:90%;' name='file1'>
                </p>
            </dl>
            <dl>
                첨부파일 #2
                <input type=file style='width:90%;' name='file2'>
            </dl>
        </dl>        
        
        <dl class="me2">
            <dt><img id='kcaptcha_image' /></dt>
            <dd><input type="input" size='10' name='wr_key' itemname="자동등록방지" required style="height:60px;">왼쪽글자입력</dd>
        </dl>
        <div class="me_btn" style="text-align: center">
            <button id='btn_submit' type='submit' class='btn'/>보내기</button>
        </div>
    </fieldset>
</form>

<script type="text/javascript" src="<?php echo"{$g4['path']}/js/md5.js" ?>"></script>
<script type="text/javascript" src="<?php echo"{$g4['g4m_path']}/js/jquery.kcaptcha.js" ?>"></script>
<script type="text/javascript">
    with (document.fformmail) {
        if (typeof fname != "undefined")
            fname.focus();
        else if (typeof subject != "undefined")
            subject.focus();
    }

    function fformmail_submit(f)
    {
        if (!check_kcaptcha(f.wr_key)) {
            return false;
        }

        if (f.file1.value || f.file2.value) {
            // 4.00.11
            if (!confirm("첨부파일의 용량이 큰경우 전송시간이 오래 걸립니다.\n\n메일보내기가 완료되기 전에 창을 닫거나 새로고침 하지 마십시오."))
                return false;
        }

        document.getElementById('btn_submit').disabled = true;

        f.action = "./formmail_send.php";
        return true;
    }
</script>
