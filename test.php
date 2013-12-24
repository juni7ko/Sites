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
				<div class="gallery-area">
					<a href="#">
						<img src="<?php echo $g4['path']?>/layout/images/pension_01.jpg" class="image" alt="pension" />
						<div class="gallery_box">
							<div class="ps_info">
								<img src="<?php echo $g4['path']?>/layout/images/ps_profile_img_001.jpg" alt="펜션프로필사진">
								<div class="title">
									<h2>Portfolio2</h2>
									<span>GRAPHIC / Portfolio2</span>
								</div>
	
								<ul class="section1">
									<li class="location">LOCATION</li>
									<li><h3>GANGWON-DO</h3></li>
									<li class="view">CLICK TO</li>
									<li><h3>165</h3></li>
									<li class="comment">COMMENT</li>
									<li><h3>29</h3></li>
								</ul>
								
							</div><!-- ps_info -->
						</div><!-- /gallery_box -->
					</a>
				</div><!-- /gallery-area -->
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

<?php echo latest("big_height_gallery", test, 3, 25); ?>
			
		</div>
	</div>
</div>
<!-- /article -->


<div class="article">
	<div class="container">
		<div class="row">
		
			<div class="span6">
				<div class="gallery-area">
					<a href="#">
						<div class="gallery_info">
							<ul>
								<li class="hit">35</li><!-- 추천수 -->
								<li class="comment">29</li><!-- 코멘트수 -->
								<li class="view">120</li><!-- 조회수 -->
							</ul>
						</div>
						<img src="<?php echo $g4['path']?>/layout/images/pension_03.jpg" class="image" alt="pension" />
					</a>
					<div class="gallery_footer">

						<img src="<?php echo $g4['path']?>/layout/images/ps_profile_img_001.jpg" alt="펜션프로필사진">

						<div class="ps_info">
							<div class="title">
								<h2>인터포펜션</h2>
							</div>
	
							<ul class="section1">
								<li>address : <span>강원도 강릉시 경포동 경포길 1235-51번지</span></li>
								<li>Telephone: <span>033.0000.0000</span></li>
								<li>URL: <span>http://interfo.com</span></li>
							</ul>
							
						</div><!-- ps_info -->

					</div><!-- /gallery_footer -->
				</div><!-- /gallery-area -->
			</div><!-- /span6 -->
		
			<div class="span6">
				<div class="gallery-area">
					<a href="#">
						<div class="gallery_info">
							<ul>
								<li class="hit">35</li><!-- 추천수 -->
								<li class="comment">29</li><!-- 코멘트수 -->
								<li class="view">120</li><!-- 조회수 -->
							</ul>
						</div>
						<img src="<?php echo $g4['path']?>/layout/images/pension_03.jpg" class="image" alt="pension" />
					</a>
					<div class="gallery_footer">

						<img src="<?php echo $g4['path']?>/layout/images/ps_profile_img_001.jpg" alt="펜션프로필사진">

						<div class="ps_info">
							<div class="title">
								<h2>인터포펜션</h2>
							</div>
	
							<ul class="section1">
								<li>address : <span>강원도 강릉시 경포동 경포길 1235-51번지</span></li>
								<li>Telephone: <span>033.0000.0000</span></li>
								<li>URL: <span>http://interfo.com</span></li>
							</ul>
							
						</div><!-- ps_info -->

					</div><!-- /gallery_footer -->
				</div><!-- /gallery-area -->
			</div><!-- /span6 -->
			
		</div>
	</div>
</div>
<!-- /article -->


<div class="article">
	<div class="container">
		<div class="row">
		
			<div class="span6 border">
				<div class="gallery-area">
					<a href="#">
						<img src="<?php echo $g4['path']?>/layout/images/pension_04.jpg" class="image" alt="pension" />
						<div class="gallery_box">
							<div class="ps_info">
								<div class="title">
									<h2>Portfolio2</h2>
									<span>GRAPHIC / Portfolio2</span>
								</div>
	
								<ul class="section1">
									<li class="location">LOCATION</li>
									<li><h3>GANGWON-DO</h3></li>
									<li class="view">CLICK TO</li>
									<li><h3>165</h3></li>
									<li class="comment">COMMENT</li>
									<li><h3>29</h3></li>
								</ul>
								
							</div><!-- ps_info -->
						</div><!-- /gallery_box -->
					</a>
				</div><!-- /gallery-area -->
			</div><!-- /span4 -->
		
			<div class="span6 border">
				<div class="gallery-area">
					<a href="#">
						<img src="<?php echo $g4['path']?>/layout/images/pension_04.jpg" class="image" alt="pension" />
						<div class="gallery_box">
							<div class="ps_info">
								<div class="title">
									<h2>Portfolio2</h2>
									<span>GRAPHIC / Portfolio2</span>
								</div>
	
								<ul class="section1">
									<li class="location">LOCATION</li>
									<li><h3>GANGWON-DO</h3></li>
									<li class="view">CLICK TO</li>
									<li><h3>165</h3></li>
									<li class="comment">COMMENT</li>
									<li><h3>29</h3></li>
								</ul>
								
							</div><!-- ps_info -->
						</div><!-- /gallery_box -->
					</a>
				</div><!-- /gallery-area -->
			</div><!-- /span6 -->
			
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
