<?php
include_once("./_common.php");
$background = "class=bg-ptn1";
include_once("$g4[path]/head.php");
?>
<script type="text/javascript">
function resform_submit(f)
{
	if(!f.wr_name.value) {
		alert("예약자명을 입력해주세요!");
		return false;
	}
	if(!f.wr_3.value) {
		alert("예약번호를 입력해주세요!");
		return false;
	}
	if(!f.wr_password.value) {
		alert("비밀번호를 입력해주세요!");
		return false;
	}

    f.action = "./chkReserv.php";
    f.submit();
}
</script>

<link rel="stylesheet" type="text/css" href="css/reservation.css">

<form name='resform1' method='post' action='javascript:resform_submit(document.resform1)' enctype='multipart/form-data' style='margin:0px;' autocomplete="off">
<input type=hidden name=null>
<input type=hidden name=type value=code />
<input type=hidden name=bo_table value='bbs34'>
<div id="container">
	<div class="content-title">
		<h1>RESERVATION</h1>
		<span>예약확인</span>
	</div>
	<div class="content-area">

		<div class="reservation-area">

			<div class="res-contents">

				<div class="res-comment">
					<ul>
						<li class="title"><h2>예약자명</h2>
							<ol class="list-none">
								<li>예약시 신청하신 예약자 성함을 입력하세요</li>
								<li><input name="wr_name" type="text" class="text" required itemname='예약자명' /></li>
							</ol>
						</li>
					</ul>

					<ul>
						<li class="title"><h2>예약번호</h2>
							<ol class="list-none">
								<li>메일또는 문자메시지로 통보된 예약번호를 입력하세요</li>
								<li><input name="wr_3" type="text" class="text" required itemname='예약번호' /></li>
							</ol>
						</li>
					</ul>

					<ul>
						<li class="title"><h2>비밀번호</h2>
							<ol class="list-none">
								<li>예약시 입력한 비빌번호를 입력하세요</li>
								<li><input name="wr_password" type="password" class="text" required itemname='비밀번호' /></li>
							</ol>
						</li>
					</ul>
				</div><!-- /res-comment -->

			</div><!-- /res-contents -->


			<div class="res-footer">
				<div class="res-footer-btn-area">
					<a href="javascript:resform_submit(document.resform1);" class="res-footer-btn"  accesskey='s'>예약확인</a>
				</div>
			</div>

		</div>

	</div>
</div><!-- container -->
</form>

<?php
include_once("$g4[path]/tail.php");
?>
