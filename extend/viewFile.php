<?php
function view_file_link2($file, $width, $height, $content="")
{
    global $config, $board;
    global $g4;
    static $ids;

    if (!$file) return;

    $ids++;

    // 파일의 폭이 게시판설정의 이미지폭 보다 크다면 게시판설정 폭으로 맞추고 비율에 따라 높이를 계산
    if ($width > $board[bo_image_width] && $board[bo_image_width])
    {
        $rate = $board[bo_image_width] / $width;
        $width = $board[bo_image_width];
        $height = (int)($height * $rate);
    }

    // 폭이 있는 경우 폭과 높이의 속성을 주고, 없으면 자동 계산되도록 코드를 만들지 않는다.
    if ($width)
        $attr = " width='$width' height='$height' ";
    else
        $attr = "";

    if (preg_match("/\.($config[cf_image_extension])$/i", $file))
        // 이미지에 속성을 주지 않는 이유는 이미지 클릭시 원본 이미지를 보여주기 위한것임
        // 게시판설정 이미지보다 크다면 스킨의 자바스크립트에서 이미지를 줄여준다
        return "<img src='$g4[path]/data/file/$board[bo_table]/".urlencode($file)."' ".$attr."  name='target_resize_image[]'  onclick='image_window(this);' style='cursor:pointer;' title='$content'>";
    /*
    // 110106 : FLASH XSS 공격으로 인하여 코드 자체를 막음
    else if (preg_match("/\.($config[cf_flash_extension])$/i", $file))
        //return "<embed src='$g4[path]/data/file/$board[bo_table]/$file' $attr></embed>";
        return "<script>doc_write(flash_movie('$g4[path]/data/file/$board[bo_table]/$file', '_g4_{$ids}', '$width', '$height', 'transparent'));</script>";
    */
    //=============================================================================================
    // 동영상 파일에 악성코드를 심는 경우를 방지하기 위해 경로를 노출하지 않음
    //---------------------------------------------------------------------------------------------
    /*
    else if (preg_match("/\.($config[cf_movie_extension])$/i", $file))
        //return "<embed src='$g4[path]/data/file/$board[bo_table]/$file' $attr></embed>";
        return "<script>doc_write(obj_movie('$g4[path]/data/file/$board[bo_table]/$file', '_g4_{$ids}', '$width', '$height'));</script>";
    */
    //=============================================================================================
}

function view_file_link3($file, $width, $height, $content="")
{
    global $config, $board;
    global $g4;
    static $ids;

    if (!$file) return;

    $ids++;

    // 파일의 폭이 게시판설정의 이미지폭 보다 크다면 게시판설정 폭으로 맞추고 비율에 따라 높이를 계산
    if ($width > $board[bo_image_width] && $board[bo_image_width])
    {
        $rate = $board[bo_image_width] / $width;
        $width = $board[bo_image_width];
        $height = (int)($height * $rate);
    }

    // 폭이 있는 경우 폭과 높이의 속성을 주고, 없으면 자동 계산되도록 코드를 만들지 않는다.
    if ($width)
        $attr = " width='$width' height='$height' ";
    else
        $attr = "";

    if (preg_match("/\.($config[cf_image_extension])$/i", $file))
        // 이미지에 속성을 주지 않는 이유는 이미지 클릭시 원본 이미지를 보여주기 위한것임
        // 게시판설정 이미지보다 크다면 스킨의 자바스크립트에서 이미지를 줄여준다
        return "<img src='$g4[path]/data/file/$board[bo_table]/".urlencode($file)."' ".$attr."  name='target_resize_image[]' style='cursor:pointer;' title='$content'>";
    /*
    // 110106 : FLASH XSS 공격으로 인하여 코드 자체를 막음
    else if (preg_match("/\.($config[cf_flash_extension])$/i", $file))
        //return "<embed src='$g4[path]/data/file/$board[bo_table]/$file' $attr></embed>";
        return "<script>doc_write(flash_movie('$g4[path]/data/file/$board[bo_table]/$file', '_g4_{$ids}', '$width', '$height', 'transparent'));</script>";
    */
    //=============================================================================================
    // 동영상 파일에 악성코드를 심는 경우를 방지하기 위해 경로를 노출하지 않음
    //---------------------------------------------------------------------------------------------
    /*
    else if (preg_match("/\.($config[cf_movie_extension])$/i", $file))
        //return "<embed src='$g4[path]/data/file/$board[bo_table]/$file' $attr></embed>";
        return "<script>doc_write(obj_movie('$g4[path]/data/file/$board[bo_table]/$file', '_g4_{$ids}', '$width', '$height'));</script>";
    */
    //=============================================================================================
}
?>
