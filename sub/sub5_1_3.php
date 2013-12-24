<?php $g4_path = ".."; // common.php 의 상대 경로
include_once("$g4_path/common.php");

//현재 페이지에서 사용될 스킨명 적음
$skin_dirs = Array();
$skin_dirs[] = 'latest/gp_slider';
$background = "class=bg-ptn1";

include_once("$g4[path]/head.php");
$sub="5"
?>

<!-- tooltip javascript -->
<script type="text/javascript" src="<?=$g4[path]?>/js/jquery.tips.js"></script>
<script type="text/javascript">
/* tooltip */
$("document").ready(function (){ 
	$('.tip').tipsy({gravity: 'e',fade: true});
});

$(function(){
	$("a[rel=gallery_zoom]").fancybox({
		'titlePosition' : 'over'
	});
});
</script>
<!-- tooltip javascript -->

<div id="container">
	<div class="content-title">
		<h1>TRAVEL</h1>
		<span>주변관광지</span>
	</div>
	<div class="content-area">

		<?php $on3="on"?>
		<?php include("$g4[path]/sub/content_navi.php");?>


		<div class="tour-area">

			<h1>선교장</h1>

			<div class="t-main-img03">
				<a href="http://www.knsgj.net" target="_blank" class="btn-homepage tip" title="홈페이지 바로가기">homepage link</a>
				<a href="#" class="btn-location tip" title="찾아가는 길 지도 확인">location map</a>
			</div>

			<div class="tour-content">
				<p>효령대군(세종대왕의 형)의 11대손인 가선대부(嘉善大夫) 무경(茂卿) 이내번(李乃蕃)에 의해 처음 지어져 무려 10대에 이르도록 나날이 발전되어 증축 되면서 오늘날에 이르렀다.</p>
			
				<p>99칸의 전형적인 사대부가의 상류주택으로서 1965년 국가지정 중요 민속자료 제 5호로 지정되어 개인소유의 국가 문화재로서 그 명성을 이어오고 있다. 300여년동안 그 원형이 잘 보존된 아름다운 전통가옥으로 주변의 아름다운 자연미를 활달하게 포용하여 조화를 이루고 돈후한 인정미를 지닌 후손들이 지금가지 거주하는 살아숨쉬는 공간이다.</p> 

				<p>따라서 한국의 유형 문화재로서 중요한 위치를 차지하고 있을뿐 아니라 강릉문화를 대표하며 경포 호수권의 중심적인 역할을 담당하고 있기에 전통문화 시범도시인 강릉시의 문화 관광 자원으로서 부각되었다.</p>

				<p>예전에는 경포호수를 가로질러 배로 다리를 만들어 건너 다녔다하여 선교장 이라고 지어진 이름 이지만 그 호수는 논이 되었고 대장원의 뒤 야산에 노송의 숲과 활래정의 연꽃 그리고 멀리보이는 백두대간 사계절 변화의 모습을 바라보는 운치는 한국 제일이라고 하겠다. 2000년을 기해 한국 방송공사에서 20세기 한국 TOP 10을 선정할 때 한국 전통가옥 분야에서 한국최고의 전통가옥으로 선정되었다.</p>
				
				<ul>
					<li>주소 : 210-350 강원도 강릉시 운정동 431번지</li>
					<li>전화번호 : 033.646.3270</li>
					<li>홈페이지 : <a href="http://www.knsgj.net" target="_blank">http://www.knsgj.net</a></li>
					<li>관람시간 : 하절기(3월~10월) = 오전 9시~오후 6시 / 동절기(11월~2월) = 오전 9시~오후 5시</li>
					<li>관람요금 : 성인-개인:3,000원,단체:2,000원 / 청소년-개인:2,000원,단체:1,200원 / 어린이-개인:1,000원,단체:600원</li>
					<li>&nbsp;※ 단체 : 30인 이상부터 적용</li>

				</ul>
				
				<div class="tour-thumb">
					<ul>
						<li><a href="images/sub5/t_org3_01.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb3_01.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org3_02.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb3_02.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org3_03.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb3_03.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org3_04.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb3_04.jpg" alt="" /></a></li>
						<!-- <li><a href="images/sub5/t_org3_05.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb3_05.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org3_06.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb3_06.jpg" alt="" /></a></li> -->
					</ul>
				</div>
				
			</div><!-- /tour-content -->
		</div><!-- /tour-area -->



	</div>
</div><!-- container -->


<?php include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php"); 
?> 
