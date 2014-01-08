<?php
// 예약 문자 발송
// 예약 완료후 이동할 페이지 지정.
$goto_url = $g4[path] . "/reserv/chkReserv.php?wr_3=" . $wr_3;
?>
<form name='resform1' method='post' enctype='multipart/form-data' style='margin:0px;'>
<input type="hidden" name="wr_3" value="<?=$wr_3?>" />
<input type="hidden" name="wr_name" value="<?=$wr_name?>" />
<input type="hidden" name="wr_password" value="<?=$wr_6?>" />
<input type="hidden" name=null>
<input type="hidden" name=type value=code />
<input type="hidden" name=bo_table value='bbs34'>
</form>
<script type="text/javascript">
function resform_submit(f)
{
    f.action = "<?=$g4[path]?>/reserv/chkReserv.php";
    f.submit();
}
resform_submit(document.resform1);
</script>
