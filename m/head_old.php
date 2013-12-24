<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once "{$g4['g4m_path']}/head.sub.php";
include_once "{$g4['path']}/lib/visit.lib.php";
include_once "{$g4['g4m_path']}/lib/g4m.lib.php";
/*
include_once "{$g4['path']}/lib/outlogin.lib.php";
include_once "{$g4['path']}/lib/poll.lib.php";
include_once "{$g4['path']}/lib/connect.lib.php";
include_once "{$g4['path']}/lib/popular.lib.php";
include_once "{$g4['path']}/lib/latest.lib.php";
*/
//print_r2(get_defined_constants());
// 사용자 화면 상단과 좌측을 담당하는 페이지입니다.
// 상단, 좌측 화면을 꾸미려면 이 파일을 수정합니다.
?>
<div style="text-align:center;">
	<div id="subtop">
		<div id="subtoptitle">
			<?php include $g4['path']."/m/subtoptitle.php";?>
		</div>

		 <div id="submenu">
			<?php include "mtopmenu.php";?>
		 </div>
	</div>
</div>

 <!-- 
 <div id="hd">
   <a href="#ct" class="gct">본문 바로가기</a>
    <h1>
        <a href="<?php echo $g4['g4m_url']?>">쇼앤뉴그린</a>
    </h1>
    <form action="<?php echo $g4['g4m_bbs_path']?>/search.php" name="fsearchbox" method="get">
        <fieldset class="sh1">
            <legend class="hc">검색</legend>
            <div class="sh1w">
                <span class="itw">
                    <input type="text" maxlength="255" value="" title="검색어 입력" class="it" name="stx" id="autocomplete_input">
                </span>
                <input type="hidden" name="sfl" value="wr_subject||wr_content">
                <input type="hidden" name="sop" value="and">

                <input type="image" class="sbt3" alt="검색" src="<?php echo $g4['g4m_path']?>/img/bt_sc.png">
            </div>
        </fieldset>
        <input type="hidden" value="m" name="where">
        <input type="hidden" value="mtp_hty" name="sm">
    </form>
</div> -->
<!-- <hr> -->

<script type="text/javascript">
    $(function(){
        function viewGroup(){
            $("#rkc_top").removeClass("rkc").addClass("rkl");
            $("#rkc_more").removeClass("btop").addClass("btfd");
            $("#rank p").css("display","none");
        }
        function closeGruop(){
            $("#rkc_top").removeClass("rkl").addClass("rkc");
            $("#rkc_more").removeClass("btfd").addClass("btop");
            $("#rank p").css("display","block");
        }
        $("#rkc_more").toggle(viewGroup, closeGruop);
    });
</script>

<div id="ct">
    <div class="rk">
        <h2> 
		<!-- <a href="<?php echo $g4['g4m_bbs_path']?>/new.php">최신게시물</a> -->
				<a href="<?php echo $g4['g4m_bbs_path']?>/board.php?bo_table=bbs13">공지사항</a> &nbsp;&nbsp;|&nbsp;&nbsp;
				<a href="<?php echo $g4['g4m_bbs_path']?>/board.php?bo_table=bbs41">포토앨범</a> &nbsp;&nbsp;|&nbsp;&nbsp;
				<a href="<?php echo $g4['g4m_bbs_path']?>/board.php?bo_table=bbs61">여행후기</a> &nbsp;&nbsp;|&nbsp;&nbsp;
				<a href="http://blog.naver.com/PostThumbnailList.nhn?blogId=bsb0332&widgetTypeCall=true&categoryNo=1&topReferer=http%3A%2F%2Fadmin.blog.naver.com%2Fbsb0332%2Fconfig%2Ftopmenu" target="_blank">동영상</a>	 &nbsp;&nbsp;|&nbsp;&nbsp;
				<a href="<?php echo $g4['g4m_bbs_path']?>/board.php?bo_table=bbs36">예약문의</a>		
		</h2>


        <!-- <h2> <a href="<?php echo $g4['g4m_bbs_path']?>/new.php">최신게시물</a></h2> -->
        <!-- <div id="rkc_top" class="rkc">
            <p class="dy"><?php echo $g4['time_ymdhis']?></p>
            <a class="btop" id="rkc_more" href="javascript:;">펼치기</a>
            <div id="rank">
                <p><span class="nc">쇼앤뉴그린 mobile</span></p>
                <div style="display: table;margin:0 auto; text-align: center;padding:10px; overflow: hidden">
                    <?php
//관리자 그룹 설정 첫번째 추가필드gr_1 를 정렬에 사용한다.
                    $hide_group = ""; //출력하지 않을 그룹 id 입력, 여러 그룹일 경우 쉼표(,)로 구분
                    echo group_menu($hide_group);
                    ?>
                </div>

            </div>
            <div class="pgw"><p class="pg"><a href="#" id="close_group">menu</a></p></div>
        </div> -->
    </div><!--//.rk-->
    <div class="to">
        <h2 class="hc">회원</h2>
        <p class="my">
            <?php if($is_member){?>
            <span><?php echo $member['mb_name']?>님</span>
            <a href="<?php echo $g4['g4m_bbs_path']?>/memo.php" class="btn">쪽지</a>
            <?php if($is_admin == 'super'){?>
            <a href="<?php echo $g4['g4m_admin_path']?>/" class="btn">Admin</a>
            <?php } ?>
            <?php }else{ ?>
            <a href="<?php echo $g4['g4m_path']?>/login.php?url=<?php echo urlencode($_SERVER['REQUEST_URI'])?>">로그인</a>
            <?php } ?>
        </p>
        <p class="we">
            <span class="dy">
                <?php
                echo date("m월 d일");
                switch (date("w")) {
                    case 0: echo " (일)";
                        break;
                    case 1: echo " (월)";
                        break;
                    case 2: echo " (화)";
                        break;
                    case 3: echo " (수)";
                        break;
                    case 4: echo " (목)";
                        break;
                    case 5: echo " (금)";
                        break;
                    case 6: echo " (토)";
                        break;
                }
                ?>
            </span>
        </p>
    </div><!--//.to-->
    <div id="g4m_content">
