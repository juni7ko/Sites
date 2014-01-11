function Process() {
	f = document.formLoadReser;
	//alert("공휴일명을 입력해 주세요!!");
	f.action = "./write_reserv.php";
	f.submit();
}

function roomFrameGo(i, rId, pId) {
	uri2 = "/reserv/roomView.php?rid="+rId+"&pId="+pId;
	//$(":radio[name='rInfo0']:radio[value="+rId+"]").attr('checked',true);
	$("#roomFrame"+i).attr("src",uri2);
}

function roomFrameGo2(i, rId, pId) {
	uri2 = "/reserv/roomView.php?rid="+rId+"&pId="+pId;
	//this.document.location.href = uri2;
	$("#roomFrame"+i, parent.document).attr('src',uri2);
}

function roomFrame(i, uri) {
	$("#roomFrame"+i).attr("src",uri);
}

function penBoard(rId, pId) {
	uri = "/bbs/board.php?bo_table=pen_"+pId+"_"+rId;
	$("#penBoard").attr("src",uri);
}

function penBoard2(rId, pId) {
	uri = "/reserv/chkBoard.php?rId="+rId+"&pId="+pId;
	$("#penBoard").attr("src",uri);
}

function viewMap(i,j) {
	$("#penMap"+j).hide();
	$("#penMap"+i).show();
}
