<?php
include_once "./_common.php";

auth_check($auth[$sub_menu], "r");

$token = get_token();

$sql_common = " from $g4[board_table] a ";
$sql_search = " where (1) ";

if ($is_admin != "super") {
    $sql_common .= " , $g4[group_table] b ";
    $sql_search .= " and (a.gr_id = b.gr_id and b.gr_admin = '$member[mb_id]') ";
}

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "bo_table" :
            $sql_search .= " ($sfl like '$stx%') ";
            break;
        case "a.gr_id" :
            $sql_search .= " ($sfl = '$stx') ";
            break;
        default : 
            $sql_search .= " ($sfl like '%$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst  = "a.gr_id, a.bo_table";
    $sod = "asc";
}
$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = $config['cf_m_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * 
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);
$listall = "<a href='{$_SERVER['PHP_SELF']}'>처음</a>";

$g4[title] = "게시판관리";
include_once("./admin.head.php");

$colspan = 7;
?>

<script type="text/javascript">
var list_update_php = 'board_list_update.php';
var list_delete_php = 'board_list_delete.php';
</script>

<table>
<tr>
    <td width="120" align=left><?php echo $listall?> (board: <?php echo number_format($total_count)?>개)</td>
    <td>
        <form name='fsearch' method='get'>
        <select name=sfl>
            <option value='bo_table'>TABLE</option>
            <option value='bo_subject'>제목</option>
            <option value='a.gr_id'>그룹ID</option>
        </select>
        <input type="text" name='stx' required itemname='검색어' value='<?php echo $stx?>' style="width:60px;">
        <button type='submit' class="submit"><span>검색</span></button>
        </form>
    </td>
</tr>
</table>

<form name='fboardlist' method='post' action="">
<input type=hidden name=sst   value="<?php echo $sst?>">
<input type=hidden name=sod   value="<?php echo $sod?>">
<input type=hidden name=sfl   value="<?php echo $sfl?>">
<input type=hidden name=stx   value="<?php echo $stx?>">
<input type=hidden name=page  value="<?php echo $page?>">
<input type=hidden name=token value="<?php echo $token?>">
<table width=100% cellpadding=0 cellspacing=0>
<tr><td colspan='<?php echo $colspan?>' class='line1'></td></tr>
<tr class='bgcol1 bold col1 ht center'>
    <td rowspan='2'><input type=checkbox name=chkall value="1" onclick="check_all(this.form)"></td>
    <td rowspan='2'><?php echo subject_sort_link("bo_table")?>TABLE</a></td>
    <td colspan='2'><?php echo subject_sort_link("bo_subject")?>제목</a></td>
    <td rowspan='2'></td>
</tr>
<tr class='bgcol1 bold col1 ht center'>
    <td><?=subject_sort_link("a.gr_id")?>그룹</a></td>
    <td><?=subject_sort_link("bo_skin", "", "desc")?>스킨</a></td>
</tr>
<tr><td colspan='<?php echo $colspan?>' class='line2'></td></tr>
<?php
// 스킨디렉토리
$skin_options = "";
$arr = get_mskin_dir("board");
for ($k=0; $k<count($arr); $k++) 
{
    $option = $arr[$k];
    if (strlen($option) > 10)
        $option = substr($arr[$k], 0, 18) . "…";

    $skin_options .= "<option value='$arr[$k]'>$option</option>";
}

for ($i=0; $row=sql_fetch_array($result); $i++) {
    $s_upd = "<a href='./board_form.php?w=u&bo_table=$row[bo_table]&$qstr' class='btn'>수정</a>";
    $s_del = "";
    if ($is_admin == "super") {
        //$s_del = "<a href=\"javascript:del('./board_delete.php?bo_table=$row[bo_table]&$qstr');\"><img src='img/icon_delete.gif' border=0 title='삭제'></a>";
        //$s_del = "<a href=\"javascript:post_delete('board_delete.php', '$row[bo_table]');\"><img src='{$g4['admin_path']}/img/icon_delete.gif' border=0 title='삭제'></a>";
    }
    //$s_copy = "<a href=\"javascript:board_copy('$row[bo_table]');\"><img src='{$g4['admin_path']}/img/icon_copy.gif' border=0 title='복사'></a>";

    $list = $i % 2;
    echo "<input type=hidden name=board_table[$i] value='$row[bo_table]'>";
    echo "<tr class='list$list col1 ht center'>";
    echo "<td rowspan='2' style='height:100px;'><input type=checkbox name=chk[] value='$i'></td>";
    echo "<td rowspan='2'><a href='$g4[g4m_bbs_path]/board.php?bo_table=$row[bo_table]'><b>$row[bo_table]</b></a></td>";
    echo "<td colspan='2' align=left height=25><input type=text class=ed name=bo_subject[$i] value='".get_text($row[bo_subject])."' style='width:99%'></td>";
    echo "<td rowspan='2'>$s_upd $s_del $s_copy</td>";
    echo "</tr>";
    echo "<tr class='list$list col1 ht center'>";

    if ($is_admin == "super")
        echo "<td align=left>".get_group_select("gr_id[$i]", $row[gr_id])."</td>";
    else
        echo "<td align=center><input type=hidden name='gr_id[$i]' value='$row[gr_id]'>$row[gr_subject]</td>";

    echo "<td align=left><select id=bo_m_skin_$i name=bo_m_skin[$i]>$skin_options</select></td>";
    echo "</tr>\n";
    echo "<script type='text/javascript'>document.getElementById('bo_m_skin_$i').value='$row[bo_m_skin]';</script>";
} 

if ($i == 0)
    echo "<tr><td colspan='$colspan' align=center height=100 bgcolor=#ffffff>자료가 없습니다.</td></tr>"; 

echo "<tr><td colspan='$colspan' class='line2'></td></tr>";
echo "</table>";

$pagelist = get_paging($config[cf_m_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");
echo "<table width=100% cellpadding=3 cellspacing=1>";
echo "<tr><td width=70%>";
echo "<input type=button class='btn1' value='선택수정' onclick=\"btn_check(this.form, 'update')\"> ";

echo "</td>";
echo "<td width=30% align=right ></td></tr></table>\n";

if ($stx)
    echo "<script>document.fsearch.sfl.value = '$sfl';</script>";
?>
</form>
<div id='paging'><?php echo $pagelist?></div>
<script type="text/javascript">
function board_copy(bo_table) {
    window.open("./board_copy.php?bo_table="+bo_table, "BoardCopy", "left=10,top=10,width=500,height=200");
}
</script>

<script>
// POST 방식으로 삭제
function post_delete(action_url, val)
{
	var f = document.fpost;

	if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
        f.bo_table.value = val;
		f.action         = action_url;
		f.submit();
	}
}
</script>

<form name='fpost' method='post'>
<input type='hidden' name='sst'   value='<?php echo $sst?>'>
<input type='hidden' name='sod'   value='<?php echo $sod?>'>
<input type='hidden' name='sfl'   value='<?php echo $sfl?>'>
<input type='hidden' name='stx'   value='<?php echo $stx?>'>
<input type='hidden' name='page'  value='<?php echo $page?>'>
<input type='hidden' name='token' value='<?php echo $token?>'>
<input type='hidden' name='bo_table'>
</form>

<?php
include_once "./admin.tail.php";
?>
