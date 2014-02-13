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

$chkLatest = Array();
?>
<div id="ContentContainer">

	<div class="smtView">
	    <div class="dtitle"> 가족점 이란?</div>
	    <p> - 한달광고비를 얼마나 지불하고 계신가요? 광고가 되는지 안되는지 불확실하지 않으세요? 광고비를 줄이시고 가족점으로 등록해보세요. </p>
	    <p> - 가족점으로 등록하실 경우 당사에서 특별관리하여 예약을 대행해드리며 예약률을 책임지고 높여드립니다.</p>
	    <p> - 펜션문의전화,예약관리 모두 대행 처리 해드립니다.</p>
	    <p> - 광고비가 따로&nbsp;존재하지 않아 부담이 없으며. <span style="color: #ff6c00">예약을 잡아드린&nbsp;예약에 대해서만&nbsp;대행수수료만
	        지불</span>하시면 됩니다.</p>
	    <p> -&nbsp;<span style="color: #ff6c00">가족점으로 등록 하시면 </span><span style="color: #ff6c00"> 광고비 없이 예약률이 상승됩니다.</span></p>
	    <p style="margin-left:12px;"> 대부분의 예약자들은 펜션포털에서 적절한 펜션을 찾은 후<br>
	        네이버에서 해당 펜션명을 직접 검색하여 펜션홈페이지에서 예약을 하고 있으므로 이제 펜션포탈의 등록은 필수조건이 되었습니다.</p>
	    <p>&nbsp; </p>
	    <p> </p>
	    <div class="dtitle"> 노출사이트 </div>
	    <p></p>
	    <p> - 스테이스토어 / G마켓 / G마켓여행 / 옥션 / 옥션숙박 / 11번가 </p>
	    <p>&nbsp; </p>
	    <p> </p>
	    <div class="dtitle"> 노출키워드</div>
	    <p></p>
	    <p> - 지역명+펜션(가평펜션), 관광지명+펜션(남이섬펜션), 팬션 ,펜션 ,팬션예약 ,펜션예약, 스파펜션, 팬션예약, 펜션예약사이트 ,팬션할인 ,펜션정보 ,펜션추천 ,펜션할인 <br>
	        - 그외 원하는 키워드 적용해드립니다. </p>
	    <p>&nbsp; </p>
	    <p> </p>
	    <div class="dtitle"> 가족점 자격조건</div>
	    <p></p>
	    <p> - 당사에서&nbsp;정하는 일정수준 이상의 시설을 갖춘 업소만 등록 가능합니다.</p>
	    <p>&nbsp; </p>
	    <p> </p>
	    <div class="dtitle"> 등록비</div>
	    <p></p>
	    <p> - 가맹등록비 30만원 (계약조건에 따라 등록비 면제될수 있습니다.) </p>
	    <p>&nbsp; </p>
	    <p> </p>
	    <div class="dtitle"> 대행수수료</div>
	    <p></p>
	    <p> - 해당 예약건의 15% </p>
	    <p> - 매주화요일 정산 </p>
	    <p>&nbsp; </p>
	    <p> </p>
	    <div class="dtitle"> 중복예약문제 일부해결</div>
	    <p></p>
	    <p> - 5명의 모니터 요원이 전화 및 핸드폰 문자로 철저히 예약상황을 관리해드리고 있습니다.</p>
	    <p>&nbsp; </p>
	    <p> </p>
	    <div class="dtitle"> 타예약대행사 동시 가입여부</div>
	    <p></p>
	    <p> - 타예약대행사와 동시 가입이 가능합니다.</p>
	    <p>&nbsp; </p>
	    <p> </p>
	    <div class="dtitle"> 편리하고 쉬운 객실 관리 프로그램</div>
	    <p></p>
	    <p> - 스테이스토어 객실관리는 쉽고 편리합니다. 한번 클릭만으로 방막기 기능은 물론이며 초보자도 쉽게 직관적으로 사용이 가능합니다. </p>
	    <p>&nbsp; </p>
	    <div style="text-align:center;"> <a href="/bbs/board.php?bo_table=bizReg" class="btn large"><span>신청하기</span></a> </div>
	</div>
</div>



<!-- CS CENTER -->
<div id="section" class="customer">
	<div class="titles">
		<img src="<?=$g4['path']?>/layout/images/customer_title.gif" alt="" />
	</div>
	<div class="row">
		<div class="container">

			<div class="latest">
				<div>
					<h3><a href="/bbs/board.php?bo_table=notice"><img src="<?=$g4['path']?>/layout/images/latest_title1.gif" alt="공지사항" /></a></h3>
					<div class="contents">
						<ul>
							<?=latest("li",notice,4,50);?>
						</ul>
					</div>
				</div>
				<div>
					<h3><a href="/bbs/board.php?bo_table=qna"><img src="<?=$g4['path']?>/layout/images/latest_title2.gif" alt="질문하기" /></a></h3>
					<div class="contents">
						<ul>
							<?=latest("li",qna,4,50);?>
						</ul>
					</div>
				</div>
			</div>

			<div class="cs-info">
				<img src="<?=$g4['path']?>/layout/images/customer.gif" alt="customer" />
			</div>

			<div class="quick-link">
				<div class="left">
					<div class="col2"><a href="/biz.php"><img src="<?=$g4['path']?>/layout/images/quick_link_01.jpg" alt="펜션입점안내" /></a></div>
					<div class="col2"><a href="/bbs/board.php?bo_table=biz"><img src="<?=$g4['path']?>/layout/images/quick_link_03.jpg" alt="광고및제휴" /></a></div>
					<div class="col2"><a href="<?=$g4['path']?>/login.php?ltype=pa"><img src="<?=$g4['path']?>/layout/images/quick_link_05.jpg" alt="펜션관리하기" /></a></div>

				</div>
				<div class="right">
					<div class="col2"><a href="/bbs/board.php?bo_table=qna"><img src="<?=$g4['path']?>/layout/images/quick_link_02.jpg" alt="질문및답변" /></a></div>
					<div class="col2"><a href="/bbs/board.php?bo_table=memqa"><img src="<?=$g4['path']?>/layout/images/quick_link_04.jpg" alt="일대일상담" /></a></div>
					<div class="col2"><a href="/bbs/board.php?bo_table=review"><img src="<?=$g4['path']?>/layout/images/quick_link_06.jpg" alt="펜션여행후기" /></a></div>

				</div>
			</div>

		</div><!-- ./container -->
	</div><!-- ./row -->
</div>
<!-- ./CS CENTER -->

<?php include_once("./_tail.php");
?>
