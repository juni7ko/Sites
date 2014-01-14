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
							<option value="지역선택">지역선택</option>
							<option value="강릉/경포대">강릉/경포대</option>
							<option value="인천/강화도">인천/강화도</option>
							<option value="가평/양평">가평/양평</option>
							<option value="태안/안면도">태안/안면도</option>
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


<div id="section" class="section-powersearch">
	<div class="container">
		<table>
			<tr>
				<th>
					지역
				</th>
				<td>
					<input type="radio" name="" value="" /><label>전지역</label>
					<input type="radio" name="" value="" /><label>경기도</label>
					<input type="radio" name="" value="" /><label>강원도</label>
					<input type="radio" name="" value="" /><label>충청도</label>
					<input type="radio" name="" value="" /><label>경상도</label>
					<input type="radio" name="" value="" /><label>전라도</label>
					<input type="radio" name="" value="" /><label>제주도</label>
				</td>
			</tr>

			<tr>
				<th>
					인기지역
				</th>
				<td>
					<input type="radio" name="" value="" /><label>전지역</label>
					<input type="radio" name="" value="" /><label>경기도</label>
					<input type="radio" name="" value="" /><label>강원도</label>
					<input type="radio" name="" value="" /><label>충청도</label>
					<input type="radio" name="" value="" /><label>경상도</label>
					<input type="radio" name="" value="" /><label>전라도</label>
					<input type="radio" name="" value="" /><label>제주도</label>
				</td>
			</tr>

			<tr>
				<th>
					주변여행지
				</th>
				<td>
					<input type="checkbox" id="condition1" name="cf1" ><label>바다</label>
					<input type="checkbox" id="condition1" name="cf2" ><label>계곡</label>
					<input type="checkbox" id="condition1" name="cf3" ><label>강/호수</label>
					<input type="checkbox" id="condition1" name="cf4" ><label>산</label>
					<input type="checkbox" id="condition1" name="cf5" ><label>섬</label>
				</td>
			</tr>

			<tr>
				<th>
					테마
				</th>
				<td style="line-height:20px;">
					<input type="checkbox" id="condition2" name="" ><label>해수욕장</label>
					<input type="checkbox" id="condition2" name="" ><label>레프팅</label>
					<input type="checkbox" id="condition2" name="" ><label>MT/워크샵</label>
					<input type="checkbox" id="condition2" name="" ><label>갯벌</label>
					<input type="checkbox" id="condition2" name="" ><label>스키장주변</label>
					<input type="checkbox" id="condition2" name="" ><label>수상레져</label>
					<input type="checkbox" id="condition2" name="" ><label>스파</label>
					<input type="checkbox" id="condition2" name="" ><label>등산,수목원,휴양림</label>
					<input type="checkbox" id="condition2" name="" ><label>낚시</label>
					<input type="checkbox" id="condition2" name="" ><label>골프장주변</label>
					<input type="checkbox" id="condition2" name="" ><label>커플전용</label>
					<br />
					<input type="checkbox" id="condition2" name="" ><label>바다,강이 보이는 전망</label>
					<input type="checkbox" id="condition2" name="" ><label>복층구조</label>
					<input type="checkbox" id="condition2" name="" ><label>독채</label>
					<input type="checkbox" id="condition2" name="" ><label>소규모(10명이상)</label>
					<input type="checkbox" id="condition2" name="" ><label>대규모(50명이상)</label>
					<input type="checkbox" id="condition2" name="" ><label>계곡주변</label>
				</td>
			</tr>

			<tr>
				<th>
					편의제공
				</th>
				<td>
					<input type="checkbox" id="condition3" name="" ><label>매점</label>
					<input type="checkbox" id="condition3" name="" ><label>식사가능</label>
					<input type="checkbox" id="condition3" name="" ><label>애완견동반가능</label>
					<input type="checkbox" id="condition3" name="" ><label>파티/이벤트제공</label>
					<input type="checkbox" id="condition3" name="" ><label>보드게임</label>
					<input type="checkbox" id="condition3" name="" ><label>픽업가능</label>
					<input type="checkbox" id="condition3" name="" ><label>인터넷</label>
					<input type="checkbox" id="condition3" name="" ><label>영화관람</label>
					<input type="checkbox" id="condition3" name="" ><label>카페</label>
					<input type="checkbox" id="condition3" name="" ><label>셔틀버스</label>
				</td>
			</tr>

			<tr>
				<th>
					부대시설
				</th>
				<td>
					<input type="checkbox" id="condition4" name="" ><label>간이축구장</label>
					<input type="checkbox" id="condition4" name="" ><label>족구장</label>
					<input type="checkbox" id="condition4" name="" ><label>바베큐장</label>
					<input type="checkbox" id="condition4" name="" ><label>캠프화이어</label>
					<input type="checkbox" id="condition4" name="" ><label>노래방</label>
					<input type="checkbox" id="condition4" name="" ><label>수영장</label>
					<input type="checkbox" id="condition4" name="" ><label>농구장</label>
					<input type="checkbox" id="condition4" name="" ><label>세미나실</label>
					<input type="checkbox" id="condition4" name="" ><label>스파</label>
					<input type="checkbox" id="condition4" name="" ><label>자전거</label>
					<input type="checkbox" id="condition4" name="" ><label>4륜오토바이</label>
					<input type="checkbox" id="condition4" name="" ><label>서바이벌게임</label>
				</td>
			</tr>

			<tr>
				<th>
					유형별
				</th>
				<td>
					<input type="checkbox" id="condition5" name="" ><label>목조형</label>
					<input type="checkbox" id="condition5" name="" ><label>통나무형</label>
					<input type="checkbox" id="condition5" name="" ><label>황토형</label>
					<input type="checkbox" id="condition5" name="" ><label>벽돌형</label>
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


<div id="section" class="search-list-top">
	<div class="row">
		<div class="container">
			<div class="left">
				검색값 : 경기도, 바다, 계곡, 강/호수, 산
			</div>
			<div class="right">
				<label><input type="radio" name="orderList" class="orderList" value="wr_good" /> 추천순</label>
				<label><input type="radio" name="orderList" class="orderList" value="lowPrice" /> 저가순</label>
				<label><input type="radio" name="orderList" class="orderList" value="wr_num" /> 예약순</label>
				<label><input type="radio" name="orderList" class="orderList" value="wr_hit" /> 조회순</label>
				<label><input type="radio" name="orderList" class="orderList" value="highPrice" /> 고가순</label>
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
				case "wr_num" :
					sod = "asc";
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
