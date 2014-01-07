<?php
	if(!$pension_id) alert("Error");
	if(!$write_table) alert("Error2");
	// 데이터 저장시 펜션정보에 최대 할인율과 최저 가격 입력 - Start
	// 최대 할인율
	$max_rate = sql_fetch(" SELECT MAX(r_cost_21) as r1, MAX(r_cost_22) as r2 , MAX(r_cost_23) as r3 , MAX(r_cost_24) as r4 , MAX(r_cost_25) as r5  FROM {$write_table}_r_cost WHERE pension_id = '$pension_id' ");
	$max_rate2 = $max_rate[r1];

	for($i=1; $i < 6; $i++) {
		if($max_rate2 < $max_rate["r{$i}"])
			$max_rate2 = $max_rate["r{$i}"];
	}

	$max_rate3 = sql_fetch(" SELECT MAX(r_date_cost_11) as r1, MAX(r_date_cost_12) as r2 , MAX(r_date_cost_13) as r3 , MAX(r_date_cost_14) as r4 , MAX(r_date_cost_15) as r5  FROM {$write_table}_r_date_cost WHERE pension_id = '$pension_id' ");
	$max_rate4 = $max_rate3[r1];

	for($i=1; $i < 6; $i++) {
		if($max_rate4 < $max_rate3["r{$i}"])
			$max_rate4 = $max_rate3["r{$i}"];
	}

	if($max_rate2 < $max_rate4) $max_rate2 = $max_rate4;

	$sql2 = "UPDATE g4_write_pension_info SET discount = '$max_rate2' WHERE pension_id ='$pension_id' LIMIT 1";
	$result2 = sql_fetch($sql2);

	// 최저 가격
	$lowPrice = sql_fetch(" SELECT MIN(r_cost_31) as r1, MIN(r_cost_32) as r2 , MIN(r_cost_33) as r3 , MIN(r_cost_34) as r4 , MIN(r_cost_35) as r5  FROM {$write_table}_r_cost WHERE pension_id = '$pension_id' ");
	$lowPrice2 = $lowPrice[r1];

	for($i=1; $i < 6; $i++) {
		if($lowPrice2 > $lowPrice["r{$i}"])
			$lowPrice2 = $lowPrice["r{$i}"];
	}

	$sql2 = "UPDATE g4_write_pension_info SET lowPrice = '$lowPrice2' WHERE pension_id ='$pension_id' LIMIT 1";
	$result2 = sql_fetch($sql2);

	$lowPrice3 = sql_fetch(" SELECT MIN(r_date_cost_21) as r1, MIN(r_date_cost_22) as r2 , MIN(r_date_cost_23) as r3 , MIN(r_date_cost_24) as r4 , MIN(r_date_cost_25) as r5  FROM {$write_table}_r_date_cost WHERE pension_id = '$pension_id' ");
	$lowPrice4 = $lowPrice3[r1];

	for($i=1; $i < 6; $i++) {
		if($lowPrice4 > $lowPrice3["r{$i}"])
			$lowPrice4 = $lowPrice3["r{$i}"];
	}

	if($lowPrice2 > $lowPrice4) $lowPrice2 = $lowPrice4;

	$sql3 = "UPDATE g4_write_pension_info SET lowPrice2 = '$lowPrice2' WHERE pension_id ='$pension_id' LIMIT 1";
	$result3 = sql_fetch($sql3);
	// 데이터 저장시 펜션정보에 최대 할인율과 최저 가격 입력 - End
?>