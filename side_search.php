				<a href="<?=$g4[bbs_path]?>/board.php?bo_table=pension_info" class="powersearch"><img src="<?=$g4['path']?>/layout/images/power_search_btn.gif" alt="POWER SEARCH" /></a>
				<form id="searchZone1" name="searchZone1" method="post" enctype="multipart/form-data" style="margin:0px;">
					<input type="hidden" name="bo_table" value="pension_info" />
					<input type="hidden" name="sfl" value="area_id" />
					<input type="hidden" name="sType" value="2" />
					<script src="<?=$g4[path]?>/js/jquery-ui.min.js"></script>
					<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/themes/base/jquery-ui.css" rel="stylesheet" />
					<style type="text/css">
					.ui-datepicker { font:12px dotum; }
					.ui-datepicker select.ui-datepicker-month,
					.ui-datepicker select.ui-datepicker-year { width: 70px;}
					.ui-datepicker-trigger { margin:0 0 -5px 2px; }
					</style>
					<?php
					$area_sql = "SELECT * from ci_area order by area_no desc ";
					$nav_sql = sql_query($area_sql);

					for($area_count=0; $areaInfo = sql_fetch_array($nav_sql); $area_count++) {
						$navi_area['area_id'][$area_count] = $areaInfo['area_id'];
						$navi_area['area_name'][$area_count] = $areaInfo['area_name'];
					}
					?>
					<h3>SPEED SEARCH</h3>
					<div class="speed-search-area">
						<table cellpadding="0" cellspacing="0">
						<caption>Speed Search Option</caption>
						<tbody>
						<tr>
							<th><span>날짜</span></th>
							<td>
								<input type="text" name="schDate" id="schDate" value="<?=$schDate?>" size=8 maxlength=8 minlength=8 numeric readonly title="옆의 달력 아이콘을 클릭하여 날짜를 입력하세요." style="width:70px;" />
								<!-- <input type="text" maxlength="8" style="width:100%;" id='searchDate' name='searchDate' /> -->
							</td>
							<td rowspan="5" class="tbl_banner">
								<!-- banner width 140px , height 150px -->
								<img src="<?=$g4['path']?>/layout/images/ex_banner.gif" alt="banner" />
								<!-- ./banner width 140px , height 150px -->
							</td>
						</tr>
						<tr>
							<th><span>지역</span></th>
							<td>
								<select name="stx">
									<option value="all">지역선택</option>
									<?php
									for($i=0; $i < $area_count; $i++) {
										if($navi_area['area_id'][$i] == $stx)
											$chk = " selected";
										else
											$chk = "";
										echo "<option value='{$navi_area['area_id'][$i]}'{$chk}>{$navi_area['area_name'][$i]}</option>";
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<th><span>기간</span></th>
							<td>
								<select name="period">
									<option value="">기간선택</option>
									<option value="1">1박2일</option>
									<option value="2">2박3일</option>
									<option value="3">3박4일</option>
									<option value="4">4박5일</option>
								</select>
							</td>
						</tr>
						<tr>
							<th><span>객실수</span></th>
							<td>
								<select name="rCnt">
									<option value="">객실수선택</option>
									<option value="1">1개</option>
									<option value="2">2개</option>
									<option value="3">3개 이상</option>
									<option value="4">4개 이상</option>
									<option value="5">5개 이상</option>
								</select>
							</td>
						</tr>
						<tr>
							<th><span>화장실</span></th>
							<td>
								<select name="tCnt">
									<option value="">화장실수선택</option>
									<option value="1">1개</option>
									<option value="2">2개 이상</option>
									<option value="3">3개 이상</option>
									<option value="4">4개 이상</option>
									<option value="5">5개 이상</option>
								</select>
							</td>
						</tr>
						</tbody>
						</table>

					</div><!-- ./speed-search-area -->

					<div class="speed-search-btn">
						<a class="btn1" id="searchBtn1">펜션검색</a>
						<a class="btn2" id="searchBtn2">빈방검색</a>
					</div>
				</form>

<script type="text/javascript">
	$(function(){
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
		$('#searchZone1').attr('action','<?=$g4[bbs_path]?>/board.php').submit();
	});
</script>
