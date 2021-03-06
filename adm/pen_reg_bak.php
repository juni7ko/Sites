<?php if ($board[bo_use_dhtml_editor] && $member[mb_level] >= $board[bo_html_level])
    $is_dhtml_editor = true;
else
    $is_dhtml_editor = true;


if ($is_dhtml_editor) {
    include_once ("../lib/cheditor4.lib.php");
    echo "<script src='../cheditor5/cheditor.js'></script>";
    echo cheditor1('wr_content', '100%', '250');
}



?>



<div class="pen_reg">





<form id="fwrite" name="fwrite" method="post" onsubmit="return fwrite_submit(this);" enctype="multipart/form-data" style="margin:0px;">
<input type=hidden name=null> 
<input type=hidden name=w        value="<?=$w?>">
<input type=hidden name=bo_table value="pension_info">
<input type=hidden name=wr_id    value="<?=$pension_id?>">
<input type=hidden name=sca      value="<?=$sca?>">
<input type=hidden name=sfl      value="<?=$sfl?>">
<input type=hidden name=stx      value="<?=$stx?>">
<input type=hidden name=spt      value="<?=$spt?>">
<input type=hidden name=sst      value="<?=$sst?>">
<input type=hidden name=sod      value="<?=$sod?>">
<input type=hidden name=page     value="<?=$page?>">
<input type=hidden name=wr_name     value="인터포">
<input type=hidden value='html1' name='html'>


<table cellpadding="0" cellspacing="0" class="register">
<?php if($pension_id){?>
	<tr>
		<th>ID</th>
		<td><?=$pension_id?></td>
	</tr>
<?php }else{?>
	<tr>
		<th>ID</th>
		<td><input type="hidden" name="wr_id" readonly> 자동등록됩니다</td>
	</tr>

<?php }?>

	<tr>
		<th>펜션이름</th>
		<td><input type="text" name="wr_subject" value=<?=$write['wr_subject']?>></td>
	</tr>
	<tr>
		<th>대표자이름</th>
		<td><input type="text" name="pre_name" value=<?=$write['pre_name']?>></td>
	</tr>
	<tr>
		<th>사업자등록번호</th>
		<td><input type="text" name="business_num" value=<?=$write['business_num']?>></td>
	</tr>
	<tr>
		<th>통신판매번호</th>
		<td><input type="text" name="sale_number" value=<?=$write['sale_number']?>></td>
	</tr>
	<tr>
		<th>주소</th>
		<td>
			<div>
			<input type="text" name="mb_zip1" maxlength="3" size="3" value=<?=$write['mb_zip1']?>>-<input type="text" name="mb_zip2" maxlength="3" size="3" value=<?=$write['mb_zip2']?>><input type="button" name="serch" value="주소검색" ><br>
			<input type="text" name="mb_addr1" alt="기본주소" value=<?=$write['mb_addr1']?>> <br>
			<input type="text" name="mb_addr2" alt="상세주소" value=<?=$write['mb_addr2']?>>
			</div>
		</td>
	</tr>
	<tr>
		<th>핸드폰</th>
		<td><input type="text" name="wr_phone1" alt="문자 송/수신" value=<?=$write['wr_phone1']?>>  (문자 송/수신 번호입니다) </td>
	</tr>
	<tr>
		<th>전화번호1</th>
		<td><input type="text" name="wr_phone2" value=<?=$write['wr_phone2']?>></td>
	</tr>
	<tr>
		<th>전화번호2</th>
		<td><input type="text" name="wr_phone3" value=<?=$write['wr_phone3']?>></td>
	</tr>
	<tr>
		<th>전화번호3</th>
		<td><input type="text" name="wr_phone4" value=<?=$write['wr_phone4']?>></td>
	</tr>
	<tr>
		<th>전화번호4</th>
		<td><input type="text" name="wr_phone5" value=<?=$write['wr_phone5']?>></td>
	</tr>
	<tr>
		<th>홈페이지주소</th>
		<td><input type="text" name="domain_name" value=<?=$write['domain_name']?>></td>
	</tr>
	<tr>
		<th>거래은행</th>
		<td><input type="text" name="bank_name" value=<?=$write['bank_name']?>></td>
	</tr>
	<tr>
		<th>계좌번호</th>
		<td><input type="text" name="bank_number" value=<?=$write['bank_number']?>></td>
	</tr>
	<tr>
		<th>예금주명</th>
		<td><input type="text" name="bank_username" value=<?=$write['bank_username']?>></td>
	</tr>
	<tr>
		<th>할인률</th>
		<td><input type="text" name="discount" value=<?=$write['discount']?>></td>
	</tr>
	<!-- <tr>
		<th>사진등록</th>
		<td>
			<input type="file" name="local_photo_search" value="찾기"><br>
			<input type="button" name="local_photo_delete" value="삭제"><input type="button" name="local_photo_addform" value="사진추가">
		</td>
	</tr> -->

<tr>
		<th>펜션설명</th>
    <td class='write_head' style='padding:5 0 5 10;'>
        <?php if ($is_dhtml_editor) { ?>
            <?=cheditor2('wr_content', $write['wr_content']);?>
        <?php } else { ?>
        <textarea id="wr_content" name="wr_content" class=tx style='width:100%; word-break:break-all;' rows=10 itemname="내용" required 
        <?php if ($write_min || $write_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?php }?>><?=$write['wr_content']?></textarea>
        <?php if ($write_min || $write_max) { ?><script type="text/javascript"> check_byte('wr_content', 'char_count'); </script><?php }?>
        <?php } ?>
    </td>
</tr>

<tr>

	<th>
		사진등록 
		<span onclick="add_file();" style="cursor:pointer;"><img src="../skin/board/basic/img/btn_file_add.gif"></span> 
		<span onclick="del_file();" style="cursor:pointer;"><img src="../skin/board/basic/img/btn_file_minus.gif"></span>
	</th>

    <td style='padding:5 0 5 0;'><table id="variableFiles" cellpadding=0 cellspacing=0></table><?php
// print_r2($file); ?>
        <script type="text/javascript">
        var flen = 0;
        function add_file(delete_code)
        {
            var upload_count = <?=(int)$board[bo_upload_count]?>;
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

            objCell.innerHTML = "<input type='file' class='ed' name='bf_file[]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'>";
            if (delete_code)
                objCell.innerHTML += delete_code;
            else
            {
                <?php if ($is_file_content) { ?>
                objCell.innerHTML += "<br><input type='text' class='ed' size=50 name='bf_content[]' title='업로드 이미지 파일에 해당 되는 내용을 입력하세요.'>";
                <?php } ?>
                ;
            }

            flen++;
        }

        <?=$file_script; //수정시에 필요한 스크립트?>

        function del_file()
        {
            // file_length 이하로는 필드가 삭제되지 않아야 합니다.
            var file_length = <?=(int)$file_length?>;
            var objTbl = document.getElementById("variableFiles");
            if (objTbl.rows.length - 1 > file_length)
            {
                objTbl.deleteRow(objTbl.rows.length - 1);
                flen--;
            }
        }

		add_file();
        </script>
		
		</td>
</tr>

</table>



<table cellpadding="0" cellspacing="0" class="check-table">
	<caption>서비스 항목 선택(해당되는 사항들을 체크하여주십시오. 다중선택 가능)</caption>
	<tr>
		<th>주변여행지</th>
		<td>
		<input type="checkbox" class="checkbox" name="cf1" value="1" <?php if($write['cf1'] ==1) echo "checked";?>>바다
		<input type="checkbox" class="checkbox" name="cf2" value="1" <?php if($write['cf2'] ==1) echo "checked";?>>계곡
		<input type="checkbox" class="checkbox" name="cf3" value="1" <?php if($write['cf3'] ==1) echo "checked";?>>강/호수
		<input type="checkbox" class="checkbox" name="cf4" value="1" <?php if($write['cf4'] ==1) echo "checked";?>>산
		<input type="checkbox" class="checkbox" name="cf5" value="1" <?php if($write['cf5'] ==1) echo "checked";?>>섬
		</td>
	</tr>
	<tr>
		<th>테마</th>
		<td>
		<input type="checkbox" class="checkbox" name="cf11" value="1" <?php if($write['cf11'] ==1) echo "checked";?>>해수욕장
		<input type="checkbox" class="checkbox" name="cf12" value="1" <?php if($write['cf12'] ==1) echo "checked";?>>레프팅
		<input type="checkbox" class="checkbox" name="cf13" value="1" <?php if($write['cf13'] ==1) echo "checked";?>>MT/워크샵
		<input type="checkbox" class="checkbox" name="cf14" value="1" <?php if($write['cf14'] ==1) echo "checked";?>>갯벌
		<input type="checkbox" class="checkbox" name="cf15" value="1" <?php if($write['cf15'] ==1) echo "checked";?>>스키장주변
		<input type="checkbox" class="checkbox" name="cf16" value="1" <?php if($write['cf16'] ==1) echo "checked";?>>수상레져
		<input type="checkbox" class="checkbox" name="cf17" value="1" <?php if($write['cf17'] ==1) echo "checked";?>>스파
		<input type="checkbox" class="checkbox" name="cf18" value="1" <?php if($write['cf18'] ==1) echo "checked";?>>등산/수목원/휴양림
		<input type="checkbox" class="checkbox" name="cf19" value="1" <?php if($write['cf19'] ==1) echo "checked";?>>낚시
		<input type="checkbox" class="checkbox" name="cf20" value="1" <?php if($write['cf20'] ==1) echo "checked";?>>골프장주변
		<input type="checkbox" class="checkbox" name="cf21" value="1" <?php if($write['cf21'] ==1) echo "checked";?>>커플전용
		<input type="checkbox" class="checkbox" name="cf22" value="1" <?php if($write['cf21'] ==1) echo "checked";?>>전망(바다/강)
		<input type="checkbox" class="checkbox" name="cf23" value="1" <?php if($write['cf23'] ==1) echo "checked";?>>복층구조
		<input type="checkbox" class="checkbox" name="cf24" value="1" <?php if($write['cf24'] ==1) echo "checked";?>>독채
		<input type="checkbox" class="checkbox" name="cf25" value="1" <?php if($write['cf25'] ==1) echo "checked";?>>소규모(10인이상)
		<input type="checkbox" class="checkbox" name="cf26" value="1" <?php if($write['cf26'] ==1) echo "checked";?>>대규모(50인이상)
		</td>
	</tr>
	<tr>
		<th>편의제공시설</th>
		<td>
		<input type="checkbox" class="checkbox" name="cf31" value="1" <?php if($write['cf31'] ==1) echo "checked";?>>매점
		<input type="checkbox" class="checkbox" name="cf32" value="1" <?php if($write['cf32'] ==1) echo "checked";?>>식사가능
		<input type="checkbox" class="checkbox" name="cf33" value="1" <?php if($write['cf33'] ==1) echo "checked";?>>애완견동반
		<input type="checkbox" class="checkbox" name="cf34" value="1" <?php if($write['cf34'] ==1) echo "checked";?>>파티/이벤트
		<input type="checkbox" class="checkbox" name="cf35" value="1" <?php if($write['cf35'] ==1) echo "checked";?>>보드게임
		<input type="checkbox" class="checkbox" name="cf36" value="1" <?php if($write['cf36'] ==1) echo "checked";?>>픽업가능
		<input type="checkbox" class="checkbox" name="cf37" value="1" <?php if($write['cf37'] ==1) echo "checked";?>>인터넷
		<input type="checkbox" class="checkbox" name="cf38" value="1" <?php if($write['cf38'] ==1) echo "checked";?>>영화관람
		<input type="checkbox" class="checkbox" name="cf39" value="1" <?php if($write['cf39'] ==1) echo "checked";?>>카페
		<input type="checkbox" class="checkbox" name="cf40" value="1" <?php if($write['cf40'] ==1) echo "checked";?>>셔틀버스
		</td>
	</tr>
	<tr>
		<th>부대시설</th>
		<td>
		<input type="checkbox" class="checkbox" name="cf51" value="1" <?php if($write['cf51'] ==1) echo "checked";?>>간이축구장
		<input type="checkbox" class="checkbox" name="cf52" value="1" <?php if($write['cf52'] ==1) echo "checked";?>>족구장
		<input type="checkbox" class="checkbox" name="cf53" value="1" <?php if($write['cf53'] ==1) echo "checked";?>>바베큐장
		<input type="checkbox" class="checkbox" name="cf54" value="1" <?php if($write['cf54'] ==1) echo "checked";?>>캠프화이어
		<input type="checkbox" class="checkbox" name="cf55" value="1" <?php if($write['cf55'] ==1) echo "checked";?>>노래방
		<input type="checkbox" class="checkbox" name="cf56" value="1" <?php if($write['cf56'] ==1) echo "checked";?>>수영장
		<input type="checkbox" class="checkbox" name="cf57" value="1" <?php if($write['cf57'] ==1) echo "checked";?>>농구장
		<input type="checkbox" class="checkbox" name="cf58" value="1" <?php if($write['cf58'] ==1) echo "checked";?>>세미나실
		<input type="checkbox" class="checkbox" name="cf59" value="1" <?php if($write['cf59'] ==1) echo "checked";?>>스파
		<input type="checkbox" class="checkbox" name="cf60" value="1" <?php if($write['cf60'] ==1) echo "checked";?>>자전거
		<input type="checkbox" class="checkbox" name="cf61" value="1" <?php if($write['cf61'] ==1) echo "checked";?>>4륜오토바이
		<input type="checkbox" class="checkbox" name="cf62" value="1" <?php if($write['cf61'] ==1) echo "checked";?>>서바이벌
		</td>
	</tr>
	<tr>
		<th>유형</th>
		<td>
		<input type="checkbox" class="checkbox" name="cf71" value="1" <?php if($write['cf71'] ==1) echo "checked";?>>목조형
		<input type="checkbox" class="checkbox" name="cf72" value="1" <?php if($write['cf72'] ==1) echo "checked";?>>통나무형
		<input type="checkbox" class="checkbox" name="cf73" value="1" <?php if($write['cf73'] ==1) echo "checked";?>>황토형
		<input type="checkbox" class="checkbox" name="cf74" value="1" <?php if($write['cf74'] ==1) echo "checked";?>>벽돌형
		</td>
	</tr>
</table>

<div class="register-btn-area">
<a onclick="reset();" class="del">내용 삭제</a>
<!-- <a href="#" onclick="document.fwrite.submit();" class="ok" style="cursor:pointer">펜션 등록</a> -->
<input type=submit  id="btn_submit" value="<?php if($w)  echo '펜션수정'; else echo '펜션 등록' ;?>" class="ok" /> 
<!-- <input type=image id="btn_submit" src="../skin/board/pension/img/btn_write.gif" border=0 class="ok"> -->
</div>


</form>


</div>





<script type="text/javascript">

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



    <?php if ($is_dhtml_editor) echo cheditor3('wr_content');
    ?>


    document.getElementById('btn_submit').disabled = true;


    <?php if ($g4[https_url])
        echo "f.action = '$g4[https_url]/$g4[bbs]/write_update.php';";
    else
        echo "f.action = '../bbs/write_update_pension.php';";
    ?>
    
    return true;
}
</script>

<script type="text/javascript" src="<?="$g4[path]/js/board.js"?>"></script>
<script type="text/javascript"> window.onload=function() { drawFont(); } </script>
