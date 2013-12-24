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
$skin_dirs[] = 'latest/showmotel-main-gallery';


$g4['title'] = '';
$headerbg = " class='main-header'";
include_once('./head.index.php');
?>

<!-- 갤러리 시작 -->
<script type="text/javascript" src="./skin/latest/showmotel-main-gallery/js/showmotel.js"></script>
<script type="text/javascript" src="./skin/latest/showmotel-main-gallery/js/supersized.3.2.7.min.js"></script>
<script type="text/javascript" src="./skin/latest/showmotel-main-gallery/js/supersized.shutter.js"></script>

	<!--Thumbnail Navigation-->
	<div id="prevthumb"></div>
	<div id="nextthumb"></div>

	<!--Arrow Navigation-->
	<a id="prevslide" class="load-item"></a>
	<a id="nextslide" class="load-item"></a>

	<div id="thumb-tray" class="load-item">
		<div id="thumb-back"></div>
		<div id="thumb-forward"></div>
	</div>

	<!--Slide captions displayed here-->
	<div id="slidecaption"></div>

	<!--Control Bar-->
	<div id="controls-wrapper" class="load-item">
		<div id="controls">

			<!--Navigation-->
			<ul id="slide-list"></ul>

		</div>
	</div>

	<script type="text/javascript">
	jQuery(function($){

	$.supersized({
		// Functionality
		slideshow:1,						// Slideshow on/off
		autoplay:1,							// Slideshow starts playing automatically
		start_slide:1,						// Start slide (0 is random)
		stop_loop:0,						// Pauses slideshow on last slide
		random:0,							// Randomize slide order (Ignores start slide)
		slide_interval:4500,				// Length between transitions
		transition:1, 						// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
		transition_speed:500,				// Speed of transition
		new_window:0,						// Image links open in new window/tab [0:self, 1:new-window]
		pause_hover:0,						// Pause slideshow on hover
		keyboard_nav:1,						// Keyboard navigation on/off
		performance:1,						// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
		image_protect:1,					// Disables image dragging and right click with Javascript

		// Size & Position
		min_width:0,						// Min width allowed (in pixels)
		min_height:0,						// Min height allowed (in pixels)
		vertical_center:1,					// Vertically center background [0:left / 1:center]
		horizontal_center:1,				// Horizontally center background [0:top /1:center]
		fit_always:0,						// Image will never exceed browser width or height (Ignores min. dimensions)
		fit_portrait:1,						// Portrait images will not exceed browser height
		fit_landscape:0,					// Landscape images will not exceed browser width

		// Components
		slide_links:'blank',				// Individual links for each slide (Options: false, 'num', 'name', 'blank')
		thumb_links:1,						// Individual thumb links for each slide
		thumbnail_navigation:0,				// Thumbnail navigation

		// Slideshow Images

		slides:[
			{
				image : 'http://showmotel.cdn2.cafe24.com/main/1.jpg',
				title : ''
			},

			{
				image : 'http://showmotel.cdn2.cafe24.com/main/2.jpg',
				title : ''
			},
			{
				image : 'http://showmotel.cdn2.cafe24.com/main/3.jpg',
				title : ''
			},
			{
				image : 'http://showmotel.cdn2.cafe24.com/main/4.jpg',
				title : ''
			},
			{
				image : 'http://showmotel.cdn2.cafe24.com/main/5.jpg',
				title : ''
			}

		],

		// Theme Options
		progress_bar:0,			// Timer for each slide
		mouse_scrub:0

		});
	});
	</script>

<!-- /갤러리 종료 -->



<div id="main-footer">
	<div class="main-footer-area">
		<div class="footer-left highlight-pink">입금계좌 : 농협 351-0612-3360-83</span> (이석순)</div>
		<div class="footer-right"><a href="http://www.victoriamotel.net" target="_blank">빅토리아 바로가기</a></div>
		<div class="clearfix">상담전화 : T.033.655.2776 / 033.644.2777 / H.010.4183.1777 </div>
		<div class="footer-left">주소 : 강원도 강릉시 강문동 302-9번지 쇼앤뉴그린</div>
		<!-- <div class="copyright">Copyright (c) 2013 <span class="highlight-blue">쇼앤뉴그린</span> all rights reserved.</div> -->
	 </div>
</div>

	<!-- <?=latest("showmotel-main-gallery", "main_slide", 5, 26);?>


<div id="main-footer">
	<div class="main-footer-area">
		<div class="footer-left">업체명. 쇼앤뉴그린 / T.033.655.2776 / H.010.4183.1777 / 농협 351.0209.6141.33 방상운(쇼앤뉴그린) / 농협 352.0449.1711.13 도길선(빅토리아) </div>
		<div class="footer-left">주소. 강원도 강릉시 강문동 302-9번지 쇼앤뉴그린 / 대표. 방상복</div>
	 </div>
</div>
 -->

<?php
include_once('./tail.sub.php');
?>
