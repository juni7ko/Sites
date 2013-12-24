<?php
if (!defined("_GNUBOARD_"))
    exit; // 개별 페이지 접근 불가 
//g4m gallery list.skin.php
$width = "80";
$height = "60";
$crop = "1"; // 잘라서 썸네일 생성
$quality = "90"; //품질 1~100
?>
<style type="text/css">
    div.g4m_gallery_title {border-bottom: 2px solid #04ba9e;padding: 0.7em 0;position: relative;white-space: nowrap;width: 100%;}
    div.g4m_gallery_title h2 {display: inline;font-size: 1.05em;margin-right: -0.3em;padding-left: 10px;}
    div.g4m_gallery_list .board_top{overflow: hidden; margin: 5px 0 5px 0}
    ul.g4m_gallery li{float: left; width: <?php echo $width + 20?>px; height: <?php echo $height + 60?>px;  overflow: hidden; margin: 5px 5px 5px; text-align: center;}
    ul.g4m_gallery li a{display: block;}
    ul.g4m_gallery li a.subject{font-size: .85em;}
    .board_button {height: 50px;line-height: 50px;margin-bottom: 10px;margin-top: 10px;padding: 5px;}
    .board_search {padding: 5px 0 5px 10px;}
    .board_search form{display: block}
    .board_search .shbox{padding: 10px 43px 10px 10px;}
    .board_search fieldset{position: relative; width: 100%}
    .board_search .search_box {background: url("<?php echo $board_skin_path?>/img/bg_sh.gif") repeat-x scroll 0 0 #FFFFFF;border: 1px solid #bcbcbc;display: block;height: 21px;padding: 6px 33px 0 6px;}
    .board_search .stx {border: 0 none;font-size: 0.93em;width: 100%;}
    .board_search .sh_del {background: url("<?php echo $board_skin_path?>/img/bt_sh_del.gif") no-repeat scroll 5px 50% transparent;border: medium none;cursor: pointer;height: 29px;margin: 0;overflow: visible;padding: 0;position: absolute;text-indent: -500em;width: 31px;z-index: 1;}
    .board_search .submit {background: url("<?php echo $board_skin_path?>/img/bt_sh.png") no-repeat scroll -38px -30px #aaa;border: medium none;height: 30px;position: absolute;right: 10px;top: 10px;width: 29px;}
    .board_search .sh_del {right: 42px;top: 10px;}
</style>
<!-- 게시판 목록 시작 -->
<div class="g4m_gallery_list">
    <div class="g4m_gallery_title">
        <h2><?php echo $board['bo_subject'] ?></h2>
    </div>
    <div class="board_top">
        <div style="float:left;">
            <form name="fcategory" method="get" style="margin:0px;" action="">
                <fieldset>
                    <legend class="hc">분류</legend>
                    <?php if ($is_category) { ?>
                    <select name=sca onchange="location='<?php echo $category_location ?>'+<?php echo strtolower($g4['charset']) == 'utf-8' ? "encodeURIComponent(this.value)" : "this.value" ?>;">
                        <option value=''>전체</option>
                    <?php echo $category_option ?>
                    </select>
                    <?php } ?>
                </fieldset>
            </form>
        </div>
        <div style="float:right;">
            <span style="color:#888888; font-size: 0.85em;">Total <?php echo number_format($total_count) ?></span>
            <?php if ($rss_href) { ?><a href='<?php echo $rss_href ?>' class="btn" title="rss">RSS</a><?php } ?>
            <?php if ($admin_href) { ?><a href="<?php echo $admin_href ?>" class="btn" title="관리자">Admin</a><?php } ?>
            <?php if ($g4m_admin_href) { ?><a href="<?php echo $g4m_admin_href ?>" class="btn" title="모바일 관리자">M</a><?php } ?>
        </div>
    </div>
    <!-- 제목 -->
    <form name="fboardlist" method="post" action="">
        <fieldset>
            <legend class="hc">List</legend>
            <input type='hidden' name='bo_table' value='<?php echo $bo_table ?>'>
            <input type='hidden' name='sfl'  value='<?php echo $sfl ?>'>
            <input type='hidden' name='stx'  value='<?php echo $stx ?>'>
            <input type='hidden' name='spt'  value='<?php echo $spt ?>'>
            <input type='hidden' name='page' value='<?php echo $page ?>'>
            <input type='hidden' name='sw'   value=''>
            <ul class="g4m_gallery">
                <?php
                $list_count = count($list);

                for ($i = 0; $i < $list_count; $i++) {


					if(!$list[$i]['file']['0']['file'])  $list[$i]['file']['0']['file'] ="2042355175_XJ30fRP4_C0DBBEF701.jpg";  // 썸네일 없으면 기본 이미지


                    $list[$i]['href'] = str_replace('../bbs', './bbs', $list[$i]['href']); //함수 수정 하지 않고 경로 변경
                    if ($list[$i]['comment_cnt']) {
                        $cmt_count = "<span class='cmt'>{$list[$i]['comment_cnt']}</span>";
                    } else {
                        $cmt_count = "";
                    }

                    if ($is_category && $list[$i]['ca_name']) {
                        $ca_name = "<span>[{$list[$i]['ca_name']}]</span> ";
                    } else {
                        $ca_name = "";
                    }
                    //$bg = $i%2 ? 0 : 1;//배경
                    if($list[$i]['is_notice']) continue;//공지는 무시하자!
                    ?>
                    <li>
                        <a href='<?php echo $list[$i]['href'] ?>' class="thumb_img">
                            <img src="<?php echo "{$g4['thumb']}?bo_table={$_GET['bo_table']}&amp;img={$list[$i]['file']['0']['file']}&amp;w={$width}&amp;h={$height}&amp;crop={$crop}&amp;q={$quality}"?>"/>
                        </a>
                        <a href='<?php echo $list[$i]['href'] ?>' class="subject">
                            <?php echo cut_str($list[$i]['subject'],'60') ?> <?php echo $cmt_count ?>
                        </a>
                        <!-- <p class="writer"><?php echo $list[$i]['name'] ?></p>
                        <p class="wr_date"><?php echo $list[$i]['datetime'] ?></p> -->
                    </li>
                    <?php
/*
                      echo " " . $list[$i][icon_new];
                      echo " " . $list[$i][icon_file];
                      echo " " . $list[$i][icon_link];
                      echo " " . $list[$i][icon_hot];
                      echo " " . $list[$i][icon_secret];
                     * 
                     */
                } //for
                ?>
            </ul>
            <?php if ($list_count == 0) {
                echo "<ul><li>게시물이 없습니다.</li></ul>";
            } ?>
        </fieldset>
    </form>
    <div class="board_button">
        <div style="float:left;">
            <?php if ($list_href) { ?>
                <a href="<?php echo $list_href ?>" class="btn" title="목록">목록</a>
            <?php } ?>
        </div>

        <div style="float:right;">
        <?php if ($write_href) { ?><a href="<?php echo $write_href ?>" class="btn" title="글쓰기">글쓰기</a><?php } ?>
        </div>
    </div>
    <!-- 페이지 -->
    <div id="paging">

        <?php
        $write_pages = str_replace("처음", "&lt;&lt;", $write_pages);
        $write_pages = str_replace("이전", "&lt;", $write_pages);
        $write_pages = str_replace("다음", "&gt;", $write_pages);
        $write_pages = str_replace("맨끝", "&gt;&gt;", $write_pages);
       
        echo $write_pages;
        ?>

    </div>
    <div style="text-align: center;">
<?php if ($prev_part_href) {
    echo "<a href='$prev_part_href' class='btn2'>이전검색</a>";
} ?>
<?php if ($next_part_href) {
    echo "<a href='$next_part_href' class='btn2'>다음검색</a>";
} ?>
    </div>

    <!-- 검색 -->
    <div class="board_search">
        <form name="fsearch" method="get" action="">
            <fieldset>
                <legend class="hc">검색</legend>
                <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                <input type="hidden" name="sca"      value="<?php echo $sca ?>">
                <input type="hidden" name="sfl"      value="wr_subject||wr_content">
                <div class="shbox">
                    <span class="search_box">
                        <input name="stx" class="stx" maxlength="15" value='<?php echo stripslashes($stx) ?>'>
                    </span>
                </div>
                <input type="hidden" name="sop" value="and" checked="checked">
                <input type="hidden" name="sop" value="or">
                <button id="searchDelete" class="sh_del" type="button">입력 내용 삭제</button>
                <button class="submit" type="submit"><span class="hc">검색</span></button>
            </fieldset>
        </form>

    </div><!--//.board_search -->
</div><!--//.board_list -->
<script type="text/javascript">
    $(function(){
        $("#searchDelete").click(function(){
            $("input.stx").val("");
        });
    });
    if ('<?php echo $sca ?>') document.fcategory.sca.value = '<?php echo $sca ?>';
    if ('<?php echo $stx ?>') {
        document.fsearch.sfl.value = '<?php echo $sfl ?>';

        if ('<?php echo $sop ?>' == 'and') 
        document.fsearch.sop[0].checked = true;

        if ('<?php echo $sop ?>' == 'or')
        document.fsearch.sop[1].checked = true;
    } else {
        document.fsearch.sop[0].checked = true;
    }
<?php if ($is_checkbox) { ?>

        function all_checked(sw) {
            var f = document.fboardlist;

            for (var i=0; i<f.length; i++) {
                if (f.elements[i].name == "chk_wr_id[]")
                    f.elements[i].checked = sw;
            }
        }

        function check_confirm(str) {
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
        function select_delete() {
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
        function select_copy(sw) {
            var f = document.fboardlist;

            if (sw == "copy")
                str = "복사";
            else
                str = "이동";

            if (!check_confirm(str))
                return;

            var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

            f.sw.value = sw;
            f.target = "move";
            f.action = "./move.php";
            f.submit();
        }
<?php } ?>
</script>
<!-- 게시판 목록 끝 -->
