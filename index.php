<?php
define('_HD_MAIN_', true);
include_once('./_common.php');

$chk_mobile = chkMobile();
if($_GET['from'] == 'mobile'){
    //새션 생성 이유는 모바일기기에서 PC버전 갔을경우 index.php을 다시 접속했을때 모바일로 오지않고 pc버전 유지하기 위해서이다.
    set_session("frommoblie", "1");
}

//모바일페이지로 이동,
if($chk_mobile == true && !$_SESSION['frommoblie']){
    header("location:/{$g4['g4m_path'] }");
}

//현재 페이지에서 사용될 스킨명 적음
$skin_dirs = Array();
$skin_dirs[] = 'latest/gyungpopension-main-gallery';

$g4['title'] = '';
$headerbg = " class='main-header'";
include_once('./head.index.php');
?>


<!-- SECTION 1 -->
<div id="section" class="section1">
	<div class="row">
		<div class="container">
			<div class="main-slide-gallery">
<?php echo latest2("section1", pension_info, 5, 25, "AND mainPrint = 1"); ?>
			</div><!-- ./main-slide-gallery -->

			<div class="main-search-area">
				<a href="#" class="powersearch"><img src="<?=$g4['path']?>/layout/images/power_search_btn.gif" alt="POWER SEARCH" /></a>

				<h3>SPEED SEARCH</h3>
				<div class="speed-search-area">
					<table cellpadding="0" cellspacing="0">
					<caption>Speed Search Option</caption>
					<tbody>
					<tr>
						<th><span>지역</span></th>
						<td>
							<select name="location">
								<option value="지역선택">지역선택</option>
								<option value="강릉/경포대">강릉/경포대</option>
								<option value="강릉/경포대">강릉/경포대</option>
								<option value="강릉/경포대">강릉/경포대</option>
								<option value="강릉/경포대">강릉/경포대</option>
							</select>
						</td>
						<td rowspan="5" class="tbl_banner">
							<!-- banner width 140px , height 150px -->
							<img src="<?=$g4['path']?>/layout/images/ex_banner.gif" alt="banner" />
							<!-- ./banner width 140px , height 150px -->
						</td>
					</tr>
					<tr>
						<th><span>기간</span></th>
						<td>
							<select name="period">
								<option value="기간선택">기간선택</option>
								<option value="1박2일">1박2일</option>
								<option value="2박3일">2박3일</option>
								<option value="3박4일">3박4일</option>
								<option value="4박5일">4박5일</option>
							</select>
						</td>
					</tr>
					<tr>
						<th><span>날짜</span></th>
						<td>
							<input type="text" maxlength="8" style="width:100%;" />
							<!-- 레이어를 이용한 캘런더 표시를 위해 주석처리됨.
							<select name="year">
								<option value="년도선택">년도선택</option>
								<option value="2013년">2013년</option>
								<option value="2014년">2014년</option>
							</select>

							<select name="month">
								<option value="월선택">월선택</option>
								<option value="01월">01월</option>
								<option value="02월">02월</option>
								<option value="03월">03월</option>
								<option value="04월">04월</option>
								<option value="05월">05월</option>
								<option value="06월">06월</option>
								<option value="07월">07월</option>
								<option value="08월">08월</option>
								<option value="09월">09월</option>
								<option value="10월">10월</option>
								<option value="11월">11월</option>
								<option value="12월">12월</option>
							</select>

							<select name="day">
								<option value="일선택">일선택</option>
								<option value="01일">01일</option>
								<option value="02일">02일</option>
								<option value="03일">03일</option>
								<option value="04일">04일</option>
								<option value="05일">05일</option>
								<option value="06일">06일</option>
								<option value="07일">07일</option>
								<option value="08일">08일</option>
								<option value="09일">09일</option>
								<option value="10일">10일</option>
								<option value="11일">11일</option>
								<option value="12일">12일</option>
								<option value="13일">13일</option>
								<option value="14일">14일</option>
								<option value="15일">15일</option>
								<option value="16일">16일</option>
								<option value="17일">17일</option>
								<option value="18일">18일</option>
								<option value="19일">19일</option>
								<option value="20일">20일</option>
								<option value="21일">21일</option>
								<option value="22일">22일</option>
								<option value="23일">23일</option>
								<option value="24일">24일</option>
								<option value="25일">25일</option>
								<option value="26일">26일</option>
								<option value="27일">27일</option>
								<option value="28일">28일</option>
								<option value="29일">29일</option>
								<option value="30일">30일</option>
								<option value="31일">31일</option>
							</select>

							<input type="image" src="<?=$g4['path']?>/layout/images/speed_search_calendar.gif" width="17" />
							./레이어를 이용한 캘런더 표시를 위해 주석처리됨. -->
						</td>
					</tr>
					<tr>
						<th><span>객실수</span></th>
						<td>
							<select name="location">
								<option value="객실수선택">객실수선택</option>
								<option value="객실수무관">객실수무관</option>
								<option value="1개">1개</option>
								<option value="2개">2개</option>
								<option value="3개">3개</option>
							</select>
						</td>
					</tr>
					<tr>
						<th><span>화장실</span></th>
						<td>
							<select name="location">
								<option value="화장실수선택">화장실수선택</option>
								<option value="화장실수무관">화장실수무관</option>
								<option value="1개">1개</option>
								<option value="2개">2개</option>
								<option value="3개">3개</option>
							</select>
						</td>
					</tr>
					</tbody>
					</table>

					<img src="<?=$g4['path']?>/layout/images/speed_search_btn.gif" alt="스피드검색 시작" />

				</div>
			</div>
		</div><!-- ./container -->
	</div><!-- ./row -->
</div>
<!-- ./SECTION -->



<!-- SECTION 2 -->
<div id="section" class="section2">
	<div class="row">
		<div class="container">
<?php echo latest2("section2", pension_info, 3, 25, "AND mainPrint = 2"); ?>
		</div><!-- ./container -->
	</div><!-- ./row -->
</div>
<!-- ./SECTION -->




<!-- SECTION 3 -->
<div id="section" class="section3">
	<div class="titles">
		<div class="container">
			<div class="tleft">
				<h3>HOT SALE</h3>
				<span>이런게 바로 에누리다!</span>
			</div>
			<div class="title-img"></div>
			<div class="tright">
				<h3>NEW STAY</h3>
				<span>내가 곧 대세 스테이!</span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="container">

			<!-- Left Pension Latest -->
			<div class="cols2">
<?php echo hotSale("hotSale", pension_info, 3, 25, ""); ?>
			</div><!-- ./cols2 -->
			<!-- ./Left Pension Latest -->

			<!-- Right Pension Latest -->
			<div class="cols2">
<?php echo newStay("newStay", pension_info, 3, 25); ?>
			</div><!-- ./cols2 -->
			<!-- ./Right Pension Latest -->

		</div><!-- ./container -->
	</div><!-- ./row -->
</div>
<!-- ./SECTION -->



<!-- SECTION 4 -->
<div id="section" class="section4">
	<div class="banner-bg">
	-------------------------- 구분선 --------------------------
	</div>
	<div class="row">
		<div class="container">

			<!-- width 318px -//- height 108px -->
			<div class="cols3">
				<img src="<?=$g4['path']?>/layout/images/main_banner.jpg" alt="banner" />
			</div>

			<div class="cols3">
				<img src="<?=$g4['path']?>/layout/images/main_banner.jpg" alt="banner" />
			</div>

			<div class="cols3 last">
				<img src="<?=$g4['path']?>/layout/images/main_banner.jpg" alt="banner" />
			</div>
			<!-- width 318px -//- height 108px -->

		</div><!-- ./container -->
	</div><!-- ./row -->
	<div class="banner-bg">
	-------------------------- 구분선 --------------------------
	</div>
</div>
<!-- ./SECTION -->



<!-- SECTION 2 -->
<div id="section" class="section5">
	<div class="row">
		<div class="container">
<?php echo latest2("section2", pension_info, 3, 25, "AND mainPrint = 3"); ?>
		</div><!-- ./container -->
	</div><!-- ./row -->
</div>
<!-- ./SECTION -->



<!-- SECTION 6 -->
<div id="section" class="section6">
	<div class="row">
		<div class="container">

			<!-- Left Pension Latest -->
			<div class="cols2">
<?php echo latest2("section3", pension_info, 3, 25, "AND mainPrint = 4"); ?>
			</div><!-- ./cols2 -->
			<!-- ./Left Pension Latest -->

			<!-- Right Pension Latest -->
			<div class="cols2">
<?php echo latest2("section3", pension_info, 3, 25, "AND mainPrint = 5"); ?>
			</div><!-- ./cols2 -->
			<!-- ./Right Pension Latest -->

		</div><!-- ./container -->
	</div><!-- ./row -->
</div>
<!-- ./SECTION -->



<!-- CS CENTER -->
<div id="section" class="customer">
	<div class="titles">
		<img src="<?=$g4['path']?>/layout/images/customer_title.gif" alt="" />
	</div>
	<div class="row">
		<div class="container">

			<div class="latest">
				<div>
					<h3><a href="/bbs/board.php?bo_table=notice"><img src="<?=$g4['path']?>/layout/images/latest_title1.gif" alt="공지사항" /></a></h3>
					<div class="contents">
						<ul>
							<?=latest("li",notice,4,50);?>
						</ul>
					</div>
				</div>
				<div>
					<h3><a href="/bbs/board.php?bo_table=qna"><img src="<?=$g4['path']?>/layout/images/latest_title2.gif" alt="질문하기" /></a></h3>
					<div class="contents">
						<ul>
							<?=latest("li",qna,4,50);?>
						</ul>
					</div>
				</div>
			</div>

			<div class="cs-info">
				<img src="<?=$g4['path']?>/layout/images/customer.gif" alt="customer" />
			</div>

			<div class="bank-info">
				<h3><img src="<?=$g4['path']?>/layout/images/online_bank_title.gif" alt="공지사항" /></h3>
			</div>

		</div><!-- ./container -->
	</div><!-- ./row -->
</div>
<!-- ./CS CENTER -->



<?php include_once("./_tail.php");
?>
