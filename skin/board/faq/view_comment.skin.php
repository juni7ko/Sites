<META http-equiv=Content-Type content="text/html; charset=ks_c_5601-1987">
<?php if (!defined("_GNUBOARD_")) exit; // 媛쒕퀎 ?섏씠吏? ?묎렐 遺덇??
?>

<script language="JavaScript">
// 湲??먯닔 ?쒗븳
var char_min = parseInt(<?=$comment_min?>); // 理쒖냼
var char_max = parseInt(<?=$comment_max?>); // 理쒕??
</script>

<?php if ($cwin==1) { ?>


<table width=100% cellpadding=10 align=center><tr><td><?php }?>
<!-- 肄붾찘?? 由ъ뒪?? -->
<?php for ($i=0; $i<count($list); $i++) {
    $comment_id = $list[$i][wr_id];
?>
<a name="c_<?=$comment_id?>"></a>
<table width=100% cellpadding=0 cellspacing=0>
<tr>
    <td><?php for ($k=0; $k<strlen($list[$i][wr_comment_reply]); $k++) echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; ?></td>
    <td>
<table width=100% cellpadding=0 cellspacing=0 bgcolor=#F8F8F9>
              <tr> 
                <td  colspan=5><img src='<?=$board_skin_path?>/img/co_point.gif'></td>
              </tr>
              <tr> 
                <td width="60" height=20 valign="top" nowrap style="padding-left:15px;"><?=$list[$i][name]?></td>
				<td width="20" height=20 valign="top"> <div align="center"><font color="#999999">|</font> 
                  </div></td>
                <td height=20> <span class="ct lh"><?=$list[$i][content]?></span></td>
                <td width="30"  valign="top" style="padding-top:2px;">
                <?php if ($list[$i][is_edit]) { echo "<a href=\"javascript:comment_box('{$comment_id}', 'cu');\"><img src='$board_skin_path/img/btn_comment_update.gif' border=0 align=absmiddle></a> "; } ?>
                  <?php if ($list[$i][is_del])  { echo "<a href=\"javascript:comment_delete('{$list[$i][del_link]}');\"><img src='$board_skin_path/img/btn_comment_delete.gif' border=0 align=absmiddle></a> "; } ?></td>
				<td width="85" height=20 align="right" valign="top" nowrap style="padding-right:15px;"><?=$list[$i][datetime]?></td>
              </tr>
			    <tr> 
                <td height=5 colspan="5" > <!-- 肄붾찘?? 異쒕젰 -->
                <?php if ($list[$i][trackback]) { echo "<p>".$list[$i][trackback]."</p>"; } ?>
                <textarea id='save_comment_<?=$comment_id?>' style='display:none; width:100%'><?=get_text($list[$i][wr_content], 0)?></textarea>                
                <span id='edit_<?=$comment_id?>' style='display:none;'></span><!-- ?섏젙 -->
</td>
              </tr>
              <tr> 
                <td height=20 colspan="5" bgcolor="#FFFFFF"></td>
              </tr>
            </table>
</td>
</tr>
</table>
<?php } ?>
<!-- 肄붾찘?? 由ъ뒪?? -->


<?php if ($is_comment_write) { ?>
<span id=comment_write style='display:none;'>
<form name="fviewcomment" method="post" action="./write_comment_update.php" onsubmit="return fviewcomment_submit(this);" autocomplete="off" style="margin:0px;">
<input type=hidden name=w           id=w value='c'>
<input type=hidden name=bo_table    value='<?=$bo_table?>'>
<input type=hidden name=wr_id       value='<?=$wr_id?>'>
<input type=hidden name=comment_id  id='comment_id' value=''>
<input type=hidden name=sfl         value='<?=$sfl?>' >
<input type=hidden name=stx         value='<?=$stx?>'>
<input type=hidden name=spt         value='<?=$spt?>'>
<input type=hidden name=page        value='<?=$page?>'>
<input type=hidden name=cwin        value='<?=$cwin?>'>
<table width=100% cellpadding=0 cellspacing=0>
<tr><td colspan="2" height=7 ></td></tr>
<tr><td colspan="2" height=1 bgcolor=#E7E7E7></td></tr>
<tr><td colspan="2" height=7 ></td></tr>
<tr>  
  <td width=125 align=center style="padding-left:15px;">
  

  <table width="110" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="40"><span class="small_eng">NAME : </span></td>
                  <td width="70" style="padding-right:2px;"><INPUT type=text maxLength=20 size=10 name="wr_name" itemname="?대쫫" required class=ed></td>
                </tr>
                <tr> 
                  <td><span class="small_eng">PASS : </span></td>
                  <td style="padding-right:2px;"><INPUT type=password maxLength=20 size=10 name="wr_password" itemname="?⑥뒪?뚮뱶" required class=ed></td>
                </tr>
                <tr> 
                  <td colspan="2" style="padding-right:5px;"><div align="right"><span class="small_eng"> 
                      <?php if ($is_norobot) { ?>
                      <?=$norobot_str?>
                      </span></div></td>
                </tr>
                <tr> 
                  <td><span class="small_eng">KEY : </span></td>
                  <td><INPUT title="?꾩쓽 湲??먯쨷 鍮④컙湲??먮쭔 ?쒖꽌??濡? ?낅젰?섏꽭??." type="input"  size=10 name="wr_key" itemname="?먮룞?깅줉諛⑹??" required class=ed> 
                    <?php } ?>
                  </td>
                </tr>
                <tr> 
                  <td colspan="2" height="33"><div align="right"><input type="image" src="<?=$board_skin_path?>/img/ok_btn.gif" border=0 accesskey='s'></div></td>
                </tr>
              </table>

	   
	   </td>
    <td valign="top"><textarea id="wr_content" name="wr_content" rows="5" itemname="?댁슜" required 
            <?php if ($comment_min || $comment_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?php }?> style='width:100%; height:69;word-break:break-all;' class=tx></textarea>
            <?php if ($comment_min || $comment_max) { ?><script language="javascript"> check_byte('wr_content', 'char_count'); </script><?php }?></td></tr>
<tr><td colspan="2" height=5 ></td></tr>			
<tr><td colspan="2" height=1 bgcolor=#E7E7E7></td></tr>
<tr><td colspan="2" height=7 ></td></tr>

</table>
</form>
</span>

<script language='JavaScript'>
var save_before = '';
var save_html = document.getElementById('comment_write').innerHTML;
function fviewcomment_submit(f)
{
    var pattern = /(^\s*)|(\s*$)/g; // \s 怨듬갚 臾몄옄

    var s;
    if (s = word_filter_check(document.getElementById('wr_content').value))
    {
        alert("?댁슜?? 湲덉???⑥뼱('"+s+"')媛? ?ы븿?섏뼱?덉뒿?덈떎");
        document.getElementById('wr_content').focus();
        return false;
    }

    // ?묒そ 怨듬갚 ?놁븷湲?
    var pattern = /(^\s*)|(\s*$)/g; // \s 怨듬갚 臾몄옄
    document.getElementById('wr_content').value = document.getElementById('wr_content').value.replace(pattern, "");
    if (char_min > 0 || char_max > 0)
    {
        check_byte('wr_content', 'char_count');
        var cnt = parseInt(document.getElementById('char_count').innerHTML);
        if (char_min > 0 && char_min > cnt)
        {
            alert("肄붾찘?몃뒗 "+char_min+"湲??? ?댁긽 ?곗뀛?? ?⑸땲??.");
            return false;
        } else if (char_max > 0 && char_max < cnt)
        {
            alert("肄붾찘?몃뒗 "+char_max+"湲??? ?댄븯濡? ?곗뀛?? ?⑸땲??.");
            return false;
        }
    }
    else if (!document.getElementById('wr_content').value)
    {
        alert("肄붾찘?몃? ?낅젰?섏뿬 二쇱떗?쒖삤.");
        return false;
    }

    if (typeof(f.wr_name) != 'undefined')
    {
        f.wr_name.value = f.wr_name.value.replace(pattern, "");
        if (f.wr_name.value == '')
        {
            alert('?대쫫?? ?낅젰?섏?? ?딆븯?듬땲??.');
            f.wr_name.focus();
            return false;
        }
    }

    if (typeof(f.wr_password) != 'undefined')
    {
        f.wr_password.value = f.wr_password.value.replace(pattern, "");
        if (f.wr_password.value == '')
        {
            alert('?⑥뒪?뚮뱶媛? ?낅젰?섏?? ?딆븯?듬땲??.');
            f.wr_password.focus();
            return false;
        }
    }

    if (typeof(f.wr_key) != 'undefined')
    {
        if (hex_md5(f.wr_key.value) != md5_norobot_key)
        {
            alert('?먮룞?깅줉諛⑹???? 鍮④컙湲??먭?? ?쒖꽌??濡? ?낅젰?섏?? ?딆븯?듬땲??.');
            f.wr_key.focus();
            return false;
        }
    }

    return true;
}

function comment_box(comment_id, work)
{
    var el_id;
    // 肄붾찘?? ?꾩씠?붽?? ?섏뼱?ㅻ㈃ ?듬??, ?섏젙
    if (comment_id)
    {
        if (work == 'c')
            el_id = 'reply_' + comment_id;
        else
            el_id = 'edit_' + comment_id;
    }
    else
        el_id = 'comment_write';

    if (save_before != el_id)
    {
        if (save_before)
        {
            document.getElementById(save_before).style.display = 'none';
            document.getElementById(save_before).innerHTML = '';
        }

        document.getElementById(el_id).style.display = '';
        document.getElementById(el_id).innerHTML = save_html;
        // 肄붾찘?? ?섏젙
        if (work == 'cu')
        {
            document.getElementById('wr_content').value = document.getElementById('save_comment_' + comment_id).value;
            if (typeof char_count != 'undefined')
                check_byte('wr_content', 'char_count');
        }

        document.getElementById('comment_id').value = comment_id;
        document.getElementById('w').value = work;

        save_before = el_id;
    }
}

function comment_delete(url)
{
    if (confirm("?? 肄붾찘?몃? ??젣?섏떆寃좎뒿?덇퉴?")) location.href = url;
}

comment_box('', 'c'); // 肄붾찘?? ?낅젰?쇱씠 蹂댁씠?꾨줉 泥섎━?섍린?꾪빐?? 異붽?? (root??)
</script>
<?php } ?>

<?php if($cwin==1) { ?></td><tr></table><p align=center><a href="javascript:window.close();"><img src="<?=$board_skin_path?>/img/btn_close.gif" border="0"></a><br><br><?php }?>
