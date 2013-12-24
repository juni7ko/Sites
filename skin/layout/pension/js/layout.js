
// Slide Navigation Bar
function whCheck(){
	var wH=$('#wrap').height();
	var windowH=$(window).height();
	if(wH>windowH){$('.background-overlay').height(wH)}
	else{$('.background-overlay').height(windowH)}
}


$(function(){whCheck();
	$(window).resize(function(){whCheck()});
	$('#nav > .nav_content > ul').find('.current').addClass('active');
	function nav_event(){
		$('#nav > .nav_content > ul > li > ul').hide();
		$('#nav > .nav_content > ul > li').removeClass('active');
		$(this).parent().addClass('active');
		$(this).parent().children('ul').slideDown()
	}

	$('#nav > .nav_content > ul > li > a').mouseover(nav_event).focus(nav_event);
	function hide_nav(){
		$("#nav > .nav_content > ul > li > ul").hide();
		$('#nav > .nav_content > ul > li').removeClass('active');
		$('#nav > .nav_content > ul').find('.current').addClass('active')
	}

	$('*:not("#nav *")').focus(hide_nav);$('#nav').mouseleave(hide_nav);
	function nav_event2(){
		$("#nav > .nav_content > ul > li > ul > li > ul").hide();
		$(this).parent().children('ul').slideDown()
	}

	$('#nav > .nav_content > ul > li > ul > li > a').mouseover(nav_event2).focus(nav_event2);
	function hide_nav2(){
		$("#nav > .nav_content > ul > li > ul > li > ul").hide()
	}

	$('*:not("#nav *")').focus(hide_nav2);
	$('#nav').mouseleave(hide_nav2);
	/*
	$(".util-nav img").tipTip({maxWidth:"auto",defaultPosition:"top"});
	if(window.opera){
		if($("a.jqbookmark").attr("rel")!="")
	}
*/
	/* 
	//기타설정
	// bookmark
	$("a.bookmark").click(function(e){e.preventDefault();
	var bookmarkUrl=this.href;
	var bookmarkTitle=this.title;
	if(navigator.userAgent.toLowerCase().indexOf('chrome')>-1){alert("크롬은 이 기능을 지원하지 않습니다. Ctrl + D (맥은 Command+D)를 입력해주세요.")}
	else if(window.sidebar){window.sidebar.addPanel(bookmarkTitle,bookmarkUrl,"")}
	else if(window.external||document.all){window.external.AddFavorite(bookmarkUrl,bookmarkTitle)}
	else if(window.opera){
		$("a.bookmark").attr("href",bookmarkUrl);
		$("a.bookmark").attr("title",bookmarkTitle);
		$("a.bookmark").attr("rel","sidebar")
	}
	else{alert('즐겨찾기 기능을 사용할 수 없습니다.');return false}
	});
	

	// cookie
	if($.cookie('huddak_vzAdminControler')=='false'){
		$('#vzAdminControler .controler-action-btn').addClass('closed');
		$('#vzAdminControler').css('right','-300px')
	}
			
	$('#vzAdminControler .controler-action-btn').click(function(){
		if($(this).hasClass('closed')){$.removeCookie('huddak_vzAdminControler');
		$(this).removeClass('closed');$('#vzAdminControler').animate({right:'0'},500)
	}else{
		$.cookie('huddak_vzAdminControler','false',{expires:1});
		$(this).addClass('closed');$('#vzAdminControler').animate({right:'-300px'},500)
	}return false
	});
	

	$('#vzAdminControler select[name="ly_bg_type"]').change(function(){
		var selectedNo=$(this).val();
		$('#vzAdminControler .input-bg-set').hide();
		$('#vzAdminControler .input-bg-set').eq(selectedNo).show()
	});

	$('#vzAdminControler .input-bg-set').eq($('#vzAdminControler select[name="ly_bg_type"]').val()).show();
	$('#vzAdminControler select[name="ly_color_set"]').change(function(){
		var selectedColorSet=$(this).val();
		$('#nav').removeClass();
		$('#nav').addClass(selectedColorSet)
	});

	$('#vzAdminControler #layoutPreviewBtn').click(function(){
		var h1textColor=$('input[name=ly_h1text_color]').val();
		var contentBgColor=$('input[name=ly_content_bg_color]').val();
		var bgColor=$('input[name=ly_bg_color]').val();
		var bgImg=$('input[name=ly_bg_img_url]').val();
		if($('#vzAdminControler select[name="ly_bg_type"]').val()==0){$('#wrap').css('background-color',bgColor)}
		if($('#vzAdminControler select[name="ly_bg_type"]').val()==1){$('#wrap').css('background','none');$.backstretch(bgImg)}
		$('.nav_content-head h2').css('color',h1textColor);
		$('.aside-nav h2').css('color',h1textColor);
		return false
	});

	if($(".color-picker").length>0){
		$(".color-picker").miniColors({
			change:function(hex,opacity){
				var bgColor=$('input[name=ly_bg_color]').val();
				var h1textColor=$('input[name=ly_h1text_color]').val();
				if($('#vzAdminControler select[name="ly_bg_type"]').val()==0){
					$('#wrap').css('background-color',bgColor)
				}
			$('.nav_content-head h2').css('color',h1textColor);
			$('.aside-nav h2').css('color',h1textColor)}
		}
	)} //기타설정
	*/
});



// Slide Navigation Bar
function whCheck(){
	var wH=$('#wrap').height();
	var windowH=$(window).height();
	if(wH>windowH){$('.background-overlay').height(wH)}
	else{$('.background-overlay').height(windowH)}
}


$(function(){whCheck();
	$(window).resize(function(){whCheck()});
	$('#quick > .quick-navi > ul').find('.current').addClass('active');
	function nav_event(){
		$('#quick > .quick-navi > ul > li > ul').hide();
		$('#quick > .quick-navi > ul > li').removeClass('active');
		$(this).parent().addClass('active');
		$(this).parent().children('ul').slideDown()
	}

	$('#quick > .quick-navi > ul > li > a').mouseover(nav_event).focus(nav_event);
	function hide_nav(){
		$("#quick > .quick-navi > ul > li > ul").hide();
		$('#quick > .quick-navi > ul > li').removeClass('active');
		$('#quick > .quick-navi > ul').find('.current').addClass('active')
	}

	$('*:not("#quick *")').focus(hide_nav);$('#quick').mouseleave(hide_nav);
	function nav_event2(){
		$("#quick > .quick-navi > ul > li > ul > li > ul").hide();
		$(this).parent().children('ul').slideDown()
	}

	$('#quick > .quick-navi > ul > li > ul > li > a').mouseover(nav_event2).focus(nav_event2);
	function hide_nav2(){
		$("#quick > .quick-navi > ul > li > ul > li > ul").hide()
	}

	$('*:not("#quick *")').focus(hide_nav2);
	$('#quick').mouseleave(hide_nav2);
});