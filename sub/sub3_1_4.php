<?php $g4_path = ".."; // common.php 의 상대 경로
include_once("$g4_path/common.php");

//현재 페이지에서 사용될 스킨명 적음
$skin_dirs = Array();
$skin_dirs[] = 'latest/gp_slider';
$background = "class=bg-ptn1";

include_once("$g4[path]/head.php");
$sub="3";
$sca = "해향(201)";
$bo_table = 'bbs34';
$write_table = 'g4_write_bbs34';
include_once ("config_func.php");
?>

<div id="container">
	<div class="content-title">
		<h1>PREVIEW</h1>
		<span>객실미리보기</span>
	</div>
	<div class="content-area">

		<?php $on4="on"?>
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
				<li><img src="http://gyungpopension.cdn2.cafe24.com/room4/1.jpg" alt="" /></li>
				<li><img src="http://gyungpopension.cdn2.cafe24.com/room4/2.jpg" alt="" /></li>
				<li><img src="http://gyungpopension.cdn2.cafe24.com/room4/3.jpg" alt="" /></li>
				<li><img src="http://gyungpopension.cdn2.cafe24.com/room4/4.jpg" alt="" /></li>
				<li><img src="http://gyungpopension.cdn2.cafe24.com/room4/5.jpg" alt="" /></li>
				<li><img src="http://gyungpopension.cdn2.cafe24.com/room4/6.jpg" alt="" /></li>
			</ul>

			<!-- 썸네일이미지 -->
			<ul id="slider1-pager">
				<li><a data-slide-index="0" href=""><img src="http://gyungpopension.cdn2.cafe24.com/room4/1.jpg" width=60 height=40 alt="" /></a></li>
				<li><a data-slide-index="1" href=""><img src="http://gyungpopension.cdn2.cafe24.com/room4/2.jpg" width=60 height=40 alt="" /></a></li>
				<li><a data-slide-index="2" href=""><img src="http://gyungpopension.cdn2.cafe24.com/room4/3.jpg" width=60 height=40 alt="" /></a></li>
				<li><a data-slide-index="3" href=""><img src="http://gyungpopension.cdn2.cafe24.com/room4/4.jpg" width=60 height=40 alt="" /></a></li>
				<li><a data-slide-index="4" href=""><img src="http://gyungpopension.cdn2.cafe24.com/room4/5.jpg" width=60 height=40 alt="" /></a></li>
				<li><a data-slide-index="5" href=""><img src="http://gyungpopension.cdn2.cafe24.com/room4/6.jpg" width=60 height=40 alt="" /></a></li>
			</ul>

<!-- 갤러리 -->
		</div>


<div class="pension-info">

		<table>
		<caption>객실안내</caption>
			<thead>
			<tr>
				<th width="120" class="border-left">객실명</th>
				<th width="80">평수</th>
				<th width="140">기준인원</th>
				<th width="110">최대인원</th>
				<th width="110">추가가능인원</th>
				<th width="110"  class="border-right">추가요금</th>		
			</tr>
			</thead>

			<tbody>
			<tr>
				<td  class="border-left"><?=Get_Room_Info_One($bo_table, $sca, 'name')?></td>
				<td  class="border-left"><?=Get_Room_Info_One($bo_table, $sca, 'area')?></td>
				<td  class="border-left"><?=number_format(Get_Room_Info_One($bo_table, $sca, 'person1'))?>명 </td>
				<td class="border-right"><?=number_format(Get_Room_Info_One($bo_table, $sca, 'person2'))?>명</td>
				<td class="border-right"><?=number_format(Get_Room_Info_One($bo_table, $sca, 'person3'))?>명</td>
				<td class="border-right"><?=number_format(Get_Room_Info_One($bo_table, $sca, 'person_add'))?></td>
			</tr>
			</tbody>
		</table>

			<div class="infomation">
				<ul>
					<li class="info-title"><h2>⊙ 유의사항</h2></li>
					<li>※ 주말은 금·토요일·공휴일 전일입니다.</li>
					<li>기준인원과 최대인원은 반드시 지켜주세요.</li>
					<li>기준인원 초과시 <span class="highlight-pink">1인당 10,000원</span>이 추가됩니다.</li>
					<li>최대인원 초과시 <span class="highlight-pink">현장에서 입실이 거부</span>될 수 있으며 <span class="highlight-pink">예약금은 환불되지 않습니다.</span></li>
					<li>퇴실시 객실정리정돈 해주십시요.</li>
					<li></li>
				 
					<li class="f-red ps">※ 객실인테리어는 벽지나 바닥재의 차이로 사진과 조금씩 상이할 수 있습니다.</li>
					<li class="f-red ps">※ 주중 : 월~목, 일요일  /  주말 : 금요일, 토요일, 공휴일 전일</li>
					
				</ul>
			</div><!-- infomation -->
		</div><!-- room-info -->

	</div>
</div><!-- container -->


<?php include("table_inc.php");?>

<?php
//include("$g4[path]/sub/sub_footer.php");?>

<?php include_once("../tail.php"); 
?> 
