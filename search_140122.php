<?php
$area_sql = "SELECT * from ci_area order by area_no desc ";
$nav_sql = sql_query($area_sql);

for($area_count=0; $areaInfo = sql_fetch_array($nav_sql); $area_count++) {
	$navi_area['area_id'][$area_count] = $areaInfo['area_id'];
	$navi_area['area_name'][$area_count] = $areaInfo['area_name'];
}
?>
<script src="<?=$g4[path]?>/js/jquery-ui.min.js"></script>
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/themes/base/jquery-ui.css" rel="stylesheet" />
<style type="text/css">
.ui-datepicker { font:12px dotum; }
.ui-datepicker select.ui-datepicker-month,
.ui-datepicker select.ui-datepicker-year { width: 70px;}
.ui-datepicker-trigger { margin:0 0 -5px 2px; }
</style>
<script src="<?=$g4[path]?>/js/support.labs.js"></script>
<script src="<?=$g4[path]?>/js/jquery.form.js"></script>
<form id="searchZone1" name="searchZone1" method="post" enctype="multipart/form-data" style="margin:0px;">
	<input type=hidden name="bo_table" value="<?=$bo_table?>" />
	<input type=hidden name="sfl" value="area_id" />
	<div id="section" class="sub-search-bar">
		<div class="container">
			<table>
				<caption>스피드검색</caption>
				<tbody>
					<tr>
						<th>
							<h4>지역</h4>
						</th>
						<td>
							<select name="stx" id="stx">
								<option value="all">지역선택</option>
								<?php
								for($i=0; $i < $area_count; $i++) {
									echo "<option value='{$navi_area['area_id'][$i]}'>{$navi_area['area_name'][$i]}</option>";
								}
								?>
							</select>
						</td>

						<th>
							<h4>기간</h4>
						</th>
						<td>
							<select name="period" id="period">
								<option value="">기간선택</option>
								<option value="1">1박2일</option>
								<option value="2">2박3일</option>
								<option value="3">3박4일</option>
								<option value="4">4박5일</option>
							</select>
						</td>

						<th>
							<h4>날짜</h4>
						</th>
						<td>
							<input type="text" name="schDate" id="schDate" value="<?=$schDate?>" size=8 maxlength=8 minlength=8 numeric readonly title="옆의 달력 아이콘을 클릭하여 날짜를 입력하세요." style="width:70px;" />
						</td>

						<th>
							<h4>객실수</h4>
						</th>
						<td>
							<select name="rCnt" id="rCnt">
								<option value="">객실수선택</option>
								<option value="1">1개</option>
								<option value="2">2개</option>
								<option value="3">3개 이상</option>
								<option value="4">4개 이상</option>
								<option value="5">5개 이상</option>
							</select>
						</td>

						<th>
							<h4>화장실</h4>
						</th>
						<td>
							<select name="tCnt" id="tCnt">
								<option value="">화장실수선택</option>
								<option value="1">1개</option>
								<option value="2">2개 이상</option>
								<option value="3">3개 이상</option>
								<option value="4">4개 이상</option>
								<option value="5">5개 이상</option>
							</select>
						</td>

						<td class="tright"><img src="<?=$g4['path']?>/layout/images/speed_search_sub_btn.gif" alt="스피드검색 시작" id="searchBtn1" style="cursor:pointer;" /></td>
					</tr>
				</tfoot>
			</table>
		</div><!-- ./container -->
	</div>
	<!-- ./sub-search-bar -->
</form>

<form id="searchZone2" name="searchZone2" method="post" enctype="multipart/form-data" style="margin:0px;">
	<input type=hidden name="bo_table" value="<?=$bo_table?>" />
	<input type=hidden name="sfl" value="area_id" />
	<div id="section" class="section-powersearch">
		<div class="container">
			<table>
				<tr>
					<th>지역</th>
					<td>
						<label><input type="radio" name="stx" class="stx" value="all" />전지역</label>
						<?php
						for($i=0; $i < $area_count; $i++)
							echo "<label><input type='radio' name='stx' class='stx' value='{$navi_area['area_id'][$i]}' />{$navi_area['area_name'][$i]}</label>";
						?>
					</td>
				</tr>

				<tr class="disnone">
					<th>인기지역</th>
					<td>
						<label><input type="radio" name="location2" value="" />전지역</label>
						<label><input type="radio" name="location2" value="" />경기도</label>
						<label><input type="radio" name="location2" value="" />강원도</label>
						<label><input type="radio" name="location2" value="" />충청도</label>
						<label><input type="radio" name="location2" value="" />경상도</label>
						<label><input type="radio" name="location2" value="" />전라도</label>
						<label><input type="radio" name="location2" value="" />제주도</label>
					</td>
				</tr>

				<tr>
					<th>주변여행지</th>
					<td>
						<label><input type="checkbox" id="condition1" name="cf1" />바다</label>
						<label><input type="checkbox" id="condition1" name="cf2" />계곡</label>
						<label><input type="checkbox" id="condition1" name="cf3" />강/호수</label>
						<label><input type="checkbox" id="condition1" name="cf4" />산</label>
						<label><input type="checkbox" id="condition1" name="cf5" />섬</label>
					</td>
				</tr>

				<tr>
					<th>테마</th>
					<td>
						<div>
							<label><input type="checkbox" id="condition2" name="cf21" />해수욕장</label>
							<label><input type="checkbox" id="condition2" name="cf22" />레프팅</label>
							<label><input type="checkbox" id="condition2" name="cf23" />MT/워크샵</label>
							<label><input type="checkbox" id="condition2" name="cf24" />갯벌</label>
							<label><input type="checkbox" id="condition2" name="cf25" />스키장</label>
							<label><input type="checkbox" id="condition2" name="cf26" />수상레져</label>
							<label><input type="checkbox" id="condition2" name="cf27" />스파</label>
							<label><input type="checkbox" id="condition2" name="cf28" />등산,수목원,휴양림</label>
							<label><input type="checkbox" id="condition2" name="cf29" />낚시</label>
							<label><input type="checkbox" id="condition2" name="cf31" />골프장주변</label>
							<label><input type="checkbox" id="condition2" name="cf32" />커플전용</label>
						</div>
						<div style="margin-top:7px;">
							<label><input type="checkbox" id="condition2" name="cf33" />바다,강이 보이는 전망</label>
							<label><input type="checkbox" id="condition2" name="cf34" />복층구조</label>
							<label><input type="checkbox" id="condition2" name="cf35" />독채</label>
							<label><input type="checkbox" id="condition2" name="cf36" />소규모(10명이상)</label>
							<label><input type="checkbox" id="condition2" name="cf37" />대규모(50명이상)</label>
							<label><input type="checkbox" id="condition2" name="cf38" />계곡주변</label>
						</div>
					</td>
				</tr>

				<tr>
					<th>편의제공</th>
					<td>
						<label><input type="checkbox" id="condition3" name="cf51" />매점</label>
						<label><input type="checkbox" id="condition3" name="cf52" />식사가능</label>
						<label><input type="checkbox" id="condition3" name="cf53" />애완견동반가능</label>
						<label><input type="checkbox" id="condition3" name="cf54" />파티/이벤트제공</label>
						<label><input type="checkbox" id="condition3" name="cf55" />보드게임</label>
						<label><input type="checkbox" id="condition3" name="cf56" />픽업가능</label>
						<label><input type="checkbox" id="condition3" name="cf57" />인터넷</label>
						<label><input type="checkbox" id="condition3" name="cf58" />영화관람</label>
						<label><input type="checkbox" id="condition3" name="cf59" />카페</label>
						<label><input type="checkbox" id="condition3" name="cf60" />셔틀버스</label>
					</td>
				</tr>

				<tr>
					<th>부대시설</th>
					<td>
						<label><input type="checkbox" id="condition4" name="cf71" />간이축구장</label>
						<label><input type="checkbox" id="condition4" name="cf72" />족구장</label>
						<label><input type="checkbox" id="condition4" name="cf73" />바베큐장</label>
						<label><input type="checkbox" id="condition4" name="cf74" />캠프화이어</label>
						<label><input type="checkbox" id="condition4" name="cf75" />노래방</label>
						<label><input type="checkbox" id="condition4" name="cf76" />수영장</label>
						<label><input type="checkbox" id="condition4" name="cf77" />농구장</label>
						<label><input type="checkbox" id="condition4" name="cf78" />세미나실</label>
						<label><input type="checkbox" id="condition4" name="cf79" />스파</label>
						<label><input type="checkbox" id="condition4" name="cf80" />자전거</label>
						<label><input type="checkbox" id="condition4" name="cf81" />4륜오토바이</label>
						<label><input type="checkbox" id="condition4" name="cf82" />서바이벌게임</label>
					</td>
				</tr>

				<tr>
					<th>유형별</th>
					<td>
						<label><input type="checkbox" id="condition5" name="cf91" />목조형</label>
						<label><input type="checkbox" id="condition5" name="cf92" />통나무형</label>
						<label><input type="checkbox" id="condition5" name="cf93" />황토형</label>
						<label><input type="checkbox" id="condition5" name="cf94" />벽돌형</label>
					</td>
				</tr>
			</table>

		</div><!-- ./container -->
	</div><!-- ./section -->

	<div id="section" class="search-value-btn">

		<div class="LineBackground"></div>

		<div class="container">
			<div class="powersearch-btn-area">
				<a id="searchBtn2" style="cursor:pointer;">펜 션 검 색</a>
				<a id="searchBtn3" style="cursor:pointer;">빈 방 검 색</a>
			</div>
		</div>

		<div class="LineBackground"></div>

	</div>

	<div id="section" class="search-list-top">
		<div class="row">
			<div class="container">
				<div class="left disnone">
					검색값 : <span id="searchValue"></span>
				</div>
				<div class="right nowrap">
					<label><input type="radio" name="orderList" class="orderList" value="wr_good" />추천순</label>
					<label><input type="radio" name="orderList" class="orderList" value="lowPrice" />저가순</label>
					<label><input type="radio" name="orderList" class="orderList" value="resCount" />예약순</label>
					<label><input type="radio" name="orderList" class="orderList" value="wr_hit" />조회순</label>
					<label><input type="radio" name="orderList" class="orderList" value="highPrice" />고가순</label>
				</div>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript">
	$(function(){
		$('.orderList').click(function(){
			var sst = $(this).val();
			var sod;
			switch(sst) {
				case "wr_good" :
				sod = "desc";
				break;
				case "lowPrice" :
				sod = "asc";
				break;
				case "resCount" :
				sod = "desc";
				break;
				case "wr_hit" :
				sod = "desc";
				break;
				case "highPrice" :
				sod = "desc";
				break;
				default :
				sod = "asc";
				break;
			}
			//uri = "<?=$_SERVER[PHP_SELF]?>?bo_table=pension_info&sfl=area_id&stx=<?=$stx?>&sop=and&sod="+sod+"&sst="+sst+"&page=<?=$page?>";
			//$(location).attr('href',uri);
			$('#searchZone2').attr('action','<?=$_SERVER[PHP_SELF]?>?sop=and&sod='+sod+'&sst='+sst+'&page=<?=$page?>').submit();
		});

		//$(".orderList[value=<?=$sst?>]").attr('checked',true);
		//$(":radio[name='orderList']:radio[value=<?=$mod?>]").attr('checked',true);
		$(".stx[value='<?=$stx?>']").attr('checked', true); // 지역 자동 체크

		<?php
		if ($_POST) {
			foreach ($_POST as $key => $value) :
				if( (substr($key, 0, 2) == "cf") && ($value == "on") )
					echo "\$(\":input[name='{$key}']\").attr('checked', true);";
				if( ($key == "orderList") )
					echo "\$(\".orderList[value='{$value}']\").attr('checked', true);";
				if( ($key == "stx") )
					echo "\$(\".stx[value='{$value}']\").attr('checked', true);";
			endforeach;
			//echo "$key = $value<br />";
		}
		?>

		$(".orderList[value='<?=$sst?>']").attr('checked', true);
		$("select#stx").val("<?=$stx?>").attr('selected', 'selected');
		$("select#period").val("<?=$period?>").attr('selected', 'selected');
		$("select#rCnt").val("<?=$rCnt?>").attr('selected', 'selected');
		$("select#tCnt").val("<?=$tCnt?>").attr('selected', 'selected');

		$.datepicker.regional['ko'] = {
			closeText: '닫기',
			prevText: '이전달',
			nextText: '다음달',
			currentText: '오늘',
			monthNames: ['1월(JAN)','2월(FEB)','3월(MAR)','4월(APR)','5월(MAY)','6월(JUN)',
			'7월(JUL)','8월(AUG)','9월(SEP)','10월(OCT)','11월(NOV)','12월(DEC)'],
			monthNamesShort: ['1월','2월','3월','4월','5월','6월',
			'7월','8월','9월','10월','11월','12월'],
			dayNames: ['일','월','화','수','목','금','토'],
			dayNamesShort: ['일','월','화','수','목','금','토'],
			dayNamesMin: ['일','월','화','수','목','금','토'],
			weekHeader: 'Wk',
			dateFormat: 'yymmdd',
			firstDay: 0,
			isRTL: false,
			showMonthAfterYear: true,
			yearSuffix: ''
		};
		$.datepicker.setDefaults($.datepicker.regional['ko']);

	    $('#schDate').datepicker({
	        showOn: 'button',
			buttonImage: '<?=$g4[path]?>/img/calendar.gif',
			buttonImageOnly: true,
	        buttonText: "달력",
	        changeMonth: true,
			changeYear: true,
	        showButtonPanel: true,
	        yearRange: 'c-99:c+99',
	        maxDate: '+60d',
	        minDate: '-0d'
	    });

	});

	$('#searchBtn1').click(function(){
		//$('#console').empty().text( $.toSource($('#searchZone1').formSerialize()));
		$('#searchZone1').attr('action','<?=$_SERVER[PHP_SELF]?>').submit();
	});

	$('#searchBtn2').click(function(){
		$('#searchZone2').attr('action','<?=$_SERVER[PHP_SELF]?>').submit();
	});

	$('#searchBtn3').click(function(){
		//$('#searchZone2').resetForm();
		$('#searchZone3').attr('action','<?=$_SERVER[PHP_SELF]?>').submit();
	});
</script>
