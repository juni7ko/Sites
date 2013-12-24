<div id="wrap">
	<!-- header -->
	<div id="header">
		<h1><a href="<?php echo $g4['path']?>/">홈페이지</a></h1>
		<div class="util-nav">
			<ul>
				<li><a href="<?php echo $g4['bbs_path'].'/new.php'?>">최근게시물</a></li>
				<?php if(!$member['mb_id']) { ?>
				<li><a href="<?php echo $g4['bbs_path']?>/login.php?url=<?php echo $urlencode?>">로그인</a></li>
				<li><a href="<?php echo $g4['bbs_path']?>/register.php">회원가입</a></li>
				<?php } else { ?>
				<li><a href="<?php echo $g4['bbs_path']?>/mypage.php">마이페이지</a></li>
				<li><a href="<?php echo $g4['bbs_path']?>/member_confirm.php?url=register_form.php">정보수정</a></li>
				<li><a href="<?php echo $g4['bbs_path']?>/logout.php">로그아웃</a></li>
				<?php } ?>
			</ul>
		</div>
		<form method="get" action="<?php echo $g4['bbs_path'].'/search.php'?>" class="header-search-form">
			<input type="hidden" name="sfl" value="wr_subject||wr_content" />
			<input type="hidden" name="sop" value="and" />
			<input type="text" name="stx" class="iText" value="<?php echo $stx;?>" />
			<input type="image" src="<?php echo $layout_skin_path?>/img/btn_search.gif" alt="검색" />
		</form>
		<ul id="nav">
			<?php foreach($Menu_Array[0] as $Id => $array){ // 1차메뉴 루핑
					$target = "";
					if($Menu_Id_Array[$Id][pagetarget])
						$target = "target=\"_blank\"";
					$current = "";
					if($Menu_Id_Array[$Id][Id] == $currentId || $Menu_Id_Array[$Id][Id] == $Menu_Id_Array[$currentId][ownerEl] || $Menu_Sub_Id == $Id) // 활성화
						$current = " class=\"current\" ";

					$Menu_pageurl = "";
					if($Menu_Id_Array[$Id][outsidetarget])
						$Menu_pageurl = $Menu_Id_Array[$Id][pageurl];
					else
						$Menu_pageurl = $g4[path].$Menu_Id_Array[$Id][pageurl];
					$Menu_pageurl = str_replace("&", "&amp;", $Menu_pageurl);

					echo "<li{$current}><a href=\"{$Menu_pageurl}\" $target >{$Menu_Id_Array[$Id][name]}</a>"; // 1차메뉴명

					if (is_array($Menu_Array[$Id])) { // 2차 메뉴 배열이 있는지
						echo "<ul>";

						foreach($Menu_Array[$Id] as $Id => $array){ // 2차메뉴 루핑

							$target = "";
							if($Menu_Id_Array[$Id][pagetarget])
								$target = "target=\"_blank\"";
							$current = "";
							if($Menu_Id_Array[$Id][Id] == $currentId || $Menu_Id_Array[$Id][Id] == $Menu_Id_Array[$currentId][ownerEl]) // 활성화
								$current = " class=\"current\" ";

							$Menu_pageurl = "";
							if($Menu_Id_Array[$Id][outsidetarget])
								$Menu_pageurl = $Menu_Id_Array[$Id][pageurl];
							else
								$Menu_pageurl = $g4[path].$Menu_Id_Array[$Id][pageurl];
							$Menu_pageurl = str_replace("&", "&amp;", $Menu_pageurl);

							echo "<li{$current}><a href=\"{$Menu_pageurl}\" $target >{$Menu_Id_Array[$Id][name]}</a></li>"; // 2차메뉴명

						}

						echo "</ul>";


					}


					echo "</li>"; // 1차메뉴 닫기
				}

				?>
			<li class="all"><a href="">전체메뉴</a></li>
		</ul>
		<!-- nav-all -->
		<div class="nav-all">
			<a href="" class="button-x"><img src="<?php echo $layout_skin_path?>/img/btn_x.gif" alt="X" /></a>

			<?php foreach($Menu_Array[0] as $Id => $array){ // 전체메뉴 1차메뉴 루핑
					
					echo "<div>"; // 시작

					$target = "";
					if($Menu_Id_Array[$Id][pagetarget])
						$target = "target=\"_blank\"";

					$Menu_pageurl = "";
					if($Menu_Id_Array[$Id][outsidetarget])
						$Menu_pageurl = $Menu_Id_Array[$Id][pageurl];
					else
						$Menu_pageurl = $g4[path].$Menu_Id_Array[$Id][pageurl];
					$Menu_pageurl = str_replace("&", "&amp;", $Menu_pageurl);

					echo "<h2><a href=\"{$Menu_pageurl}\" $target >{$Menu_Id_Array[$Id][name]}</a></h2>"; // 1차메뉴명

					if (is_array($Menu_Array[$Id])) { // 2차 메뉴 배열이 있는지
						echo "<ul>";

						foreach($Menu_Array[$Id] as $Id => $array){ // 2차메뉴 루핑
							
							if (is_array($Menu_Array[$Id])) { // 3차메뉴가 있는지 확인
								continue; // 3차 사용하지 않기때문에 카테고리 리턴
							}

							$target = "";
							if($Menu_Id_Array[$Id][pagetarget])
								$target = "target=\"_blank\"";


							$Menu_pageurl = "";
							if($Menu_Id_Array[$Id][outsidetarget])
								$Menu_pageurl = $Menu_Id_Array[$Id][pageurl];
							else
								$Menu_pageurl = $g4[path].$Menu_Id_Array[$Id][pageurl];
							$Menu_pageurl = str_replace("&", "&amp;", $Menu_pageurl);

							echo "<li><a href=\"{$Menu_pageurl}\" $target >{$Menu_Id_Array[$Id][name]}</a></li>";; // 2차메뉴명

						}

						echo "</ul>";


					}


					echo "</div>"; // 1차메뉴 닫기
				}

				?>
		</div>
		<!-- nav-all : E -->
	</div>
	<!-- header : E -->
	<!-- container -->
	<div id="container">
