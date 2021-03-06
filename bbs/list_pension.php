<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once("{$board_skin_path}/view.skin.lib.php");

$pType = "펜션 검색";

if( $sfl == "area_id" and $stx == "all" ) {
	$sfl = "";
	$stx = "";
}

if( !$sop and !$sod and !$sst ) {
	$sop = "and";
	$sod = "asc";
	$sst = "lowPrice";
}

if( $schDate ) {
	$sDateY = substr($schDate, 0, 4);
	$sDateM = substr($schDate, 4, 2);
	$sDateD = substr($schDate, 6, 2);
	$schDateTmp = mktime(12,0,0,$sDateM,$sDateD,$sDateY);
} else {
	$sDateY = date('Y');
	$sDateM = date('m');
	$sDateD = date('d');
	$schDate = $sDateY . $sDateM . $sDateD;
	$schDateTmp = mktime(12,0,0,$sDateM,$sDateD,$sDateY);
}

// 검색 체크값을 쿼리에 더하기 시작
$cfSearch = "";
if ($_POST) {
	$kv = array();
	foreach ($_POST as $key => $value) {
		// cf 값인 것만 검색 추출
		if( substr($key, 0, 2) == "cf" ) {
			if($value == "on") $value = 1;
			$kv[] = "$key = '$value'";
		}
	}
	$cfSearch = join(" and ", $kv);
}
if($cfSearch)
	$cfSearch2 = $cfSearch . " and mainUse = 1 ";
else
	$cfSearch2 = " mainUse = 1 ";
// 검색 체크값을 쿼리에 더하기 끝

// 분류 사용 여부
$is_category = false;

$sop = strtolower($sop);
if ($sop != "and" && $sop != "or")
	$sop = "and";

// 분류 선택 또는 검색어가 있다면
$stx = trim($stx);
if ($sca || $stx || $cfSearch)
{
	$sql_search = get_sql_search($sca, $sfl, $stx, $sop);

	// 가장 작은 번호를 얻어서 변수에 저장 (하단의 페이징에서 사용)
	$sql = " SELECT MIN(wr_num) as min_wr_num from $write_table WHERE $cfSearch2 ";
	$row = sql_fetch($sql);
	$min_spt = $row[min_wr_num];

	if (!$spt) $spt = $min_spt;

	// stx 값 삭제로 인해 $sql_search 값으로 0이 올 경우 처리.
	if(!$sql_search)
		$sql_search = " (wr_num between '".$spt."' and '".($spt + $config[cf_search_part])."') ";
	else
		$sql_search .= " and (wr_num between '".$spt."' and '".($spt + $config[cf_search_part])."') ";

	$sql_search = $cfSearch2 . " and " . $sql_search;
	// 원글만 얻는다. (코멘트의 내용도 검색하기 위함)
	$sql = " SELECT distinct wr_parent from $write_table where $sql_search ";
	$result = sql_query($sql);
	$total_count = mysql_num_rows($result);
}
else
{
	$sql_search = $cfSearch2;

	$total_count = $board[bo_count_write];
}

$total_page  = ceil($total_count / $board[bo_page_rows]);  // 전체 페이지 계산
if (!$page) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $board[bo_page_rows]; // 시작 열을 구함

// 관리자라면 CheckBox 보임
$is_checkbox = false;
if ($member[mb_id] && ($is_admin == "super" || $group[gr_admin] == $member[mb_id] || $board[bo_admin] == $member[mb_id]))
	$is_checkbox = true;

// 정렬에 사용하는 QUERY_STRING
$qstr2 = "bo_table=$bo_table&sop=$sop";

if ($board[bo_gallery_cols])
	$td_width = (int)(100 / $board[bo_gallery_cols]);

// 정렬
// 인덱스 필드가 아니면 정렬에 사용하지 않음
//if (!$sst || ($sst && !(strstr($sst, 'wr_id') || strstr($sst, "wr_datetime")))) {
if (!$sst)
{
	if ($board[bo_sort_field])
		$sst = $board[bo_sort_field];
	else
		$sst  = "wr_num, wr_reply";
	$sod = "";
}
else {
	// 게시물 리스트의 정렬 대상 필드가 아니라면 공백으로 (nasca 님 09.06.16)
	// 리스트에서 다른 필드로 정렬을 하려면 아래의 코드에 해당 필드를 추가하세요.
	// $sst = preg_match("/^(wr_subject|wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
	$sst = preg_match("/^(wr_datetime|wr_hit|wr_good|wr_nogood|lowPrice|discount|resCount)$/i", $sst) ? $sst : "";
}

if ($sst)
	$sql_order = " order by $sst $sod ";

$sql_search2 = $sql_search . " and ";

if ($sca || $stx)
{
	$sql = " SELECT distinct wr_parent from $write_table where $sql_search $sql_order limit $from_record, $board[bo_page_rows] ";
}
else
{
	$sql = " SELECT * from $write_table where $sql_search2 wr_is_comment = 0 $sql_order limit $from_record, $board[bo_page_rows] ";
}
$result = sql_query($sql);

// 년도 2자리
$today2 = $g4[time_ymd];

$list = array();
$i = 0;

if (!$sca && !$stx)
{
	$arr_notice = explode("\n", trim($board[bo_notice]));
	for ($k=0; $k<count($arr_notice); $k++)
	{
		if (trim($arr_notice[$k])=='') continue;

		$row = sql_fetch(" SELECT * from $write_table where mainUse = 1 and wr_id = '$arr_notice[$k]' ");

		if (!$row[wr_id]) continue;

		$list[$i] = get_list($row, $board, $board_skin_path, $board[bo_subject_len]);
		$list[$i][is_notice] = true;

		$i++;
	}
}

$k = 0;

while ($row = sql_fetch_array($result))
{
	// 검색일 경우 wr_id만 얻었으므로 다시 한행을 얻는다
	if ($sca || $stx)
		$row = sql_fetch(" SELECT * from $write_table where mainUse = 1 and wr_id = '$row[wr_parent]' $sql_order ");

	$list[$i] = get_list($row, $board, $board_skin_path, $board[bo_subject_len]);
	if (strstr($sfl, "subject"))
		$list[$i][subject] = search_font($stx, $list[$i][subject]);
	$list[$i][is_notice] = false;
	//$list[$i][num] = number_format($total_count - ($page - 1) * $board[bo_page_rows] - $k);
	$list[$i][num] = $total_count - ($page - 1) * $board[bo_page_rows] - $k;

	$i++;
	$k++;
}

$write_pages = get_paging($config[cf_write_pages], $page, $total_page, "./board.php?bo_table=$bo_table".$qstr."&page=");

$list_href = '';
$prev_part_href = '';
$next_part_href = '';
if ($sca || $stx)
{
	$list_href = "./board.php?bo_table=$bo_table";

	//if ($prev_spt >= $min_spt)
	$prev_spt = $spt - $config[cf_search_part];
	if (isset($min_spt) && $prev_spt >= $min_spt)
		$prev_part_href = "./board.php?bo_table=$bo_table".$qstr."&spt=$prev_spt&page=1";

	$next_spt = $spt + $config[cf_search_part];
	if ($next_spt < 0)
		$next_part_href = "./board.php?bo_table=$bo_table".$qstr."&spt=$next_spt&page=1";
}

$write_href = "";
if ($member[mb_level] >= $board[bo_write_level])
	$write_href = "./write.php?bo_table=$bo_table";

$nobr_begin = $nobr_end = "";
if (preg_match("/gecko|firefox/i", $_SERVER['HTTP_USER_AGENT'])) {
	$nobr_begin = "<nobr style='display:block; overflow:hidden;'>";
	$nobr_end   = "</nobr>";
}

// RSS 보기 사용에 체크가 되어 있어야 RSS 보기 가능 061106
$rss_href = "";
if ($board[bo_use_rss_view])
	$rss_href = "./rss.php?bo_table=$bo_table";

$stx = get_text(stripslashes($stx));
include_once("$board_skin_path/list.skin.php");
?>
