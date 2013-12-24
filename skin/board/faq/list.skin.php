<?php if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 3;
if ($is_category) $colspan++;
if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;
// 제목이 두줄로 표시되는 경우 이 코드를 사용해 보세요.
// <nobr style='display:block; overflow:hidden; width:000px;'>제목</nobr>
?>
<table width="<?=$width?>" align=center cellpadding=0 cellspacing=0>
<tr><td> 
          

<!-- 분류 셀렉트 박스, 게시물 몇건, 관리자화면 링크 -->
<form name=fsearch method=get style="margin:0px;">
<input type=hidden name=bo_table value="<?=$bo_table?>">
<input type=hidden name=sca      value="<?=$sca?>">
<input type=hidden name=sca      value="<?=$sca?>">
<input type=hidden name=sfl value="wr_subject||wr_content">
<input type="hidden" name="sop" value="and">

<table width="100%" height="112" border="0" cellspacing="0" cellpadding="0" background="<?=$board_skin_path?>/img/faq_title_bg.gif">
 <tr>
  <td width="15"><img src="<?=$board_skin_path?>/img/faq_title_left.gif" width="15" height="112" border=0></td>
  <td>
   <table height="63" border="0" cellspacing="0" cellpadding="0">
    <tr>
	 <td align="left"><img src="<?=$board_skin_path?>/img/faq_title.gif" width="426" height="63" border=0></td>
	</tr>
	<tr>
	 <td>
	  <table height="49" border="0" cellspacing="0" cellpadding="0" align=center>
       <tr>
	    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name=stx class=ed value='<?=$stx?>' style="width:250px; height:19px; padding-top:2px" onClick="this.value=''" maxlength=15 size=10 itemname="검색어" required></td><td width=3></td><td><input type=image src="<?=$board_skin_path?>/img/search_btn.gif" border=0 align=absmiddle></td>
	   </tr>
       <tr>
	    <td height=12 colspan=3></td>
	   </tr>
	  </table>
	 </td>
	</tr>
   </table>
  </td>
  <td width=17><img src="<?=$board_skin_path?>/img/faq_title_right.gif" width="17" height="112" border=0></td>
 </tr>
</table>
<table width="98%" align="center" height="29" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td>
   <table width="100%" height="29" border="0" cellspacing="0" cellpadding="0">
    <tr><td height="20"></td></tr>
    <tr align="center">
		<?php
			$arr = explode("|", $board[bo_category_list]);
			$arr1   = explode("|", $board[bo_10]);
			$str = "";
				if(!$sca)
				$str = "<td width='2'><img src='$board_skin_path/img/tab_on_notice_left.gif' height='29'></td>
						<td background='$board_skin_path/img/tab_on_bg.gif' style='padding:4 15 0 15' nowrap>
						<a href='board.php?bo_table=$bo_table'><b>전체</b></a></td>
						<td width='2'><img src='$board_skin_path/img/tab_on_right.gif' height='29'></td>";
				else
				$str = "<td width='2'><img src='$board_skin_path/img/tab_off_notice_left.gif' height='29'></td>
						<td background='$board_skin_path/img/tab_off_bg.gif' style='padding:4 15 0 15' nowrap>
						<a href='board.php?bo_table=$bo_table'>전체</a></td>
						<td width='2'><img src='$board_skin_path/img/tab_off_right.gif' height='29'></td>";
			for ($i=0; $i<count($arr); $i++)
				if (trim($arr[$i])){
					if($arr[$i]==$sca){ 
						$key    = array_search($sca, $arr);
						$cate   = explode("^", $arr1[$key]);
						$subca1 = $cate[0];
						$str .= "<td width='2'><img src='$board_skin_path/img/tab_on_left.gif'></td>
								 <td background='$board_skin_path/img/tab_on_bg.gif' style='padding:4 15 0 15' nowrap>
								 <a href='$category_location$arr[$i]&sfl=wr_10&stx=$subca1&nca=$subca1'><b>$arr[$i]</b></a></td>
								 <td width='2'><img src='$board_skin_path/img/tab_on_right.gif'></td>";
						}else{ 
						$key    = array_search($arr[$i], $arr);
						$cate   = explode("^", $arr1[$key]);
						$subca1=$cate[0];
						$str .= "<td width='2'><img src='$board_skin_path/img/tab_off_left.gif'></td>
								 <td background='$board_skin_path/img/tab_off_bg.gif' style='padding:4 15 0 15' nowrap>
								 <a href='$category_location$arr[$i]&sfl=wr_10&stx=$subca1&nca=$subca1'>$arr[$i]</a></td>
								 <td width='2'><img src='$board_skin_path/img/tab_off_right.gif''></td>";
						}
					}
			echo $str;
			echo "<td width='100%' background='$board_skin_path/img/tab_bg.gif' style='padding:4 15 0 15' nowrap></td>";
		?>

	</form>
	</tr>
   </table>

<!-- 제목 과 내용-->
<form name="fboardlist" method="post" style="margin:0px;">
<input type="hidden" name="bo_table" value="<?=$bo_table?>">
<input type="hidden" name="sfl"  value="<?=$sfl?>">
<input type="hidden" name="stx"  value="<?=$stx?>">
<input type="hidden" name="spt"  value="<?=$spt?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="sw"   value="">


   <?php for ($i=0; $i<count($list); $i++) { ?> 	  
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td>
      <table width=100% border=0  cellpadding=0 cellspacing=0>
       <tr height="30"> 
        <td width=20 style='padding:0 0 0 15;'><img src="<?=$board_skin_path?>/img/q.gif" align=absmiddle border=0></td>
        <td align="left" valign="middle">
         <?php if ($is_category) { ?><font color=#CC6A9B><?=$list[$i][ca_name]?></font><?php } ?> <a onclick=view(<?=$list[$i][num]?>) style='cursor:hand'><?=$list[$i][subject]?></a>
		</td>
		<?php if (($member[mb_id] && ($member[mb_id] == $write[mb_id])) || $is_admin) { ?>
        <td width="100" align="right" ><a href="<?=$write_href?>&w=u&wr_id=<?=$list[$i][wr_id]?>&page=<?=$page?>"><img src="<?=$board_skin_path?>/img/btn_modify.gif" alt="수정" border="0"  align="absmiddle" title="수정하기"></a> <a href="javascript:del('./delete.php?bo_table=<?=$bo_table?>&wr_id=<?=$list[$i][wr_id]?>&page=');"><img src="<?=$board_skin_path?>/img/btn_del.gif" alt="삭제" border="0" align="absmiddle" title="삭제하기"></a></td>
        <?php } ?>
       </tr>
      </table>
	  <div id="view_<?=$list[$i][num]?>" style="display:none">                 
	  <table cellspacing=0 cellpadding=0 width=100% border=0>
       <tr><td colspan=2 height=1 background="<?=$board_skin_path?>/img/line_bg.gif"></td></tr>
	   <tr>
        <td valign=top width=20 style='padding:14 0 0 15;' bgcolor=#F9F9F9><img src="<?=$board_skin_path?>/img/a.gif" align=absmiddle border=0></td>
        <td valign=top style='padding:10 10 20 0;' bgcolor=#F9F9F9><?=nl2br($list[$i][wr_content])?></td>
       </tr>
      </table>
	  </div>
	 </td>
    </tr>
	<tr><td height=1 background="<?=$board_skin_path?>/img/line_bg.gif"></td></tr>
   </table>
   <?php } ?>
<?php if (count($list) == 0) { 
echo "<table width=100% border=0 cellspacing=0 cellpadding=0>";
echo "<tr>";
echo "<td width=11></td>";
echo " <td></td>";
echo "<td width=11></td>";
echo "</tr>";
echo " <tr>";
echo "<td></td>";
echo "<td  style='padding:20 0 20 0;'><div align=center><br>죄송합니다 찾으시는 게시물이 없습니다</div></td>";
echo "<td></td>";
echo "</tr>";
echo "<tr>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "</tr>";
echo "<tr>";
echo "<td height=10 colspan=3></td>";
echo "</tr>";
echo "<tr><Td height= bgcolor=CECECE></td></tr>";
echo "</table>";
; } 
?>
</form>

<!-- 버튼 -->
   <table width="100%" cellspacing="0" cellpadding="0">
    <tr> 
     <td style='padding:7 0 0 5;'><?php if ($write_href) { ?><a href="<?=$write_href?>"><img src="<?=$board_skin_path?>/img/btn_write.gif" border="0"></a><?php } ?>
     </td>
	 <td align=right style='padding:7 5 0 0;'><?php if ($admin_href) { ?><a href="<?=$admin_href?>"><img src="<?=$board_skin_path?>/img/btn_admin.gif" title="관리자" align="absmiddle"></a><?php }?></td>
	</tr>
   </table>

   <!-- 페이지 -->
   <table width="100%" cellspacing="0" cellpadding="0">
    <tr> 
     <td width="100%" align="center" style='padding:10 0 0 0;'>
      <?php if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$board_skin_path/img/btn_search_prev.gif' border=0 align=absmiddle title='이전검색'></a>"; } ?>
      <?php
// 기본으로 넘어오는 페이지를 아래와 같이 변환하여 이미지로도 출력할 수 있습니다.
      //echo $write_pages;
      //$write_pages = str_replace("처음", "<img src='$board_skin_path/img/begin.gif' border='0' align='absmiddle' title='처음'>", $write_pages);
      //$write_pages = str_replace("이전", "<img src='$board_skin_path/img/prev.gif' border='0' align='absmiddle' title='이전'>", $write_pages);
      //$write_pages = str_replace("다음", "<img src='$board_skin_path/img/next.gif' border='0' align='absmiddle' title='다음'>", $write_pages);
      //$write_pages = str_replace("맨끝", "<img src='$board_skin_path/img/end.gif' border='0' align='absmiddle' title='맨끝'>", $write_pages);
      //$write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "<b><font style=\"font-family:돋움; font-size:9pt; color:#797979\">$1</font></b>", $write_pages);
      //$write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<b><font style=\"font-family:돋움; font-size:9pt; color:orange;\">$1</font></b>", $write_pages);
      ?>
      <?=$write_pages?>
      <?php if ($next_part_href) { echo "<a href='$next_part_href'><img src='$board_skin_path/img/btn_search_next.gif' border=0 align=absmiddle title='다음검색'></a>"; } ?>
     </td>
    </tr>
   </table>
  </td>
 </tr>
</table>
</td></tr></table>

<script language="JavaScript">
//if ("<?=$sca?>") document.fcategory.sca.value = "<?=$sca?>";
//if ("<?=$stx?>") {
//    document.fsearch.sfl.value = "<?=$sfl?>";
//    document.fsearch.sop.value = "<?=$sop?>";
//}
</script>

<?php if ($is_checkbox) { ?>
<script language="JavaScript">
function all_checked(sw)
{
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function check_confirm(str)
{
    var f = document.fboardlist;
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(str + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }
    return true;
}

// 선택한 게시물 삭제
function select_delete()
{
    var f = document.fboardlist;

    str = "삭제";
    if (!check_confirm(str))
        return;

    if (!confirm("선택한 게시물을 정말 "+str+" 하시겠습니까?\n\n한번 "+str+"한 자료는 복구할 수 없습니다"))
        return;

    f.action = "./delete_all.php";
    f.submit();
}

// 선택한 게시물 복사 및 이동
function select_copy(sw)
{
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";
                       
    if (!check_confirm(str))
        return;

    var sub_win = window.open("", "move", "left=50, top=50, width=396, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<?php } ?>

<!-- 펼쳐지는 스크립트-->
<script>
var old_i; // 전에 클릭했던 글의 번호값 저장 
function view(i) { // 답변 표시여부 조정하는 js함수
	if (old_i==i) {
		var mode=document.getElementById('view_'+i).style.display;
		if (mode=='inline') document.getElementById('view_'+i).style.display='none';
		else document.getElementById('view_'+i).style.display='inline';
	}
	else {
		if (old_i) document.getElementById('view_'+old_i).style.display='none';
		document.getElementById('view_'+i).style.display='inline';
	}
	old_i=i;
}
</script> 
