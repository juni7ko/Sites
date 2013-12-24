// Main Visual Position
(function(a){a.backstretch=function(p,b,l){function s(){if(p){var b;0==c.length?c=a("<div />").attr("id","backstretch").css({left:0,top:0,position:m?"fixed":"absolute",overflow:"hidden",zIndex:-999999,margin:0,padding:0,height:"100%",width:"100%"}):c.find("img").addClass("deleteable");b=a("<img />").css({position:"absolute",display:"none",margin:0,padding:0,border:"none",zIndex:-999999,maxWidth:"none"}).bind("load",function(d){var b=a(this),e;b.css({width:"auto",height:"auto"});e=this.width||a(d.target).width();d=this.height||a(d.target).height();n=e/d;q();b.fadeIn(g.speed,function(){c.find(".deleteable").remove();"function"==typeof l&&l()})}).appendTo(c);0==a("body #backstretch").length&&(0===a(window).scrollTop()&&window.scrollTo(0,0),a("body").append(c));c.data("settings",g);b.attr("src",p);a(window).unbind("resize.backstretch").bind("resize.backstretch",function(){"onorientationchange"in window&&window.pageYOffset===0&&window.scrollTo(0,1);q()})}}function q(){try{j={left:0,top:0},rootWidth=h=o.width(),roo
tHeight=r?window.innerHeight:o.height(),f=h/n,f>=rootHeight?(k=(f-rootHeight)/2,g.centeredY&&(j.top="-"+k+"px")):(f=rootHeight,h=f*n,k=(h-rootWidth)/2,g.centeredX&&(j.left="-"+k+"px")),c.css({width:rootWidth,height:rootHeight}).find("img:not(.deleteable)").css({width:h,height:f}).css(j)}catch(a){}}var t={centeredX:!0,centeredY:!0,speed:0},c=a("#backstretch"),g=c.data("settings")||t;c.data("settings");var o,m,r,n,h,f,k,j;b&&"object"==typeof b&&a.extend(g,b);b&&"function"==typeof b&&(l=b);a(document).ready(function(){var b=window,d=navigator.userAgent,c=navigator.platform,e=d.match(/AppleWebKit\/([0-9]+)/),e=!!e&&e[1],f=d.match(/Fennec\/([0-9]+)/),f=!!f&&f[1],g=d.match(/Opera Mobi\/([0-9]+)/),h=!!g&&g[1],i=d.match(/MSIE ([0-9]+)/),i=!!i&&i[1];o=(m=!((-1<c.indexOf("iPhone")||-1<c.indexOf("iPad")||-1<c.indexOf("iPod"))&&e&&534>e||b.operamini&&"[object OperaMini]"==={}.toString.call(b.operamini)||g&&7458>h||-1<d.indexOf("Android")&&e&&533>e||f&&6>f||"palmGetResource"in window&&e&&534>e||-1<d.indexOf("MeeGo")&&-1<d
.indexOf("NokiaBrowser/8.5.0")||i&&6>=i))?a(window):a(document);r=m&&window.innerHeight;s()});return this}})(jQuery);

// Main Visual
(function($){$.fn.tipTip=function(options){
var defaults={activation:"hover",keepAlive:false,maxWidth:"200px",edgeOffset:3,defaultPosition:"bottom",delay:400,fadeIn:200,fadeOut:200,attribute:"title",content:false,enter:function(){},exit:function(){}};
var opts=$.extend(defaults,options);
if($("#tiptip_holder").length<=0){var tiptip_holder=$('<div id="tiptip_holder" style="max-width:'+opts.maxWidth+';"></div>');
var tiptip_content=$('<div id="tiptip_content"></div>');
var tiptip_arrow=$('<div id="tiptip_arrow"></div>');
$("body").append(tiptip_holder.html(tiptip_content).prepend(tiptip_arrow.html('<div id="tiptip_arrow_inner"></div>')))}else{var tiptip_holder=$("#tiptip_holder");
var tiptip_content=$("#tiptip_content");
var tiptip_arrow=$("#tiptip_arrow")}return this.each(function(){var org_elem=$(this);
if(opts.content){var org_title=opts.content}else{var org_title=org_elem.attr(opts.attribute)}if(org_title!=""){if(!opts.content){org_elem.removeAttr(opts.attribute)}var timeout=false;
if(opts.activation=="hover"){org_elem.hover(function(){active_tiptip()},function(){if(!opts.keepAlive){deactive_tiptip()}});
if(opts.keepAlive){tiptip_holder.hover(function(){},function(){deactive_tiptip()})}}else if(opts.activation=="focus"){org_elem.focus(function(){active_tiptip()}).blur(function(){deactive_tiptip()})}else if(opts.activation=="click"){org_elem.click(function(){active_tiptip();return false}).hover(function(){},function(){if(!opts.keepAlive){deactive_tiptip()}});
if(opts.keepAlive){tiptip_holder.hover(function(){},function(){deactive_tiptip()})}}function active_tiptip(){opts.enter.call(this);tiptip_content.html(org_title);tiptip_holder.hide().removeAttr("class").css("margin","0");tiptip_arrow.removeAttr("style");
var top=parseInt(org_elem.offset()['top']);
var left=parseInt(org_elem.offset()['left']);
var org_width=parseInt(org_elem.outerWidth());
var org_height=parseInt(org_elem.outerHeight());
var tip_w=tiptip_holder.outerWidth();
var tip_h=tiptip_holder.outerHeight();
var w_compare=Math.round((org_width-tip_w)/2);
var h_compare=Math.round((org_height-tip_h)/2);
var marg_left=Math.round(left+w_compare);
var marg_top=Math.round(top+org_height+opts.edgeOffset);
var t_class="";
var arrow_top="";
var arrow_left=Math.round(tip_w-12)/2;
if(opts.defaultPosition=="bottom"){t_class="_bottom"}else if(opts.defaultPosition=="top"){t_class="_top"}else if(opts.defaultPosition=="left"){t_class="_left"}else if(opts.defaultPosition=="right"){t_class="_right"}var right_compare=(w_compare+left)<parseInt($(window).scrollLeft());
var left_compare=(tip_w+left)>parseInt($(window).width());
if((right_compare&&w_compare<0)||(t_class=="_right"&&!left_compare)||(t_class=="_left"&&left<(tip_w+opts.edgeOffset+5))){t_class="_right";arrow_top=Math.round(tip_h-13)/2;arrow_left=-12;marg_left=Math.round(left+org_width+opts.edgeOffset);marg_top=Math.round(top+h_compare)}else if((left_compare&&w_compare<0)||(t_class=="_left"&&!right_compare)){t_class="_left";arrow_top=Math.round(tip_h-13)/2;arrow_left=Math.round(tip_w);marg_left=Math.round(left-(tip_w+opts.edgeOffset+5));marg_top=Math.round(top+h_compare)}var top_compare=(top+org_height+opts.edgeOffset+tip_h+8)>parseInt($(window).height()+$(window).scrollTop());
var bottom_compare=((top+org_height)-(opts.edgeOffset+tip_h+8))<0;
if(top_compare||(t_class=="_bottom"&&top_compare)||(t_class=="_top"&&!bottom_compare)){if(t_class=="_top"||t_class=="_bottom"){t_class="_top"}else{t_class=t_class+"_top"}arrow_top=tip_h;marg_top=Math.round(top-(tip_h+5+opts.edgeOffset))}else if(bottom_compare|(t_class=="_top"&&bottom_compare)||(t_class=="_bottom"&&!top_compare)){if(t_class=="_top"||t_class=="_bottom"){t_class="_bottom"}else{t_class=t_class+"_bottom"}arrow_top=-12;marg_top=Math.round(top+org_height+opts.edgeOffset)}if(t_class=="_right_top"||t_class=="_left_top"){marg_top=marg_top+5}else if(t_class=="_right_bottom"||t_class=="_left_bottom"){marg_top=marg_top-5}if(t_class=="_left_top"||t_class=="_left_bottom"){marg_left=marg_left+5}tiptip_arrow.css({"margin-left":arrow_left+"px","margin-top":arrow_top+"px"});tiptip_holder.css({"margin-left":marg_left+"px","margin-top":marg_top+"px"}).attr("class","tip"+t_class);
if(timeout){clearTimeout(timeout)}timeout=setTimeout(function(){tiptip_holder.stop(true,true).fadeIn(opts.fadeIn)},opts.delay)}function deactive_tiptip(){opts.exit.call(this);
if(timeout){clearTimeout(timeout)}tiptip_holder.fadeOut(opts.fadeOut)}
}
}
)}
})(jQuery);
