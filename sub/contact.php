<?php $g4_path = ".."; // common.php 의 상대 경로
include_once("$g4_path/common.php");
include_once("$g4[path]/head.php");
$depth = $_GET[ct_id];
 $classname = "CONTACT US";


?>


	<div id="sub-visual">

		<div class="spot_sub">
			<div class="spot_sub_images" id="mainImage">
				<div id="spot_sub_image1" class="spot_sub_image1 mainshow"><div class="image"><div></div></div></div>
				<div id="spot_sub_image2" class="spot_sub_image2"><div class="image"><div></div></div></div>
				<div id="spot_sub_image3" class="spot_sub_image3"><div class="image"><div></div></div></div>
			</div><!-- spot_sub_images -->
			<div class="spot_sub_static">
				<div class="page_sub">
					<a id="main_image1" class="on" href="javascript:mainImg(1)"></a>
					<a id="main_image2" href="javascript:mainImg(2)"></a>
					<a id="main_image3" href="javascript:mainImg(3)"></a>
				</div><!-- page -->
			</div><!-- spot_static -->
		</div><!-- spot -->

	</div><!-- visual -->


	<div class="content-area">

		<div class="snb-area">
			<div class="snb-title">
				<!-- <img src="<?=$g4['path']?>/layout/images/snb_title_01.gif" alt="서브페이지제목" /> -->
			</div>
			
			
			<!-- snb [좌측메뉴] -->
			<div id="snb">
				
					<?php
// include("$g4[path]/sub/leftmenu1.php");?>
				
			</div>
			<!-- snb [좌측메뉴] -->
			
		</div>

		<div id="content">
			<div class="content-top">
				
				<div class="sub-title">
				<?php if($ct_id){?>
				<!-- <img src="<?=$g4['path']?>/layout/images/sub_title1_0<?=$ct_id?>.gif" alt="sub_title1_0<?=$ct_id?>.gif" /> -->
				<?php }else{?>
					<!-- <img src="<?=$g4['path']?>/layout/images/sub_title1_01.gif" alt="sub_title1_01.gif" /> -->
				<?php }?>
				</div>
				
				
				<div class="location">
					<ul>
				<li><a href="<?=$g4['path']?>/">홈</a></li>

				<li>></li>
				<li class="local"><a href="#top"><?=$classname?></a></li>
					</ul>
				</div>
				
			</div><!-- content-top [컨텐츠 상단의 서브타이틀과 페이지 위치정보] -->
			
			
			<!-- contents [내용이 들어가는 곳] -->
			<div class="contents">
			


<div style='width:800px;padding-left:0px;'>

    <form id="fwrite" method="post" action="<?php echo $g4['https_url'] ? "{$g4['https_url']}/{$g4['bbs']}" : "./write_update.php" ?>" enctype="multipart/form-data">
    <input type="hidden" name="w"        value="w" />
    <input type="hidden" name="bo_table" value="contactus" />
    <input type="hidden" name="wr_id"    value="<?php echo $wr_id?>" />
    <input type="hidden" name="sca"      value="<?php echo $sca?>" />
    <input type="hidden" name="sfl"      value="<?php echo $sfl?>" />
    <input type="hidden" name="stx"      value="<?php echo $stx?>" />
    <input type="hidden" name="spt"      value="<?php echo $spt?>" />
    <input type="hidden" name="sst"      value="<?php echo $sst?>" />
    <input type="hidden" name="sod"      value="<?php echo $sod?>" />
    <input type="hidden" name="page"     value="<?php echo $page?>" />
	<input type="hidden" name="currentId"     value="<?php echo $currentId?>" />
    <?php echo $option_hidden?>



<div style="width:800px; height:800px; background:url('../../en/images/contact_bg.jpg') no-repeat;">
	<div style="width:800px; height:50px;"></div>
    <div style="width:800px; height:294px;text-align:left;">
        <div style="width:134px; height:294px; float:left;">
        	<div style="width:134px; height:40px; padding-left:120px; font-size:11px; font-family:tahoma; color:#666;">Your Name</div>
            <div style="width:134px; height:40px; padding-left:120px; font-size:11px; font-family:tahoma; color:#666;">Your E-Mail</div>
            <div style="width:134px; height:40px; padding-left:120px; font-size:11px; font-family:tahoma; color:#666;">Phone Num</div>
            <div style="width:134px; height:40px; padding-left:120px; font-size:11px; font-family:tahoma; color:#666;">Subject</div>
            <div style="width:134px; height:134px; padding-left:120px; font-size:11px; font-family:tahoma; color:#666;">Content</div>
        </div>
        <div style="width:558px; height:330px; float:right;">
        	<div style="width:558px; height:40px;">
            	<input type="text" name="wr_name" id="wr_name" style="width:246px; height:20px; border:1px solid #999; padding:3px 0px 3px 5px; margin:0px; font-size:12px; font-family:돋움; color:#666; background:#fff;" />
            </div>
            <div style="width:558px; height:40px;">
            	<input type="text" id="wr_email" name="wr_email"  style="width:246px; height:20px; border:1px solid #999; padding:3px 0px 3px 5px; margin:0px; font-size:12px; font-family:돋움; color:#666; background:#fff;" />
            </div>
            <div style="width:558px; height:40px;">
            	<input type="text" name="wr_1" id="wr_1"  style="width:246px; height:20px; border:1px solid #999; padding:3px 0px 3px 5px; margin:0px; font-size:12px; font-family:돋움; color:#666; background:#fff;" />
            </div>
            <div style="width:558px; height:40px;">

            	<input type="text" id="wr_subject" name="wr_subject"   style="width:246px; height:20px; border:1px solid #999; padding:3px 0px 3px 5px; margin:0px; font-size:12px; font-family:돋움; color:#666; background:#fff;" />
            </div>
            <div style="width:525px; height:110px;">

				   <textarea id="wr_content" name="wr_content" class="iTextarea required" rows="10" cols="1" title="내용" style="width:96%; border:1px solid #999;"></textarea>

            </div>
        </div>
    </div>
    <div style="width:800px; height:56px; text-align:center;">
    	<div style="width:750px; height:56px; float:left; text-align:right;margin-top:10px;">
<input type="submit" name="push_btn" id="push_btn" value=" WRITE " />
        </div>
        <div style="width:25px; height:10px; float:right;"></div>
    </div>
</div>



	</form>

</div><!-- #board_write -->









<!-- contents -->


		</div>  <!-- content_area -->
 </div> <!-- content -->






<?php include_once("../tail.php"); 
?> 
