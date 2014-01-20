<?php if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if ($g4['https_url']) {
    $outlogin_url = $_GET['url'];
    if ($outlogin_url) {
        if (preg_match("/^\.\.\//", $outlogin_url)) {
            $outlogin_url = urlencode($g4[url]."/".preg_replace("/^\.\.\//", "", $outlogin_url));
        }
        else {
            $purl = parse_url($g4[url]);
            if ($purl[path]) {
                $path = urlencode($purl[path]);
                $urlencode = preg_replace("/".$path."/", "", $urlencode);
            }
            $outlogin_url = $g4[url].$urlencode;
        }
    }
    else {
        $outlogin_url = $g4[url];
    }
}
else {
    $outlogin_url = $urlencode;
}
?>

<script type="text/javascript" src="<?=$g4[path]?>/js/capslock.js"></script>
<script type="text/javascript">
// 엠파스 로긴 참고
var bReset = true;
function chkReset(f)
{
    if (bReset) { if ( f.mb_id.value == '아이디' ) f.mb_id.value = ''; bReset = false; }
    document.getElementById("pw1").style.display = "none";
    document.getElementById("pw2").style.display = "";
}
</script>


<!-- 로그인 전 외부로그인 시작 -->

<form name="fhead" method="post" onsubmit="return fhead_submit(this);" autocomplete="off" style="margin-left:50%; margin-top:100px;">
<input type="hidden" name="url" value="<?=$outlogin_url?>">
<div style="width:500px; margin-left:-250px;">
    <div style="clear:both;"><img src="<?=$outlogin_skin_path?>/img/login_top.gif" width="500" height="110"></div><!-- 상단로고이미지 -->
    <div style="clear:both; float:left; width:1px; height:160px; background:#bbbbbb;"></div><!-- 왼쪽세로라인 -->

    <div style="width:498px; float:left; margin-top:40px;"><!-- 아이디/비번  -->

        <table width="498" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="80" border="0" cellpadding="0" cellspacing="0"></td>
			<td width="248">
                <table width="248" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="100" height="40"><img src="<?=$outlogin_skin_path?>/img/login_id.gif" width="90" height="30"></td>
                    <td width="148" height="40" colspan="2"><input name="mb_id" type="text" class=ed size="12" maxlength="20" required itemname="아이디" value='아이디' onMouseOver='chkReset(this.form);' onFocus='chkReset(this.form);'></td>
                </tr>
                <tr>
                    <td width="100" height="30"><img src="<?=$outlogin_skin_path?>/img/login_pw.gif" width="90" height="30"></td>
                    <td id=pw1 width="148" height="30" colspan="2"><input type="text" class=ed size="12" maxlength="20" required itemname="패스워드" value='패스워드' onMouseOver='chkReset(this.form);' onfocus='chkReset(this.form);'></td>
                    <td id=pw2 style='display:none;' width="148" height="30" colspan="2" align="center"><input name="mb_password" id="outlogin_mb_password" type="password" class=ed size="12" maxlength="20" itemname="패스워드" onMouseOver='chkReset(this.form);' onfocus='chkReset(this.form);' onKeyPress="check_capslock(event, 'outlogin_mb_password');"></td>
                </tr>
                </table>
            </td>
            <td width="170" height="" rowspan="2" align="center"><input type="image" src="<?=$outlogin_skin_path?>/img/login_btn.gif" width="90" height="70"></td><!-- 오른쪽로그인버튼 -->
        </tr>
        </table>

        <div style="clear:both; padding:10px 0 0 100px;"><!-- 자동로그인 -->
            <div style="float:left;"><input type="checkbox" name="auto_login" value="1" onclick="if (this.checked) { if (confirm('자동로그인을 사용하시면 다음부터 회원아이디와 패스워드를 입력하실 필요가 없습니다.\n\n\공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?')) { this.checked = true; } else { this.checked = false; } }"></div>
            <div style="float:left; padding-left:5px;">자동로그인</div>
        </div> 		
    </div>

    <div style="float:right; width:1px; height:160px; background:#bbbbbb;"></div><!-- 오른쪽세로라인 -->
    <div style="clear:both; width:500px; height:1px; background:#bbbbbb;"><!-- <img src="<?=$outlogin_skin_path?>/img/login_down.gif" width="220" height="14"> --></div>
	<div style="clear:both; padding:20px 0 0 100px;">
            <!-- <a href="javascript:win_password_forget();"><img src="<?=$outlogin_skin_path?>/img/login_pw_find_button.gif" width="90" height="20" border="0"></a> -->
            <a href="javascript:win_password_lost();"><img src="<?=$outlogin_skin_path?>/img/login_pw_find_button.gif" width="150" height="30" border="0"></a>
            <a href="<?=$g4[bbs_path]?>/register.php"><img src="<?=$outlogin_skin_path?>/img/login_join_button.gif" width="150" height="30" border="0"></a>
        </div>
</div>
</form>



<script type="text/javascript">
function fhead_submit(f)
{
    if (!f.mb_id.value) {
        alert("회원아이디를 입력하십시오.");
        f.mb_id.focus();
        return false;
    }

    if (document.getElementById('pw2').style.display!='none' && !f.mb_password.value) {
        alert("패스워드를 입력하십시오.");
        f.mb_password.focus();
        return false;
    }

    <?php if ($g4[https_url])
        echo "f.action = '$g4[https_url]/$g4[bbs]/login_check.php';";
    else
        echo "f.action = '$g4[bbs_path]/login_check.php';";
    ?>

    return true;
}
</script>
<!-- 로그인 전 외부로그인 끝 -->
