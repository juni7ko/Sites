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
<table width="828" border="0" cellpadding="0" cellspacing="0" background="<?=$new_skin_path?>/img/my_bg.jpg">
  <tr>
    <td width="232" height="118" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="30" style='padding:0 0px 0 10px;'><span class="STYLE3">MY개인등급</span></td>
      </tr>
      <tr>
        <td width="232" height="88" style='padding:0 0px 0 50px;'>아이디&nbsp;:&nbsp;<span class="STYLE6"><?=$member[mb_id]?></span><BR/>
          닉네임&nbsp;:&nbsp;<span class="STYLE6"><?=$member[mb_nick]?></span><BR/>레&nbsp;&nbsp;&nbsp;벨&nbsp;:&nbsp;<span class="STYLE6">[<?=$member[mb_level]?>등급]</span></td>
      </tr>
    </table></td>
    <td width="183"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="30" style='padding:0 0px 0 10px;'><span class="STYLE3">가입및 접속정보 </span></td>
      </tr>
      <tr>
        <td width="183" height="88" style='padding:0 0px 0 10px;'>외원가입:&nbsp;<span class="STYLE8"><?=$member[mb_datetime]?></span><BR/>
          최종접속:&nbsp;<span class="STYLE8"><?=$member[mb_today_login]?></span></td>
      </tr>
    </table></td>
    <td width="183"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="30" style='padding:0 0px 0 10px;'><span class="STYLE3">TODAY 포인트 </span></td>
      </tr>
      <tr>
        <td width="183" height="88" style='padding:0 0px 0 10px;'><?=$row[po_datetime]?><BR/>총 포인트&nbsp;:&nbsp;<?=$member[point]?></td>
      </tr>
    </table></td>
    <td width="233"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="30" style='padding:0 0px 0 10px;'><span class="STYLE3">MY 포인트&amp;레벨 </span></td>
      </tr>
      <tr>
        <td width="233" height="88" style='padding:0 0px 0 10px;'>포인트&nbsp;:&nbsp;<span class="STYLE4"><?=$member[mb_point]?></span></td>
      </tr>
    </table></td>
  </tr>
</table>
