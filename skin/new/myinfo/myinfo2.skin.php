<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<style>
.n_title1 { font-family:돋움; font-size:9pt; color:#FFFFFF; }
.n_title2 { font-family:돋움; font-size:9pt; color:#5E5E5E; }
.STYLE3 {color: #FFFFFF; font-weight: bold; }
.STYLE4 {
	color: #0066FF;
	font-weight: bold;
	font-size: 18px;
}
.STYLE6 {color: #0066FF}
.STYLE8 {color: #0066FF; font-size: 11px; }
</style>

</style>

<!-- 제목 시작 -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="30" width="100%" class="STYLE3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td bgcolor="#6a7690"><table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td height="30" bgcolor="#7C88A2" class="STYLE3" style='padding:0 0px 0 10px;'>자기소개</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center" valign="top" bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td height="160" valign="top" bgcolor="#FFFFFF" style='padding:15px 15px 15px 15px;'><?=$member[mb_profile] ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td align="center"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><a href="<?=$g4['bbs_path']?>/member_confirm.php?url=register_form.php"><img src="<?=$new_skin_path?>/img/profil_modify.gif" border="0"/></a></td>
        <td width="10" height="10"></td>
        <td><a href="<?=$g4[path]?>"><img src="<?=$new_skin_path?>/img/cencel_btn.gif" border="0" /></a></td>
      </tr>
    </table></td>
  </tr>
</table>
