<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<script type="text/javascript">
//<![CDATA[
// 글자수 제한
var char_min = parseInt(<?php echo $comment_min?>); // 최소
var char_max = parseInt(<?php echo $comment_max?>); // 최대
//]]>
</script>

<?php if ($is_comment_write) { ?>
<!-- 코멘트 쓰기 -->
<div id='comment_write' class="board-comment-write">
	<form id='fcomment' method='post' action='#' onsubmit='return fcomment_submit(this);'>
		<input type='hidden' name='w'           id='w' value='c' />
		<input type='hidden' name='bo_table'    value='<?php echo $bo_table?>' />
		<input type='hidden' name='wr_id'       value='<?php echo $wr_id?>' />
		<input type='hidden' name='comment_id'  id='comment_id' value='' />
		<input type='hidden' name='sca'         value='<?php echo $sca?>'  />
		<input type='hidden' name='sfl'         value='<?php echo $sfl?>'  />
		<input type='hidden' name='stx'         value='<?php echo $stx?>' />
		<input type='hidden' name='spt'         value='<?php echo $spt?>' />
		<input type='hidden' name='page'        value='<?php echo $page?>' />
		<input type="hidden" name="currentId"     value="<?php echo $currentId?>" />
		<input type='hidden' name='is_good'     value='' />
		<ul>
			<?php if ($is_guest) { ?>
			<li>
				<label for="wr_name">이름</label>
				<input type='text' id='wr_name' name='wr_name' maxlength='20' size='10' class='iText required hangulalpha' title='이름' />
			</li>
			<li>
				<label for="wr_password">비밀번호</label>
				<input type='password' name='wr_password' id='wr_password' maxlength='20' size='10' class='iText required' title='비밀번호' />
			</li>
			<?php } ?>
			<li>
				<label for="wr_secret">비밀글</label>
				<input type='checkbox' name='wr_secret' id='wr_secret' value='secret' class="iCheckbox" />
			</li>
			<?php if ($is_guest) { ?>
			<li>
				<label for="wr_key"><img id="zsfImg" alt="자동등록방지 코드" /></label>
				<input type="text" name="wr_key" id="wr_key" size="7" class="iText required" title="자동등록방지 코드" />
			</li>
			<?php } ?>
			<?php if ($comment_min || $comment_max) { ?>
			<li>(코멘트 <span id='char_count'>0</span> 글자)</li>
			<?php } ?>
		</ul>
		<div class="textarea-wrap">
			<label for="wr_content" class="iLabel">댓글을 입력하세요.</label>
			<textarea id='wr_content' name='wr_content' rows='5' cols='50' class='iText required autoresize' title='댓글'></textarea>
			<input type="submit" value="작성" class="button-submit" />
		</div>
	</form>
</div>
<!-- 코멘트 쓰기 -->
<?php } ?>

<div class="board-comment-list-wrap">
	<?php
	for ($i=0; $i<count($list); $i++) {
		$comment_id = $list[$i][wr_id];

		//블라인드 체크
		if (empty($is_admin) && $list[$i]['wr_blind'] == 1) {

			$list[$i]['content'] = $report_config['report_blind_msg_comment'];
		}
		else if (empty($is_admin) && $report_config['report_blind_auto_comment'] == 1) {//코멘트 자동 블랑인드 설정되어 있다면

			//현재 코멘트가 오늘 신고를 몇번 당했는지 체크
			$report_count_target_today = report_get_count_target($bo_table, $comment_id, $g4['time_ymd']);

			//현재 코멘트가 전체 신고를 몇번 당했는지 체크
			$report_count_target_all = report_get_count_target($bo_table, $comment_id, '');

			if ($report_count_target_all >= $report_config['report_blind_count_comment_all'] || $report_count_target_today >= $report_config['report_blind_count_comment_today'])
				$list[$i]['content'] = $report_config['report_blind_msg_comment'];
		}

		$reply_len = strlen($list[$i][wr_comment_reply]);
		$reply_class = $reply_style = "";
		if ($reply_len) {
			$reply_class = " indent";
			$reply_style = " style='padding-left:".($reply_len * 30)."px;background-position:".($reply_len * 30 - 20)."px 12px;'";
		}
	?>
	<div id="c_<?php echo $comment_id?>" class="board-comment-list<?php echo $reply_class?>"<?php echo $reply_style?>>
		<?php 
			if($config[cf_use_member_image]){ // 요걸 체크해줘야 속도에 영향을 덜줌
				$tmp_image = get_member($list[$i]['mb_id'],"mb_image");
				$mb_image = "{$g4['path']}/data/member/img_".substr($list[$i]['mb_id'],0,2)."/{$list[$i]['mb_id']}.{$tmp_image['mb_image']}";
			}
		?>
		<?php if (file_exists($mb_image)) { ?>
		<div class="photo">
			<img src="<?php echo $mb_image?>" alt="" />
		</div>
		<?php } ?>
		<div class="content">
			<div class="head-wrap">
				<span class="author"><?php echo $list[$i][name]?></span>
				<span class="date"><?php echo str_replace("-", ".", $list[$i][wr_datetime])?></span>
				<?php if ($is_ip_view) echo "<span class='ipaddress'>({$list[$i][ip]})</span>"; ?>
				<?php if ($list[$i][is_reply]) { ?><a href='javascript:;' class='cmnt_reply reply' rel='<?php echo $comment_id?>'>댓글달기</a><?php } ?>
				<?php if ($list[$i][is_edit]) { ?><a href='javascript:;' class='cmnt_update edit' rel='<?php echo $comment_id?>'>수정</a><?php } ?>
				<?php if ($list[$i][is_del]) { ?><a href='<?php echo $list[$i][del_link]?>' class='cmnt_delete delete' onclick='return false;'>삭제</a><?php } ?>
                <?php if (report_check_auth($is_admin, $member['mb_level']) === true && $board[bo_use_report] == 1) { ?><a href='javascript:popup_report("<?=$g4['bbs_path']?>/report_popup.php?bo_table=<?=$bo_table?>&wr_id=<?=$comment_id?>");' class="notify">신고</a><?php } ?>
                <?php if (!empty($is_admin)) { ?><a href='<?=$g4['bbs_path']?>/report_view_blind.php?bo_table=<?=$bo_table?>&wr_id=<?=$comment_id?><?=$qstr?>&wr_blind=<?=($list[$i]['wr_blind'] == 1)?'0':'1'?>' class="blind">블라인드<?=($list[$i]['wr_blind'] == 1)?'해제':'처리'?></a><?php } ?>
			</div>
			<?php
			if (strstr($list[$i][wr_option], "secret")) echo "<img src='$board_skin_path/img/icon_secret.gif' class='icon_secret' alt='비밀글' /> ";
			$str = $list[$i][content];
			if (strstr($list[$i][wr_option], "secret"))
				$str = "<span class='secret'>$str</span>";

			$str = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp|mms)\:\/\/([^[:space:]]+)\.(mp3|wma|wmv|asf|asx|mpg|mpeg)\".*\<\/a\>\]/i", "<script>doc_write(obj_movie('$1://$2.$3'));</script>", $str);
			//$str = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp)\:\/\/([^[:space:]]+)\.(swf)\".*\<\/a\>\]/i", "<script>doc_write(flash_movie('$1://$2.$3'));</script>", $str);
			//$str = preg_replace("/\[\<a\s*href\=\"(http|https|ftp)\:\/\/([^[:space:]]+)\.(gif|png|jpg|jpeg|bmp)\"\s*[^\>]*\>[^\s]*\<\/a\>\]/i", "<img src='$1://$2.$3' id='target_resize_image[]' onclick='image_window(this);' border='0'>", $str);
			echo $str;
			?>
		</div>
	</div>
	<?php } ?>
</div>

<!-- 코멘트 js -->
<script type="text/javascript" src="<?php echo $g4[path]?>/js/md5.js"></script>
<script type="text/javascript" src="<?="$g4[path]/zmSpamFree/zmspamfree.js"?>"></script>
<script type="text/javascript">
//<![CDATA[
// 코멘트쓰기 전송전 검사
function fcomment_submit(f)
{

	if(!wrestSubmit(f))
		return false;

    if (typeof(f.wr_password) != "undefined") {
        if (f.wr_password.value == "") {
            alert("비밀번호를 입력하십시오.");
            f.wr_password.focus();
            return false;
        }
    }

	if (typeof(f.wr_key) != 'undefined') {
		if (!checkFrm()) {
			alert ("스팸방지코드(Captcha Code)가 틀렸습니다. 다시 입력해 주세요.");
			return false;
		}
	}

    var comment = document.getElementById("wr_content");

    var s;
    if (s = word_filter_check(comment.value)) {
        alert("코멘트에 금지단어('"+s+"')가 포함되어있습니다");
        comment.focus();
        return false;
    }

    if (char_min > 0 || char_max > 0) {
        check_byte("wr_content", "char_count");
        var cnt = parseInt(document.getElementById("char_count").innerHTML);
        if (char_min > 0 && char_min > cnt) {
            alert("코멘트는 "+char_min+"글자 이상 쓰셔야 합니다.");
            comment.focus();
            return false;
        } else if (char_max > 0 && char_max < cnt) {
            alert("코멘트는 "+char_max+"글자 이하로 쓰셔야 합니다.");
            comment.focus();
            return false;
        }
    }

    f.action = "./write_comment_update.php";

    return true;
}

$(function() {
    // 코멘트 답변의 배경이미지 설정 (css 에서는 별도로 설정되지 않음)
    $("#board_comment .comment_area .reply")
        .css("background", "url(<?php echo $board_skin_path?>/img/icon_cmt_reply.gif) no-repeat left 11px")
        .css("padding-left", "15px");

    // 코멘트 글자수
    $("#wr_content").bind("keyup", function() {
        if ($("#char_count")[0])
            check_byte("wr_content", "char_count");
    });

    // 코멘트 답변
    $(".cmnt_reply").bind("click", function() {
        var f = $("#fcomment").get(0);
        f.w.value = "c";
        f.comment_id.value = this.rel;
        f.wr_content.value = "";
        //alert($(this).parents().find(".comment_area").html());

		$(this).parents(".board-comment-list").after( $("#comment_write") );
		$(".textarea-wrap .iText").focus();
	});

    // 코멘트 수정
    $(".cmnt_update").bind("click", function() {
        var f = $("#fcomment").get(0);
        f.w.value = "cu";
		f.comment_id.value = this.rel;
		$(this).parents(".board-comment-list").after( $("#comment_write") );

		$.ajax({
            async: false,
            cache: false,
            type: "GET",
            dataType: "json",
            url: g4_bbs_path+"/get_comment.php",
            data: {
                "bo_table": f.bo_table.value,
                "comment_id": f.comment_id.value
            },
            success: function(data, textStatus) {
                if (data.secret == "secret")
                    f.wr_secret.checked = "checked";
                else
                    f.wr_secret.checked = "";
                f.wr_content.value = data.wr_content;
            }
        });
		$(".textarea-wrap .iText").focus();
	});

    function comment_delete(url)
    {
        if (confirm("이 코멘트를 삭제하시겠습니까?")) location.href = url;
    }

    // 코멘트 수정
    $(".cmnt_delete").bind("click", function() {
        if (confirm("이 코멘트를 삭제하시겠습니까?"))
            location.href = this.href;
    });

    $("#fcomment").attr("autocomplete", "off");
});
//]]>
</script>
