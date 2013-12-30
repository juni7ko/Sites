<?php
if($is_admin) {
$bo_table2 = "bbs34";
?>
<div class="ui-state-default ui-corner-all" style="margin:5px 0; padding: 5px .7em; text-align:right;">
	<a href='<?=$g4[bbs_path]?>/board.php?bo_table=<?=$bo_table?>&pension_id=<?=$pension_id?>'>예약홈</a> |
    <a href='<?=$g4[bbs_path]?>/board.php?bo_table=<?=$bo_table2?>&view_mode=list&pension_id=<?=$pension_id?>'>리스트</a><a href="<?=$g4[bbs_path]?>/board.php?bo_table=<?=$bo_table?>&view_mode=call&pension_id=<?=$pension_id?>">(달력)</a> |
    <a href='<?=$board_skin_path?>/config_room.php?bo_table=<?=$bo_table?>&pension_id=<?=$pension_id?>'>객실/기본요금</a> |
    <a href='<?=$board_skin_path?>/config_date.php?bo_table=<?=$bo_table?>&pension_id=<?=$pension_id?>'>기간별요금</a> |
    <a href='<?=$board_skin_path?>/config_off.php?bo_table=<?=$bo_table?>&pension_id=<?=$pension_id?>'>공휴일</a> |
    <a href='<?=$board_skin_path?>/config_close.php?bo_table=<?=$bo_table?>&pension_id=<?=$pension_id?>'>예약불가</a> |
    <a href='<?=$board_skin_path?>/config_tel.php?bo_table=<?=$bo_table?>&pension_id=<?=$pension_id?>'>전화예약</a> |
    <a href='<?=$board_skin_path?>/config_option.php?bo_table=<?=$bo_table?>&pension_id=<?=$pension_id?>'>추가옵션</a><!-- |
    <a href='<?=$g4[path]."/adm/";?>' title='관리자' onfocus='this.blur()' target='_blank'><img src='<?=$board_skin_path?>/img/admin.gif' border=0 align=absmiddle></a>-->
<!--  <a href='<?=$board_skin_path?>/set_sql.php?bo_table=<?=$bo_table?>&pension_id=<?=$pension_id?>'>업그레이드</a>-->
</div>
<?php } ?>
