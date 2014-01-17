<?php
function get_member_pension_select($name, $selected='', $event='')
{
    global $g4;

    $str = "<select name='$name' $event>";
    $str .= "<option vaule=''>펜션지정</option>";

    $sql = " SELECT * from g4_write_pension_info where wr_is_comment = 0 order by wr_subject asc ";
    $result = sql_query($sql);
    while ($row = sql_fetch_array($result)) {
        $str .= "<option value='$row[wr_id]'";
        if($row[wr_id] == $selected)
            $str .= " selected";
        $str .= ">$row[wr_subject]</option>";
    }

    $str .= "</select>";
    return $str;
}

function get_mb1_name($mb_1) {
    global $g4;

    $sql = " SELECT * FROM g4_write_pension_info WHERE pension_id = '$mb_1' LIMIT 1 ";
    $penName = sql_fetch($sql);

    return $penName[wr_subject];
}
?>
