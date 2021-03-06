<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once("{$board_skin_path}/view.skin.lib.php");

if($write_table == "g4_write_pension_info") {
	$rInfo_table = "g4_write_bbs34_r_info";
	$rCost_table = "g4_write_bbs34_r_cost";
	$rDate_table = "g4_write_bbs34_r_date";
	$rDateCost_table = "g4_write_bbs34_r_date_cost";
}

$pType = "객실/빈방 검색";

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

if( ($period > 1) and $schDate)
	$schDateTmp2 = $schDateTmp + (86400 * $period);

// 객실수, 화장실수 체크시 검사항목 추가.
if($rCnt) {
	switch ($rCnt) {
		case '1':
		case '2':
			$where = " r_info_rCnt = '$rCnt' ";
			break;
		case '3':
		case '4':
		case '5':
			$where = " r_info_rCnt >= '$rCnt' ";
			break;
		default:
			break;
	}
}
if($tCnt) {
	if($where) $where .= " and ";
	switch ($tCnt) {
		case '1':
			$where .= " r_info_tCnt = '$tCnt' ";
			break;
		case '2':
		case '3':
		case '4':
		case '5':
			$where .= " r_info_tCnt >= '$tCnt' ";
			break;
		default:
			break;
	}
}

// 검색 체크값을 쿼리에 더하기 시작
$cfSearch = "";
if ($_POST) {
	$kv = array();
	foreach ($_POST as $key => $value) :
		// cf 값인 것만 검색 추출
		if( substr($key, 0, 2) == "cf" ) {
			if($value == "on") $value = 1;
			$kv[] = "$key = '$value'";
		}
	endforeach;
	$cfSearch = join(" and ", $kv);
}
if($cfSearch) {
	$cfSearch2 = $cfSearch . " and mainUse = 1 ";
} else {
	$cfSearch2 = " mainUse = 1 ";
}

// 검색 체크값을 쿼리에 더하기 끝

// 분류 사용 여부
$is_category = false;

$sop = strtolower($sop);
if ($sop != "and" && $sop != "or")
	$sop = "and";

// 분류 선택 또는 검색어가 있다면
$stx = trim($stx);
if ($sca || $stx || $cfSearch) {
	$sql_search = get_sql_search($sca, $sfl, $stx, $sop);

	// 가장 작은 번호를 얻어서 변수에 저장 (하단의 페이징에서 사용)
	$sql = " SELECT MIN(wr_num) as min_wr_num from $write_table WHERE $cfSearch2 ";
	$row = sql_fetch($sql);
	$min_spt = $row[min_wr_num];

	if (!$spt) $spt = $min_spt;

	// stx 값 삭제로 인해 $sql_search 값으로 0이 올 경우 처리.
	if(!$sql_search) {
		$sql_search = " (wr_num between '".$spt."' and '".($spt + $config[cf_search_part])."') ";
	} else {
		$sql_search .= " and (wr_num between '".$spt."' and '".($spt + $config[cf_search_part])."') ";
	}

	$sql_search = $cfSearch2 . " and " . $sql_search;
	// 원글만 얻는다. (코멘트의 내용도 검색하기 위함)
	$sql = " SELECT distinct wr_parent from $write_table where $sql_search ";
	$result = sql_query($sql);
	$total_count = mysql_num_rows($result);
} else {
	$sql_search = $cfSearch2;

	$total_count = $board[bo_count_write];
}

// 정렬에 사용하는 QUERY_STRING
$qstr2 = "bo_table=$bo_table&sop=$sop";

if ($board[bo_gallery_cols])
	$td_width = (int)(100 / $board[bo_gallery_cols]);

// 정렬
// 인덱스 필드가 아니면 정렬에 사용하지 않음
//if (!$sst || ($sst && !(strstr($sst, 'wr_id') || strstr($sst, "wr_datetime")))) {
if (!$sst) {
	if ($board[bo_sort_field]) {
		$sst = $board[bo_sort_field];
	} else {
		$sst  = "wr_num, wr_reply";
	}
	$sod = "";
} else {
	// 게시물 리스트의 정렬 대상 필드가 아니라면 공백으로 (nasca 님 09.06.16)
	// 리스트에서 다른 필드로 정렬을 하려면 아래의 코드에 해당 필드를 추가하세요.
	// $sst = preg_match("/^(wr_subject|wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
	$sst = preg_match("/^(wr_datetime|wr_hit|wr_good|wr_nogood|lowPrice|discount|resCount)$/i", $sst) ? $sst : "";
}

if ($sst)
	$sql_order = " order by $sst $sod ";

$sql_search2 = $sql_search . " and ";

if ($sca || $stx) {
	$sql = " SELECT distinct wr_parent from $write_table where $sql_search $sql_order ";
} else {
	$sql = " SELECT * from $write_table where $sql_search2 wr_is_comment = 0 $sql_order ";
}
$result = sql_query($sql);

// 년도 2자리
$today2 = $g4[time_ymd];

$list = array();
$rlist = array();
$i = 0;

if ( !$sca && !$stx ) {
	$arr_notice = explode("\n", trim($board[bo_notice]));
	for ( $k=0; $k<count($arr_notice); $k++ ) {
		if (trim($arr_notice[$k])=='') continue;

		$row = sql_fetch(" SELECT * from $write_table where mainUse = 1 and wr_id = '$arr_notice[$k]' $sql_order ");

		if ( !$row[wr_id] ) continue;

		$list[$i] = get_list($row, $board, $board_skin_path, $board[bo_subject_len]);
		$list[$i][is_notice] = true;

		$i++;
	}
}

$k = 0;

while($row = sql_fetch_array($result)) {
	// 검색일 경우 wr_id만 얻었으므로 다시 한행을 얻는다
	if ($sca || $stx)
		$row = sql_fetch(" SELECT * from $write_table where mainUse = 1 and wr_id = '$row[wr_parent]' ");

	$list[$i] = get_list($row, $board, $board_skin_path, $board[bo_subject_len]);
	if (strstr($sfl, "subject"))
		$list[$i][subject] = search_font($stx, $list[$i][subject]);

	$i++;
	$k++;
}

// 검색으로 얻은 결과값으로 객실을 검색한다.
if($where) $where2 = " and " . $where;

$t = 0;
for($q = 0; $q < $k; $q++) {
	$sql_r = "SELECT * from $rInfo_table where pension_id = '{$list[$q][wr_id]}' $where2 ORDER BY r_info_order DESC ";
	$resultList = sql_query($sql_r);

	for ($rc=0; $roomArray = sql_fetch_array($resultList); $rc++) {
		// 객실 전체를 배열로 만들어 정렬을 하여 리스트로 만든다.
		// 해당 일자의 가격을 함께 검색
		$rlist[$t] = get_list_roomInfo($roomArray, $board, $board_skin_path, $board[bo_subject_len], $schDateTmp);
		//echo $rlist[$t]['r_info_name'] . "<br>";
		$t++;
	}
}

if($rlist) {
	unset($list);
	$list = $rlist;
	unset($rlist);
} else {
	unset($list);
}

// 검색에 날짜를 포함 했을 경우 해당 일자의 예약 가능 여부를 검색
// 검색한 갯수
$rct = 0;
for( $q = 0; $q < $t; $q++ ) {
	// 예약 가능 여부 체크
	if($schDateTmp2)
		$resCheck[$q] = resCheck2($list[$q]['pension_id'], $schDateTmp, $list[$q]['r_info_id'], $schDateTmp2);
	else
		$resCheck[$q] = resCheck($list[$q]['pension_id'], $schDateTmp, $list[$q]['r_info_id']);

	if( !$resCheck[$q] ) {
		$rlist[$rct] = $list[$q];
		$rct++;
	}
}

if($rlist) {
	unset($list);
	$list = $rlist;
	unset($rlist);
} else {
	unset($list);
}

// 선택된 옵션에따라 Sort
for($aa = 0; $aa < count($list); $aa++) {
	for($ab = $aa + 1; $ab < count($list); $ab++) {
		if($sst == "discount") {
			if( $list[$aa]['minCost2'] <= $list[$ab]['minCost2'] ) {
				$tmp = $list[$aa];
				$tmp2 = $list[$ab];
				$list[$aa] = $tmp2;
				$list[$ab] = $tmp;
				unset($tmp);
				unset($tmp2);
			}
		} else {
			if( $list[$aa]['minCost3'] >= $list[$ab]['minCost3'] ) {
				$tmp = $list[$aa];
				$tmp2 = $list[$ab];
				$list[$aa] = $tmp2;
				$list[$ab] = $tmp;
				unset($tmp);
				unset($tmp2);
			}
		}
	}
}

// 같은 펜션이 연속해서 오는 경우 rowspan 지정
for($aa = 0; $aa < count($list); $aa++) {
	for($ab = $aa + 1; $ab < count($list); $ab++) {
		if( $list[$aa]['pension_id'] == $list[$ab]['pension_id'] and $list[$aa]['rowspan']) {
			$list[$aa]['rowspan']++;
			$list[$ab]['rowspan'] = 0;
		} else {
			break;
		}
	}
}

$list_href = '';
$prev_part_href = '';
$next_part_href = '';
if ($sca || $stx) {
	$list_href = "./board.php?bo_table=$bo_table";
}
$write_href = "";

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

include_once("$board_skin_path/list2.skin.php");
?>