<?php if(!defined('_HD_MAIN_')){?>

<!-- aside -->
<div id="aside">
	<?php // echo outlogin('basic'); // 외부 로그인 ?>
	<?php // echo latest("line_notice","test",5,15); // 한줄 공지사항 ?>
	<!-- aside-nav -->
	<div class="aside-nav">

		<h2><?=$Menu_Id_Array[$Menu_Sub_Id][name];?></h2>
<?php $navi_title = array();
if(is_array($Menu_Array[$Menu_Sub_Id])){
?>
		<ul>

			<?php foreach($Menu_Array[$Menu_Sub_Id] as $Id => $array){ // 2차메뉴 루핑
					$target = "";
					if($Menu_Id_Array[$Id][pagetarget])
						$target = "target=\"_blank\"";
					$current = "";
					$navi1 = "";
					if($Menu_Id_Array[$Id][Id] == $currentId || $Menu_Id_Array[$Id][Id] == $Menu_Id_Array[$currentId][ownerEl] || $Menu_Sub_Id == $Id){ // 활성화
						$current = " class=\"current\" ";
						$navi_title[0] = $Menu_Id_Array[$Id][name];

					}else{
						if(!$navi_title[0])
							$navi_title[0] = $Menu_Id_Array[$currentId][name];
					}

					$Menu_pageurl = "";
					if($Menu_Id_Array[$Id][outsidetarget])
						$Menu_pageurl = $Menu_Id_Array[$Id][pageurl];
					else
						$Menu_pageurl = $g4[path].$Menu_Id_Array[$Id][pageurl];
					$Menu_pageurl = str_replace("&", "&amp;", $Menu_pageurl);

					echo "<li{$current}><a href=\"{$Menu_pageurl}\" $target >{$Menu_Id_Array[$Id][name]}</a>"; // 2차메뉴명

					if (is_array($Menu_Array[$Id])) { // 3차 메뉴 배열이 있는지
						echo "<ul>";

						foreach($Menu_Array[$Id] as $Id => $array){ // 2차메뉴 루핑

							if (is_array($Menu_Array[$Id])) { // 4차메뉴가 있는지 확인
								continue; // 4차 사용하지 않기때문에 카테고리 리턴
							}

							$target = "";
							if($Menu_Id_Array[$Id][pagetarget])
								$target = "target=\"_blank\"";
							$current = "";
							if($Menu_Id_Array[$Id][Id] == $currentId){ // 활성화
								$current = " class=\"current\" ";
								if(!$navi_title[1])
									$navi_title[1] = $Menu_Id_Array[$Id][name];
							}

							$Menu_pageurl = "";
							if($Menu_Id_Array[$Id][outsidetarget])
								$Menu_pageurl = $Menu_Id_Array[$Id][pageurl];
							else
								$Menu_pageurl = $g4[path].$Menu_Id_Array[$Id][pageurl];
							$Menu_pageurl = str_replace("&", "&amp;", $Menu_pageurl);

							echo "<li{$current}><a href=\"{$Menu_pageurl}\" $target >{$Menu_Id_Array[$Id][name]}</a></li>"; // 3차메뉴명

						}

						echo "</ul>";


					}


					echo "</li>"; // 1차메뉴 닫기
				}

				?>
		</ul>
<?php 
}else{
	$navi_title[0] = $Menu_Id_Array[$Menu_Sub_Id][name];
}
?>
	</div>
	<!-- aside-nav : E -->
	<?php echo banner_latest("aside"); // aside배너호출;?>
</div>
<!-- aside : E -->
<!-- content -->
<div id="content">
	<div class="content-head">
		<h2><?php echo $navi_title[0]?></h2>
		<div class="breadcrumb">
			<img src="<?=$layout_skin_path;?>/img/icon_home.gif" alt="HOME" /> &gt;
			 <?php echo $navi_title[0]?>
			 <?php if($navi_title[1]){?>&gt; <strong><?php echo $navi_title[1]?></strong><?php }?>
		</div>
	</div>
<?php } ?>
