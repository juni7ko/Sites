<style type="text/css">
	#sideZone { margin:0 auto; width:980px; position:relative; height:0px;}
	#STATICMENU { margin:0pt; padding: 0pt; position: absolute; left:985px; top: 0px; width:70px; z-index: 999; background-color:#00aebd; table-layout: fixed; }
	#STATICMENU h1 { width:70px; height:26px; background:url(/layout/images/right_banner_01.jpg) no-repeat; }
	#STATICMENU .zone1 { width:70px; height:60px; }
	#STATICMENU .zone2 { width:70px; height:109px; background:url(/layout/images/right_banner_03.jpg) no-repeat; }
</style>
<script type="text/javascript">
var stmnLEFT = 10; // 오른쪽 여백
var stmnGAP1 = 0; // 위쪽 여백
var stmnGAP2 = 150; // 스크롤시 브라우저 위쪽과 떨어지는 거리
var stmnBASE = 150; // 스크롤 시작위치
var stmnActivateSpeed = 30; //스크롤을 인식하는 딜레이 (숫자가 클수록 느리게 인식)
var stmnScrollSpeed = 20; //스크롤 속도 (클수록 느림)
var stmnTimer;

function RefreshStaticMenu() {
	var stmnStartPoint, stmnEndPoint;
	stmnStartPoint = parseInt(document.getElementById('STATICMENU').style.top, 10);
	stmnEndPoint = Math.max(document.documentElement.scrollTop, document.body.scrollTop) + stmnGAP2;
	if (stmnEndPoint < stmnGAP1) stmnEndPoint = stmnGAP1;
	if (stmnStartPoint != stmnEndPoint) {
		stmnScrollAmount = Math.ceil( Math.abs( stmnEndPoint - stmnStartPoint ) / 15 );
		document.getElementById('STATICMENU').style.top = parseInt(document.getElementById('STATICMENU').style.top, 10) + ( ( stmnEndPoint<stmnStartPoint ) ? -stmnScrollAmount : stmnScrollAmount ) + 'px';
		stmnRefreshTimer = stmnScrollSpeed;
	}
	stmnTimer = setTimeout("RefreshStaticMenu();", stmnActivateSpeed);
}

function InitializeStaticMenu() {
	document.getElementById('STATICMENU').style.right = stmnLEFT + 'px'; //처음에 오른쪽에 위치. left로 바꿔도.
	document.getElementById('STATICMENU').style.top = document.body.scrollTop + stmnBASE + 'px';
	RefreshStaticMenu();
}

$(function(){
	InitializeStaticMenu();
});
</script>
<div id="sideZone">
	<div id="STATICMENU">
		<div>
			<h1></h1>
			<div class="zone1"><a href="/bbs/board.php?bo_table=notice&wr_id=2"><img src="/layout/images/right_banner_02.jpg"></a></div>
			<div class="zone2"></div>
		</div>
	</div>
</div>