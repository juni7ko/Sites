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

		<?php $on1="on"?>
		<?php include("$g4[path]/sub/content_navi.php");?>


		<div class="tour-area">

			<h1>경포 해변과 경포호</h1>

			<div class="t-main-img01">
				<a href="https://tour.gangneung.go.kr/sea/beach_01_01/page/main.jsp?cntCode=beach_01_01"  target="_blank" class="btn-homepage tip" title="홈페이지 바로가기">homepage link</a>
				<a href="#" class="btn-location tip" title="찾아가는 길 지도 확인">location map</a>
			</div>

			<div class="tour-content">
				<p>관동지방의 경치 좋기로 이름난 곳인 경포호는 경포대를 중심으로 호수 주변의 많은 누정과 경포 해수욕장 및 주변의 소나무숲을 통틀어서 가리키는 말이다. 물이 거울같이 맑아 경포호라고 하며, 사람에게 유익함을 준다고 해서 군자호라고도 한다. 경포호는 원래 주변이 12㎞에 달했으나 지금은 4㎞에 불과하다. 호수 한가운데 자리 잡은 바위에는 각종 철새들이 찾아와 노는 곳으로 새바위라고 한다. 해안과 호수주위의 소나무 숲과 벗나무가 어울려 아름다운 경치를 뽐내는 경포호는 해마다 많은 피서객들이 찾는 명소이다. 경포에는 옛날부터 전해오는 ‘경포 8경’이 있는데 녹두정의 해돋이, 죽도의 밝은 달, 강문 바닷가 고기잡이배의 불, 초당의 저녁밥 짓는 연기, 홍장암의 밤비, 시루봉의 저녁 노을, 환선정에서 들려오는 신선들의 피리소리, 한송사의 저녁 종소리를 말한다. 경포8경과 함께 이곳에서의 달구경도 빼놓을 수 없는 경관으로, 흔히 이곳에서는 다섯 개의 달을 볼 수 있다고 하는데, 즉 하늘의 달, 호수의 달, 바다의 달, 술잔의 달, 님 눈동자의 달이다.</p>
			
				<p>경포해변은 모두 삼키기라도 하려는 듯 밀려오는 파도, 넓은 하얀 모래밭과 외부와의 세계를 차단하는 듯 둘러 쳐진 송림병풍은 경포해변 특유의 아름다움입니다. 또한 붉게 타오르는 해돋이와 해 저무는 저녁노을은 우리를 다시 한번 뒤돌아보게 합니다. 경포해변 주변에는 경포대, 오죽헌, 참소리 박물관, 선교장, 난설헌 문학비 등 경포호를 중심으로 볼 만한 곳이 많으며 경포호 주변을 자전거 하이킹 하는 것 또한 하나의 즐거움입니다. 해마다 여름해변축제와 관노가면극, 강릉농악, 사물놀이, 학산오독떼기 등의 전통문예행사, 해변무용제, 홍길동전, 공개방송 등 문화행사가 다채롭게 펼쳐져 피서지의 열기를 달구며 관광객들이 많이 몰려듭니다. 또한 매년 1월 1일 새벽에는 해돋이 잔치가 열려 많은 관광객들이 해를 보며 새해다짐을 하곤합니다. 이 밖에도 바다를 가로지르는 유람선, 혼자만의 추억을 간직하게 되는 마차여행, 싱싱한 생선회, 깨끗한 숙박시설, 편리한 대중교통 등이 경포해변 매력중의 매력입니다.</p>
				
				<ul>
					<li>주소 : 강원도 강릉시 경포일대</li>
					<li>전화번호 : 033.640.4414(종합관광안내소)</li>
					<li>홈페이지 : <a href="https://tour.gangneung.go.kr/sea/beach_01_01/page/main.jsp?cntCode=beach_01_01"  target="_blank">홈페이지 바로가기</a></li>
				</ul>
				
				<div class="tour-thumb">
					<ul>
						<li><a href="images/sub5/t_org1_01.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb1_01.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org1_02.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb1_02.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org1_03.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb1_03.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org1_04.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb1_04.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org1_05.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb1_05.jpg" alt="" /></a></li>
						<li><a href="images/sub5/t_org1_06.jpg" rel="gallery_zoom" class="zoom"><img src="images/sub5/t_thumb1_06.jpg" alt="" /></a></li>
					</ul>
				</div>
				
			</div><!-- /tour-content -->
		</div><!-- /tour-area -->



	</div>
</div><!-- container -->


<?php include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php"); 
?> 
