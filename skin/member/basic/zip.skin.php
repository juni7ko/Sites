<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<table width="600" border="0" cellspacing="0" cellpadding="0">
<form name="fzip" method="get" autocomplete="off">
<input type=hidden name=frm_name  value='<?=$frm_name?>'>
<input type=hidden name=frm_zip1  value='<?=$frm_zip1?>'>
<input type=hidden name=frm_zip2  value='<?=$frm_zip2?>'>
<input type=hidden name=frm_addr1 value='<?=$frm_addr1?>'>
<input type=hidden name=frm_addr2 value='<?=$frm_addr2?>'>
<tr>
    <td colspan="2">
        <table width="100%" height="50" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" valign="middle" bgcolor="#EBEBEB">
                <table width="98%" height="40" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="5%" align="center" bgcolor="#FFFFFF" ><img src="<?=$g4[bbs_img_path]?>/icon_01.gif" width="5" height="5"></td>
                    <td width="35%" align="left" bgcolor="#FFFFFF" ><font color="#666666"><b><?=$g4[title]?></b></font></td>
                    <td width="60%" bgcolor="#FFFFFF" ></td>
                </tr>
                </table></td>
        </tr>
        </table></td>
</tr>
<tr>
    <td height="20" colspan="2"></td>
</tr>
<tr>
    <td width=130 style="padding-left:60px;"><strong>검색 타입</strong></td>
    <td>
		<input type="radio" onclick="addr_change('new');" checked value="new" name="type">도로/건물명 통합검색
		<input type="radio" onclick="addr_change('newdong');" <?=($type=="newdong")?"checked":"";?> value="newdong" name="type">구주소(동,번지)
		<input type="radio" onclick="addr_change('old');" <?=($type=="old")?"checked":"";?> value="old" name="type">구주소(동,읍/면/리)
	</td>
</tr>
<tr>
    <td height="50" colspan="2" valign="bottom" style="padding-left:60px;">
		<div class="addrs new" <?=($type=="new" || $type=="")?"":"style='display:none;'";?>>
			※ 찾고자 하시는 도로명 주소나 건물명을 한단어 또는 여러 단어로 입력하세요.</br>
			<span style="padding-left:15px;">예) 가산동 에이스하이엔드, 덕양구 행신동 햇빛마을, 한글비석로24</span>
		</div>
		<div class="addrs newdong" <?=($type=="newdong")?"":"style='display:none;'";?>>
			※ 찾고자 하시는 구 주소지를 동과 번지로 구분하여 입력하세요.
			</br><span style="padding-left:15px;">예) 대치동 907, 상계5동 155-48, 가산동 371-50</span>
		</div>
		<div class="addrs old" <?=($type=="old")?"":"style='display:none;'";?>>
			※ 찾고자 하시는 구 주소의 동(읍/면/리) 이름을 입력하세요.</br>
			<span style="padding-left:15px;">예) 가산동, 수유4동, 상계45동</span>
		</div>
	</td>
</tr>
<tr>
    <td height="20" colspan="2"></td>
</tr>
<tr>
    <td width=130 style="padding-left:60px;"><strong>검색 주소</strong></td>
    <td>
		<div class="addrs new" <?=($type=="new" || $type=="")?"":"style='display:none;'";?>>
			<input type=text name=addr1 value='<?=$addr1?>' size=35> <input type=image src='<?=$g4[bbs_img_path]?>/btn_post_search.gif' border=0 align=absmiddle>
		</div>
		<div class="addrs newdong" <?=($type=="newdong")?"":"style='display:none;'";?>>
			<input type=text name=addr2 value='<?=($addr2)?$addr2:"동";?>' onclick="if(this.value=='동'){this.value='';}"; size=10>
			<input type=text name=addr3 value='<?=($addr3)?$addr3:"번지";?>' onclick="if(this.value=='번지'){this.value='';}"; size=10>
			<input type=image src='<?=$g4[bbs_img_path]?>/btn_post_search.gif' border=0 align=absmiddle>
		</div>
		<div class="addrs old" <?=($type=="old")?"":"style='display:none;'";?>>
			<input type=text name=addr4 value='<?=$addr4?>' size=35> <input type=image src='<?=$g4[bbs_img_path]?>/btn_post_search.gif' border=0 align=absmiddle>
		</div>
	</td>
</tr>
<tr>
    <td height="20" colspan="2"></td>
</tr>
</table>
<!-- 검색결과 여기서부터 -->

<script type='text/javascript'>
document.fzip.addr1.focus();

function addr_change(addr_type) {
	$(".addrs").hide();
	$("."+addr_type).show();
}
</script>


<?php if ($search_count > 0) { ?>
<table width="600" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td height="1" colspan="2" background="<?=$g4[bbs_img_path]?>/post_dot_bg.gif"></td>
</tr>
<tr>
    <td height="50" colspan="2"><img src="<?=$g4[bbs_img_path]?>/zip_img_03.gif" width="99" height="13"></td>
</tr>
<tr>
    <td width="10%"></td>
    <td width="90%">
        <table width=100% cellpadding=0 cellspacing=0>
        <tr>
            <td height=23 valign=top>총 <?=$search_count?>건 가나다순 (검색시간 : <?=$output[time];?>초)</td>
        </tr>
        <?php
        for ($i=0; $i<count($list); $i++)
        {
            echo "<tr><td height=19><a href='javascript:;' onclick=\"find_zip('{$list[$i][zip1]}', '{$list[$i][zip2]}', '{$list[$i][addr]}');\">{$list[$i][zip1]}-{$list[$i][zip2]} : {$list[$i][addr]} {$list[$i][addr2]}";
			if($type != "old") echo $list[$i][bunji];
			echo "</a></td></tr>\n";
        }
        ?>
        <tr>
            <td height=23>[끝]</td>
        </tr>
        </table>
</tr>
</table>

<script type="text/javascript">
function find_zip(zip1, zip2, addr1)
{
    var of = opener.document.<?=$frm_name?>;

    of.<?=$frm_zip1?>.value  = zip1;
    of.<?=$frm_zip2?>.value  = zip2;

    of.<?=$frm_addr1?>.value = addr1;

    of.<?=$frm_addr2?>.focus();
    window.close();
    return false;
}

function addr_change(addr_type) {
	$(".addrs").hide();
	$("."+addr_type).show();
}
</script>
<?php } ?>
