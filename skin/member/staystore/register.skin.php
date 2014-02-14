<?php if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 ?>
<style type="text/css">
	#divRegister { margin:0 auto; width:600px; }
	#userDiv { display:block; }
	#padminDiv { display:none; }
</style>
<div id="divRegister">
	<form name="fregister" method="POST" onsubmit="return fregister_submit(this);" autocomplete="off">
		<table width=600 cellspacing=0 cellspacing=0 align=center><tr><td align=center>

			<table width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td align=center><img src="<?=$member_skin_path?>/img/join_title.gif" width="624" height="72"></td>
				</tr>
			</table>

			<div style="margin:10px 0;">
				<input type="radio" name="utype" value='user' id="utype1" />&nbsp;<label for="utype1">일반회원 가입</label>
				&nbsp; <input type="radio" name="utype" value='padmin' id="utype2" />&nbsp;<label for="utype2">펜션관리자 가입</label>
			</div>

			<div id="userDiv">
				<table width="100%" cellpadding="4" cellspacing="0" bgcolor=#EEEEEE>
					<tr>
						<td height=40>&nbsp; <b>회원가입약관</b></td>
					</tr>
					<tr>
						<td align="center" valign="top"><textarea style="width: 98%" rows=10 readonly class=ed><?=get_text($config[cf_stipulation])?></textarea></td>
					</tr>
					<tr>
						<td height=40>
							&nbsp; <input type=radio value=1 name=agree id="agree11" />&nbsp;<label for="agree11">동의합니다.</label>
							&nbsp; <input type=radio value=0 name=agree id="agree10" />&nbsp;<label for="agree10">동의하지 않습니다.</label>
						</td>
					</tr>
				</table>

				<br>
				<table width="100%" cellpadding="4" cellspacing="0" bgcolor=#EEEEEE>
					<tr>
						<td height=40>&nbsp; <b>개인정보취급방침</b></td>
					</tr>
					<tr>
						<td align="center" valign="top"><textarea style="width: 98%" rows=10 readonly class=ed><?=get_text($config[cf_privacy])?></textarea></td>
					</tr>
					<tr>
						<td height=40>
							&nbsp; <input type=radio value=1 name=agree2 id="agree21" />&nbsp;<label for="agree21">동의합니다.</label>
							&nbsp; <input type=radio value=0 name=agree2 id="agree20" />&nbsp;<label for="agree20">동의하지 않습니다.</label>
						</td>
					</tr>
				</table>
			</div>

			<div id="padminDiv">
				<br>
				<table width="100%" cellpadding="4" cellspacing="0" bgcolor=#EEEEEE>
					<tr>
						<td height=40>&nbsp; <b>펜션관리자 약관</b></td>
					</tr>
					<tr>
						<td align="center" valign="top"><textarea style="width: 98%" rows=10 readonly class=ed><?=get_text($config[cf_10])?></textarea></td>
					</tr>
					<tr>
						<td height=40>
							&nbsp; <input type=radio value=1 name=pagree id="agree31" />&nbsp;<label for="agree31">동의합니다.</label>
							&nbsp; <input type=radio value=0 name=pagree id="agree30" />&nbsp;<label for="agree30">동의하지 않습니다.</label>
						</td>
					</tr>
				</table>
			</div>

		</td></tr></table>

		<br>
		<div align=center>
			<input type=image width="66" height="20" src="<?=$member_skin_path?>/img/join_ok_btn.gif" border=0>
		</div>
	</form>
</div>

<script type="text/javascript">
	function fregister_submit(f)
	{
		var agree1 = document.getElementsByName("agree");
		if (!agree1[0].checked) {
			alert("회원가입약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
			agree1[0].focus();
			return false;
		}

		var agree2 = document.getElementsByName("agree2");
		if (!agree2[0].checked) {
			alert("개인정보취급방침의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
			agree2[0].focus();
			return false;
		}

		var utype = document.getElementsByName("utype");
		if(utype[1].checked) {
			var agree3 = document.getElementsByName("pagree");
			if(!agree3[0].checked) {
				alert("펜션관리자 약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
				agree3[0].focus();
				return false;
			}
		}

		f.action = "./register_form.php";
		return true;
	}

	if (typeof(document.fregister.mb_name) != "undefined")
		document.fregister.mb_name.focus();

	$("input:radio[name='utype']").click(function(){
		var chk = $(this).val();
		if(chk == 'user') {
			//$('#userDiv').css('display','block');
			$('#padminDiv').css('display','none');
		} else if( chk == 'padmin') {
			//$('#userDiv').css('display','none');
			$('#padminDiv').css('display','block');
		}
	});
</script>
