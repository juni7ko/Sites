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


<div class="article">
	<div class="container">
		<div class="row clearfix">
			<div class="sec1">

<?php echo latest("big_gallery", pension_info, 1, 25); ?>

			</div><!-- /sec1 -->

			<div class="notice-area">
				<div class="search-form">
					<input type="text" />
					<input type="submit" value=" " />
				</div>
				<a href="#" class="power-search">Power Search</a>
				<div class="line-bar"></div>
				<div class="download">
					<p>펜셜할인 모바일앱 다운로드</p>
					<ul class="clearfix">
						<li><a href="#" class="android">안드로이드</a></li>
						<li><a href="#" class="ios">APPLE IOS</a></li>
					</ul>
				</div>
				<div class="line-bar"></div>
				<div class="notice">
					<ul>
						<li><a href="#">[안내] 가격비교 서비스 내 사용자리뷰 ...</a></li>
						<li><a href="#">[안내] 펜션할인사이트 개편</a></li>
						<li><a href="#">[안내] 펜션할인사이트 모바일앱 오픈 안...</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /article -->


<div class="article">
	<div class="container">
		<div class="row">

<?php echo latest("big_height_gallery", pension_info, 3, 25); ?>

		</div><!-- /row -->
	</div><!-- /container -->
</div>
<!-- /article -->


<div class="article">
	<div class="container">
		<div class="row">

<?php echo latest("big_detail_gallery", pension_info, 2, 25); ?>

		</div>
	</div>
</div>
<!-- /article -->


<div class="article">
	<div class="container">
		<div class="row">

<?php echo latest("big_gallery_3", pension_info, 2, 25); ?>

		</div>
	</div>
</div>
<!-- /article -->


<div class="article">
	<div class="container">
		<div class="row">

			<div class="span5 border">
				<div class="gallery-area">
					<a href="#">
						<img src="<?php echo $g4['path']?>/layout/images/pension_05.jpg" class="image" alt="pension" />
						<div class="gallery_box">
							<div class="ps_info">
								<img src="<?php echo $g4['path']?>/layout/images/ps_profile_img_001.jpg" alt="펜션프로필사진">
								<div class="title">
									<h2>Portfolio2</h2>
									<span>GRAPHIC / Portfolio2</span>
								</div>

							</div><!-- ps_info -->
						</div><!-- /gallery_box -->
					</a>
				</div><!-- /gallery-area -->
			</div><!-- /span4 -->

			<div class="span3 border">
				<div class="gallery-area">
					<a href="#">
						<img src="<?php echo $g4['path']?>/layout/images/pension_051.jpg" class="image" alt="pension" />
						<div class="gallery_box">
							<div class="ps_info">
								<img src="<?php echo $g4['path']?>/layout/images/ps_profile_img_001.jpg" alt="펜션프로필사진">
								<div class="title">
									<h2>Portfolio2</h2>
									<span>GRAPHIC / Portfolio2</span>
								</div>

							</div><!-- ps_info -->
						</div><!-- /gallery_box -->
					</a>
				</div><!-- /gallery-area -->
			</div><!-- /span3 -->

			<div class="span3">
				<div class="gallery-area  border mb10">
					<a href="#">
						<img src="<?php echo $g4['path']?>/layout/images/pension_052.jpg" class="image" alt="pension" />
						<div class="gallery_box">
							<div class="ps_info">
								<div class="title">
									<h2>Portfolio2</h2>
									<span>GRAPHIC / Portfolio2</span>
								</div>

							</div><!-- ps_info -->
						</div><!-- /gallery_box -->

					</a>

				</div><!-- /gallery-area -->

				<div class="gallery-area  border">
					<a href="#">
						<img src="<?php echo $g4['path']?>/layout/images/pension_052.jpg" class="image" alt="pension" />
						<div class="gallery_box">
							<div class="ps_info">
								<div class="title">
									<h2>Portfolio2</h2>
									<span>GRAPHIC / Portfolio2</span>
								</div>

							</div><!-- ps_info -->
						</div><!-- /gallery_box -->

					</a>

				</div><!-- /gallery-area -->
			</div><!-- /span3 -->

			<div class="span3 border">
				<div class="gallery-area">
					<a href="#">
						<img src="<?php echo $g4['path']?>/layout/images/pension_051.jpg" class="image" alt="pension" />
						<div class="gallery_box">
							<div class="ps_info">
								<img src="<?php echo $g4['path']?>/layout/images/ps_profile_img_001.jpg" alt="펜션프로필사진">
								<div class="title">
									<h2>Portfolio2</h2>
									<span>GRAPHIC / Portfolio2</span>
								</div>

							</div><!-- ps_info -->
						</div><!-- /gallery_box -->
					</a>
				</div><!-- /gallery-area -->
			</div><!-- /span3 -->

		</div>
	</div>
</div>
<!-- /article -->


<div class="article">
	<div class="container">
		<div class="row">

			<div class="span12 home-info">
				고객센터, 영업시간, 제휴업체 가맹안내 질문답변 예약안내 업소관리 광고문의
			</div><!-- /span12-->

		</div>
	</div>
</div>
<!-- /article -->




<?php include_once("./_tail.php");
?>
