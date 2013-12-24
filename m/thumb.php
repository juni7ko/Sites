<?php

$phpver = substr(phpversion(), 0, 1);

$img_path = "../data/file/{$_GET['bo_table']}/{$_GET['img']}";
$img = $img_path;
if (!$_GET['img'])
    exit();
//php 4.x 에서 썸네일 생성 되게 수정.
if ($phpver < 5) {
    //php 4.x
    require_once './lib/thumb/thumbnail.inc.php';
    if (strstr($img, "http") || file_exists($img)) {
        $thumb = new Thumbnail($img);
        $thumb->resize($_GET['w'], $_GET['h']);
        $thumb->show();
        $thumb->destruct();
    } else {
        //없는 이미지는 PHP Fatal error 안나게 1px 투명 gif 출력
        header("Content-Type: image/gif");
        header("Content-Length: 43");

        echo chr(0x47) . chr(0x49) . chr(0x46) . chr(0x38) . chr(0x39) . chr(0x61) . chr(0x01) . chr(0x00) .
        chr(0x01) . chr(0x00) . chr(0x80) . chr(0x00) . chr(0x00) . chr(0x04) . chr(0x02) . chr(0x04) .
        chr(0x00) . chr(0x00) . chr(0x00) . chr(0x21) . chr(0xF9) . chr(0x04) . chr(0x01) . chr(0x00) .
        chr(0x00) . chr(0x00) . chr(0x00) . chr(0x2C) . chr(0x00) . chr(0x00) . chr(0x00) . chr(0x00) .
        chr(0x01) . chr(0x00) . chr(0x01) . chr(0x00) . chr(0x00) . chr(0x02) . chr(0x02) . chr(0x44) .
        chr(0x01) . chr(0x00) . chr(0x3B);
    }
} else {
    //php 5.x
    require_once './lib/thumb/ThumbLib.inc.php';
    if (strstr($img, "http") || file_exists($img)) {
        // 원격 이미지 또는 서버에 이미지가 있을경우
        $thumb = PhpThumbFactory::create($img);
        if ($_GET['w'] && $_GET['h']) {
            if ($_GET['crop'] == 1) {
                $thumb->cropFromCenter('800', '600');
            }
            $thumb->resize($_GET['w'], $_GET['h']);
        } elseif ($_GET['w']) {
            $thumb->resize($_GET['w']);
        }
        if ($_GET['q']) {
            $jpegQuality = $_GET['q'];
        } else {
            $jpegQuality = 75;
        }
        $thumb->setOptions(array('jpegQuality' => $jpegQuality));
        $thumb->show();
    } else {
        //없는 이미지는 PHP Fatal error 안나게 1px 투명 gif 출력
        header("Content-Type: image/gif");
        header("Content-Length: 43");

        echo chr(0x47) . chr(0x49) . chr(0x46) . chr(0x38) . chr(0x39) . chr(0x61) . chr(0x01) . chr(0x00) .
        chr(0x01) . chr(0x00) . chr(0x80) . chr(0x00) . chr(0x00) . chr(0x04) . chr(0x02) . chr(0x04) .
        chr(0x00) . chr(0x00) . chr(0x00) . chr(0x21) . chr(0xF9) . chr(0x04) . chr(0x01) . chr(0x00) .
        chr(0x00) . chr(0x00) . chr(0x00) . chr(0x2C) . chr(0x00) . chr(0x00) . chr(0x00) . chr(0x00) .
        chr(0x01) . chr(0x00) . chr(0x01) . chr(0x00) . chr(0x00) . chr(0x02) . chr(0x02) . chr(0x44) .
        chr(0x01) . chr(0x00) . chr(0x3B);
    }
}
/* ?>뒤로공백 있으면 안됨 */
?>
