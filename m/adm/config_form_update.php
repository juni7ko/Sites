<?php
include_once "./_common.php";
check_demo();
auth_check($auth[$sub_menu], "w");

if ($is_admin != "super")
    alert("최고관리자만 접근 가능합니다.");

if ($member['mb_password'] != sql_password($_POST['admin_password'])) {
    alert("패스워드가 다릅니다.");
}

$mb = get_member($cf_admin);
check_token();

$sql = " update $g4[config_table]
            set 
                cf_m_cut_name             = '{$_POST['cf_m_cut_name']}',
                cf_m_new_skin             = '{$_POST['cf_m_new_skin']}',
                cf_m_new_rows             = '{$_POST['cf_m_new_rows']}',
                cf_m_search_skin          = '{$_POST['cf_m_search_skin']}',
                cf_m_connect_skin         = '{$_POST['cf_m_connect_skin']}',
                cf_m_member_skin          = '{$_POST['cf_m_member_skin']}',
                cf_m_write_pages          = '{$_POST['cf_m_write_pages']}',
                cf_m_page_rows            = '{$_POST['cf_m_page_rows']}'";
sql_query($sql);

//sql_query(" OPTIMIZE TABLE `$g4[config_table]` ");
goto_url("./config_form.php", false);
?>
