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


<div id="ps-container">
	<div class="container">
		<div class="row">
			<div class="detail-wrap">
				<div class="span4 pension-gallery">
					<img src="<?php echo $g4['path']?>/layout/images/pension_03.jpg" class="viewer" alt="pension" />
					<ul class="pension-gallery-thumb clearfix">
						<li><img src="<?php echo $g4['path']?>/layout/images/pension_03.jpg" alt="pension" /></li>
						<li><img src="<?php echo $g4['path']?>/layout/images/pension_03.jpg" alt="pension" /></li>
						<li><img src="<?php echo $g4['path']?>/layout/images/pension_03.jpg" alt="pension" /></li>
						<li><img src="<?php echo $g4['path']?>/layout/images/pension_03.jpg" alt="pension" /></li>
						<li><img src="<?php echo $g4['path']?>/layout/images/pension_03.jpg" alt="pension" /></li>
					</ul>
				</div><!-- /pension-gallery -->
				
				<div class="span-detail detail">
					<h2 class="title">펜션이름</h2>
					<table class="tbl-detail">
					<caption>Detail Info</caption>
						<tr>
							<th>펜션주소</th>
							<td>강원도 강릉시 어흘리 613-3</td>
						</tr>
						<tr>
							<th>대표번호</th>
							<td>033-000-0000</td>
						</tr>
						<tr>
							<th>결제방법</th>
							<td>무통장입금, 실시간계좌이체, 신용카드</td>
						</tr>
						<tr>
							<th>무통장계좌</th>
							<td>농협 000000-00-000000 인터포</td>
						</tr>
						<tr>
							<th>입/퇴실안내</th>
							<td>입실 오후2시30분부터, 퇴실 오전11시30분까지</td>
						</tr>
						<tr>
							<th>픽업안내</th>
							<td>픽업가능(부대/기타 정보참조)</td>
						</tr>
						<tr>
							<th>홈페이지</th>
							<td>http://interfo.com</td>
						</tr>
						<tr>
							<th>서비스</th>
							<td>스파, 강/바다</td>
						</tr>
						<tr>
							<td colspan="2">
								<ul class="row">
									<li class="span50 cart-add"><a href="#" class="btn">관심등록</a></li>
									<li class="span50 fav-add"><a href="#" class="btn">즐겨찾기</a></li>
								</ul>
							</td>
						</tr>
					</table>
				</div><!-- /span-detail -->
				

				<div class="detail-readme">
					<span class="red">예약완료(결제완료)시 예약자 휴대폰으로 예약내역 및 펜션주연락처가 자동 전송되며,<br />
					동시에 펜션주의 휴대폰으로도 예약내역 및 예약자정보(연락처)가 자동 전송됩니다.</span><br />
					픽업 및 찾아가는길은 예약후 전송된 펜션연락처로 전화하셔서 시간 약속 잡으시면 됩니다.<br />
					예약취소시 취소수수료가 존재합니다. 신중하게 예약하세요. <span class="green-dark">취소수수료보기</span><br />
					예약변경시는 이용일 7일전 1회에 한하여 펜션주와 합의하에만 가능합니다.<br />
					예약금을 무통장입금 하실경우 : 성수기에는 예약후 3시간내에 입금완료 하지 않는 경우 강제 취소 처리 될수 있습니다.
				</div><!-- /detail-readme -->
				
				<div class="span12">
					
					<div class="row title-bg">
						<h3 class="span20 cal-title">객실현황 &amp; 예약하기</h3>
						<div class="span80 tright t12">
							예약할 객실을 체크하고 이용인원을 입력한후 예약하기 버튼을 클릭하세요.
						</div>
					</div><!-- row -->
					
					<table class="tbl-condition">
					<caption></caption>
					<tr>
						<th colspan="15">
							<input type="button" value="이전" />
							2013년 10월 07일 ~ 2013년 10월 20일
							<input type="button" value="다음" />
						</th>
					</tr>
					<tr>
						<td rowspan="2">객실명</td>
						<td>비수기</td>
						<td>비수기</td>
						<td>비수기</td>
						<td>비수기</td>
						<td>비수기</td>
						<td>비수기</td>
						<td>비수기</td>
						<td>비수기</td>
						<td>비수기</td>
						<td>비수기</td>
						<td>비수기</td>
						<td>비수기</td>
						<td>비수기</td>
						<td>비수기</td>
					</tr>
					<tr>
						<td>10/07<br />(월)</td>
						<td>10/08<br />(화)</td>
						<td>10/09<br />(수)</td>
						<td>10/10<br />(목)</td>
						<td>10/11<br />(금)</td>
						<td class="blue">10/12<br />(토)</td>
						<td class="red">10/13<br />(일)</td>
						<td>10/14<br />(월)</td>
						<td>10/15<br />(화)</td>
						<td>10/16<br />(수)</td>
						<td>10/17<br />(목)</td>
						<td>10/18<br />(금)</td>
						<td class="blue">10/19<br />(토)</td>
						<td class="red">10/20<br />(일)</td>
					</tr>
					<tr class="pay">
						<td rowspan="2">
							<h3 class="title">실비아(스파)</h3>
							<span>기준4/최대8</span>
						</td>
						<td>126,000</td>
						<td>126,000</td>
						<td>126,000</td>
						<td>126,000</td>
						<td>126,000</td>
						<td>126,000</td>
						<td>126,000</td>
						<td>126,000</td>
						<td>126,000</td>
						<td>126,000</td>
						<td>126,000</td>
						<td>126,000</td>
						<td>126,000</td>
						<td>126,000</td>
					</tr>
					<tr class="check">
						<td><input type="checkbox" /></td>
						<td><input type="checkbox" /></td>
						<td><input type="checkbox" /></td>
						<td>완료</td>
						<td><input type="checkbox" /></td>
						<td><input type="checkbox" /></td>
						<td><input type="checkbox" /></td>
						<td><input type="checkbox" /></td>
						<td><input type="checkbox" /></td>
						<td><input type="checkbox" /></td>
						<td><input type="checkbox" /></td>
						<td><input type="checkbox" /></td>
						<td><input type="checkbox" /></td>
						<td><input type="checkbox" /></td>
					</tr>
					</table>
					<div class="row reserve-wrap">
						<ul class="span80">
							<li>기준인원 초가시 추가요금이 있습니다.</li>
							<li>최대인원 초과로 인한 입실 거부시 환불도 되지 않으니 유의하시기 바랍니다.</li>
							<li>아동불가 또는 유아불가인 경우 어떠한 사유에도 입실이 허락되지 않습니다.</li>
						</ul>
						<div class="span20">
							<a href="#" class="btn-reserve">예약하기</a>
						</div>
					</div><!-- reserve-wrap -->
				</div><!-- span12 -->

				
			</div><!-- detail-wrap -->
			
			<div class="span-qucik">
				<p><img src="<?php echo $g4['path']?>/layout/images/detail_power_search.gif" /></p>
				<p><img src="<?php echo $g4['path']?>/layout/images/detail_power_search.gif" /></p>
			</div><!-- /span-qucik -->
		</div><!-- /row -->
	</div><!-- /container -->
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




<?php include_once("./_tail.php");
?>
