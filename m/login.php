<?php
include_once "./_common.php";

$g4['title'] = "로그인";
include_once("./_head.php");
// 이미 로그인 중이라면
if ($member['mb_id']){
    if ($url)
        goto_url($url);
    else
        goto_url($g4['g4m_path']);
}
if ($url)
    $urlencode = urlencode($url);
else
    $urlencode = urlencode($_SERVER['REQUEST_URI']);

if ($g4['https_url']) {
    $login_url = $_GET['url'];
    if ($login_url) {
        if (preg_match("/^\.\.\//", $url)) {
            $login_url = urlencode($g4['url'] . "/" . preg_replace("/^\.\.\//", "", $login_url));
        } else {
            $purl = parse_url($g4['url']);
            if ($purl['path']) {
                $path = urlencode($purl['path']);
                $urlencode = preg_replace("/" . $path . "/", "", $urlencode);
            }
            $login_url = $g4['url'] . $urlencode;
        }
    } else {
        $login_url = $g4['url'];
    }
} else {
    $login_url = $urlencode;
}
?>

<div id="login">
    <h1>로그인</h1>
    <div class="sc1">
    <form name="flogin" method="post" onsubmit="return flogin_submit(this);" autocomplete="off" action="<?php echo $g4['bbs_path']?>/login_check.php">
        <fieldset>
            <legend class="hc">로그인</legend>
            <input type="hidden" name="url" value='<?php echo $login_url ?>'>
            <div class="ia">
                <ul class="ip">
                    <li>
                        <label class="hc" for="id">아이디</label>
                        <span id="idb" class="it">
                            <input type="text" class="il" maxlength="26" name="mb_id" id="login_mb_id" style="ime-mode: disabled; background: url('./img/lb.gif') no-repeat scroll 0.6em 5px #FFFFFF;">
                        </span>
                    </li>
                    <li>
                        <label class="hc" for="pw">비밀번호</label>
                        <span id="pwb" class="it" style="border: 1px solid rgb(155, 155, 157);">
                            <input type="password" class="pl" maxlength="16" name="mb_password" id="login_mb_password" style="background: url('./img/lb.gif') no-repeat scroll 0.6em -78px #FFFFFF;">
                        </span>
                    </li>
                </ul>
                <p class="ac">
                    <input type="submit" id="btn" value="로그인">
                </p>
            </div>
            <div class="ot">
                <p class="sv">
                    <input type="checkbox" name="auto_login" id="login_auto_login" value="1" > <label for="login_auto_login">자동 로그인</label>
                </p>
            </div>
        </fieldset>
    </form>
    </div>

    <div class="sc2">
        <h2>아이디가 없으세요?<br>아이디나 비밀번호가 기억나지 않으세요?</h2>
        <p>PC에서 <?php echo $config['cf_title']?>(<a target="_top" href="<?php echo $g4['url']?>?from=mobile"><?php echo $g4['url']?></a>) 회원가입과 아이디/비밀번호 찾기를 하실 수 있습니다.</p>
    </div>
</div>
<script type="text/javascript">
$(function() {
    $("#login_auto_login").bind("click", function() {
        if (confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n\공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?")) {
            this.checked = "checked";
        } else {
            this.checked = "";
        }
    });
    $("#login_mb_id, #login_mb_password").click(function(){
        $(this).css("background","none");
    });
});


function flogin_submit(f)
{
    if (!f.mb_id.value.trim()) {
        alert("회원아이디를 입력하십시오.");
        f.mb_id.focus();
        return false;
    }

    if (!f.mb_password.value.trim()) {
        alert("비밀번호를 입력하십시오.");
        f.mb_password.focus();
        return false;
    }

    <?php
    if ($g4['https_url'])
        echo "f.action = '{$g4['https_url']}/{$g4['bbs']}/login_check.php';";
    else
        echo "f.action = '{$g4['bbs_path']}/login_check.php';";
    ?>

    return true;
}
</script>
<?php
include_once "./_tail.php";
?>
