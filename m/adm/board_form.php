<?php
include_once "./_common.php";
auth_check($auth[$sub_menu], "w");
$token = get_token();

$sql = " select count(*) as cnt from {$g4['group_table']} ";
$row = sql_fetch($sql);
if (!$row['cnt'])
    alert("게시판그룹이 한개 이상 생성되어야 합니다.", "./boardgroup_form.php");
$html_title = "게시판";
if ($w == "") {
;
} else if ($w == "u") {
    $html_title .= " 수정";

    if (!$board['bo_table'])
        alert("존재하지 않은 게시판 입니다.");

    if ($is_admin == "group") {
        if ($member['mb_id'] != $group['gr_admin'])
            alert("그룹이 틀립니다.");
    }
}

if ($is_admin != "super") {
    $group = get_group($board['gr_id']);
    $is_admin = is_admin($member['mb_id']);
}

$g4['title'] = $html_title;
include_once "./admin.head.php";
?>
<style type="text/css">
.lst{margin: 10px;}
.lst li{line-height: 35px; border-bottom: 1px solid #ccc}
.lst li p{font-size: .8em; color:#ff6666;padding: 5px; margin: 0; line-height: 1em;}
.bbtn{text-align: center;padding: 10px;}
h2.bf_title {text-align: center; margin: 10px; border-bottom: 2px solid #104068; line-height: 30px;}
</style>
<h2 class="bf_title"><a href="<?php echo $g4['g4m_path']?>/bbs/board.php?bo_table=<?php echo $bo_table?>" title="<?php echo $board['bo_subject']?>"><?php echo $board['bo_subject']?></a></h2>
<form name='fboardform' action="" method='post' onsubmit="return fboardform_submit(this)" enctype="multipart/form-data">
    <fieldset>
        <legend class="hc">게시판 수정</legend>
        <input type='hidden' name="w"     value="<?php echo $w?>">
        <input type='hidden' name="sfl"   value="<?php echo $sfl?>">
        <input type='hidden' name="stx"   value="<?php echo $stx?>">
        <input type='hidden' name="sst"   value="<?php echo $sst?>">
        <input type='hidden' name="sod"   value="<?php echo $sod?>">
        <input type='hidden' name="page"  value="<?php echo $page?>">
        <input type='hidden' name="token" value="<?php echo $token?>">
        <input type="hidden" name="gr_id" value="<?php echo $board['gr_id']?>">
        <input type="hidden" name="bo_table" value="<?php echo $board['bo_table']?>">
        <ul class="lst">
            <li>
                <?php if ($board['bo_m_use'] == '1') {
                    $chk_use = 'checked="checked"';
                } else {
                    $chk_nuse = 'checked="checked"';
                } ?>
                <input type='checkbox' name='chk_m_use' value='1'> 모바일출력
                <input id="use" type='radio'  name='bo_m_use' value='1' <?php echo $chk_use?>><label for="use">출력</label> <input id="nuse" type='radio'  name='bo_m_use' value='0' <?php echo $chk_nuse?>><label for="nuse">출력안함</label> <p>최신글 출력여부</p>
            </li>
            <li>
                <input type='checkbox' name='chk_m_sort' value='1'> 정렬순서
                <input type='text'  name='bo_m_sort' size="5" value='<?php echo $board['bo_m_sort']?>'> <p>낮은숫자 우선, group.php 에서 사용</p>
            </li>
            <li>
                <input type='checkbox' name='chk_m_skin' value='1'>
                모바일스킨 디렉토리
                <select name='bo_m_skin' required itemname="모바일스킨 디렉토리">
                <?php
                $arr = get_mskin_dir("board");
                for ($i = 0; $i < count($arr); $i++) {
                    echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
                }
                ?>
                </select>
                <script type="text/javascript">document.fboardform.bo_m_skin.value="<?php echo $board['bo_m_skin']?>";</script>
            </li>
            <li>
                <input type='checkbox' name='chk_m_latest_skin' value='1'>
                최신글스킨
                <select name='bo_m_latest_skin' required itemname="최신글스킨">
                <?php
                $arr = get_mskin_dir("latest");
                for ($i = 0; $i < count($arr); $i++) {
                    echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
                }
                ?>
                </select>
                <script type="text/javascript">document.fboardform.bo_m_latest_skin.value="<?php echo $board['bo_m_latest_skin']?>";</script>
            </li>
            <li>
                <input type='checkbox' name='chk_m_latest_rows' value='1'> 최신글 개수
                <input type='text' name='bo_m_latest_rows' size='10' required itemname='최신글 개수' value='<?php echo $board['bo_m_latest_rows']?>'><p>최근게시물 줄 수</p>
            </li>
            <li>
                <input type='checkbox' name='chk_m_table_width' value='1'> 게시판 폭
                <input type='text' name='bo_m_table_width' size='10' required itemname='게시판 테이블 폭' value='<?php echo $board['bo_m_table_width']?>'><p>100 이하 %</p>
            </li>
            <li>
                <input type='checkbox' name=chk_m_page_rows value='1'> 페이지당 목록 수
                <input type='text' name='bo_m_page_rows' size='10' required itemname='페이지당 목록 수' value='<?php echo $board['bo_m_page_rows']?>'><p>list.php 목록수</p>
            </li>
            <li>
                <input type='checkbox' name='chk_m_subject_len' value='1'> 제목 길이
                <input type='text'  name='bo_m_subject_len' size='10' required itemname='제목 길이' value='<?php echo $board['bo_m_subject_len']?>'> <p>목록 제목 글자수. 잘리는 글 … 로 표시</p>
            </li>
            <li>
                <input type='checkbox' name='chk_m_latestsub_len' value='1'> 최신글 제목 길이
                <input type='text'  name='bo_m_latestsub_len' size='10' required itemname='최신글 제목 길이' value='<?php echo $board['bo_m_latestsub_len']?>'> <p>최신글 제목 글자수. 잘리는 글 … 로 표시</p>
            </li>
            <li>
                <input type='checkbox' name='chk_m_image_width' value='1'> 이미지 폭 크기
                <input type='text'  name='bo_m_image_width' size='10' required itemname='이미지 폭 크기' value='<?php echo $board['bo_m_image_width']?>'> 픽셀 <p>(내용보기 이미지의 폭 크기)</p>
            </li>

            <li>
                <input type='checkbox' name='chk_m_include_head' value='1'> 상단 파일 경로
                <input type='text'  name='bo_m_include_head' style='width:100%;' value='<?php echo $board['bo_m_include_head']?>'>
            </li>
            <li>
                <input type='checkbox' name='chk_m_include_tail' value='1'> 하단 파일 경로
                <input type='text'  name='bo_m_include_tail' style='width:100%;' value='<?php echo $board['bo_m_include_tail']?>'>
            </li>
            <li>
                <input type='checkbox' name=chk_m_content_head value='1'> 상단 내용
                <p>
                    <textarea  name='bo_m_content_head' rows='5' cols="" style='width:100%;'><?php echo $board['bo_m_content_head'] ?></textarea>
                </p>
            </li>
            <li>
                <input type='checkbox' name=chk_m_content_tail value='1'> 하단 내용
                <p>
                    <textarea  name=bo_m_content_tail rows='5' cols="" style='width:100%;'><?php echo $board['bo_m_content_tail'] ?></textarea>
                </p>
            </li>
        </ul>
        <div class="bbtn">
            <button type="submit" class="btn">확인</button>
            <input type=button class=btn value='  목  록  ' onclick="document.location.href='./board_list.php?<?php echo $qstr?>';">
        </div>
        
    </fieldset>

</form>

<script type="text/javascript">

function fboardform_submit(f) {
    f.action = "./board_form_update.php";
    return true;
}
</script>

<?php
include_once "./admin.tail.php";
?>
