<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

?>
<!-- 게시글 보기 -->
<div style='width:<?php echo $bo_table_width?>; overflow:auto; *overflow-x:auto; *overflow-y:hidden;'>



<div class="board-view">
	<div class="board-view-head">
		<h3>
			<?php if ($is_category) { echo ($category_name ? "<span class='category'>[$view[ca_name]]</span> " : ""); } ?>
			<?php echo cut_hangul_last(get_text($view[wr_subject]))?>
		</h3>
	</div>
	<ul class="board-view-info">
		<li>
			<span>글쓴이</span>
			<em><?php echo $view[name]?> <?php echo $is_ip_view?"($ip)":"";?></em>
			<span>날짜</span>
			<em><?php echo date("Y.m.d H:i", strtotime($view[wr_datetime]))?></em>
			<span>조회</span>
			<em><?php echo number_format($view[wr_hit])?></em>
			<?php if ($is_good) { ?>
			<span>추천</span>
			<em class="good"><?php echo number_format($view[wr_good])?></em>
			<?php } ?>
			<?php if ($is_nogood) { ?>
			<span>비추천</span>
			<em class="nogood"><?php echo number_format($view[wr_nogood])?></em>
			<?php } ?>
		</li>
		<?php
		// 링크
		$cnt = 0;
		for ($i=1; $i<=$g4[link_count]; $i++) {
			if ($view[link][$i]) {
				$cnt++;
				$link = cut_str($view[link][$i], 70);
				echo "<li class='link'>";
				echo "<a href='{$view[link_href][$i]}' target='{$config[cf_link_target]}'>{$link} ({$view[link_hit][$i]})</a>";
				echo "</li>\n";
			}
		}

		// 가변 파일
		$cnt = 0;
		for ($i=0; $i<count($view[file]); $i++) {
			if ($view[file][$i][source] && !$view[file][$i][view]) {
				$cnt++;
				echo "<li class='file'>";
				echo "<a href=\"javascript:file_download('{$view[file][$i][href]}', '{$view[file][$i][source]}');\">";
				echo "{$view[file][$i][source]} ({$view[file][$i][size]}) ({$view[file][$i][download]})\n";
				echo "<span class='date'>DATE : {$view[file][$i][datetime]}</span></a>";
				echo "</li>\n";
			}
		}
		?>
	</ul>
	<div class="board-view-content">
		<?php
		// 파일 출력

			//블라인드 체크
			if (empty($is_admin) && $write['wr_blind'] == 1) {

				$view[content] = $report_config['report_blind_msg_write'];
			}
			else if (empty($is_admin) && $report_config['report_blind_auto_write'] == 1) {//게시물 자동 블랑인드 설정되어 있다면

				//현재 게시물이 오늘 신고를 몇번 당했는지 체크
				$report_count_target_today = report_get_count_target($bo_table, $write['wr_id'], $g4['time_ymd']);

				//현재 게시물이 전체 신고를 몇번 당했는지 체크
				$report_count_target_all = report_get_count_target($bo_table, $write['wr_id'], '');

				if ($report_count_target_all >= $report_config['report_blind_count_write_all'] || $report_count_target_today >= $report_config['report_blind_count_write_today'])
					$view[content] = $report_config['report_blind_msg_write'];
			}

			if($is_admin || $write['wr_blind'] != 1){

				for ($i=0; $i<=count($view[file]); $i++) {
					if ($view_file = $view[file][$i][view]) {
						echo "<div class='view_file'>".hd_get_content_imgcall($view_file,$board[bo_image_width])."</div>";
					}
				}

            }
		?>
		<!-- 내용 출력 -->
		<?php echo hd_get_content_imgcall($view[content],$board[bo_image_width]);?>
	</div>
	<div class="util-button">
		<div class="fLeft">
			<?php if ($good_href) {?><a href="<?php echo $good_href?>" class="good ajax_good" title="추천"><?php echo number_format($view[wr_good])?></a><?php } ?>
			<?php if ($nogood_href) {?><a href="<?php echo $nogood_href?>" class="nogood ajax_good" title="비추천"><?php echo number_format($view[wr_nogood])?></a><?php } ?>
		</div>
		<div class="fRight">
			<?php if ($scrap_href) { ?><a href="<?php echo $scrap_href?>" class="win_scrap scrap">스크랩</a><?php } ?>
			<a href="" class="print" title="<?php echo cut_hangul_last(get_text($view[wr_subject]))?>">인쇄</a>
			<?php if (report_check_auth($is_admin, $member['mb_level']) === true && $board[bo_use_report] == 1) { ?><a href='javascript:popup_report("<?=$g4['bbs_path']?>/report_popup.php?bo_table=<?=$bo_table?>&wr_id=<?=$write['wr_id']?>");' class="notify">신고</a><?php } ?>
			<?php if (!empty($is_admin)) { ?><a href='<?=$g4['bbs_path']?>/report_view_blind.php?bo_table=<?=$bo_table?>&wr_id=<?=$wr_id?><?=$qstr?>&wr_blind=<?=($write['wr_blind'] == 1)?'0':'1'?>' class="blind">블라인드<?=($write['wr_blind'] == 1)?'해제':'처리'?></a><?php } ?>
		</div>
	</div>
	<?php if ($is_signature) { // 서명 ?><div class="sign"><?php echo $signature?></div><?php } ?>
</div>




    

    <?php
    // 코멘트 입출력
    include_once("./view_comment.php");
    ?>

<div class="board-foot">
	<div class="fLeft button-set">
		<?php if ($copy_href) { ?><a href="<?php echo $copy_href?>">복사하기</a><?php } ?>
		<?php if ($move_href) { ?><a href="<?php echo $move_href?>">이동하기</a><?php } ?>
		<a href="<?php echo $list_href?>" class="black">목록</a>
		<?php if ($search_href) { ?><a href="<?php echo $search_href?>">검색목록</a><?php } ?>
	</div>
	<div class="fRight button-set">
		<?php if ($write_href) {   ?><a href="<?php echo $write_href?>" class="purple">글쓰기</a><?php } ?>
		<?php if ($update_href) {  ?><a href="<?php echo $update_href?>">수정</a><?php } ?>
		<?php if ($delete_href) {  ?><a href="<?php echo $delete_href?>">삭제</a><?php } ?>
		<?php if ($reply_href) {   ?><a href="<?php echo $reply_href?>">답글</a><?php } ?>
	</div>
</div>



</div><!-- #board_view -->

<script type="text/javascript" src="<?php echo $g4['path']?>/js/jquery.PrintArea.js_4.js"></script>
<script type='text/javascript'>
//<![CDATA[
function file_download(link, file) {
    <?php if ($board[bo_download_point] < 0) { ?>if (confirm("'"+decodeURIComponent(file)+"' 파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board[bo_download_point])?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?"))<?php }?>
    document.location.href=link;
}

// 신고 창
function popup_report(url)
{
    opt = 'scrollbars=yes,width=417,height=385,top=10,left=20';
    popup_window(url, "wreport", opt);
}

$(function() {
    // 추천
    $('.ajax_good').bind('click', function() {
        $.ajax({
            async: false,
            cache: false,
            type: "GET",
            url: this.href,
            success: function(data, textStatus) {
                alert(data);
            }
        });

        return false;
    });

	// 인쇄
	$('a.print').click(function(){
		$('div.board-view').printArea({mode : 'popup', popTitle : $(this).attr('title')});
		return false;
	});

	// 이미지 확대보기
	$("a[rel=image_zoom]").fancybox({
		'titlePosition' 	: 'over',
		'autoScale' : false,
		'hideOnContentClick' 	: false,
		'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
			return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
		}
	});
});
//]]>
</script>
