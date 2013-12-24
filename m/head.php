<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once "{$g4['g4m_path']}/head.sub.php";
include_once "{$g4['path']}/lib/visit.lib.php";
include_once "{$g4['g4m_path']}/lib/g4m.lib.php";

?>


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

<!-- <div id="ct">

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
    </div>
 -->

    <div id="g4m_content">
