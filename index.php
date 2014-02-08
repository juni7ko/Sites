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
<?php echo latest2("section2", pension_info, 3, 25, "AND mainPrint = 2"); ?>
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
<?php echo latest2("section3", pension_info, 3, 25, "AND mainPrint = 3"); ?>
			</div><!-- ./cols2 -->
			<!-- ./Left Pension Latest -->

			<!-- Right Pension Latest -->
			<div class="cols2">
<?php echo latest2("section3", pension_info, 3, 25, "AND mainPrint = 4"); ?>
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
