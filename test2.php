<?php
define('_HD_MAIN_', true);
include_once('./_common.php');

$chk_mobile = chkMobile();
if($_GET['from'] == 'mobile'){
    //새션 생성 이유는 모바일기기에서 PC버전 갔을경우 index.php을 다시 접속했을때 모바일로 오지않고 pc버전 유지하기 위해서이다.
    set_session("frommoblie", "1");
}

//모바일페이지로 이동,
if($chk_mobile == true && !$_SESSION['frommoblie']){
    header("location:/{$g4['g4m_path'] }");
}

//현재 페이지에서 사용될 스킨명 적음
$skin_dirs = Array();
$skin_dirs[] = 'latest/gyungpopension-main-gallery';

$g4['title'] = '';
$headerbg = " class='main-header'";
include_once('./head.index.php');
?>

<table>
<?php $sql_r2 = "select * from g4_write_bbs34_r_info where pension_id = '3' ";
$sql_r2 = mysql_query($sql_r2);
	while ($r_info2 = sql_fetch_array($sql_r2))
		{

		?>

			<tr>
				<td>
					<?=$r_info2['r_info_name']?>
				</td>
				<td>
					<?=$r_info2['r_info_area']?>평(<?=$r_info2['r_info_area'] * 3.3?>㎡)<br />
					원룸형(온돌룸1개+화장실1개)<br />
					<font color=#777777><?=cut_str(strip_tags($list[$i][wr_content]),210,"…")?></font>
				</td>
				<td>
					기준<?=$r_info2['r_info_person1']?>명<br />
					최대<?=$r_info2['r_info_person2']?>명
				</td>
				<td>
					<?=$r_info2['r_info_person2']?>명초과시<br />
					인원당<?=$r_info2['r_info_person_add']?>원
				</td>
				<td class="last">
					<?=$r_cost['r_cost_11']?>
				</td>
			</tr>

<?php }?>
</table>
