<html>
<head>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui.min.js"></script>

<style>
.pension-info {width:100%; color:#333; font-size:12px;}
.pension-info table {border-collapse:collapse; width:100%; font-size:12px; color:#333;}
.pension-info table th {font-size:11px; color:#c00; font-weight:bold; text-align:center; border:1px solid #ccc; padding:5px;}
.pension-info table td {font-size:12px; color:#333; text-align:center; border:1px solid #ccc; padding:5px; border-top:none;}
.pension-info table .border-left {border-left:none;}
.pension-info table .border-right {border-right:none;}
.pension-info .infomation {width:96%; margin:20px auto;}
.pension-info .infomation .f-red {font-size:11px; color:#c00; font-weight:bold;}
.pension-info .infomation li {padding:1px 0 2px 0;}
.pension-info .infomation li.ps {padding:0 0 0 15px}
.pension-info .infomation li.info-title {padding:20px 0 5px 0;}

#my_slider { margin:26px 0;}
#my_slider * { outline:none;}
#my_slider .clear_my_slider { clear:both; height:1px; overflow:hidden; float:none !important;}

#my_slider { width:960px; height:450px; position:relative; overflow:hidden;}
#my_slider .info_block_my_slider { width:269px; height:450px; position:absolute; left:0px; top:0px; bottom:0px; z-index:100; background:url(http://1.234.56.91/~bearvill/home/images/bg_info_block.png); overflow:visible; background:#c00;}
#my_slider .inner_block_my_slider { width:960px; height:450px; position:relative; z-index:50;}
#my_slider .inner_block_my_slider div{ position:absolute; left:0px; top:0px; width:960px; height:450px;}
#my_slider .inner_block_my_slider div.active { z-index:10;}
#my_slider .prev_my_slider,
#my_slider .next_my_slider { width: 23px; height:450px; position:absolute; right:-23px; top:0px; bottom:0px; z-index:80; background:url(http://1.234.56.91/~bearvill/home/images/bg_next_prev.png);}
#my_slider .next_my_slider { right:0px;}
#my_slider .prev_my_slider a,
#my_slider .next_my_slider a { display:block; width: 23px; height:450px; text-decoration:none; overflow:hidden;}
#my_slider .prev_my_slider a span,
#my_slider .next_my_slider a span{ display:block; width:23px; height:24px; margin-top:200px; cursor: pointer;}
#my_slider .prev_my_slider a span{ background: #ef4e39 url(http://1.234.56.91/~bearvill/home/images/ad_prev.gif) no-repeat 9px;}
#my_slider .next_my_slider a span{ background: #ef4e39 url(http://1.234.56.91/~bearvill/home/images/ad_next.gif) no-repeat 9px;}
#min_images_my_slider { width:100%; margin:82px 0 0 22px;}
#min_images_my_slider ul { list-style-type:none;}
#min_images_my_slider ul li { list-style-type:none; float:left; margin-right:3px; padding-top:2px;}
#min_images_my_slider ul li a { display:block; width:31px; height:29px; padding-top:2px; border: 2px solid #f2f5f4;
	filter:progid:DXImageTransform.Microsoft.Alpha(opacity=50);
	-moz-opacity: 0.5;
	-khtml-opacity: 0.5;
	opacity: 0.5;
}
#min_images_my_slider ul li a:hover,
#min_images_my_slider ul li a.active {
	filter:progid:DXImageTransform.Microsoft.Alpha(opacity=100);
	-moz-opacity: 1;
	-khtml-opacity: 1;
	opacity: 1;
}
#my_slider .close_see_info_block_my_slider { display:block; width:23px; height:50px; overflow:hidden; position:absolute; z-index:150; top:34px; right:-23px; background:url(http://1.234.56.91/~bearvill/home/images/ad_close.gif) no-repeat left bottom; }
#my_slider .close_see_info_block_my_slider a { display:block; width:23px; height:50px; overflow:hidden;} 
#my_slider .close_see_info_block_my_slider.active { background:url(http://1.234.56.91/~bearvill/home/images/ad_close.gif) no-repeat left top; }


#my_slider #description_my_slider {width:100%; margin-top:21px;}
#my_slider .alt_my_slider { background: #fff; color: #3d3d3d; position:absolute; right:10px; height:14px; padding:2px 2px 1px 2px;}
#my_slider .title_my_slider { background:#99d4e8; color: #fff; font-weight:bold; float:right; margin:25px 10px 0 0; height:14px; padding:2px;}
#my_slider .number_my_slider { margin-top:10px; color:#333333; font: bold 29px/35px 'Droid Sans', sans-serif; clear:both; width:257px; display:block; text-align:left; display:none;}

</style>
</head>

<body>
<div id="container">
	<div class="content-title">
		<h1>PROLOGUE</h1>
		<span>contents sub title</span>
	</div>
	<div class="content-area">




			<script type="text/javascript" src="http://1.234.56.91/~bearvill/home/js/jquery.prettyPhoto.js"></script>
			<script type="text/javascript" src="http://1.234.56.91/~bearvill/home/js/jquery.codestar.1.0.js"></script>
			<script type="text/javascript" src="http://1.234.56.91/~bearvill/home/js/jquery.easing.js"></script>
			<script type="text/javascript" src="http://1.234.56.91/~bearvill/home/js/scroll_script.js"></script>
			<script type="text/javascript">
			jQuery(document).ready( function($){	
				var buttons = { previous:$('#lofslidecontent45 .lof-previous') , next:$('#lofslidecontent45 .lof-next') };
				$obj = $('#lofslidecontent45')
				.lofJSidernews( { interval : 10000,
				easing : 'easeInOutExpo',
				duration : 1200,
				auto : true,
				maxItemDisplay : 10,
				startItem:0,
				navPosition     : 'horizontal', // horizontal, vertical
				navigatorHeight : 15,
				navigatorWidth  : 25,
				buttons : buttons,
				mainWidth:491} );	
			});
			</script>



			<script type="text/javascript" src="http://1.234.56.91/~bearvill/home/js/my_slider.min.js"></script>



			<div id="my_slider">

				<a href="http://1.234.56.91/~bearvill/sub2/images/room1/s_room_photo1_01.jpg">
				<img src="http://1.234.56.91/~bearvill/sub2/images/room1/room_photo1_01.jpg" alt="&lt;a href='..//bbs/board.php?bo_table=booking'&gt;실시간예약 바로가기&lt;a&gt;" title="토끼방 갤러리" seehaa="토끼방" />
				</a>

				<a href="http://1.234.56.91/~bearvill/sub2/images/room1/s_room_photo1_02.jpg">
				<img src="http://1.234.56.91/~bearvill/sub2/images/room1/room_photo1_02.jpg" alt="&lt;a href='..//bbs/board.php?bo_table=booking'&gt;실시간예약 바로가기&lt;a&gt;" title="토끼방 갤러리" seehaa="토끼방" />
				</a>

				<a href="http://1.234.56.91/~bearvill/sub2/images/room1/s_room_photo1_03.jpg">
				<img src="http://1.234.56.91/~bearvill/sub2/images/room1/room_photo1_03.jpg" alt="&lt;a href='..//bbs/board.php?bo_table=booking'&gt;실시간예약 바로가기&lt;a&gt;" title="토끼방 갤러리" seehaa="토끼방" />
				</a> 

				<a href="http://1.234.56.91/~bearvill/sub2/images/room1/s_room_photo1_04.jpg">
				<img src="http://1.234.56.91/~bearvill/sub2/images/room1/room_photo1_04.jpg" alt="&lt;a href='..//bbs/board.php?bo_table=booking'&gt;실시간예약 바로가기&lt;a&gt;" title="토끼방 갤러리" seehaa="토끼방" />
				</a>

				<a href="http://1.234.56.91/~bearvill/sub2/images/room1/s_room_photo1_05.jpg">
				<img src="http://1.234.56.91/~bearvill/sub2/images/room1/room_photo1_05.jpg" alt="&lt;a href='..//bbs/board.php?bo_table=booking'&gt;실시간예약 바로가기&lt;a&gt;" title="토끼방 갤러리" seehaa="토끼방" />
				</a> 

				<a href="http://1.234.56.91/~bearvill/sub2/images/room1/s_room_photo1_06.jpg">
				<img src="http://1.234.56.91/~bearvill/sub2/images/room1/room_photo1_06.jpg" alt="&lt;a href='..//bbs/board.php?bo_table=booking'&gt;실시간예약 바로가기&lt;a&gt;" title="토끼방 갤러리" seehaa="토끼방" />
				</a>

				 <a href="http://1.234.56.91/~bearvill/sub2/images/room1/s_room_photo1_07.jpg">
				<img src="http://1.234.56.91/~bearvill/sub2/images/room1/room_photo1_07.jpg" alt="&lt;a href='..//bbs/board.php?bo_table=booking'&gt;실시간예약 바로가기&lt;a&gt;" title="토끼방 갤러리" seehaa="토끼방" />
				</a>


			</div><!-- my_slider -->







		<div class="pension-info">
			<table>
			<caption>객실안내</caption>
				<thead>
				<tr>
					<th width="70" class="border-left">객실형태</th>
					<th width="45">평수</th>
					<th width="115">수용인원</th>
					<th class="border-right">객실요금(원)</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td class="border-left">침대1/1층</td>
					<td>16평</td>
					<td>기준2명/최대4명</td>
					<td class="border-right">주중:100,000 / <span class="pink">주말:120,000</span> / <span class="blue">성수기:130,000</span></td>
				</tr>
				</tbody>
			</table>

			<div class="infomation">
				<ul>
					<li class="info-title"><img src="images/info_title1.gif" alt="객실집기 및 외부시설" /></li>
					<li>TV,QOOK(쿡),인터넷,침대,침구,화장대,식탁,주방시설 및 주방집기, 전기밥솥,샤워용품 등</li>
					<li>객실별 테라스, 야외데크(바비큐시설) 등</li>
				 
					<li>※ 일부 객실집기품목은 객실유형별로 차이가 날 수 있습니다.</li>
					<li>※ 바비큐그릴+참숯 포함 대(4~6인용):20,000원 / 소(2~4인용):10,000원입니다.</li>
					<li class="f-red ps">(예약시 미리 말씀해 주세요)</li>

					<li class="info-title"><img src="images/info_title2.gif" alt="객실집기 및 외부시설" /></li>
					<li>여름 7월25일~8월15일 / 겨울 12월20일~1월31일</li>
					<li class="f-red">성수기에는 주중에도 주말(금~일, 법정공휴일) 요금 적용</li>

					<li class="info-title"><img src="images/info_title3.gif" alt="객실집기 및 외부시설" /></li>
					<li>금,토요일은 주말요금이 적용됩니다.(일~목요일은 평일요금)</li>

					<li class="info-title"><img src="images/info_title4.gif" alt="객실집기 및 외부시설" /></li>
					<li>법정공휴일 전날과 당일에는 주말요금이 적용 됩니다.</li>
				</ul>
			</div><!-- infomation -->
		</div><!-- room-info -->

</body>
</html>
