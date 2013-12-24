<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<script type="text/javascript">
// 글자수 제한
var char_min = parseInt(<?php echo $comment_min?>); // 최소
var char_max = parseInt(<?php echo $comment_max?>); // 최대
</script>
<section>
    <div id="commentContents">
    <?php
    $list_count = count($list);
    for ($i = 0; $i < $list_count; $i++) {
        $comment_id = $list[$i]['wr_id'];
        $margin_left = "0";
        for ($k = 0; $k < strlen($list[$i]['wr_comment_reply']); $k++) {
            $margin_left += "20"; 
        }
    ?>
        <article>
            <footer>
                <a name="c_<?php echo $comment_id?>"></a>
                <div id="comment" style="margin-left: <?php echo $margin_left?>px">
                    <div class="cmt_info">
                        <div style="float:left; margin:2px 0 0 2px;">
                            <?php echo $list[$i]['name']?> 
                            <span style="color:#888; font-size:10px;letter-spacing: -1px;"><?php echo $list[$i]['datetime']?></span>
                        </div>
                        <div style="float:right;">
                        <?php if ($is_ip_view) { echo "&nbsp;<span style=\"color:#B2B2B2; font-size:11px;\">{$list[$i]['ip']}</span>"; } ?>
                        <?php if ($list[$i]['is_reply']) { echo "<a href=\"javascript:comment_box('{$comment_id}', 'c');\" class='btn btn_reply'>답변</a> "; } ?>
                        <?php if ($list[$i]['is_edit']) { echo "<a href=\"javascript:comment_box('{$comment_id}', 'cu');\" class='btn'>수정</a> "; } ?>
                        <?php if ($list[$i]['is_del'])  { echo "<a href=\"javascript:comment_delete('{$list[$i]['del_link']}');\" class='btn'>삭제</a> "; } ?>
                        </div>
                    </div>

                    <!-- 코멘트 출력 -->
                    <div class="cmt_content">
                        <?php
                        if (strstr($list[$i]['wr_option'], "secret")) echo "<span style='color:#ff6600;'>*</span> ";
                        $str = $list[$i]['content'];
                        if (strstr($list[$i]['wr_option'], "secret"))
                            $str = "<span style='color:#ff6600;'>$str</span>";

                        $str = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp|mms)\:\/\/([^[:space:]]+)\.(mp3|wma|wmv|asf|asx|mpg|mpeg)\".*\<\/a\>\]/i", "<script>doc_write(obj_movie('$1://$2.$3'));</script>", $str);
                        // FLASH XSS 공격에 의해 주석 처리 - 110406
                        //$str = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp)\:\/\/([^[:space:]]+)\.(swf)\".*\<\/a\>\]/i", "<script>doc_write(flash_movie('$1://$2.$3'));</script>", $str);
                        $str = preg_replace("/\[\<a\s*href\=\"(http|https|ftp)\:\/\/([^[:space:]]+)\.(gif|png|jpg|jpeg|bmp)\"\s*[^\>]*\>[^\s]*\<\/a\>\]/i", "<img src='$1://$2.$3' id='target_resize_image[]' onclick='image_window(this);' border='0'>", $str);
                        echo $str;
                        ?>
                    </div>
                    <span id='edit_<?php echo $comment_id?>' style='display:none;'></span><!-- 수정 -->
                    <span id='reply_<?php echo $comment_id?>' style='display:none;'></span><!-- 답변 -->
                    <input type='hidden' id='secret_comment_<?php echo $comment_id?>' value="<?php echo strstr($list[$i]['wr_option'],"secret")?>">
                    <textarea id='save_comment_<?php echo $comment_id?>' style='display:none;'><?php echo get_text($list[$i][content1], 0)?></textarea>
                </div>
            </footer>
        </article>
    <?php } ?>
    </div><!--//commentContents-->

    <?php if ($is_comment_write) { ?>
    <!-- 코멘트 입력 -->
    <div id='comment_write' style="display:none;">
        <form name="fviewcomment" method="post" action="./write_comment_update.php" onsubmit="return fviewcomment_submit(this);" autocomplete="off" style="margin:0px;">
            <fieldset>
                <legend class="hc">댓글쓰기</legend>
                <input type='hidden' name='w'           id='w' value='c'>
                <input type='hidden' name='bo_table'    value='<?php echo $bo_table ?>'>
                <input type='hidden' name='wr_id'       value='<?php echo $wr_id ?>'>
                <input type='hidden' name='comment_id'  id='comment_id' value=''>
                <input type='hidden' name='sca'         value='<?php echo $sca ?>' >
                <input type='hidden' name='sfl'         value='<?php echo $sfl ?>' >
                <input type='hidden' name='stx'         value='<?php echo $stx ?>'>
                <input type='hidden' name='spt'         value='<?php echo $spt ?>'>
                <input type='hidden' name='page'        value='<?php echo $page ?>'>
                <input type='hidden' name='cwin'        value='<?php echo $cwin ?>'>
                <input type='hidden' name='is_good'     value=''>
                <div style="padding:5px;">
                    <p style="padding-bottom: 5px;">
                    <?php if ($is_guest) { ?>
                   <input type='text' maxLength='20' size='10' name="wr_name" class="wr_input" style="border:1px solid #ccc;height:25px; background: url('<?php echo $board_skin_path?>/img/bg_lv1.gif') no-repeat scroll 0.4em 7px #fff;">
                   <input type='password' maxLength='20' size='10' name="wr_password" class="wr_input" style="border:1px solid #ccc;height:25px;background: url('<?php echo $board_skin_path?>/img/bg_lv1.gif') no-repeat scroll 0.4em -80px #fff;">
                    <?php } ?>
                   <input type='checkbox' id="wr_secret" name="wr_secret" value="secret"><label for="wr_secret"> 비밀글</label>
                    </p>
                    <textarea id="wr_content" name="wr_content" rows='5' itemname="내용" required <?php if ($comment_min || $comment_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?php }?> style='width:100%; word-break:break-all; border: 1px solid #ccc'></textarea>
                    <?php if ($comment_min || $comment_max) { ?><script type="text/javascript"> check_byte('wr_content', 'char_count'); </script><?php }?>
                    <p style="padding:10px 0 10px 0; line-height: 60px;">
                    <?php if ($is_guest) { ?>
                    <img class='kcaptcha_image' id="kcaptcha_image" style="vertical-align: middle;">
                    <input title="왼쪽의 글자를 입력하세요." type="input" name="wr_key" size="10" required itemname="자동등록방지" style="border:1px solid #ccc;height:60px; ">
                    <?php } ?>
                    <button type="submit" accesskey='s' style="height: 60px;">댓글입력</button>
                    </p>
                </div>
            </fildset>
        </form>
    </div>
</section>
<script type="text/javascript" src="<?php echo "{$g4['g4m_path']}/js/jquery.kcaptcha.js"?>"></script>
<script type="text/javascript">
    $(function(){
        $(".wr_input").click(function(){
            $(this).css("background","none");
        });
    });
    var save_before = '';
    var save_html = document.getElementById('comment_write').innerHTML;

    function good_and_write()
    {
        var f = document.fviewcomment;
        if (fviewcomment_submit(f)) {
            f.is_good.value = 1;
            f.submit();
        } else {
            f.is_good.value = 0;
        }
    }

    function fviewcomment_submit(f)
    {
        var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자

        f.is_good.value = 0;

        /*
        var s;
        if (s = word_filter_check(document.getElementById('wr_content').value))
        {
            alert("내용에 금지단어('"+s+"')가 포함되어있습니다");
            document.getElementById('wr_content').focus();
            return false;
        }
        */

        var subject = "";
        var content = "";
        $.ajax({
            url: "<?php echo $board_skin_path?>/ajax.filter.php",
            type: "POST",
            data: {
                "subject": "",
                "content": f.wr_content.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            f.wr_content.focus();
            return false;
        }

        // 양쪽 공백 없애기
        var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자
        document.getElementById('wr_content').value = document.getElementById('wr_content').value.replace(pattern, "");
        if (char_min > 0 || char_max > 0)
        {
            check_byte('wr_content', 'char_count');
            var cnt = parseInt(document.getElementById('char_count').innerHTML);
            if (char_min > 0 && char_min > cnt)
            {
                alert("코멘트는 "+char_min+"글자 이상 쓰셔야 합니다.");
                return false;
            } else if (char_max > 0 && char_max < cnt)
            {
                alert("코멘트는 "+char_max+"글자 이하로 쓰셔야 합니다.");
                return false;
            }
        }
        else if (!document.getElementById('wr_content').value)
        {
            alert("코멘트를 입력하여 주십시오.");
            return false;
        }

        if (typeof(f.wr_name) != 'undefined')
        {
            f.wr_name.value = f.wr_name.value.replace(pattern, "");
            if (f.wr_name.value == '')
            {
                alert('이름이 입력되지 않았습니다.');
                f.wr_name.focus();
                return false;
            }
        }

        if (typeof(f.wr_password) != 'undefined')
        {
            f.wr_password.value = f.wr_password.value.replace(pattern, "");
            if (f.wr_password.value == '')
            {
                alert('패스워드가 입력되지 않았습니다.');
                f.wr_password.focus();
                return false;
            }
        }

        if (!check_kcaptcha(f.wr_key)) {
            return false;
        }

        return true;
    }

    function comment_box(comment_id, work)
    {
        var el_id;
        // 코멘트 아이디가 넘어오면 답변, 수정
        if (comment_id)
        {
            if (work == 'c'){
                el_id = 'reply_' + comment_id;
            }else{
                el_id = 'edit_' + comment_id;
            }
        }
        else
            el_id = 'comment_write';

        if (save_before != el_id)
        {
            if (save_before)
            {
                document.getElementById(save_before).style.display = 'none';
                document.getElementById(save_before).innerHTML = '';
            }

            document.getElementById(el_id).style.display = '';
            document.getElementById(el_id).innerHTML = save_html;
            // 코멘트 수정
            if (work == 'cu')
            {
                document.getElementById('wr_content').value = document.getElementById('save_comment_' + comment_id).value;
                if (typeof char_count != 'undefined')
                    check_byte('wr_content', 'char_count');
                if (document.getElementById('secret_comment_'+comment_id).value)
                    document.getElementById('wr_secret').checked = true;
                else
                    document.getElementById('wr_secret').checked = false;
            }

            document.getElementById('comment_id').value = comment_id;
            document.getElementById('w').value = work;

            save_before = el_id;
        }

        if (typeof(wrestInitialized) != 'undefined')
            wrestInitialized();
        if (comment_id && work == 'c')
            $.kcaptcha_run();
    }

    function comment_delete(url)
    {
        if (confirm("이 코멘트를 삭제하시겠습니까?")) location.href = url;
    }

    comment_box('', 'c'); // 코멘트 입력폼이 보이도록 처리하기위해서 추가 (root님)
</script>
<?php  } ?>
