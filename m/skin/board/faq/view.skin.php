<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
/*
 * http://www.g4m.kr
 * g4m board view.skin.php
 * 
 */
?>
<!-- 게시글 보기 시작 -->
<style type="text/css">
/* board skin g4m_basic  view.skin.php */
.vi_title{display:block; border-bottom: 1px solid #ccc; margin: 10px 0 10px 0}
.vi_title h1{font-size: 1.2em;line-height: 1.5em;}
.wr_info{margin-bottom: 5px;}
.wr_info span,div.wr_info time{color: #999999; font-size: .9em; padding-right: 5px;}
.wr_info span.member{color: #666600;font-weight: bold}
ul.vi_file{ border:  1px dotted #ccc; margin: 5px; padding: 5px;  border-radius: 8px;}
ul.vi_file li.first{border-bottom: 1px dotted #ccc;}
ul.vi_file li a{display: block; line-height: 2em; font-size: .9em; color:#666 }
ul.vi_file li a img{ vertical-align: middle;}
div.article {line-height: 1.5em;}
/*modal*/
#mask {position:absolute;left:0;top:0;z-index:9000;background-color:#000;display:none;}
.window {border:1px solid #333; position:absolute;left:0;top:0;display:none;z-index:9999;padding:5px; background-color: #fff; width: 110px;box-shadow:6px 6px 2px rgba(0, 0, 0, 0.40);-moz-box-shadow:6px 6px 2px rgba(0, 0, 0, 0.40);-webkit-box-shadow:6px 6px 2px rgba(0, 0, 0, 0.40); border-radius: 8px;}
div.pn{height: 54px;position: relative;top: 0;width: 100%;}
div.pn button {background: url("<?php echo $board_skin_path;?>/img/icon.png") no-repeat scroll 0 4px transparent;height: 41px;overflow: hidden;position: absolute;text-indent: -1000em;top: 4px;width: 60px;}
div.pn .btn_prev {background-position: 0 4px;left: 0; border: medium ;cursor: pointer; text-align: center}
div.pn .btn_next {background-position: right 4px !important;right: 0;border: medium ;cursor: pointer; text-align: center}

/*foot */
footer { overflow: hidden}
div#nogood{width:72px; height:55px; background:url(<?php echo $board_skin_path?>/img/good_bg.gif) no-repeat; text-align:center; float: right}
div#good{width:72px; height:55px; background:url(<?php echo $board_skin_path?>/img/good_bg.gif) no-repeat; text-align:center;float: right}

/* comment */
div#comment {margin-top: 10px;border: 1px solid #ccc; background-color: #efefef}
div#comment .cmt_info{padding:5px; border-bottom: 1px solid #ccc; overflow: hidden}
div#comment .cmt_content {line-height:2em; padding:10px; word-break:break-all; overflow:hidden; clear:both;}
div#comment .wr_input{background-color: #fff}
</style>
<script type="text/javascript">
$(document).ready(function() {
    $('a[name=modal]').click(function(e) {
        //Cancel the link behavior
        e.preventDefault();
        //Get the A tag
        var id = $(this).attr('href');
        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
        //Set heigth and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight});
        //transition effect
        //$('#mask').fadeIn(100);
        $('#mask').fadeTo("fast",0.5);
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();
        //Set the popup window to center
        //$(id).css('top',  winH/2-$(id).height()/2);
        //$(id).css('left', winW/2-$(id).width()/2);
        $(id).css('top', e.pageY - '20');
        $(id).css('left', e.pageX - "140");
        //transition effect
        $(id).fadeIn(100);
    });
    //모달창 닫기
    $('.window .close').click(function (e) {
        //Cancel the link behavior
        e.preventDefault();
        $('#mask').hide();
        $('.window').hide();
    });
    //if mask is clicked
    $('#mask').click(function () {
        $(this).hide();
        $('.window').hide();
    });
    <?php if ($prev_href) { ?>
        $('#wr_prev').click(function(){
            location.href='<?php echo $prev_href?>';
        });
    <?php } ?>
    <?php if ($next_href) {?>
        $('#wr_next').click(function(){
            location.href='<?php echo $next_href?>';
        });
    <?php } ?>
});
</script>
<div id="mask"></div>
<div class="pn">
    <?php if ($prev_href) {?><button id="wr_prev" class="btn_prev" style="display: block;">이전글</button> <?php } ?>
    <?php if ($next_href) {?><button id="wr_next" class="btn_next" style="display: block;">다음글</button> <?php } ?>
</div>
<article>
    <header class="vi_title">
        <h1>
            <?php
            if ($is_category) {
                echo ($category_name ? "[{$view['ca_name']}] " : "");
            }
            echo $view['wr_subject']
            ?>
        </h1>
        <!-- <div class="wr_info">
            <span><?php echo $view['name']?><?php // if ($is_ip_view) { echo "&nbsp;($ip)"; } ?></span>
            <time pubdate="">작성일 : <?php echo date("y-m-d H:i", strtotime($view['wr_datetime']))?></time>
            <span>조회 : <?php echo number_format($view['wr_hit'])?></span>
        </div> -->
    </header>


    <?php 
    if($view['link']['1'] == NULL && $view['link']['2'] == NULL){
        $vf_style="display:none";
    }
    ?>
    <ul class="vi_file" style="<?php echo $vf_style;?>">
    <?php
    // 가변 파일
    /*
    $file_count = count($view['file']);
    for ($i = 0; $i < $file_count; $i++) {
        if ($view[file][$i][source] && !$view[file][$i][view]) {
            echo "<li>";
            echo "<a href=\"javascript:file_download('{$view[file][$i][href]}', '{$view[file][$i][source]}');\" title='{$view[file][$i][content]}'>";
            echo "<img src='{$board_skin_path}/img/icon_file.gif'> {$view[file][$i][source]} ({$view[file][$i][size]})";
            echo "<span>[{$view[file][$i][download]}]</span>";
            echo "<span>DATE : {$view[file][$i][datetime]}</span>";
            echo "</a></li>";
        }
    }
    */
    // 링크
    for ($i = 1; $i <= $g4['link_count']; $i++) {
        $first = "";
        if($i == 1) $first = "first";
        if ($view['link'][$i]) {
            $link = cut_str($view['link'][$i], 70);
            echo "<li class='$first'>";
            echo "<a href='{$view['link_href'][$i]}' target='_blank'>";
            echo " <img src='{$board_skin_path}/img/icon_link.gif'> {$link}";
            echo "<span>[{$view['link_hit'][$i]}]</span>";
            echo "</a></li>";
        }
    }
    ?>
    </ul>
    <div class="article">
        <?php
        // 파일 출력
        $list_view_count =  count($view['file']);
        for ($i = 0; $i <= $list_view_count; $i++) {
            if ($view['file'][$i]['view']){
                echo "<p><img src='{$g4['thumb']}?w={$board['bo_m_image_width']}&amp;bo_table={$_GET['bo_table']}&amp;img={$view['file'][$i]['file']}'></p>";
            }
        }
        echo $view['content'];
        ?>
    </div>

    <footer style="display: block; margin: 10px auto; text-align: center">
    <div style="clear:both; height:30px; margin-bottom: 10px;">
        <!-- 링크 버튼 -->
        <div style="float:right;">
        <?php
        ob_start();
        echo "<div id='man_btn' class='window'>";
  //      if ($copy_href) { echo "<a href=\"$copy_href\" class='btn'>복사</a> "; }
 //       if ($move_href) { echo "<a href=\"$move_href\" class='btn'>이동</a> "; }
        if ($update_href) { echo "<a href=\"$update_href\" class='btn'>수정</a> "; }
        if ($delete_href) { echo "<a href=\"$delete_href\" class='btn'>삭제</a> "; }
        echo "</div>";
        if($is_member){ echo "<a href='#man_btn' class='btn' name='modal'>관리</a> "; }
   //     if ($search_href) { echo "<a href=\"$search_href\"  class='btn2'>검색목록</a> "; }
        echo "<a href=\"$list_href\" class='btn'>목록</a> ";
    //    if ($reply_href) { echo "<a href=\"$reply_href\" class='btn'>답변</a> "; }

        $link_buttons = ob_get_contents();
        ob_end_flush();
        ?>
        </div>
    </div>
    </footer>


</article>

<script type="text/javascript">
function file_download(link, file) {
    <?php if ($board['bo_download_point'] < 0) { ?>
    if (confirm("'"+file+"' 파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point'])?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?"))
    <?php } ?>
    document.location.href=link;
}
</script>

<script type="text/javascript" src="<?php echo "{$g4['path']}/js/board.js"?>"></script>
<script type="text/javascript">
window.onload=function() {
    resizeBoardImage(<?=(int)$board['bo_m_image_width']?>);
//    drawFont();
}
</script>
<!-- 게시글 보기 끝 -->
