<?php $g4_path = ".."; // common.php 의 상대 경로
include_once("$g4_path/common.php");

//현재 페이지에서 사용될 스킨명 적음
$skin_dirs = Array();
$skin_dirs[] = 'latest/gp_slider';
$background = "class=bg-ptn1";
include_once("$g4[path]/head.php");
$sub="1"

?>

<script type="text/javascript" src="js/jquery.livequery.js"></script>
<script type="text/javascript" src="js/jquery.livesetting.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.livequery.css" />

<div id="container">
	<div class="content-title">
		<h1>PROLOGUE</h1>
		<span>부대시설보기</span>
	</div>

	<div class="content-area">

	<?php $on3="on"?>
		<?php include("$g4[path]/sub/content_navi.php");?>

	<div>
<!-- 갤러리 -->

		<script type="text/javascript" src="<?php echo $g4['path']?>/skin/latest/gp_slider/js/jquery.slider.js"></script>

		<script type="text/javascript">
		$(document).ready(function(){
			$('#slider1').bxSlider({
				pause: 3500,
				mode: 'fade',
				auto: true,
				autoHover:true,
				autoControls: false,
				autoControlsCombine:true,
				controls:true,
				pagerCustom: '#slider1-pager'
			});
		});
		</script>

		<div class="gp-slider">
			<!-- 원본이미지 -->
			<ul id="slider1">
				<li><img src="http://gyungpopension.cdn2.cafe24.com/outside/1.jpg" alt="" /></li>
				<li><img src="http://gyungpopension.cdn2.cafe24.com/outside/2.jpg" alt="" /></li>
				<li><img src="http://gyungpopension.cdn2.cafe24.com/outside/3.jpg" alt="" /></li>
				<li><img src="http://gyungpopension.cdn2.cafe24.com/outside/4.jpg" alt="" /></li>
				<li><img src="http://gyungpopension.cdn2.cafe24.com/outside/5.jpg" alt="" /></li>
				<li><img src="http://gyungpopension.cdn2.cafe24.com/outside/6.jpg" alt="" /></li>
				<!-- <li><img src="http://gyungpopension.cdn2.cafe24.com/outside/7.jpg" alt="" /></li>
				<li><img src="http://gyungpopension.cdn2.cafe24.com/outside/8.jpg" alt="" /></li>
				<li><img src="http://gyungpopension.cdn2.cafe24.com/outside/9.jpg" alt="" /></li> -->
			</ul>

			<!-- 썸네일이미지 -->
			<ul id="slider1-pager">
				<li><a data-slide-index="0" href=""><img src="http://gyungpopension.cdn2.cafe24.com/outside/1.jpg" width=60 height=40 alt="" /></a></li>
				<li><a data-slide-index="1" href=""><img src="http://gyungpopension.cdn2.cafe24.com/outside/2.jpg" width=60 height=40 alt="" /></a></li>
				<li><a data-slide-index="2" href=""><img src="http://gyungpopension.cdn2.cafe24.com/outside/3.jpg" width=60 height=40 alt="" /></a></li>
				<li><a data-slide-index="3" href=""><img src="http://gyungpopension.cdn2.cafe24.com/outside/4.jpg" width=60 height=40 alt="" /></a></li>
				<li><a data-slide-index="4" href=""><img src="http://gyungpopension.cdn2.cafe24.com/outside/5.jpg" width=60 height=40 alt="" /></a></li>
				<li><a data-slide-index="5" href=""><img src="http://gyungpopension.cdn2.cafe24.com/outside/6.jpg" width=60 height=40 alt="" /></a></li>
				<!-- <li><a data-slide-index="6" href=""><img src="http://gyungpopension.cdn2.cafe24.com/outside/7.jpg" width=60 height=40 alt="" /></a></li>
				<li><a data-slide-index="7" href=""><img src="http://gyungpopension.cdn2.cafe24.com/outside/8.jpg" width=60 height=40 alt="" /></a></li>
				<li><a data-slide-index="8" href=""><img src="http://gyungpopension.cdn2.cafe24.com/outside/9.jpg" width=60 height=40 alt="" /></a></li> -->
			</ul>

<!-- 갤러리 -->
		</div><br/>

		<!--<img src="<?php echo $g4['path']?>/img/sub2_01.png" alt="바베큐" /><br /> -->

		<!-- 내용 -->
		<!-- <ul>
			<li><h2>돈만 들고 와서 바베큐 즐기기</h2></li>
			<li>
				<ol>
					<li>- 취사용품 무료대여 (냄비,버너,취사 집기류)</li>
					<li>- 쌀을 가지고 오시면 밥은 무료로 해드립니다.</li>
					<li>- 바베큐시설 무료</li>
					<li class="highlight-pink">- 바베큐 그릴+숯+번개탄+가위+집게 ==  10,000원(2인기준) / 15,000원(3~4인) / 20,000원(5~6인) </li>
					<li>- 삼겹살 판매 500g == 15,000원</li>
					<li>- 숟가락,젓가락,접시,종이컵,밥그릇,일회용품 시중가로 판매합니다.</li>					
				</ol>
			</li>
		</ul><br/><br/> -->
		<!-- /내용 -->

	</div> <!-- content-area -->
</div><!-- container -->



<?php include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php"); 
?>
