<?php
$g4_path = ".."; // common.php 의 상대 경로
include_once("$g4_path/common.php");
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

<form name='resform1' method='post' action='javascript:resform_submit(document.resform1)' enctype='multipart/form-data' style='margin:0px;'>
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
			<div class="res-header">
				<div class="today">오늘 : 2013년 5월 28일 (화요일)</div>
				<div class="res-btn-area">
					<ul>
						<li><a href="<?=$g4['path']?>/reserv/chkReservForm.php">예약확인</a></li>
						<li><a href="<?=$g4['path']?>/sub/reservation1_5.php">예약수정</a></li>
						<li><a href="<?=$g4['path']?>/sub/reservation1_6.php">예약취소</a></li>
					</ul>
				</div>
				<div class="res-select">
					<select name="year">
						<option value="2012" >2012년</option>
						<option value="2013" selected>2013년</option>
						<option value="2014" >2014년</option>
					</select>년
					<select name="month">
						<option value="1" >1</option>
						<option value="2" >2</option>
						<option value="3" >3</option>
						<option value="4" >4</option>
						<option value="5" selected>5</option>
						<option value="6" >6</option>
						<option value="7" >7</option>
						<option value="8" >8</option>
						<option value="9" >9</option>
						<option value="10" >10</option>
						<option value="11" >11</option>
						<option value="12" >12</option>
					</select>월
					<select name="day">
						<option value="1" >1</option>
						<option value="2" >2</option>
						<option value="3" >3</option>
						<option value="4" >4</option>
						<option value="5" >5</option>
						<option value="6" >6</option>
						<option value="7" >7</option>
						<option value="8" >8</option>
						<option value="9" >9</option>
						<option value="10" >10</option>
						<option value="11" >11</option>
						<option value="12" >12</option>
						<option value="13" >13</option>
						<option value="14" >14</option>
						<option value="15" >15</option>
						<option value="16" >16</option>
						<option value="17" >17</option>
						<option value="18" >18</option>
						<option value="19" >19</option>
						<option value="20" >20</option>
						<option value="21" >21</option>
						<option value="22" >22</option>
						<option value="23" >23</option>
						<option value="24" >24</option>
						<option value="25" >25</option>
						<option value="26" >26</option>
						<option value="27" >27</option>
						<option value="28" >28</option>
						<option value="29" >29</option>
						<option value="30" selected>30</option>
						<option value="31" >31</option>
					</select>
					일 ~
					<select name="stay">
						<option value="1">1박2일</option>
						<option value="2">2박3일</option>
						<option value="3">3박4일</option>
						<option value="4">4박5일</option>
						<option value="5">5박6일</option>
						<option value="6">6박7일</option>
						<option value="7">7박8일</option>
						<option value="8">8박9일</option>
						<option value="9">9박10일</option>
						<option value="10">10박11일</option>
						<option value="11">11박12일</option>
						<option value="12">12박13일</option>
						<option value="13">13박14일</option>
						<option value="14">14박15일</option>
						<option value="15">15박16일</option>
						<option value="16">16박17일</option>
						<option value="17">17박18일</option>
						<option value="18">18박19일</option>
						<option value="19">19박20일</option>
						<option value="20">20박21일</option>
					</select>

				</div>
			</div>

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
								<li><input name="wr_3" type="text" class="text" required itemname='예약코드' /></li>
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

<?php include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php");
?>
