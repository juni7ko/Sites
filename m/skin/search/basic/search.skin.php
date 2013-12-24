<?php
if (!defined("_GNUBOARD_"))
    exit; // 개별 페이지 접근 불가 
?>
<div class="search_title">
    <h2>통합검색</h2>
</div>

<div class="search_box">
    <form name=fsearch method=get onsubmit="return fsearch_submit(this);" style="margin:0px;">
        <fieldset>
            <legend class="hc">통합검색</legend>
            <input type="hidden" name="srows" value="<?php echo $srows ?>">    
            <p>
                <?php echo $group_select ?>
                <script type="text/javascript">document.getElementById("gr_id").value = "<?php echo $gr_id ?>";</script>
                <select name="sfl">
                    <option value="wr_subject||wr_content" selected="selected">제목+내용</option>
                    <option value="wr_subject">제목</option>
                    <option value="wr_content">내용</option>
                    <option value="mb_id">회원아이디</option>
                    <option value="wr_name">이름</option>
                </select>
            </p>
            <p>
                <input type="text" name="stx" maxlength="20" required itemname="검색어" value='<?php echo $text_stx ?>'> 
                <input type="submit" value=" 검 색 ">
            </p>

            <p>
                연산자 &nbsp; 
                <input type="radio" name="sop" value="or" <?php echo ($sop == "or") ? "checked" : ""; ?> id="option_or"><label for="option_or">OR</label> &nbsp;
                <input type="radio" name="sop" value="and" <?php echo ($sop == "and") ? "checked" : ""; ?> id="option_and"><label for="option_and">AND</label>
            </p>
        </fieldset>
    </form>
</div>

<?php
if ($stx) {
    echo "<div class='noticebox'><b>검색된 게시판</b> <p>(<b>{$board_count}</b>개의 게시판, <b>" . number_format($total_count) . "</b>개의 게시글, <b>" . number_format($page) . "/" . number_format($total_page) . "</b> 페이지)</p></div>";
    if ($board_count) {
        echo "<ul class='search_list'>";
        if ($onetable) {
            echo "<li style='font-weight:bold;padding-left:15px; background-color:#efefef'><a href='?$search_query&gr_id=$gr_id'>전체게시판 검색</a>";
        }
        echo $str_board_list;
        echo "</ul>";
    } else {
        echo "<div class='search_result'>검색된 자료가 없습니다.</div>";
    }
}
 
    $k = 0;
    $search_count = count($search_table);
    if($search_count > 0 ){
        echo '<div class="search_result">';
    }
    for ($idx = $table_index, $k = 0; $idx < $search_count && $k < $rows; $idx++) {
        echo "<div class='sr_title'>{$bo_subject[$idx]} 검색결과 <a href='./board.php?bo_table={$search_table[$idx]}&{$search_query}'>[게시판 바로가기]</a></div>";
        $comment_href = "";
        $list_count = count($list[$idx]);
        echo "<ul>";
        for ($i = 0; $i < $list_count && $k < $rows; $i++, $k++) {
            echo "<li>";
            $is_cmt = "";
            if ($list[$idx][$i]['wr_is_comment']) {
                $is_cmt = "<span style='color:#999'>[댓글]</span> ";
                $comment_href = "#c_" . $list[$idx][$i]['wr_id'];
            }
            echo "<a href='{$list[$idx][$i]['href']}{$comment_href}'>";
            echo $is_cmt . $list[$idx][$i]['subject'];
            echo "</a>";
            echo "<span class='sr_content'>".$list[$idx][$i]['content']." <em>{$list[$idx][$i]['wr_datetime']}</em></span>";
            echo "<p style='color:#999'>{$list[$idx][$i]['wr_name']}</p>";
            echo "</li>";
        }
        echo "</ul>";
    }
    if($search_count > 0 ){
        echo '</div>';
    }

echo "<div id='paging'>".$write_pages."</div>";
?>
<script type="text/javascript">
    document.fsearch.sfl.value = "<?php echo $sfl ?>";
    
    function fsearch_submit(f){
        if (f.stx.value.length < 2) {
            alert("검색어는 두글자 이상 입력하십시오.");
            f.stx.select();
            f.stx.focus();
            return false;
        }
        
        // 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
        var cnt = 0;
        for (var i=0; i<f.stx.value.length; i++) {
            if (f.stx.value.charAt(i) == ' ')
                cnt++;
        }
        
        if (cnt > 1) {
            alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
            f.stx.select();
            f.stx.focus();
            return false;
        }
        
        f.action = "";
        return true;
    }
</script>
