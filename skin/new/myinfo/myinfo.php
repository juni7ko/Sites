<style type="text/css">
<!--
.STYLE3 {color: #FFFFFF; font-weight: bold; }
.STYLE4 {	color: #0066FF;
	font-weight: bold;
	font-size: 18px;
}
.STYLE6 {color: #0066FF}
.STYLE8 {color: #0066FF; font-size: 11px; }
-->
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="30" width="100%" class="STYLE3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td bgcolor="#6a7690"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                  <tr>
                    <td height="30" bgcolor="#7C88A2" class="STYLE3" style='padding:0 0px 0 10px;'>MY 게시물 전체</td>
                  </tr>
              </table></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center" valign="top" bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                  <tr>
                    <td bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td height="1" colspan="10" bgcolor="#6a7690"></td>
                        </tr>
                        <tr>
                          <td width="1" bgcolor="#6a7690"></td>
                          <td width="130" height="30" align="center" bgcolor="#EEEEEE"><strong>게시판</strong></td>
                          <td width="" align="center" bgcolor="#EEEEEE"><strong>제목</strong></td>
                          <td width="100" align="center" bgcolor="#EEEEEE"><strong>이름</font></td>
                          <td width="78" align="center" bgcolor="#EEEEEE"><strong>일시</font></td>
                          <td width="1" bgcolor="#6a7690"></td>
                        </tr>
                        <tr>
                          <td height="1" colspan="10" bgcolor="#6a7690"></td>
                        </tr>
                        <?php
for ($i=0; $i<count($list); $i++)
{
    $bo_subject = cut_str($list[$i][bo_subject], 10);
    $wr_subject = get_text(cut_str($list[$i][wr_subject], 60));

    echo <<<HEREDOC
<tr>
    <td width="1"></td>
    <td width="130" height="30" align="center" ><a href='./board.php?bo_table={$list[$i][bo_table]}'>{$bo_subject}</a></td>
    <td width=""><a href='{$list[$i][href]}'>{$list[$i][comment]}{$wr_subject}</a></td>
    <td width="100" align="center" >{$list[$i][name]}</td>
    <td width="78" align="center" >{$list[$i][datetime]}</td>
    <!-- <a href="javascript:;" onclick="document.getElementById('mb_id').value='{$list[$i][mb_id]}';">&middot;</a> -->
	<td width="1"></td>
</tr>
<tr>
    <td colspan="10" height="1" background="{$new_skin_path}/img/dot_bg.gif"></td>
</tr>
HEREDOC;
}
?>
                        <?php if ($i == 0) { ?>
                        <tr>
                          <td colspan="10" height="400" align="center">게시물이 없습니다.</td>
                        </tr>
                        <?php } ?>
                        <tr>
                          <td colspan="10" height="30" align="center"><?=$write_pages?></td>
                        </tr>
                    </table></td>
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
    <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
    </table></td>
  </tr>
</table>
