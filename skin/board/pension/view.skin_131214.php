<?php if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>


<!-- 게시글 보기 시작 -->
<div id="section">
	<div class="row">
		<div class="container">

			<div class="detail-gallery-area">
        <?php echo $view[file][0][view_big];   // 큰 파일
		?>


				<div class="small-thumb-area">
					<ul>
		<?php
// 파일 출력
        for ($i=1; $i<=count($view[file]); $i++) {
            if ($view[file][$i][view_small]) 
                echo "<li>" .$view[file][$i][view_small] . "</li>";
        }
        ?>
						<!-- <li><img src="<?=$g4['path']?>/layout/images/ex_pension.jpg" alt="" /></li>
						<li><img src="<?=$g4['path']?>/layout/images/ex_pension.jpg" alt="" /></li>
						<li><img src="<?=$g4['path']?>/layout/images/ex_pension.jpg" alt="" /></li>
						<li><img src="<?=$g4['path']?>/layout/images/ex_pension.jpg" alt="" /></li>
						<li><img src="<?=$g4['path']?>/layout/images/ex_pension.jpg" alt="" /></li> -->

					</ul>
				</div>
				<div class="gallery-view-btn"><a href="#" class="btn">상세보기</a></div>
			</div><!-- ./detail-slide-gallery -->
			
			<div class="detail-pension-info">
				<table class="tbl-detail">
					<caption>Detail Info</caption>
						<tr>
							<th width="60"> 펜션명</th>
							<td><?=$view[wr_subject]?></td>
						</tr>
						<tr>
							<th> 펜션주소</th>
							<td>
								<?=$view[mb_addr1]?>
								<?=$view[mb_addr2]?>
							</td>
						</tr>
						<tr>
							<th>대표번호</th>
							<td><?=$view[wr_phone1]?></td>
						</tr>
						<tr>
							<th>결제방법</th>
							<td>
								<?=($view[payment1]) ? "<span style='color:blue;'>무통장입금</span>":"";?>
								<?=($view[payment2]) ? "<span style='color:green'>실시간계좌이체</span>":"";?>
								<?=($view[payment3]) ? "<span style='color:red'>신용카드</span>":"";?>
							</td>
						</tr>
						<?php if($view[payment1] == "1") {?>
						<tr>
							<th>무통장계좌</th>
							<td>
								<?=$view[bank_name]?>
								<?=$view[bank_number]?>
								<?=$view[bank_username]?>
							</td>
						</tr>
						<?php }?>
						<?php if($view[checkin]) {?>
						<tr>
							<th>입실안내</th>
							<td><?=$view[checkin]?></td>
						</tr>
						<?php }?>
						<?php if($view[checkout]) {?>
						<tr>
							<th>퇴실안내</th>
							<td><?=$view[checkout]?></td>
						</tr>
						<?php }?>
						<?php if($view[pickup]) {?>
						<tr>
							<th>픽업안내</th>
							<td><?=$view[pickup]?></td>
						</tr>
						<?php }?>
						<?php if($view[domain_name]) {?>
						<tr>
							<th>홈페이지</th>
							<td><?=$view[domain_name]?></td>
						</tr>
						<?php }?>
						<tr>
							<th>서비스</th>
							<td>스파, 강/바다</td>
						</tr>
					</table>

					<ul class="pension-info-btn">
						<li class="cols50 cart-add"><a href="#" class="btn">관심등록</a></li>
						<li class="cols50 fav-add"><a href="#" class="btn">즐겨찾기</a></li>
					</ul>

			</div>
			
			<div class="detail-search-area">
				<a href="#" class="powersearch"><img src="<?=$g4['path']?>/layout/images/power_search_btn.gif" alt="POWER SEARCH" /></a>
				
				<h3>SPEED SEARCH</h3>
				<div class="speed-search-area">
					<table cellpadding="0" cellspacing="0">
					<caption>Speed Search Option</caption>					
					<tbody>
					<tr>
						<th><span>지역</span></th>
						<td>
							<select name="location">
								<option value="지역선택">지역선택</option>
								<option value="강릉/경포대">강릉/경포대</option>
								<option value="강릉/경포대">강릉/경포대</option>
								<option value="강릉/경포대">강릉/경포대</option>
								<option value="강릉/경포대">강릉/경포대</option>
							</select>
						</td>
						<td rowspan="5" class="tbl_banner">
							<!-- banner width 140px , height 150px -->
							<img src="<?=$g4['path']?>/layout/images/ex_banner.gif" alt="banner" />
							<!-- ./banner width 140px , height 150px -->
						</td>
					</tr>
					<tr>
						<th><span>기간</span></th>
						<td>
							<select name="period">
								<option value="기간선택">기간선택</option>
								<option value="1박2일">1박2일</option>
								<option value="2박3일">2박3일</option>
								<option value="3박4일">3박4일</option>
								<option value="4박5일">4박5일</option>
							</select>
						</td>
					</tr>
					<tr>
						<th><span>날짜</span></th>
						<td>
							<input type="text" maxlength="8" style="width:100%;" />
							<!-- 레이어를 이용한 캘런더 표시를 위해 주석처리됨.
							<select name="year">
								<option value="년도선택">년도선택</option>
								<option value="2013년">2013년</option>
								<option value="2014년">2014년</option>
							</select>
							
							<select name="month">
								<option value="월선택">월선택</option>
								<option value="01월">01월</option>
								<option value="02월">02월</option>
								<option value="03월">03월</option>
								<option value="04월">04월</option>
								<option value="05월">05월</option>
								<option value="06월">06월</option>
								<option value="07월">07월</option>
								<option value="08월">08월</option>
								<option value="09월">09월</option>
								<option value="10월">10월</option>
								<option value="11월">11월</option>
								<option value="12월">12월</option>
							</select>
							
							<select name="day">
								<option value="일선택">일선택</option>
								<option value="01일">01일</option>
								<option value="02일">02일</option>
								<option value="03일">03일</option>
								<option value="04일">04일</option>
								<option value="05일">05일</option>
								<option value="06일">06일</option>
								<option value="07일">07일</option>
								<option value="08일">08일</option>
								<option value="09일">09일</option>
								<option value="10일">10일</option>
								<option value="11일">11일</option>
								<option value="12일">12일</option>
								<option value="13일">13일</option>
								<option value="14일">14일</option>
								<option value="15일">15일</option>
								<option value="16일">16일</option>
								<option value="17일">17일</option>
								<option value="18일">18일</option>
								<option value="19일">19일</option>
								<option value="20일">20일</option>
								<option value="21일">21일</option>
								<option value="22일">22일</option>
								<option value="23일">23일</option>
								<option value="24일">24일</option>
								<option value="25일">25일</option>
								<option value="26일">26일</option>
								<option value="27일">27일</option>
								<option value="28일">28일</option>
								<option value="29일">29일</option>
								<option value="30일">30일</option>
								<option value="31일">31일</option>
							</select>
							
							<input type="image" src="<?=$g4['path']?>/layout/images/speed_search_calendar.gif" width="17" />
							./레이어를 이용한 캘런더 표시를 위해 주석처리됨. -->
						</td>
					</tr>
					<tr>
						<th><span>객실수</span></th>
						<td>
							<select name="location">
								<option value="객실수선택">객실수선택</option>
								<option value="객실수무관">객실수무관</option>
								<option value="1개">1개</option>
								<option value="2개">2개</option>
								<option value="3개">3개</option>
							</select>
						</td>
					</tr>
					<tr>
						<th><span>화장실</span></th>
						<td>
							<select name="location">
								<option value="화장실수선택">화장실수선택</option>
								<option value="화장실수무관">화장실수무관</option>
								<option value="1개">1개</option>
								<option value="2개">2개</option>
								<option value="3개">3개</option>
							</select>
						</td>
					</tr>
					</tbody>
					</table>

				</div><!-- ./speed-search-area -->

				<div class="speed-search-btn">
					<a href="#" class="btn1">펜션검색</a>
					<a href="#" class="btn2">빈방검색</a>
				</div>
				
			</div><!-- ./detail-search-area -->

		</div><!-- ./container -->
	</div><!-- ./row -->
</div>
<!-- ./section -->


<div id="section">
	<div class="container">
		<div class="detail-readme">
			<span class="red">예약완료(결제완료)시 예약자 휴대폰으로 예약내역 및 펜션주연락처가 자동 전송되며, 동시에 펜션주의 휴대폰으로도 예약내역 및 예약자정보(연락처)가 자동 전송됩니다.</span><br />
			픽업 및 찾아가는길은 예약후 전송된 펜션연락처로 전화하셔서 시간 약속 잡으시면 됩니다.<br />
			예약취소시 취소수수료가 존재합니다. 신중하게 예약하세요. <a href="#">취소수수료보기</a><br />
			예약변경시는 이용일 7일전 1회에 한하여 펜션주와 합의하에만 가능합니다.<br />
			예약금을 무통장입금 하실경우 : 성수기에는 예약후 3시간내에 입금완료 하지 않는 경우 강제 취소 처리 될수 있습니다.
		</div><!-- /detail-readme -->
		
		<div class="cols">
			
			<div class="row title-bg">
				<h3 class="cal-title">객실현황&amp;예약하기</h3>
				<div class="tright t12">
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
	</div>
</div>
<!-- 게시글 보기 끝 -->

<?php if($member['mb_level'] >= 9 ){?>
<div style="clear:both; height:30px;text-align:center;">
    <!-- 링크 버튼 -->
    <!-- <?php echo "<a href=\"$list_href\"><img src='$board_skin_path/img/btn_list.gif' border='0' align='absmiddle'></a> "; ?> -->
    <?php if ($update_href) { echo "<a href=\"$update_href\"><img src='$board_skin_path/img/btn_modify.gif' border='0' align='absmiddle'></a> "; } ?>
    <!-- <?php if ($delete_href) { echo "<a href=\"$delete_href\"><img src='$board_skin_path/img/btn_delete.gif' border='0' align='absmiddle'></a> "; } ?> -->
    <!-- <?php if ($write_href) { echo "<a href=\"$write_href\"><img src='$board_skin_path/img/btn_write.gif' border='0' align='absmiddle'></a> "; } ?> -->
</div>
<?php }?>
