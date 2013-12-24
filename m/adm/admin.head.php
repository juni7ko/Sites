<?php
if (!defined("_GNUBOARD_")) exit;

$begin_time = get_microtime();

include_once "{$g4['g4m_path']}/head.sub.php";
?>
<script type="text/javascript" src="<?php echo $g4['path']?>/js/common.js"></script>
<script type="text/javascript" src="<?php echo $g4['g4m_path']?>/js/sideview.js"></script>
<link rel="stylesheet" href="<?php echo $g4['g4m_admin_path']?>/admin.style.css" type="text/css">
<script type="text/javascript">
if (!g4_is_ie) document.captureEvents(Event.MOUSEMOVE)
document.onmousemove = getMouseXY;
var tempX = 0;
var tempY = 0;
var prevdiv = null;
var timerID = null;

function getMouseXY(e) 
{
    if (g4_is_ie) { // grab the x-y pos.s if browser is IE
        tempX = event.clientX + document.body.scrollLeft + 'px';
        tempY = event.clientY + document.body.scrollTop + 'px';
    } else {  // grab the x-y pos.s if browser is NS
        tempX = e.pageX + 'px';
        tempY = e.pageY + 'px';
    }  

    if (tempX < 0) {tempX = 0;}
    if (tempY < 0) {tempY = 0;}  

    return true;
}

function imageview(id, w, h)
{

    menu(id);

    var el_id = document.getElementById(id);

    //submenu = eval(name+".style");
    submenu = el_id.style;
    submenu.left = tempX - ( w + 11 ) + 'px';
    submenu.top  = tempY - ( h / 2 ) + 'px';

    selectBoxVisible();

    if (el_id.style.display != 'none')
        selectBoxHidden(id);
}

function help(id, left, top)
{
    menu(id);

    var el_id = document.getElementById(id);

    //submenu = eval(name+".style");
    submenu = el_id.style;
    submenu.left = tempX - 50 + left + 'px';
    submenu.top  = tempY + 15 + top + 'px';

    selectBoxVisible();

    if (el_id.style.display != 'none')
        selectBoxHidden(id);
}

// TEXTAREA 사이즈 변경
function textarea_size(fld, size)
{
	var rows = parseInt(fld.rows);

	rows += parseInt(size);
	if (rows > 0) {
		fld.rows = rows;
	}
}

var save_layer = null;
function layer_view(link_id, menu_id, opt, x, y)
{
    var link = document.getElementById(link_id);
    var menu = document.getElementById(menu_id);

    //for (i in link) { document.write(i + '<br/>'); } return;

    if (save_layer != null)
    {
        save_layer.style.display = "none";
        selectBoxVisible();
    }

    if (link_id == '')
        return;

    if (opt == 'hide')
    {
        menu.style.display = 'none';
        selectBoxVisible();
    }
    else
    {
        x = parseInt(x);
        y = parseInt(y);
        menu.style.left = get_left_pos(link) + x + 'px';
        menu.style.top  = get_top_pos(link) + link.offsetHeight + y + 'px';
        menu.style.display = 'block';
    }

    save_layer = menu;
}
</script>
<style type="text/css">
    p.my{color: #0033ff}
</style>

<body>
<div id="hd">
    <h1>
        <a href="<?php echo $g4['g4m_url']?>">HOME</a>
    </h1>
</div>
<hr>
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
        <h2><a href="<?php echo $g4['g4m_admin_path']?>" style="color:#fff">Admin</a></h2>
        <div id="rkc_top" class="rkc">
            <p class="dy"><?php echo $g4['time_ymdhis']?></p>
            <a class="btop" id="rkc_more" href="javascript:;">펼치기</a>
            <div id="rank">
                <p><span class="nc"><?php echo $g4['title']?></span></p>
                <div style="display: table;margin:0 auto; text-align: center;padding:10px; overflow: hidden">
                    <menu>
                        <li><a href="<?php echo $g4['g4m_admin_path']?>/config_form.php">모바일설정</a></li>
                        <li><a href="<?php echo $g4['g4m_admin_path']?>/board_list.php">게시판목록</a></li>
                    </menu>
                </div>

            </div>
            <div class="pgw"><p class="pg"><a href="#" id="close_group">menu</a></p></div>
        </div>
    </div><!--//.rk-->
    <div class="to">
        <h2 class="hc">오늘의 정보</h2>
        <p class="my">
           모바일 관리자
        </p>
        <p class="we">
            <span class="dy"><!-- 03.10.(목) --></span>
        </p>
    </div><!--//.to-->
