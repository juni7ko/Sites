<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<style>
.n_title1 { font-family:돋움; font-size:9pt; color:#FFFFFF; }
.n_title2 { font-family:돋움; font-size:9pt; color:#5E5E5E; }
.STYLE3 {color: #FFFFFF; font-weight: bold; }
</style>

</style>

<!-- 분류 시작 -->
<form name=fnew method=get style="margin:0px;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
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
            <td><table width="100%" border="0" cellspacing="1" cellpadding="0">
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
                        <td colspan="10" height="50" align="center">게시물이 없습니다.</td>
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
  </table>
</form>
