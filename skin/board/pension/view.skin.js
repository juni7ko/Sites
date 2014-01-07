function Process() {
	f = document.formLoadReser;
	//alert("공휴일명을 입력해 주세요!!");
	f.action = "./write_reserv.php";
	f.submit();
}

function roomFrameGo(i, rId, pId) {
	uri2 = "/reserv/roomView.php?rid="+rId+"&pId="+pId;
	//chkid = $(":radio[name='rInfo0']:checked").val();
	//$(":radio[name='rInfo0']:radio[value="+chkid+"]").attr('checked',false);
	//$(":radio[name='rInfo0']").removeAttr("checked");
	//$(":radio[name='rInfo0']").prop("checked",false);
	//$(":radio[name='rInfo0']:checked").removeAttr('checked');
	$(":radio[name='rInfo0']:radio[value="+rId+"]").attr('checked',true);
	$("#roomFrame"+i).attr("src",uri2);
}

function roomFrame(i, uri) {
	$("#roomFrame"+i).attr("src",uri);
}

function penBoard(rId, pId) {
	uri = "/reserv/boardCheck.php?rId="+rId+"&pId="+pId;
	$("#penBoard").attr("src",uri);
}