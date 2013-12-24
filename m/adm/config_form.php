<?php
include_once "./_common.php";
auth_check($auth[$sub_menu], "r");
$token = get_token();

if ($is_admin != "super")
    alert("최고관리자만 접근 가능합니다.");

$g4['title'] = "모바일설정";
include_once ("./admin.head.php");
?>
<style type="text/css">
.lst{margin: 10px;}
.lst li{line-height: 35px; border-bottom: 1px solid #ccc}
.lst li p{font-size: .8em; color:#ff6666;padding: 5px; margin: 0; line-height: 1em;}
.bbtn{text-align: center;padding: 10px;}
h2.bf_title {text-align: center; margin: 10px; border-bottom: 2px solid #104068; line-height: 30px;}
</style>
<form name='fconfigform' method='post' onsubmit="return fconfigform_submit(this);" action="">
    <fieldset>
        <ul class="lst">
            <li>
                이름(별명) 표시<input type='text' name='cf_m_cut_name' value='<?php echo $config['cf_m_cut_name']?>' size='2'> 자리만 표시
            </li>
            <li>
                한페이지당 라인수<input type='text' name='cf_m_page_rows' value='<?php echo $config['cf_m_page_rows']?>' size='5'> 라인
                <p>쪽지,게시판관리자의 게시판목록 등의 라인수 설정</p>
            </li>
            <li>
                최근게시물 라인수<input type='text' name='cf_m_new_rows' value='<?php echo $config['cf_m_new_rows']?>' size='5'> 라인
                <p>new.php</p>
            </li>
            <li>최근게시물 스킨
                <select id='cf_m_new_skin' name='cf_m_new_skin' required itemname="최근게시물 스킨">
                    <?php
                    $arr = get_mskin_dir("new");
                    for ($i = 0; $i < count($arr); $i++) {
                        echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
                    }
                    ?>
                </select>
                <script type="text/javascript"> document.getElementById('cf_m_new_skin').value="<?= $config['cf_m_new_skin'] ?>";</script>
            </li>
            <li>검색스킨
                <select id='cf_m_search_skin' name='cf_m_search_skin' required itemname="검색 스킨">
                    <?php
                    $arr = get_mskin_dir("search");
                    for ($i = 0; $i < count($arr); $i++) {
                        echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
                    }
                    ?>
                </select>
                <script type="text/javascript"> document.getElementById('cf_m_search_skin').value="<?= $config['cf_m_search_skin'] ?>";</script>
            </li>
            <li>접속자 스킨
                <select id='cf_m_connect_skin' name='cf_m_connect_skin' required itemname="접속자 스킨">
                <?php
                $arr = get_mskin_dir("connect");
                for ($i = 0; $i < count($arr); $i++) {
                    echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
                }
                ?>
                </select>
                <script type="text/javascript"> document.getElementById('cf_m_connect_skin').value="<?php echo $config['cf_m_connect_skin']?>";</script>
            </li>
            <li>회원 스킨
                <select id='cf_m_member_skin' name='cf_m_member_skin' required itemname="회원가입 스킨">
                <?php
                $arr = get_mskin_dir("member");
                for ($i = 0; $i < count($arr); $i++) {
                    echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
                }
                ?>
                </select>
                <script type="text/javascript"> document.getElementById('cf_m_member_skin').value="<?php echo $config['cf_m_member_skin']?>";</script>
            </li>
            <li>
                <input type='text' name='cf_m_write_pages' size='10' required itemname='페이지 표시 수' value='<?php echo $config['cf_m_write_pages']?>'> 페이지씩 표시
            </li>
            <li>
                관리자 패스워드
                <input  type='password' name='admin_password' itemname="관리자 패스워드" required>
            </li>
        </ul>
    <input type='hidden' name='token' value='<?php echo $token?>'>
    <input type='submit' class='btn' accesskey='s' value='  확  인  '>
    </fieldset>
</form>

<script type="text/javascript">
function fconfigform_submit(f)
{
    f.action = "./config_form_update.php";
    return true;
}
</script>

<?php
include_once "./admin.tail.php";
?>
