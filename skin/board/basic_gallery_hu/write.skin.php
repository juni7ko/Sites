<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if ($is_dhtml_editor) {
    include_once("$g4[path]/lib/cheditor5.lib.php");
    echo "<script type='text/javascript' src='$g4[cheditor5_path]/cheditor.js'></script>";
    echo cheditor1('wr_content', '100%', '350');
}

if ($is_file) {
    $flen_limit = (int)$board['bo_upload_count'];
    if ($flen_limit == 0 && $w == "")
        $flen_each = 2; // 무한일 때 반복수
	else if($flen_limit == 0 && $w == "u")
        $flen_each = ($file["count"] == 0)?2:$file["count"]; // 무한일 때 반복수
    else // 제한 있을 때
        $flen_each = $flen_limit;
}
?>

<script type="text/javascript">
// 글자수 제한
// 이 코드는 board.skin.js 위에 선언이 되어야 합니다.
//<![CDATA[
var char_min = parseInt(<?php echo $write_min?>); // 최소
var char_max = parseInt(<?php echo $write_max?>); // 최대
var flen = 0; // 첨부파일 카운터
var flen_limit = parseInt(<?php echo $flen_limit?>);
var flen_each = parseInt(<?php echo $flen_each?>);
var ca_name = "<?php echo $write['ca_name']?>";
//]]>
</script>

<div id='board_write' style='width: <?php echo $bo_table_width?>;'>

    <form id="fwrite" method="post" action="<?php echo $g4['https_url'] ? "{$g4['https_url']}/{$g4['bbs']}" : $g4['bbs_path']; ?>/write_update.php" enctype="multipart/form-data">
    <input type="hidden" name="w"        value="<?php echo $w?>" />
    <input type="hidden" name="bo_table" value="<?php echo $bo_table?>" />
    <input type="hidden" name="wr_id"    value="<?php echo $wr_id?>" />
    <input type="hidden" name="sca"      value="<?php echo $sca?>" />
    <input type="hidden" name="sfl"      value="<?php echo $sfl?>" />
    <input type="hidden" name="stx"      value="<?php echo $stx?>" />
    <input type="hidden" name="spt"      value="<?php echo $spt?>" />
    <input type="hidden" name="sst"      value="<?php echo $sst?>" />
    <input type="hidden" name="sod"      value="<?php echo $sod?>" />
    <input type="hidden" name="page"     value="<?php echo $page?>" />
	<input type="hidden" name="currentId"     value="<?php echo $currentId?>" />
    <?php echo $option_hidden?>

    <table class='board-write'>
		<colgroup>
			<col width="20%" />
			<col width="80%" />
		</colgroup>
	<?php if ($is_name) { ?>
    <tr>
        <th scope="row">이름</th>
        <td><input type="text" id="wr_name" name="wr_name" maxlength="20" class="iText required hangulalpha" title="이름" value="<?php echo $name?>" /></td>
    </tr>
    <?php } ?>
    <?php if ($is_password) { ?>
    <tr>
        <th>비밀번호</th>
        <td><input type="password" id="wr_password" name="wr_password" maxlength="20" class="iText <?php echo ($w==""?'required':'');?>" title="비밀번호" /></td>
    </tr>
    <?php } ?>

<!-- 
    <?php if ($is_email) { ?>
    <tr>
        <th>이메일</th>
        <td><input type="text" id="wr_email" name="wr_email" size="50" maxlength="100" class="iText email" value="<?php echo $email?>" title="이메일" /></td>
    </tr>
    <?php } ?> -->


    <?php if ($is_homepage) { ?>
    <tr>
        <th>홈페이지</th>
        <td><input type="text" id="wr_homepage" name="wr_homepage" size="50" class="iText" value="<?php echo $homepage?>" /></td>
    </tr>
    <?php } ?>
    <?php if ($option) { ?>
    <tr>
        <th>옵션</th>
        <td><?php echo $option?></td>
    </tr>
    <?php } ?>
    <?php if ($is_category) { ?>
    <tr>
        <th>분류</th>
        <td>
            <select id="ca_name" name="ca_name" class="required" title="분류">
                <option value="">선택하세요</option>
                <?php echo $category_option?>
            </select>
        </td>
    </tr>
    <?php } ?>
    <tr>
        <th>제목</th>
        <td><input type="text" id="wr_subject" name="wr_subject" class="iText required" title="제목" value="<?php echo $subject?>" style="width:98%;" /></td>
    </tr>
    <tr>
        <td colspan="2">

			<?php if ($is_dhtml_editor) { ?>
			<?=cheditor2('wr_content', $content);?>
			<?php } else { ?>
            <div class="textarea_control">
                <div class="fLeft">
                    <span onclick="javascript:textarea_decrease('wr_content', 10);"><img src="<?php echo $board_skin_path?>/img/btn_txt_up.gif" alt="줄이기" /></span>
                    <span onclick="javascript:textarea_original('wr_content', 10);"><img src="<?php echo $board_skin_path?>/img/btn_txt_default.gif" alt="기본" /></span>
                    <span onclick="javascript:textarea_increase('wr_content', 10);"><img src="<?php echo $board_skin_path?>/img/btn_txt_down.gif" alt="늘이기" /></span>
                </div>
                <div class="fRight"><?php if ($write_min || $write_max) { ?><span id="char_count"></span>글자<?php } ?></div>
            </div>
            <textarea id="wr_content" name="wr_content" class="iTextarea required" rows="10" cols="1" title="내용" style="width:99%;"><?php echo $content?></textarea>
			<?php } ?>
        </td>
    </tr>

    <?php if ($is_link)
        for ($i=1; $i<=$g4['link_count']; $i++) { ?>
    <tr>
        <th>링크 #<?php echo $i?></th>
        <td><input type="text" size="60" id="wr_link<?php echo $i?>" name="wr_link<?php echo $i?>" class="iText" value="<?php echo $write["wr_link{$i}"]?>" /></td>
    </tr>
    <?php } // for, if ?>
    <?php if ($is_file) { ?>
    <tr>
        <th>파일첨부
            <a href="javascript:;" id="add_file"><img src="<?php echo "$board_skin_path/img/icon_plus.gif"?>" alt="파일추가" /></a>
            <a href="javascript:;" id="del_file"><img src="<?php echo "$board_skin_path/img/icon_minus.gif"?>" alt="파일추가삭제" /></a>
        </th>
        <td>
            <ul id="variableFiles">
            <?php for ($i = 0; $i < $flen_each; $i++) {
                $wu = "";
                if ($w == "u" && $file[$i])
                    $wu = "wu";
            ?>
            <li class="<?php if ($wu) echo $wu; ?>">
                <span class="basicForm">
                    <input type="file" class="ed file" name="bf_file[]" title="파일 용량 <?php echo $upload_max_filesize?> 이하만 업로드 가능" />
                    <?php if($is_file_content) { ?><input type="text" class="ed" size="50" name="bf_content[]" title="업로드 이미지 파일에 해당 되는 내용을 입력하세요." value="<?php if ($wu) echo $file[$i]['content']; ?>" /><?php } ?>
                </span>
                <?php if ($wu) { ?>
                <input type="checkbox" name="bf_file_del[<?php echo $i?>]" id="bf_file_del<?php echo $i?>" value="1" />
                <a href="<?php echo $file[$i]['href']?>"><?php echo $file[$i]['source']?>(<?php echo $file[$i]['size']?>)</a>
                <label for="bf_file_del<?php echo $i?>">파일삭제</label>
                <?php } ?>
            </li>
            <?php } ?>
            </ul>
        </td>
    </tr>
    <?php } ?>
    <?php if ($is_guest) { ?>
    <tr>
        <th>
			<img id="zsfImg" alt="자동등록방지 코드" />
		</th>
        <td>
			<input type="text" name="wr_key" id="wr_key" size="10" class="iText required" title="자동등록방지 코드" />
			왼쪽의 글자를 입력하세요.
        </td>
    </tr>
    <?php } ?>
    </table>

		<div class="board-foot button-set">
			<input type="submit" value="글쓰기" class="purple" />
			<a href="./board.php?bo_table=<?php echo $bo_table?>&amp;currentId=<?=$currentId;?>">목록</a>
		</div>
	</form>

</div><!-- #board_write -->

<script type="text/javascript" src="<?php echo $g4[path]?>/js/md5.js"></script>
<script type="text/javascript" src="<?="$g4[path]/zmSpamFree/zmspamfree.js"?>"></script>
<script type="text/javascript">
//<![CDATA[
$(function() {
    if ($('#ca_name').length) {
        if (typeof(g4_admin) != 'undefined') {
            var option = new Option('공지', '공지');
            if ($.browser.msie) {
                $('#ca_name')[0].add(option);
            } else {
                $('#ca_name')[0].add(option, null);
            }
        }

        $('#ca_name').val(ca_name);
    }

    // 파일 첨부
    // $('#variable').append("<table id='variable_files' cellspacing='0'><tbody></tbody></table>").css({'margin':'0px','padding':'0px'});

    $("#variableFiles li").each(function() {
        if(!$(this).hasClass("wu")) {
            $(this).css("display", "none");
        } else {
            flen++;
        }
    });

    <?php
    //무조건 첨부필드를 1개 추가하는것을 방지. 수정시 첨부파일이 최대첨부 개수와 같으면 alert 창이 뜬다.
    if ($flen_limit > $file['count']) {
        $trigger = ".trigger(\"click\");";
    } else {
        $trigger = ";";
    } ?>
     $("#add_file").click(function() {
        if (flen_limit && flen >= flen_limit) {
            alert("이 게시판은 " + flen_limit + "개 까지만 파일 업로드가 가능합니다.");
            return false;
        } else if ( $("#variableFiles li").length < flen_each || (flen_limit == 0 && flen >= flen_each) ) {
            $("#variableFiles").append("<li>" + $("#variableFiles li:eq(0) > span.basicForm").html() + "</li>");
        } else {
            $("#variableFiles li").eq(flen).css("display", "");
        }
        flen++;
    })<?php echo $trigger?>

    $("#del_file").click(function() {
        if (flen <= 1) {
            alert("더이상 삭제할 수 없습니다!");
            return false;
        } else {
            $("#variableFiles li").eq(flen - 1).remove();
        }
        flen--;
    });

    $("#wr_content")
    .load(function() {
        if($(this).hasClass("geditor")) {
            $(this).attr("geditor", "geditor");
        }
    })
    .keyup(function() {
        if(char_min || char_max) {
            check_byte('wr_content', 'char_count');
        }
    })
    .trigger("load")
    .trigger("keyup");

    // 포커스
    $("#fwrite")
    .attr("autocomplete", "off")
    .submit(function() {

		if(!wrestSubmit(this))
			return false;
/*
        if($("#char_count") && (char_min > 0 || char_max > 0)) {
            var cnt = parseInt($("#char_count").html());
            if (char_min > 0 && char_min > cnt) {
                 alert("내용은 " + char_min + "글자 이상 쓰셔야 합니다.");
                 return false;
            }
            else if (char_max > 0 && char_max < cnt) {
                alert("내용은 " + char_max + "글자 이하로 쓰셔야 합니다.");
                return false;
            }
        }
*/
		<?php if ($is_dhtml_editor) { echo cheditor3('wr_content'); } ?>
	/*
		if (document.getElementById('tx_wr_content')) {
			if (!ed_wr_content.getBodyText()) {
				alert('내용을 입력하십시오.');
				ed_wr_content.returnFalse();
				return false;
			}
		}
*/
/*
        var subject = "";
        var content = "";
        $.ajax({
            url: g4_bbs_path + "/ajax.filter.php",
            type: "POST",
            data: {
                "subject": $("#wr_subject").val(),
                "content": $("#wr_content").val()
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });


        if (subject) {
            alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
            $("wr_subject").focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_wr_content) != "undefined")
                ed_wr_content.returnFalse();
            else
                $("wr_content").focus();
            return false;

        }
*/
/*
		<?php if($is_guest){?>
			if (!checkFrm()) {
				alert ("스팸방지코드(Captcha Code)가 틀렸습니다. 다시 입력해 주세요.");
				return false;
			}
		<?php }?>
*/


    })
    .find(":input[type=text]:visible:enabled:first").focus();
});
//]]>
</script>
