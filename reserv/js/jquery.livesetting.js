$(document).ready(function() {
	
	var Arrays=new Array();
	

	
	$('.remove').livequery('click', function() {
		
		var deduct = $(this).parent().children(".shopp-price").find('em').html();
		
		var thisID = $(this).parent().attr('id').replace('each-','');
		
		var pos = getpos(Arrays,thisID);
		Arrays.splice(pos,1,"0")
		
		prev_charges = parseInt(prev_charges)-parseInt(deduct);
		$('#total-hidden-charges').val(prev_charges);
		$(this).parent().remove();
		
	});	
	
	$('#Submit').livequery('click', function() {
		
		var totalCharge = $('#total-hidden-charges').val();
		
		$('#cart_wrapper').html('Total Charges: $'+totalCharge);
		
		return false;
		
	});	
	
	// this is for 2nd row's li offset from top. It means how much offset you want to give them with animation
	var single_li_offset 	= 200;
	var current_opened_box  = -1;
	
	$('.open').click(function() {//클릭임
		
		var thisID = $(this).attr('id');
		var $this  = $(this);
		
		var id = $('.open').index($this);
		if(current_opened_box == id) // if user click a opened box li again you close the box and return back
		{
			$('.detail-view').slideUp('300');
			current_opened_box = '-1';
			return false;

		}
		$('#cart_wrapper').slideUp('300');
		$('.detail-view').slideUp('300');
		
		// save this id. so if user click a opened box li again you close the box.
		current_opened_box = id;
		
		var targetOffset = 0;
		
		// below conditions assumes that there are four li in one row and total rows are 4. How ever if you want to increase the rows you have to increase else-if conditions and if you want to increase li in one row, then you have to increment all value below. (if(id<=3)), if(id<=7) etc


		$('#wrap #detail-'+thisID).slideDown(300);
			return false;
		});//클릭임 끝



/*
		if(id<=6)
			targetOffset = 0;
		else if(id<=2)
			targetOffset = single_li_offset;
		else if(id<=4)
			targetOffset = single_li_offset*2;
		else if(id<=8)
			targetOffset = single_li_offset*3;
		else if(id<=11)
			targetOffset = single_li_offset*4;
		else if(id<=15)
			targetOffset = single_li_offset*5;
		else if(id<=19)
			targetOffset = single_li_offset*6;
		
		$("html:not(:animated),body:not(:animated)").animate({scrollTop: targetOffset}, 500,function(){			
			$('#detail-'+thisID).slideDown(300);
			return false;
		});
	}); */
	//클릭임 끝
	
	$('.close a').click(function() {
		
		$('.detail-view').slideUp('300');
		
	});
	
});

function include(arr, obj) {
  for(var i=0; i<arr.length; i++) {
    if (arr[i] == obj) return true;
  }
}

function getpos(arr, obj) {
  for(var i=0; i<arr.length; i++) {
    if (arr[i] == obj) return i;
  }
}
