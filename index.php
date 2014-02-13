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

$chkLatest = Array();
?>


<!-- SECTION 1 -->
<div id="section" class="section1">
	<div class="row">
		<div class="container">
			<div class="main-slide-gallery">
<?php echo latest2("section1", pension_info, 5, 25, ""); ?>
			</div><!-- ./main-slide-gallery -->

			<div class="main-search-area">
				<?php include_once("$g4[path]/side_search_main.php"); ?>
			</div>
		</div><!-- ./container -->
	</div><!-- ./row -->
</div>
<!-- ./SECTION -->



<!-- SECTION 2 -->
<div id="section" class="section2">
	<div class="row">
		<div class="container">
<?php echo latest2("section2", pension_info, 3, 25, "AND mainPrint = 1"); ?>
		</div><!-- ./container -->
	</div><!-- ./row -->
</div>
<!-- ./SECTION -->




<!-- SECTION 3 -->
<div id="section" class="section3">
	<div class="titles">
		<div class="container">
			<div class="tleft">
				<h3>BIG SALE</h3>
				<span>최고의 할인율!</span>
			</div>
			<div class="title-img"></div>
			<div class="tright">
				<h3>VERY CHEEP</h3>
				<span>진정한 할인가!</span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="container">

			<!-- Left Pension Latest -->
			<div class="cols2">
<?php echo bigSale("hotSale", pension_info, 3, 25, ""); ?>
			</div><!-- ./cols2 -->
			<!-- ./Left Pension Latest -->

			<!-- Right Pension Latest -->
			<div class="cols2">
<?php echo veryCheep("newStay", pension_info, 3, 25, ""); ?>
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
				<a href="http://www.baugil.org" target="_blank"><img src="<?=$g4['path']?>/layout/images/main_banner_01.jpg" alt="banner" /></a><!--  바우길 -->
			</div>

			<div class="cols3">
				<a href="http://www.coffeefestival.net" target="_blank"><img src="<?=$g4['path']?>/layout/images/main_banner_02.jpg" alt="banner" /></a><!-- 커피축제 -->
			</div>

			<div class="cols3 last">
				<a href="http://www.danojefestival.or.kr" target="_blank"><img src="<?=$g4['path']?>/layout/images/main_banner_03.jpg" alt="banner" /></a><!-- 단오제 -->
			</div>
			<!-- width 318px -//- height 108px -->

		</div><!-- ./container -->
	</div><!-- ./row -->
	<div class="banner-bg">
	-------------------------- 구분선 --------------------------
	</div>
</div>
<!-- ./SECTION -->



<!-- SECTION 7 -->
<div id="section" class="section7">
	<div class="titles">
		<div class="container">
			<div class="tleft">
				<h3>HOT</h3>
				<span>내가 제일 잘나가!</span>
			</div>
			<div class="title-img"></div>
			<div class="tright">
				<h3>NEW</h3>
				<span>내가 곧 대세!</span>
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
<?php echo newStay("newStay", pension_info, 3, 25, ""); ?>
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
</div>
<!-- ./SECTION -->

<!-- SECTION 2 -->
<div id="section" class="section5">
	<div class="row">
		<div class="container">
<?php echo latest2("section2", pension_info, 3, 25, "AND mainPrint = 2"); ?>
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

			<div class="quick-link">
				<div class="left">
					<div class="col2"><a href="#"><img src="<?=$g4['path']?>/layout/images/quick_link_01.jpg" alt="펜션입점안내" /></a></div>
					<div class="col2"><a href="#"><img src="<?=$g4['path']?>/layout/images/quick_link_03.jpg" alt="광고및제휴" /></a></div>
					<div class="col2"><a href="<?=$g4['path']?>/login.php?ltype=pa"><img src="<?=$g4['path']?>/layout/images/quick_link_05.jpg" alt="펜션관리하기" /></a></div>

				</div>
				<div class="right">
					<div class="col2"><a href="/bbs/board.php?bo_table=qna"><img src="<?=$g4['path']?>/layout/images/quick_link_02.jpg" alt="질문및답변" /></a></div>
					<div class="col2"><a href="#"><img src="<?=$g4['path']?>/layout/images/quick_link_04.jpg" alt="일대일상담" /></a></div>
					<div class="col2"><a href="#"><img src="<?=$g4['path']?>/layout/images/quick_link_06.jpg" alt="펜션여행후기" /></a></div>

				</div>
			</div>

		</div><!-- ./container -->
	</div><!-- ./row -->
</div>
<!-- ./CS CENTER -->

<?php include_once("./_tail.php");
?>
