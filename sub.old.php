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

$g4['title'] = '';
$headerbg = " class='main-header'";
include_once('./head.index.php');
?>


<!--  -->
<div class="article search-wrap-sub">
	<div class="container">
		<div class="clearfix">
			<h2 class="span5"><img src="<?php echo $g4['path']?>/layout/images/powersearch_sub_text.png" alt="POWER SEARCH. 검색하시고자 하는 내용을 선택해주세요(다중선택 가능)" /></h2>
			<div class="search-form">
				<input type="text" />
				<input type="submit" value=" " />
			</div>
		</div>
	</div>
</div>
<!--  -->


<!-- power search -->
<div id="psearch" class="SelectForm">
	<div class="search_opt clearfix">
		<div class="section1">
			<h3><img src="<?php echo $g4['path']?>/layout/images/select_title_01.gif" alt="지역별검색" /></h3>
			<ul>
				<li itemname="전지역"><a href="#none" class="check-btn1-1">전지역</a></li>
				<li itemname="경기도"><a href="#none" class="check-btn1-2">경기도</a></li>
				<li itemname="강원도"><a href="#none" class="check-btn1-3">강원도</a></li>
				<li itemname="충천남도"><a href="#none" class="check-btn1-4">충천남도</a></li>
				<li itemname="충천북도"><a href="#none" class="check-btn1-5">충천북도</a></li>
				<li itemname="경상남도"><a href="#none" class="check-btn1-6">경상남도</a></li>
				<li itemname="경상북도"><a href="#none" class="check-btn1-7">경상북도</a></li>
				<li itemname="전라남도"><a href="#none" class="check-btn1-8">전라남도</a></li>
				<li itemname="전라북도"><a href="#none" class="check-btn1-9">전라북도</a></li>
				<li itemname="제주도"><a href="#none" class="check-btn1-10">제주도</a></li>
			</ul>
		</div><!-- /section -->

		<div class="section2">
			<h3><img src="<?php echo $g4['path']?>/layout/images/select_title_02.gif" alt="주변여행지별검색" /></h3>
			<ul>
				<li itemname="바다"><a href="#none" class="check-btn2-1">바다</a></li>
				<li itemname="계곡"><a href="#none" class="check-btn2-2">계곡</a></li>
				<li itemname="강/호수"><a href="#none" class="check-btn2-3">강/호수</a></li>
				<li itemname="산"><a href="#none" class="check-btn2-4">산</a></li>
				<li itemname="섬"><a href="#none" class="check-btn2-5">섬</a></li>
			</ul>
		</div><!-- /section -->

		<div class="section3 clearfix">
			<h3><img src="<?php echo $g4['path']?>/layout/images/select_title_03.gif" alt="테마별검색" /></h3>
			<ul class="left">
				<li itemname="해수욕장"><a href="#none" class="check-btn3-1">해수욕장</a></li>
				<li itemname="레프팅"><a href="#none" class="check-btn3-2">레프팅</a></li>
				<li itemname="MT/워크샵"><a href="#none" class="check-btn3-3">MT/워크샵</a></li>
				<li itemname="갯벌"><a href="#none" class="check-btn3-4">갯벌</a></li>
				<li itemname="스키장"><a href="#none" class="check-btn3-5">스키장</a></li>
				<li itemname="수상레져"><a href="#none" class="check-btn3-6">수상레져</a></li>
				<li itemname="스파"><a href="#none" class="check-btn3-7">스파</a></li>
				<li itemname="등산/수목원/휴양림"><a href="#none" class="check-btn3-8">등산/수목원/휴양림</a></li>
				<li itemname="낚시"><a href="#none" class="check-btn3-9">낚시</a></li>
			</ul>
			<ul class="right">
				<li itemname="골프장주변"><a href="#none" class="check-btn4-1">골프장주변</a></li>
				<li itemname="커플전용"><a href="#none" class="check-btn4-2">커플전용</a></li>
				<li itemname="전망(바다/강)"><a href="#none" class="check-btn4-3">전망(바다/강)</a></li>
				<li itemname="복층구조"><a href="#none" class="check-btn4-4">복층구조</a></li>
				<li itemname="독채"><a href="#none" class="check-btn4-5">독채</a></li>
				<li itemname="소규모(10인이상)"><a href="#none" class="check-btn4-6">소규모(10인이상)</a></li>
				<li itemname="대규모(50인이상)"><a href="#none" class="check-btn4-7">대규모(50인이상)</a></li>
				<li itemname="계곡주변"><a href="#none" class="check-btn4-8">계곡주변</a></li>
			</ul>
		</div><!-- /section -->

		<div class="section4">
			<h3><img src="<?php echo $g4['path']?>/layout/images/select_title_04.gif" alt="편의시설별검색" /></h3>
			<ul>
				<li itemname="매점"><a href="#none" class="check-btn5-1">매점</a></li>
				<li itemname="식사가능"><a href="#none" class="check-btn5-2">식사가능</a></li>
				<li itemname="애완견동반"><a href="#none" class="check-btn5-3">애완견동반</a></li>
				<li itemname="파티/이벤트"><a href="#none" class="check-btn5-4">파티/이벤트</a></li>
				<li itemname="보드게임"><a href="#none" class="check-btn5-5">보드게임</a></li>
				<li itemname="픽업가능"><a href="#none" class="check-btn5-6">픽업가능</a></li>
				<li itemname="인터넷"><a href="#none" class="check-btn5-7">인터넷</a></li>
				<li itemname="영화관람"><a href="#none" class="check-btn5-8">영화관람</a></li>
				<li itemname="카페"><a href="#none" class="check-btn5-9">카페</a></li>
				<li itemname="셔틀버스"><a href="#none" class="check-btn5-10">셔틀버스</a></li>
			</ul>
		</div><!-- /section -->

		<div class="section5">
			<h3><img src="<?php echo $g4['path']?>/layout/images/select_title_05.gif" alt="부대시설별검색" /></h3>
			<ul>
				<li itemname="간이축구장"><a href="#none" class="check-btn6-1">간이축구장</a></li>
				<li itemname="족구장"><a href="#none" class="check-btn6-2">족구장</a></li>
				<li itemname="바베큐장"><a href="#none" class="check-btn6-3">바베큐장</a></li>
				<li itemname="캠프화이어"><a href="#none" class="check-btn6-4">캠프화이어</a></li>
				<li itemname="노래방"><a href="#none" class="check-btn6-5">노래방</a></li>
				<li itemname="수영장"><a href="#none" class="check-btn6-6">수영장</a></li>
				<li itemname="농구장"><a href="#none" class="check-btn6-7">농구장</a></li>
				<li itemname="세미나실"><a href="#none" class="check-btn6-8">세미나실</a></li>
				<li itemname="스파"><a href="#none" class="check-btn6-9">스파</a></li>
				<li itemname="자전거"><a href="#none" class="check-btn6-10">자전거</a></li>
				<li itemname="4륜오토바이"><a href="#none" class="check-btn6-11">4륜오토바이</a></li>
				<li itemname="서바이벌"><a href="#none" class="check-btn6-12">서바이벌</a></li>
			</ul>
		</div><!-- /section -->

		<div class="section6">
			<h3><img src="<?php echo $g4['path']?>/layout/images/select_title_06.gif" alt="유형별검색" /></h3>
			<ul>
				<li itemname="목조형"><a href="#none" class="check-btn7-1">목조형</a></li>
				<li itemname="통나무형"><a href="#none" class="check-btn7-2">통나무형</a></li>
				<li itemname="황토형"><a href="#none" class="check-btn7-3">황토형</a></li>
				<li itemname="벽돌형"><a href="#none" class="check-btn7-4">벽돌형</a></li>
			</ul>
		</div><!-- /section -->
	</div>
</div>
<!-- /power search -->


<div id="ps-container">
	<table class="tbl">
		<caption>펜션정보검색</caption>
		<thead>
		<tr>
			<th width="220">업소</th>
			<th width="100">빈객실</th>
			<th>구조</th>
			<th width="80">인원</th>
			<th width="120">추가금액</th>
			<th width="100">요금(원)</th>
		</tr>
		</thead>
		
		<!-- section group start [tbody까지 반복되어야 함.] -->
		<tbody>
		<tr>
			<td rowspan="4" class="gallery">
				<a href="detail.php"><a href="detail.php"><img src="<?php echo $g4['path']?>/layout/images/sub_title_photo.jpg" alt="펜션이름" /></a></a>
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
			<td>
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
			<td>
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
			<td>
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
			<td>
				100,000
			</td>
		</tr>
		</tbody>
		<!-- // section group end [tbody까지 반복되어야 함.] -->
		
		
		<!-- 여기서부터 지워주세요 -->
		<tbody>
		<tr>
			<td rowspan="4" class="gallery">
				<a href="detail.php"><img src="<?php echo $g4['path']?>/layout/images/sub_title_photo.jpg" alt="펜션이름" /></a>
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
			<td>
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
			<td>
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
			<td>
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
			<td>
				100,000
			</td>
		</tr>
		</tbody>
		<tbody>
		<tr>
			<td rowspan="4" class="gallery">
				<a href="detail.php"><img src="<?php echo $g4['path']?>/layout/images/sub_title_photo.jpg" alt="펜션이름" /></a>
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
			<td>
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
			<td>
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
			<td>
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
			<td>
				100,000
			</td>
		</tr>
		</tbody>
		<tbody>
		<tr>
			<td rowspan="4" class="gallery">
				<a href="detail.php"><img src="<?php echo $g4['path']?>/layout/images/sub_title_photo.jpg" alt="펜션이름" /></a>
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
			<td>
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
			<td>
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
			<td>
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
			<td>
				100,000
			</td>
		</tr>
		</tbody>
		<!-- // 여기까지 지워주세요 -->
	</table>
</div>


<div class="article">
	<div class="container">
		<div class="row">
		
			<div class="span12 home-info">
				고객센터, 영업시간, 제휴업체 가맹안내 질문답변 예약안내 업소관리 광고문의
			</div><!-- /span12-->
			
		</div>
	</div>
</div>
<!-- /article -->


<script type="text/javascript">
    var this_page = 1;
    $(window).scroll(function(){
        if($(window).scrollTop() == $(document).height() - $(window).height()){
            this_page++;
            searchAjax();
        }
    });
    
    function resetButton()
    {
        $("#psearch .search_opt li").removeClass('on');
        searchAjax();
    }
    function searchAjax()
    {
        var data = {"지역":Array(), "주변":Array(), "테마":Array(), "편의시설":Array(), "부대시설":Array(), "유형":Array(), "검색": "", "페이지": this_page};
        var wldur  = Array();
        var wnqus  = Array();
        var xpak  = Array();
        var vusdmltltjf  = Array();
        var qneotltjf  = Array();
        var dbgud  = Array();

        $(".loading").css("visibility", 'visible');


        $(".search_opt .section1 li").each(function(){
            if($(this).is(".on")) qnsdi.push($(this).attr("itemname"))
        });
        $(".search_opt .section2 li").each(function(){
            if($(this).is(".on")) wlrwhd.push($(this).attr("itemname"))
        });
        $(".search_opt .section3 li").each(function(){
            if($(this).is(".on")) ghkfehd.push($(this).attr("itemname"))
        });
        $(".search_opt .section4 li").each(function(){
            if($(this).is(".on")) rudfur.push($(this).attr("itemname"))
        });
        $(".search_opt .section5 li").each(function(){
            if($(this).is(".on")) wldur.push($(this).attr("itemname"))
        });
        $(".search_opt .section6 li").each(function(){
            if($(this).is(".on")) wldur.push($(this).attr("itemname"))
        });

        data["지역"] = wldur;
        data["주변"] = wnqus;
        data["테마"] = xpak;
        data["편의시설"] = vusdmltltjf;
        data["부대시설"] = qneotltjf;
        data["유형"] = dbgud;

        $.ajax({
            type: "POST",
            url: "/dsm_main/proc_search/designer",
            data: data,
            async: true,
            success: function(ret) {
                $("#list_designer").html(ret);
                $(".loading").css("visibility", 'hidden');
            }
        });
    }

    $(document).ready(function() {
        $("#psearch .search_opt li").click(function(){

            if($(this).is(".on"))
            {
                $(this).removeClass('on');
            }
            else
            {
            	/* -- 삽입되면 section3의 다중클릭 활성화가 안됨.
                if($(this).parent().parent().attr("class") == "section3")
                {
                    $(".search_opt .section3 li").removeClass('on');
                }
                */

                $(this).toggleClass('on');
            }

            searchAjax();
        });

        searchAjax();
    });

    var pension_discount = 'n';
    var del_flag = 'n';
    var pension_discount_count = 0;
    function pension_discount_go(obj, pd_no)
    {
        var data = {
            'pd_no' : pd_no,
            'person_id' : ""
        };

        $.ajax({
            url: "http://www.designshow.me/dsm_main/proc_showme",
            data: data,
            dataType: "jsonp",
            async:false,
            success: function(ret) {
                if(ret.status == 'y')
                {
                    pension_discount_count++;
                    $("#pd_count").text(String(pension_discount_count).comma());
                }
                $(obj).addClass('on');
            }
        });

        return false;
    }
</script>




<?php include_once("./_tail.php");
?>
