<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>
<script type="text/javascript">
// 글자수 제한
var char_min = parseInt(<?php echo $write_min?>); // 최소
var char_max = parseInt(<?php echo $write_max?>); // 최대
</script>
<style type="text/css">
/* basic board write.skin.php */
form#fwrite input,form#fwrite textarea{border:1px solid #666;}
.wr1{padding-top: .7em; position: relative}
.wr2{padding-top: 1em; position: relative; height: 65px;}
.wr2 dt{color: #666666;left: 10px;position: absolute;top: 1em;white-space: nowrap;}
.wr2 dd{padding-right: 10px;padding-left: 10em;}
.wr1 dt{color: #666666;left: 10px;position: absolute;top: 0.7em;white-space: nowrap;}
.wr1 dd{padding-right: 10px;padding-left: 5.4em;}
</style>
<form id="fwrite" name="fwrite" method="post" onsubmit="return fwrite_submit(this);" enctype="multipart/form-data" style="margin:0px;">
    <fieldset>
        <legend class="hc">글쓰기</legend>
        <input type='hidden' name='null'> 
        <input type='hidden' name='w'        value="<?php echo $w?>">
        <input type='hidden' name='bo_table' value="<?php echo $bo_table?>">
        <input type='hidden' name='wr_id'    value="<?php echo $wr_id?>">
        <input type='hidden' name='sca'      value="<?php echo $sca?>">
        <input type='hidden' name='sfl'      value="<?php echo $sfl?>">
        <input type='hidden' name='stx'      value="<?php echo $stx?>">
        <input type='hidden' name='spt'      value="<?php echo $spt?>">
        <input type='hidden' name='sst'      value="<?php echo $sst?>">
        <input type='hidden' name='sod'      value="<?php echo $sod?>">
        <input type='hidden' name='page'     value="<?php echo $page?>">
        <div class="wr_title">
            <h1>글쓰기</h1>
            <p class="l"><a href="<?php echo "{$g4['g4m_path']}/bbs/board.php?bo_table={$_GET['bo_table']}";?>" class="btn">취소</a></p>
            <p class="r"><button type="submit"  class="btn">확인</button></p>
        </div>
        <?php if ($is_name) { ?>
        <dl class='wr1'>
            <dt>이 름</dt>
            <dd><input maxlength='20' size='15' name='wr_name' itemname="이름" required value='<?php echo $name?>'></dd>
        </dl>
        <?php } ?>
        <?php if ($is_password) { ?>
        <dl class='wr1'>
            <dt>패스워드</dt>
            <dd><input type='password' maxlength='20' size='15' name='wr_password' itemname="패스워드" <?php echo $password_required?>></dd>
        </dl>
        <?php } ?>

        <?php if ($is_email) { ?>
        <dl class='wr1'>
            <dt>이메일</dt>
            <dd><input maxlength='100' type="email" name='wr_email' value="<?php echo $email?>"></dd>
        </dl>
        <?php } ?>

        <?php if ($is_homepage) { ?>
        <dl class='wr1'>
            <dt>홈페이지</dt>
            <dd><input  name='wr_homepage' type='url' value="<?php echo $homepage?>"></dd>
        </dl>
        <?php } ?>

        <?php
        $option = "";
        $option_hidden = "";
        if ($is_notice || $is_html || $is_secret || $is_mail) { 
            $option = "";
            if ($is_notice) { 
                $option .= "<input type='checkbox' name='notice' value='1' $notice_checked> 공지&nbsp;";
            }

            if ($is_html) {
                $option .= "<input onclick='html_auto_br(this);' type='checkbox' value='$html_value' name='html' $html_checked><span class='w_title'> html</span>&nbsp;";
            }

            if ($is_secret) {
                if ($is_admin || $is_secret==1) {
                    $option .= "<input type='checkbox' value='secret' name='secret' $secret_checked><span class='w_title'> 비밀글</span>&nbsp;";
                } else {
                    $option_hidden .= "<input type='hidden' value='secret' name='secret'>";
                }
            }

            if ($is_mail) {
                $option .= "<input type='checkbox' value='mail' name='mail' $recv_email_checked> 답변메일받기&nbsp;";
            }
        }

        echo $option_hidden;
        if ($option) {
        ?>
        <dl class='wr1'>
            <dt>옵 션</dt>
            <dd><?php echo $option?></dd>
        </dl>
        <?php } ?>

        <?php if ($is_category) { ?>
        <dl class='wr1'>
            <dt>분 류</dt>
            <dd><select name='ca_name' required itemname="분류"><option value="">선택하세요<?php echo $category_option?></select></dd>
        </dl>
        <?php } ?>

        <dl class='wr1'>
            <dt>제 목</dt>
            <dd><input name='wr_subject' id="wr_subject" itemname="제목" required value="<?php echo $subject?>" style="width: 100%"></dd>
        </dl>

        <dl class='wr1'>
            <dt>내용</dt>
            <dd>
                <textarea id="wr_content" name="wr_content" style='width:100%; word-break:break-all;' rows='10' itemname="내용" required <?php if ($write_min || $write_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?php }?>><?php echo $content?></textarea>
                <?php if ($write_min || $write_max) { ?><script type="text/javascript"> check_byte('wr_content', 'char_count'); </script><?php } ?>
            </dd>
        </dl>

        <?php if ($is_link) { ?>
        <?php for ($i = 1; $i <= $g4[link_count]; $i++) { ?>
        <dl class='wr1'>
            <dt>링크 #<?php echo $i?></dt>
            <dd><input type='text' name='wr_link<?php echo $i?>' itemname='링크 #<?php echo $i?>' value='<?php echo $write["wr_link{$i}"]?>'></dd>
        </dl>
        <?php } ?>
        <?php } ?>

        <?php if ($is_file) { ?>
        <dl class='wr1' style=" ">
            <dt>
                파일첨부<br> 
                <span onclick="add_file();" style="cursor:pointer;"><img src="<?php echo $board_skin_path?>/img/btn_file_add.gif"></span> 
                <span onclick="del_file();" style="cursor:pointer;"><img src="<?php echo $board_skin_path?>/img/btn_file_minus.gif"></span>
            </dt>
            <dd>
                <table id="variableFiles" cellpadding=0 cellspacing=0></table><?php
// print_r2($file); ?>
                <script type="text/javascript">
                var flen = 0;
                function add_file(delete_code)
                {
                    var upload_count = <?php echo (int)$board[bo_upload_count]?>;
                    if (upload_count && flen >= upload_count)
                    {
                        alert("이 게시판은 "+upload_count+"개 까지만 파일 업로드가 가능합니다.");
                        return;
                    }

                    var objTbl;
                    var objRow;
                    var objCell;
                    if (document.getElementById)
                        objTbl = document.getElementById("variableFiles");
                    else
                        objTbl = document.all["variableFiles"];

                    objRow = objTbl.insertRow(objTbl.rows.length);
                    objCell = objRow.insertCell(0);

                    objCell.innerHTML = "<input type='file' name='bf_file[]' title='파일 용량 <?php echo $upload_max_filesize?> 이하만 업로드 가능' style='width:99%'>";
                    if (delete_code)
                        objCell.innerHTML += delete_code;
                    else
                    {
                        <?php if ($is_file_content) { ?>
                        objCell.innerHTML += "<br><input type='text' name='bf_content[]' title='업로드 이미지 파일에 해당 되는 내용을 입력하세요.'>";
                        <?php } ?>
                        ;
                    }

                    flen++;
                }

                <?php echo $file_script; //수정시에 필요한 스크립트?>

                function del_file()
                {
                    // file_length 이하로는 필드가 삭제되지 않아야 합니다.
                    var file_length = <?php echo (int)$file_length?>;
                    var objTbl = document.getElementById("variableFiles");
                    if (objTbl.rows.length - 1 > file_length)
                    {
                        objTbl.deleteRow(objTbl.rows.length - 1);
                        flen--;
                    }
                }
                </script>
            </dd>
        </dl>
        <?php } ?>
        <?php if ($is_guest) { ?>
        <dl class='wr2'>
            <dt><img id='kcaptcha_image' class="kcaptcha_image"/></dt>
            <dd><input type='input' size='10' name='wr_key' style="height: 60px;"><span style="font-size:0.85em; letter-spacing: -1px;">왼쪽글자입력</span></dd>
        </dl>
        <?php } ?>
        <div style="position: relative; top:.7em;padding:10px; margin-bottom: 20px;overflow: hidden">
            <p style="float: left"><button type='submit' id="btn_submit" class="btn">확인</button></p>
            <p style="float: right"><a href="./board.php?bo_table=<?php echo $bo_table?>" id="btn_list" class="btn">목록</a></p>
        </div>
        <hr class="hc">
    </fieldset>
</form>

<script type="text/javascript" src="<?php echo "{$g4['g4m_path']}/js/jquery.kcaptcha.js"?>"></script>
<script type="text/javascript">
<?php
// 관리자라면 분류 선택에 '공지' 옵션을 추가함
if ($is_admin) 
{
    echo "
    if (typeof(document.fwrite.ca_name) != 'undefined')
    {
        document.fwrite.ca_name.options.length += 1;
        document.fwrite.ca_name.options[document.fwrite.ca_name.options.length-1].value = '공지';
        document.fwrite.ca_name.options[document.fwrite.ca_name.options.length-1].text = '공지';
    }";
} 
?>

with (document.fwrite) 
{
    if (typeof(wr_name) != "undefined")
        wr_name.focus();
    else if (typeof(wr_subject) != "undefined")
        wr_subject.focus();
    else if (typeof(wr_content) != "undefined")
        wr_content.focus();

    if (typeof(ca_name) != "undefined")
        if (w.value == "u")
            ca_name.value = "<?php echo $write[ca_name]?>";
}

function html_auto_br(obj) 
{
    if (obj.checked) {
        result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
        if (result)
            obj.value = "html2";
        else
            obj.value = "html1";
    }
    else
        obj.value = "";
}

function fwrite_submit(f) 
{
    /*
    var s = "";
    if (s = word_filter_check(f.wr_subject.value)) {
        alert("제목에 금지단어('"+s+"')가 포함되어있습니다");
        return false;
    }

    if (s = word_filter_check(f.wr_content.value)) {
        alert("내용에 금지단어('"+s+"')가 포함되어있습니다");
        return false;
    }
    */

    if (document.getElementById('char_count')) {
        if (char_min > 0 || char_max > 0) {
            var cnt = parseInt(document.getElementById('char_count').innerHTML);
            if (char_min > 0 && char_min > cnt) {
                alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                return false;
            } 
            else if (char_max > 0 && char_max < cnt) {
                alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                return false;
            }
        }
    }

    if (document.getElementById('tx_wr_content')) {
        if (!ed_wr_content.outputBodyText()) { 
            alert('내용을 입력하십시오.'); 
            ed_wr_content.returnFalse();
            return false;
        }
    }

    var subject = "";
    var content = "";
    $.ajax({
        url: "<?php echo $board_skin_path?>/ajax.filter.php",
        type: "POST",
        data: {
            "subject": f.wr_subject.value,
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

    if (subject) {
        alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
        f.wr_subject.focus();
        return false;
    }

    if (content) {
        alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
        if (typeof(ed_wr_content) != "undefined") 
            ed_wr_content.returnFalse();
        else 
            f.wr_content.focus();
        return false;
    }

    if (!check_kcaptcha(f.wr_key)) {
        return false;
    }

    document.getElementById('btn_submit').disabled = true;
    document.getElementById('btn_list').disabled = true;

    <?php if ($g4[https_url])
        echo "f.action = '{$g4['https_url']}/{$g4['bbs']}/write_update.php';";
    else
        echo "f.action = './write_update.php';";
    ?>
    
    return true;
}

$(function() { 
    $('#wr_key').bind('keyup', function() {
        $('#wr_10').val($(this).val());
    });
});
</script>

<script type="text/javascript" src="<?php echo "{$g4['path']}/js/board.js"?>"></script>
<script type="text/javascript"> window.onload=function() { drawFont(); } </script>
