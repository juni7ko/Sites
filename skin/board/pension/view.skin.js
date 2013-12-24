function Process() {
	f = document.formLoadReser;
	//alert("공휴일명을 입력해 주세요!!");
	f.action = "./write_reserv.php";
	f.submit();
}
