<link rel="stylesheet" href="<?=$board_skin_path?>/jQuery/jquery-ui-1.7.1.css" type="text/css">
<link rel="stylesheet" href="<?=$board_skin_path?>/mstyle.css" type="text/css">
<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jquery.js"></script>
<script type="text/javascript" src="<?=$board_skin_path?>/jQuery/jquery-ui-1.7.1.js"></script>
<style type="text/css">
th { font-size: 9pt; height:30px; }
/* caption { font-size:12pt; }*/
.tbl_cap { font-size:9pt; font-weight:bold; text-align:left; }
</style>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left top;"></td>
        <td bgcolor="#ffffff">&nbsp;</td>
        <td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right top;"></td>
    </tr>
    <tr>
        <td colspan="3" valign="top" style="background:#FFF; padding:10px;">
<div class="sjbox">예약확인</div>
<table width="100%" border="0" align="center" cellpadding="15" cellspacing="5" bgcolor="#f3f3f3">
  <tr>
    <td bgcolor="#FFFFFF" align="center">
<form name='resform1' method='post' action='javascript:resform_submit(document.resform1)' enctype='multipart/form-data' style='margin:0px;'>
  <input type=hidden name=null>
  <input type=hidden name=type value=code />
  <!-- 삭제하지 마십시오. -->
  <input type=hidden name=bo_table value='<?=$bo_table?>'>
    <table width="350" border="0" align="center" cellpadding="5" cellspacing="0">
      <tr>
        <td><img src="<?=$board_skin_path?>/img_n/code.gif" width="131" height="27" /></td>
      </tr>
    </table>
      <table width="350" border="0" align="center" cellpadding="10" cellspacing="0" bgcolor="#F3F3F3">
        <tr>
          <td><table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" bgcolor="#f3f3f3">
            <tr>
              <td align="right">예약코드
                <input type="text" name="wr_3" size="15" required itemname='예약코드' /><br />
                비밀번호
                <input type='password' name='wr_6' size="15" required itemname='비밀번호' /></td>
              <td width="90"><input type="image" src="<?=$board_skin_path?>/img_n/ok.gif" accesskey='s'></td>
            </tr>
            
          </table></td>
        </tr>
      </table>
</form>
      <table width="350" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
<form name='resform2' method='post' action='javascript:resform_submit(document.resform2)' enctype='multipart/form-data' style='margin:0px;'>
  <input type=hidden name=null>
  <input type=hidden name=type value=id />
  <!-- 삭제하지 마십시오. -->
  <input type=hidden name=bo_table value='<?=$bo_table?>'>
      <table width="350" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
          <td><img src="<?=$board_skin_path?>/img_n/id.gif" width="200" height="27" /></td>
        </tr>
      </table>
      <table width="350" border="0" align="center" cellpadding="10" cellspacing="0" bgcolor="#F3F3F3">
        <tr>
          <td><table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" bgcolor="#f3f3f3">
              <tr>
                <td align="right">아이디
                	<input type='text' name='wr_3' size="15" required itemname='아이디'><br />
                  비밀번호
                  <input type='password' name='wr_6' size='15' required itemname='비밀번호'></td>
                <td width="90"><input type='image' src='<?=$board_skin_path?>/img_n/ok.gif' accesskey='s'></td>
              </tr>
          </table></td>
        </tr>
      </table>
</form>
      <table width="350" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
            </td>
    </tr>
    <tr>
        <td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) left bottom;"></td>
        <td bgcolor="#ffffff">&nbsp;</td>
        <td width="15" height="15" style="background:url(<?=$board_skin_path?>/img/rbox_white.gif) right bottom;"></td>
    </tr>
</table>
<script language="JavaScript">
function resform_submit(f)
{
    f.action = "./res_check.php";
    f.submit();
}
</script>
