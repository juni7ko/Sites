<?php $sub_menu = "200100";
include_once("./_common.php");

check_demo();

auth_check($auth[$sub_menu], "w");

check_token();

for ($i=0; $i<count($chk); $i++)
{
    // 실제 번호를 넘김
    $k = $_POST['chk'][$i];

    $mb = get_member($_POST['mb_id'][$k]);

    if (!$mb[mb_id]) {
        $msg .= "$mb[mb_id] : 회원자료가 존재하지 않습니다.\\n";
    } else if ($is_admin != "super" && $mb[mb_level] >= $member[mb_level]) {
        $msg .= "$mb[mb_id] : 자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.\\n";
    } else if ($member[mb_id] == $mb[mb_id]) {
        $msg .= "$mb[mb_id] : 로그인 중인 관리자는 수정 할 수 없습니다.\\n";
    } else {
        $sql = " UPDATE $g4[member_table]
                    set mb_level          = '{$_POST['mb_level'][$k]}',
                        mb_intercept_date = '{$_POST['mb_intercept_date'][$k]}',
                        mb_1              = '{$_POST['mb_1'][$k]}'
                  where mb_id             = '{$_POST['mb_id'][$k]}' ";
        sql_query($sql);
    }

    // 게시판 그룹 관리자 지정
    $groupSql = " SELECT * FROM g4_group WHERE gr_id = 'pen_{$_POST['mb_1'][$k]}' and gr_admin != '{$_POST['mb_id'][$k]}' LIMIT 1 ";
    if(sql_fetch($groupSql)) {
        sql_query(" UPDATE g4_group set gr_admin = '{$_POST['mb_id'][$k]}' WHERE gr_id = 'pen_{$_POST['mb_1'][$k]}' ");
    }

    // 관리자페이지 관리권한 설정
    if($_POST['mb_1'][$k])
    {
        $au_menu = array('300100', '400300', '400310');
        foreach($au_menu as $aumenu) {
            $sql = " INSERT into $g4[auth_table]
                        set mb_id   = '{$_POST['mb_id'][$k]}',
                            au_menu = '$aumenu',
                            au_auth = 'r,w,' ";
            $result = sql_query($sql, FALSE);
            if (!$result) {
                $sql = " UPDATE $g4[auth_table]
                            set au_auth = 'r,w,'
                          where mb_id   = '{$_POST['mb_id'][$k]}'
                            and au_menu = '$aumenu' ";
                sql_query($sql);
            }
        }
    }
}

if ($msg)
    echo "<script type='text/javascript'> alert('$msg'); </script>";

goto_url("./member_list.php?$qstr");
?>
