<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

//썸네일 기본값 설정
$thumb_w = '64'; //썸네일넓이
$thumb_h = '64';   //썸네일높이

$data_path = $g4['path'] . "/data/file/" . $bo_table;
$thumb_path = $data_path . "/thumb_" . $skin_dir;

if (!is_dir($thumb_path)){
  @mkdir($thumb_path, 0707);
  @chmod($thumb_path, 0707);
}
?>

<script type="text/javascript" src="<?php echo $g4['path']?>/skin/latest/showmotel-main-gallery/js/showmotel.js"></script>
<script type="text/javascript" src="<?php echo $g4['path']?>/skin/latest/showmotel-main-gallery/js/supersized.3.2.7.min.js"></script>
<script type="text/javascript" src="<?php echo $g4['path']?>/skin/latest/showmotel-main-gallery/js/supersized.shutter.js"></script>

	<!--Thumbnail Navigation-->
	<div id="prevthumb"></div>
	<div id="nextthumb"></div>
	
	<!--Arrow Navigation-->
	<a id="prevslide" class="load-item"></a>
	<a id="nextslide" class="load-item"></a>
	
	<div id="thumb-tray" class="load-item">
		<div id="thumb-back"></div>
		<div id="thumb-forward"></div>
	</div>

			<!--Slide captions displayed here-->
			<div id="slidecaption"></div>
	
	<!--Control Bar-->
	<div id="controls-wrapper" class="load-item">
		<div id="controls">
			
			<!--Navigation-->
			<ul id="slide-list"></ul>
			
		</div>
	</div>

	<script type="text/javascript">
	jQuery(function($){

	$.supersized({
		// Functionality
		slideshow:1,						// Slideshow on/off
		autoplay:1,							// Slideshow starts playing automatically
		start_slide:1,						// Start slide (0 is random)
		stop_loop:0,						// Pauses slideshow on last slide
		random:0,							// Randomize slide order (Ignores start slide)
		slide_interval:4500,				// Length between transitions
		transition:1, 						// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
		transition_speed:500,				// Speed of transition
		new_window:0,						// Image links open in new window/tab [0:self, 1:new-window]
		pause_hover:0,						// Pause slideshow on hover
		keyboard_nav:1,						// Keyboard navigation on/off
		performance:1,						// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
		image_protect:1,					// Disables image dragging and right click with Javascript

		// Size & Position
		min_width:0,						// Min width allowed (in pixels)
		min_height:0,						// Min height allowed (in pixels)
		vertical_center:1,					// Vertically center background [0:left / 1:center]
		horizontal_center:1,				// Horizontally center background [0:top /1:center]
		fit_always:0,						// Image will never exceed browser width or height (Ignores min. dimensions)
		fit_portrait:1,						// Portrait images will not exceed browser height
		fit_landscape:0,					// Landscape images will not exceed browser width

		// Components
		slide_links:'blank',				// Individual links for each slide (Options: false, 'num', 'name', 'blank')
		thumb_links:1,						// Individual thumb links for each slide
		thumbnail_navigation:0,				// Thumbnail navigation

		// Slideshow Images

		slides:[
<?php for ($i=0; $i<count($list); $i++) { 
					if($list[$i][file][0][view]){
						$src = $list[$i][file][0][path]."/".$list[$i][file][0][file];
					}
			
	?>
			{
				image : '<?php echo $src;?>',
				title : '<?php echo $li[subject]?>'
			},


	<?php }
	if ($i==0) { echo "<li style='width:100%; text-align:center; padding:10px 0; border-top:1px solid #ddd;'>게시물이 없습니다.</li>"; }
    ?>

			{
				image : 'img/main-visual.jpg',
				title : '고정적으로 보여줄 대표 이미지'
			}
		],

		// Theme Options			   
		progress_bar:0,			// Timer for each slide							
		mouse_scrub:0

		});
	});
	</script>
