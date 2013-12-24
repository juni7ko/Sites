<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

//썸네일 기본값 설정
$thumb_w = '110'; //썸네일넓이
$thumb_h = '110';   //썸네일높이

$data_path = $g4['path'] . "/data/file/" . $bo_table;
$thumb_path = $data_path . "/thumb";

if (!is_dir($thumb_path)){
  @mkdir($thumb_path, 0707);
  @chmod($thumb_path, 0707);
}
?>
<!-- 게시판 목록 -->
<div style='width:<?php echo $bo_table_width?>;'>
<script type="text/javascript">
$(function(){
	<?php if($sst=="wr_num, wr_reply"){?>
		$('.hd-board-list-sort .sort_datetime').parent().addClass('active');
	<?php }?>
	<?php if($sst=="wr_datetime"){?>
		$('.hd-board-list-sort .sort_datetime').parent().addClass('active');
	<?php }?>
	<?php if($sst=="wr_hit"){?>
		$('.hd-board-list-sort .sort_hit').parent().addClass('active');
	<?php }?>
	<?php if($sst=="wr_good"){?>
		$('.hd-board-list-sort .sort_good').parent().addClass('active');
	<?php }?>
	<?php if($sst=="wr_nogood"){?>
		$('.hd-board-list-sort .sort_nogood').parent().addClass('active');
	<?php }?>
	$('.hd-board-list-webzine li').hover(
		function(){$(this).addClass('active');},
		function(){$(this).removeClass('active');}
	);
	$('.hd-board-list-webzine .thumb span').mouseover(function(){
		$(this).parent().addClass('active');
	});
	$('.hd-board-list-webzine div.thumb-over').mouseleave(function(){
		$(this).parent().removeClass('active');
	});
	$('.hd-board-list-webzine div.thumb-over').each(function(){
		var n = $(this).find('img').size();
		$(this).css('width', n*113);
	});
});
</script>

<div class="board-head">
	<div class="fRight">
		<?php if ($rss_href) { ?><a href="<?php echo $rss_href?>"><img src='<?php echo $board_skin_path?>/img/btn_rss.gif' alt='RSS' /></a><?php } ?>
		<?php if ($admin_href) { ?><a href="<?php echo $admin_href?>"><img src='<?php echo $board_skin_path?>/img/btn_admin.gif' alt='관리' /></a><?php } ?>
	</div>
</div>
<div class="board-head">
	<div class="fLeft">
		<?php if ($is_checkbox) { ?><input type="checkbox" id="all_chk" class="fLeft iCheckbox" style="margin-right:10px;"/><?php }?>
		<?php if ($is_category) { ?>
		<form id='fcategory' method='get' action='#'>
			<input type="hidden" name="currentId" value="<?php echo $currentId?>" />
			<fieldset>
				<select name='sca' id='board_sca'>
					<option value="">전체</option>
					<?php echo $category_option?>
				</select>
				<noscript><input type='submit' value='이동' /></noscript>
			</fieldset>
		</form>
		<?php } ?>
	</div>
	<div class="fRight">
		<div class="hd-board-list-sort">
			<?php echo subject_sort_link('wr_datetime', $qstr2, 1)?><span class="sort_datetime">신규 등록순</span></a> |
			<?php echo subject_sort_link('wr_hit', $qstr2, 1)?><span class="sort_hit">조회순</span></a>
			<?php if ($is_good) { ?>| <?php echo subject_sort_link('wr_good', $qstr2, 1)?><span class="sort_good">추천</span></a><?php }?>
			<?php if ($is_nogood) { ?>| <?php echo subject_sort_link('wr_nogood', $qstr2, 1)?><span class="sort_nogood">비추천</span></a><?php }?>
		</div>
	</div>
</div>

<form id='fboardlist' method='post' action='<?php echo $g4['bbs_path']; ?>/list_update.php'>
	<input type='hidden' name='bo_table' value='<?php echo $bo_table?>' />
	<input type='hidden' name='sfl'  value='<?php echo $sfl?>' />
	<input type='hidden' name='stx'  value='<?php echo $stx?>' />
	<input type='hidden' name='spt'  value='<?php echo $spt?>' />
	<input type='hidden' name='page' value='<?php echo $page?>' />
	<input type="hidden" name="currentId"     value="<?php echo $currentId?>" />

<ul class="hd-board-list-webzine">
    <?php
    for ($i=0; $i<count($list); $i++) {
        if ($list[$i][is_notice]) { // 공지사항
            $tr_class = " class='notice'"; // 이 클래스는 제목과 기본정보만 나오게 할 때 씀.
		} else {
            $tr_class = "";
            if ($wr_id == $list[$i][wr_id]) {// 현재위치
	            $tr_class = " class='current'";
            }
        }

		$wr_content = preg_replace("/<(.*?)\>/"," ",$list[$i][wr_content]); 
		$wr_content = preg_replace("/&nbsp;/"," ",$wr_content); 
		$wr_content = str_replace("//##", " ", $wr_content); 
		$wr_content = cut_str(get_text($wr_content), 300, '…');

		$content_img_array = "";
		$content_img_array = hd_get_content_img($list[$i][wr_content]);

		$thumb = array();
		$image_file = "";

		$thumb_i = 1; // 리스트에서 이미지 6개이상 출력안되게
		// 파일첨부 이미지 썸네일
		if (is_array($list[$i]['file'])) {
			foreach($list[$i]['file'] as $k => $v){

				if($thumb_i >= 6)
					continue;

				if($list[$i][file][$k][view]){
					$temp_thumb = $thumb_path."/". $v['file']; // 썸네일 경로와 파일명
					$image_file = $data_path . '/' . $v['file']; // 원본 경로와 파일명
					if(!file_exists($thumb_path."/". $v['file'])){
						if(make_thumnail($image_file, $temp_thumb, $thumb_w, $thumb_h))  // 썸네일만 생성
							$thumb[] = $thumb_path."/". $v['file']; // 썸네일이 생성되면 배열에 썸네일 경로를 넣음
					}else{
						$thumb[] = $thumb_path."/". $v['file']; // 썸네일이 생성되면 배열에 썸네일 경로를 넣음
					}
					$thumb_i++;
				}
			}
		}

		// 에디터 이미지 썸네일
		foreach($content_img_array as $k => $v){

			if($thumb_i >= 6)
				continue;

			$Imgfilename = hd_get_imgname($v);
			$temp_thumb = $thumb_path."/". $Imgfilename[1]; // 썸네일 경로와 파일명
			$v = trim($v);
			$image_file = (preg_match("`^(/|http)`i", $v)) ? str_replace(dirname(__FILE__), '', $_SERVER['DOCUMENT_ROOT'] . preg_replace("`https?://[^/]+`i", '', $v)) : $v;

			if(!file_exists($thumb_path."/". $Imgfilename[1])){
				if(make_thumnail($image_file, $temp_thumb, $thumb_w, $thumb_h))  // 썸네일만 생성
					$thumb[] = $thumb_path."/". $Imgfilename[1]; // 썸네일이 생성되면 배열에 썸네일 경로를 넣음
			}else{
				$thumb[] = $thumb_path."/". $Imgfilename[1]; // 썸네일이 생성되면 배열에 썸네일 경로를 넣음
			}

			$thumb_i++;

		}

//		if(!$thumb[0]) $thumb[0] = $board_skin_path."/img/no-image.gif";

	?>
	<li<?php echo $tr_class?>>
		<?php if($thumb[0]) {?>
		<div class="thumb">
			<a href="<?php echo $list[$i]['href'];?>" class="img"><img src="<?php echo $thumb[0];?>" alt="<?php echo $list[$i]['subject'];?>" /></a>
			<?php if(count($thumb) > 1) {?><span><img src="<?php echo $board_skin_path?>/img/icon_thumb-plus.gif" alt="+" /></span><?php } ?>
			<div class="thumb-over">
				<?php foreach($thumb as $k => $v){?>
				<a href="<?php echo $list[$i]['href'];?>"><img src="<?=$v;?>" alt="<?php echo $list[$i]['subject'];?>" /></a>
				<?php }?>
				<span><?=count($thumb);?>개</span>
			</div>
		</div>
		<?php } ?>
		<div class="content">
			<h3>
				<?php if ($is_checkbox) { ?><input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id']?>" class="iCheckbox" /><?php } ?>
				<a href="<?php echo $list[$i]['href'];?>"><?php echo $list[$i]['subject'];?></a>
				<?php if ($list[$i]['comment_cnt'])
						echo " <a href=\"{$list[$i]['comment_href']}\" class=\"comment\">{$list[$i]['comment_cnt']}</a>";
				?>
				<?php
				echo $list[$i]['icon_new']    ? " ".$list[$i]['icon_new']    : "";
				echo $list[$i]['icon_file']   ? " ".$list[$i]['icon_file']   : "";
				echo $list[$i]['icon_link']   ? " ".$list[$i]['icon_link']   : "";
				echo $list[$i]['icon_hot']    ? " ".$list[$i]['icon_hot']    : "";
				echo $list[$i]['icon_secret'] ? " ".$list[$i]['icon_secret'] : "";

				$date = date("y.m.d", strtotime($list[$i]['wr_datetime']));
				?>
			</h3>
			<div class="info">
				<?php
				if ($is_category && $list[$i]['ca_name']) {
					echo "<span class=\"category first\"><a href='{$list[$i]['ca_name_href']}&amp;currentId={$currentId}'>{$list[$i][ca_name]}</a></span> | ";
				}
				?>
				<span class="author"><?php echo $list[$i]['name']?></span> |
				<span class="date"><?php echo $date?></span> |
				<span class="hit">조회 <?php echo $list[$i]['wr_hit']?></span>
				<?php if ($is_good) { ?>| <span class="good">추천 <em><?php echo $list[$i]['wr_good']?></em></span><?php }?>
				<?php if ($is_nogood) { ?>| <span class="nogood">비추천 <?php echo $list[$i]['wr_nogood']?></span><?php }?>
			</div>
			<div class="text">
				<a href="<?php echo $list[$i]['href'];?>"><?php echo $wr_content;?></a>
			</div>
		</div>
	</li>
    <?php } // for()?>
    <?php if (count($list) == 0) { ?>
    <li>게시물이 없습니다.</li>
    <?php } ?>
</ul>


    <?php if($is_checkbox) { ?>
		<div class="hd-board-sw">
			<span>선택한 글들을</span>
			<select name="sw">
				<option value="delete">삭제</option>
				<option value="copy">복사</option>
				<option value="move">이동</option>
			</select>
			<span>합니다.</span>
			<noscript>
				<input type="submit" value="확인" />
			</noscript>
		</div>
	<?php } ?>

    </form>


<div class="paginate">
	<?php if ($prev_part_href) { echo "<a href='$prev_part_href'>이전검색</a>"; } ?>
	<?php echo $write_pages;?>
	<?php if ($next_part_href) { echo "<a href='$next_part_href'>다음검색</a>"; } ?>
</div>




<div class="board-foot">
	<div class="fLeft">
        <form id='fsearch' method='get' action='<?php echo $_SERVER[PHP_SELF]?>' class="board-search-form">
            <input type='hidden' name='bo_table' value='<?php echo $bo_table?>' />
            <input type='hidden' name='sca'      value='<?php echo $sca?>' />
            <input type='hidden' name='sop'      value='<?php echo $sop?>' />
			<input type="hidden" name="currentId" value="<?php echo $currentId?>" />
            <select name='sfl'>
                <option value='wr_subject||wr_content'>제목+내용</option>
                <option value='wr_subject'>제목</option>
                <option value='wr_content'>내용</option>
                <option value='mb_id,1'>회원아이디</option>
                <option value='mb_id,0'>회원아이디(코)</option>
                <option value='wr_name,1'>글쓴이</option>
                <option value='wr_name,0'>글쓴이(코)</option>
            </select>
            <select name='sop'>
                <option value='and'>and</option>
                <option value='or'>or</option>
            </select>
			<input type='text' name='stx' id='stx' size='20' maxlength='20' class='iText' value='<?php echo stripslashes($stx)?>' />
            <input type='image' src='<?php echo $board_skin_path?>/img/btn_search.gif' />
        </form>
	</div>
	<div class="fRight button-set">
		<?php if ($is_checkbox) { ?>
		<a href="javascript:select_sw('delete');">선택삭제</a>
		<a href="javascript:select_sw('copy');">선택복사</a>
		<a href="javascript:select_sw('move');">선택이동</a>
		<?php } ?>
		<a href="<?php echo $write_href?>" class="purple">글쓰기</a>
		<?php if ($list_href) { ?><a href="<?php echo $list_href?>" class="black">목록</a><?php }?>
	</div>
</div>





</div><!-- .board_list -->

<script type="text/javascript">
//<![CDATA[
function select_sw(sw) {
    var frm =$("#fboardlist");
    var opt = frm.find("select[name='sw'] > option[value='" + sw + "']");
    var str = opt.text();
    if(!frm.find("input[name='chk_wr_id[]']:checked").length) {
        alert(str + "할 게시물을 하나 이상 선택하세요.");
    } else {
    switch (sw) {
        case "copy" :
        case "move" :
            var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");
            frm.attr("target", "move");
            // frm.attr("action", "./move.php");
            break;
        case "delete" :
            if (!confirm("선택한 게시물을 정말 " + str + " 하시겠습니까?\n\n한번 " + str + "한 자료는 복구할 수 없습니다"))
                return;
            // frm.attr("action", "./delete_all.php?" + Math.random());
            break;
        default :
            alert("지정되지 않은 작업입니다!");
            return false;
            break;
    }
	opt.attr("selected", "true");
    frm.submit();
	}
}

$(function() {
    $("#board_sca").bind("change", function() {
        document.location.href = "./board.php?bo_table=" + g4_bo_table + "&sca=" + encodeURIComponent(this.value) + "&currentId=" + g4_currentId;
    }).val(g4_sca);

    // 배경색상 변경
    $("#board_list tbody tr")
    .each(function(i) {
        if (i%2==0)
            $(this).css("background", "#ffffff");
        else
            $(this).css("background", "#fcfcfc");
    })
    .bind("mouseover", function() {
        $(this).attr("rel", $(this).css("background"));
        $(this).css("background", "#f1f1f1");
    })
    .bind("mouseout", function() {
        $(this).css("background", $(this).attr("rel"));
    })

    // 체크박스 모두 선택
    $("#all_chk").bind("click", function() {
        var chk = this.checked;
        $("#fboardlist input[name='chk_wr_id[]']").each(function() {
            this.checked = chk;
        });
    });

    $("#fsearch")
    .attr("autocomplete", "off")
    .load(function() {
        if ($(this).find("input[name='stx']").val()) {
            var val_sfl = $.trim($("#fboardlist input[name='sfl']").val());
            var val_sop = $.trim($(this).find("input[type='hidden'][name='sop']").val());
            if (val_sfl)
                $(this).find("select[name=sfl] > option[value='" + val_sfl + "']").attr("selected", "true");
            if (val_sop) {
                $(this).find("input[type='radio'][name='sop'][value='" + val_sop + "']").attr("checked", "checked");
                $(this).find("select[name='sop'] > option[value='" + val_sop + "']").attr("selected", "true");
            }
        }
    })
    .submit(function() {
        var fld_stx= $(this).find("input[name='stx']");
        if (fld_stx.val().length < 2) {
            alert("검색어는 2글자 이상 입력하십시오.");
            fld_stx.select().focus();
            return false;
        }
    })
    .trigger("load");
});
//]]>
</script><!-- 게시판 목록 -->
