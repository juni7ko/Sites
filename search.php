<?php
$area_sql = "SELECT * from ci_area order by area_no desc ";
$nav_sql = sql_query($area_sql);

for($area_count=0; $areaInfo = sql_fetch_array($nav_sql); $area_count++) {
	$navi_area['area_id'][$area_count] = $areaInfo['area_id'];
	$navi_area['area_name'][$area_count] = $areaInfo['area_name'];
}
?>
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
						<select name="location">
							<option value="">지역선택</option>
							<?php
							for($i=0; $i < $area_count; $i++)
								echo "<option value='{$navi_area['area_id'][$i]}'>{$navi_area['area_name'][$i]}</option>";
							?>
						</select>
					</td>

					<th>
						<h4>기간</h4>
					</th>
					<td>
						<select name="period">
							<option value="기간선택">기간선택</option>
							<option value="1박2일">1박2일</option>
							<option value="2박3일">2박3일</option>
							<option value="3박4일">3박4일</option>
							<option value="4박5일">4박5일</option>
						</select>
					</td>

					<th>
						<h4>날짜</h4>
					</th>
					<td>
						<input type="text" maxlength="8" />
					</td>

					<th>
						<h4>객실수</h4>
					</th>
					<td>
						<select name="location">
							<option value="객실수선택">객실수선택</option>
							<option value="객실수무관">객실수무관</option>
							<option value="1개">1개</option>
							<option value="2개">2개</option>
							<option value="3개">3개</option>
						</select>
					</td>

					<th>
						<h4>화장실</h4>
					</th>
					<td>
						<select name="location">
							<option value="화장실수선택">화장실수선택</option>
							<option value="화장실수무관">화장실수무관</option>
							<option value="1개">1개</option>
							<option value="2개">2개</option>
							<option value="3개">3개</option>
						</select>
					</td>

					<td class="tright"><img src="<?=$g4['path']?>/layout/images/speed_search_sub_btn.gif" alt="스피드검색 시작" /></td>
				</tr>
			</tfoot>
		</table>
	</div><!-- ./container -->
</div>
<!-- ./sub-search-bar -->

<form name="searchZone2" method="post" action="javascript:resform_submit(document.resform1)" enctype="multipart/form-data" style="margin:0px;">
	<div id="section" class="section-powersearch">
		<div class="container">
			<table>
				<tr>
					<th>지역</th>
					<td>
						<label><input type="radio" name="area_id" value="all" />전지역</label>
						<?php
						for($i=0; $i < $area_count; $i++)
							echo "<label><input type='radio' name='area_id' value='{$navi_area['area_id'][$i]}' />{$navi_area['area_name'][$i]}</label>";
						?>
					</td>
				</tr>

				<tr>
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
				<a href="#">펜 션 검 색</a>
				<a href="#">빈 방 검 색</a>
			</div>
		</div>

		<div class="LineBackground"></div>

	</div>
</form>

<div id="section" class="search-list-top">
	<div class="row">
		<div class="container">
			<div class="left">
				검색값 : 경기도, 바다, 계곡, 강/호수, 산
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
			uri = "<?=$_SERVER[PHP_SELF]?>?bo_table=pension_info&sfl=area_id&stx=<?=$stx?>&sop=and&sod="+sod+"&sst="+sst+"&page=<?=$page?>";
			$(location).attr('href',uri);
		});

		$(".orderList[value=<?=$sst?>]").attr('checked',true);
		//$(":radio[name='orderList']:radio[value=<?=$mod?>]").attr('checked',true);
	});
</script>
