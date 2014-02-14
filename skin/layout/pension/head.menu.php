<script type="text/javascript">
function addbookmark_top() {
	var url = "<?=$g4[url]?>";   // URL
	var title = "스테이 스토어(StayStore.co.kr)";           // 사이트 이름
	var browser=navigator.userAgent.toLowerCase();
	// Mozilla, Firefox, Netscape
	if (window.sidebar) {
		window.sidebar.addPanel(title, url,"");
	}
	// IE or chrome
	else if( window.external) {
	// IE
		if (browser.indexOf('chrome')==-1){
			window.external.AddFavorite( url, title);
		} else {
		// chrome
		alert('CTRL+D 또는 Command+D를 눌러 즐겨찾기에 추가해주세요.');
		}
	}
	// Opera - automatically adds to sidebar if rel=sidebar in the tag
	else if(window.opera && window.print) {
		return true;
	}
	// Konqueror
	else if (browser.indexOf('konqueror')!=-1) {
		alert('CTRL+B를 눌러 즐겨찾기에 추가해주세요.');
	}
	// safari
	else if (browser.indexOf('webkit')!=-1){
		alert('CTRL+B 또는 Command+B를 눌러 즐겨찾기에 추가해주세요.');
	} else {
		alert('사용하고 계시는 브라우저에서는 이 버튼으로 즐겨찾기를 추가할 수 없습니다. 수동으로 링크를 추가해주세요.')
	}
}
</script>
	<table class="topTable" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td class="ext1">&nbsp;</td>
			<td class="contents1">
				<a href="/reserv/chkReservForm.php">예약확인</a>
				<span>|</span>
				<a href="/bbs/board.php?bo_table=qna">Q&A</a>
				<span>|</span>
				<a href="/bbs/board.php?bo_table=memqa">일대일상담</a>
				<span>|</span>
				<a href="/bbs/board.php?bo_table=notice">공지사항</a>
			</td>
			<td class="contents2">
				<a href="javascript:addbookmark_top()">즐겨찾기</a>
				<span>|</span>
			<?php if($member['mb_id']) :?>
				<a href="<?=$g4[bbs_path]?>/logout.php">로그아웃</a>
				<span>|</span>
				<a href="<?=$g4[bbs_path]?>/myinfo.php">MyPage</a>
			<?php else :?>
				<a href="<?=$g4[bbs_path]?>/login.php">로그인</a>
				<span>|</span>
				<a href="<?=$g4[bbs_path]?>/register.php">회원가입</a>
			<?php endif;?>
			</td>
			<td class="ext2">&nbsp;</td>
		</tr>
	</table>