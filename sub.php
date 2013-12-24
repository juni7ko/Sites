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
$skin_dirs[] = 'latest/gyungpopension-main-gallery';

include_once('./head.sub.php');
include_once('./_head.php');
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
					<option value="지역선택">지역선택</option>
					<option value="강릉/경포대">강릉/경포대</option>
					<option value="강릉/경포대">강릉/경포대</option>
					<option value="강릉/경포대">강릉/경포대</option>
					<option value="강릉/경포대">강릉/경포대</option>
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
				<input type="checkbox" id="" name="" ><label>바다</label>
				<input type="checkbox" id="" name="" ><label>계곡</label>
				<input type="checkbox" id="" name="" ><label>강/호수</label>
				<input type="checkbox" id="" name="" ><label>산</label>
				<input type="checkbox" id="" name="" ><label>섬</label>
			</td>
		</tr>
		
		<tr>
			<th>
				테마
			</th>
			<td>
				<input type="checkbox" id="" name="" ><label>바다</label>
				<input type="checkbox" id="" name="" ><label>계곡</label>
				<input type="checkbox" id="" name="" ><label>강/호수</label>
				<input type="checkbox" id="" name="" ><label>산</label>
				<input type="checkbox" id="" name="" ><label>섬</label>
			</td>
		</tr>
		
		<tr>
			<th>
				편의제공
			</th>
			<td>
				<input type="checkbox" id="" name="" ><label>바다</label>
				<input type="checkbox" id="" name="" ><label>계곡</label>
				<input type="checkbox" id="" name="" ><label>강/호수</label>
				<input type="checkbox" id="" name="" ><label>산</label>
				<input type="checkbox" id="" name="" ><label>섬</label>
			</td>
		</tr>
		
		<tr>
			<th>
				부대시설
			</th>
			<td>
				<input type="checkbox" id="" name="" ><label>바다</label>
				<input type="checkbox" id="" name="" ><label>계곡</label>
				<input type="checkbox" id="" name="" ><label>강/호수</label>
				<input type="checkbox" id="" name="" ><label>산</label>
				<input type="checkbox" id="" name="" ><label>섬</label>
			</td>
		</tr>
		
		<tr>
			<th>
				유형별
			</th>
			<td>
				<input type="checkbox" id="" name="" ><label>바다</label>
				<input type="checkbox" id="" name="" ><label>계곡</label>
				<input type="checkbox" id="" name="" ><label>강/호수</label>
				<input type="checkbox" id="" name="" ><label>산</label>
				<input type="checkbox" id="" name="" ><label>섬</label>
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
				<input type="radio" name="" value="" /><label>추천순</label>
				<input type="radio" name="" value="" /><label>저가순</label>
				<input type="radio" name="" value="" /><label>예약순</label>
				<input type="radio" name="" value="" /><label>조회순</label>
				<input type="radio" name="" value="" /><label>고가순</label>
			</div>
		</div>
	</div>
</div>










<div id="section">
	<div class="container">

		<table class="tbl">
			<caption>펜션정보검색</caption>
			<thead>
			<tr>
				<th width="150">업소</th>
				<th width="100">빈객실</th>
				<th width="380">구조</th>
				<th width="80">인원</th>
				<th width="120">추가금액</th>
				<th width="150">요금(원)</th>
			</tr>
			</thead>
			
			<!-- section group start [tbody까지 반복되어야 함.] -->
			<tbody>
			<tr>
				<td rowspan="4" class="gallery">
					<a href="<?=$g4['path']?>/detail.php"><img src="<?=$g4['path']?>/layout/images/ex_w270.jpg" alt="펜션이름" /></a>
					<h3>강원도 강릉시 교1동 1898-3 드림빌라</h3>
					<span><a href="#">미리보기</a></span>
				</td>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			<!-- //여기까지 반복 -->
			<tr>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			<tr>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			<tr>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			</tbody>
			<!-- // section group end [tbody까지 반복되어야 함.] -->
			
			
			<!-- 여기서부터 지워주세요 -->
			<tbody>
			<tr>
				<td rowspan="4" class="gallery">
					<a href="<?=$g4['path']?>/detail.php"><img src="<?=$g4['path']?>/layout/images/ex_w270.jpg" alt="펜션이름" /></a>
					<h3>강원도 강릉시 교1동 1898-3 드림빌라</h3>
					<span><a href="#">미리보기</a></span>
				</td>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			<!-- //여기까지 반복 -->
			<tr>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			<tr>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			<tr>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			</tbody>
			<tbody>
			<tr>
				<td rowspan="4" class="gallery">
					<a href="<?=$g4['path']?>/detail.php"><img src="<?=$g4['path']?>/layout/images/ex_w270.jpg" alt="펜션이름" /></a>
					<h3>강원도 강릉시 교1동 1898-3 드림빌라</h3>
					<span><a href="#">미리보기</a></span>
				</td>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			<!-- //여기까지 반복 -->
			<tr>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			<tr>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			<tr>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			</tbody>
			<tbody>
			<tr>
				<td rowspan="4" class="gallery">
					<a href="<?=$g4['path']?>/detail.php"><img src="<?=$g4['path']?>/layout/images/ex_w270.jpg" alt="펜션이름" /></a>
					<h3>강원도 강릉시 교1동 1898-3 드림빌라</h3>
					<span><a href="#">미리보기</a></span>
				</td>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			<!-- //여기까지 반복 -->
			<tr>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			<tr>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			<tr>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			</tbody>
			<tbody>
			<tr>
				<td rowspan="4" class="gallery">
					<a href="<?=$g4['path']?>/detail.php"><img src="<?=$g4['path']?>/layout/images/ex_w270.jpg" alt="펜션이름" /></a>
					<h3>강원도 강릉시 교1동 1898-3 드림빌라</h3>
					<span><a href="#">미리보기</a></span>
				</td>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			<!-- //여기까지 반복 -->
			<tr>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			<tr>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			<tr>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			</tbody>
			<tbody>
			<tr>
				<td rowspan="4" class="gallery">
					<a href="<?=$g4['path']?>/detail.php"><img src="<?=$g4['path']?>/layout/images/ex_w270.jpg" alt="펜션이름" /></a>
					<h3>강원도 강릉시 교1동 1898-3 드림빌라</h3>
					<span><a href="#">미리보기</a></span>
				</td>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			<!-- //여기까지 반복 -->
			<tr>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			<tr>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			<tr>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			</tbody>
			<tbody>
			<tr>
				<td rowspan="4" class="gallery">
					<a href="<?=$g4['path']?>/detail.php"><img src="<?=$g4['path']?>/layout/images/ex_w270.jpg" alt="펜션이름" /></a>
					<h3>강원도 강릉시 교1동 1898-3 드림빌라</h3>
					<span><a href="#">미리보기</a></span>
				</td>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			<!-- //여기까지 반복 -->
			<tr>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			<tr>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			<tr>
				<td>
					안개실
				</td>
				<td>
					10평(33㎡)<br />
					원룸형(온돌룸1개+화장실1개)
				</td>
				<td>
					기준8명<br />
					최대12명
				</td>
				<td>
					8명초과시<br />
					인원당10,000원
				</td>
				<td class="last">
					100,000
				</td>
			</tr>
			</tbody>
			<!-- // 여기까지 지워주세요 -->
		</table>
	
	</div><!-- ./container -->
</div><!-- ./section -->




<?php include_once("./_tail.php");
?>
