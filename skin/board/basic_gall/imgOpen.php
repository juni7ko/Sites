<?php include_once("./_common.php");
$g4[title] = "원본 이미지 보기";

function ResizeImage($Image, $ThumbSize)
{
  $ImageSize = @getimagesize($Image);
  if($ImageSize[0] > $ThumbSize || $ImageSize[1] > $ThumbSize)
  {
    if($ImageSize[0] > $ImageSize[1])
    {
      $ImageWidth = $ImageSize[0] * $ThumbSize / $ImageSize[0];
      $ImageHeight = $ImageSize[1] * $ThumbSize / $ImageSize[0];
    }
    else
    {
      $ImageWidth = $ImageSize[0] * $ThumbSize / $ImageSize[1];
      $ImageHeight = $ImageSize[1] * $ThumbSize / $ImageSize[1];
    }
  }
  else
  {
    $ImageWidth = $ImageSize[0];
    $ImageHeight = $ImageSize[1];
  }
  return array((int)($ImageWidth), (int)($ImageHeight));
}

$brd_bo_1 = 800;
$brd_bo_2 = 600;
$brd_bo_9 = 80;

$wr_id2 = $wr_id . "_2";
$file = $img_url;
$data_path = $g4[path]."/data/file/$bo_table";
$thumb_path = $data_path.'/thumb';
$thumb = $thumb_path.'/'.$wr_id2;
$file = $data_path .'/'. $img_url;

list($brd_bo_1, $brd_bo_2) = ResizeImage($file, $brd_bo_1);

@mkdir($thumb_path, 0707);
@chmod($thumb_path, 0707);

if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file) && file_exists($file))
{
		$size = getimagesize($file);
		if ($size[2] == 1)
				$src = imagecreatefromgif($file);
		else if ($size[2] == 2)
				$src = imagecreatefromjpeg($file);
		else if ($size[2] == 3)
				$src = imagecreatefrompng($file);
		else
				continue;

		$rate = $brd_bo_1 / $size[0];
		$height = (int)($size[1] * $rate);

		if ($height < $brd_bo_2)
				$dst = imagecreatetruecolor($brd_bo_1, $height);
		else
				$dst = imagecreatetruecolor($brd_bo_1, $brd_bo_2);
		imagecopyresampled($dst, $src, 0, 0, 0, 0, $brd_bo_1, $height, $size[0], $size[1]);
		imagejpeg($dst, $thumb_path.'/'.$wr_id2, $brd_bo_9);
		chmod($thumb_path.'/'.$wr_id2, 0606);
}
?>
<html>
<head>
<title>이미지 보기</title>
<script>
  function init()
  {
     window.resizeBy(document.all.pop_img.width-document.body.clientWidth, document.all.pop_img.height-document.body.clientHeight);

  }
</script>
</head>
<body bgcolor=white topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="init();">
<a href="javascript:self.close();"><img src="<?=$thumb?>" border="0" id="pop_img"></a>
</body>
</html>
