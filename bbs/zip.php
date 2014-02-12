<?php
include_once("./_common.php");

// 검색 타입에 따른 검색단어 설정
if($type == "old") { $addr1 = $addr4; }
if($type == "newdong") { $addr1 = $addr2." ".$addr3; }

if ($addr1)
{

	// 신주소 소켓통신 요청
	function HTTP_Post($URL,$data) {
		$URL_Info=parse_url($URL);
		if(!empty($data)) foreach($data AS $k => $v) $str .= urlencode($k).'='.urlencode($v).'&';
		$path = $URL_Info["path"];
		$host = $URL_Info["host"];
		$port = $URL_Info["port"];
		if (empty($port)) $port=80;

		$result = "";
		$fp = fsockopen($host, $port, $errno, $errstr, 30);
		$http  = "POST $path HTTP/1.0\r\n";
		$http .= "Host: $host\r\n";
		$http .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$http .= "Content-length: " . strlen($str) . "\r\n";
		$http .= "Connection: close\r\n\r\n";
		$http .= $str . "\r\n\r\n";
		fwrite($fp, $http);
		while (!feof($fp)) { $result .= fgets($fp, 4096); }
		fclose($fp);
		return $result;
	}

	$url  = "http://post.phpschool.com/phps.kr"; // 신주소 api URL
	$data = array("addr"=>$addr1, "ipkey"=>"2051114", "charset"=>"UTF-8", "type"=>$type); // UTF-8일경우 "UTF-8" 로 기재

	$output = (HTTP_Post($url, $data));
	$output = substr($output, strpos($output,"\r\n\r\n")+4);

	$output = unserialize($output);
	$result = $output['result'];

	if ($result > 0) {
		$post_data = unserialize($output['post']);

		for ($i=0; $i<$result; $i++) {

			//$post_data[$i]['post'];              // 우편번호
			//$post_data[$i]['addr_1'];            // 시/도
			//$post_data[$i]['addr_2'];            // 구
			//$post_data[$i]['addr_3'];            // 도로명
			//$post_data[$i]['addr_4'];            // 동/건물
			$list[$i][zip1] = substr($post_data[$i]['post'],0,3);
			$list[$i][zip2] = substr($post_data[$i]['post'],3,3);
			$list[$i][addr] = $post_data[$i]['addr_1']." ".$post_data[$i]['addr_2']." ".$post_data[$i]['addr_3'];
			$list[$i][addr2] = $post_data[$i]['addr_4'];
			$list[$i][bunji] = "<br /><span style='padding-left:1px;'>[ 구주소 : ".$post_data[$i]['addr_5']." ]</span>";
			$list[$i][encode_addr] = urlencode($list[$i][addr]);
		}
	} else if ($result == 0) {

		alert("찾으시는 주소가 없습니다.");

	} else if ($result < 0) {

		switch($result) {
			case "-1":
				alert("검색결과가 너무 많습니다. 2단어 이상 조합해 주세요.");
				break;
			case "-2":
				alert("미인증 IP입니다. http://post.phpschool.com/join.html에 접속하여 API를 신청해 주세요.");
				break;
			case "-3":
				alert("1일 조회 횟수가 초과되었습니다.");
				break;
			case "-4":
				alert("이메일 인증을 완료하지 않은 API 사용자입니다.");
				break;
		}

		// $result  "-1"  일경우 :  너무많은검색결과 1000건이상
		// $result  "-2"  일경우 :  서버 IP 미인증
		// $result  "-3"  일경우 :  조회횟수초과
		// $result  "-4"  일경우 :  미인증 사용자
	}

	$search_count = $output[result];
}


// 메모리를 많이 잡아먹어서 아래의 코드로 대체
//ini_set('memory_limit', '20M');
//$zipfile = file("./zip.db");
/*
$zipfile = array();
$fp = fopen("./zip.db", "r");
while(!feof($fp)) {
    $zipfile[] = fgets($fp, 4096);
}
fclose($fp);

$search_count = 0;

if ($addr1)
{
    while ($zipcode = each($zipfile))
    {
        if(strstr(substr($zipcode[1],9,512), $addr1))
        {
            $list[$search_count][zip1] = substr($zipcode[1],0,3);
            $list[$search_count][zip2] = substr($zipcode[1],4,3);
            $addr = explode(" ", substr($zipcode[1],8));

            if ($addr[sizeof($addr)-1])
            {
                $list[$search_count][addr] = str_replace($addr[sizeof($addr)-1], "", substr($zipcode[1],8));
                $list[$search_count][bunji] = trim($addr[sizeof($addr)-1]);
            }
            else
                $list[$search_count][addr] = substr($zipcode[1],8);

            $list[$search_count][encode_addr] = urlencode($list[$search_count][addr]);
            $search_count++;
        }
    }

    if (!$search_count) alert("찾으시는 주소가 없습니다.");
}

/* 기존의 DB에서 불러오는 방식
if ($addr1)
{
    //$sql = " select * from $g4[zip_table] where zp_dong like '%$addr1%' order by zp_id ";
    $sql = " select * from $g4[zip_table] where zp_dong like '%$addr1%' order by zp_sido, zp_gugun, zp_dong ";
    $result = sql_query($sql);
    $search_count = 0;
    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
        $list[$i][zip1] = substr($row[zp_code], 0, 3);
        $list[$i][zip2] = substr($row[zp_code], 3, 3);
        $list[$i][addr] = "$row[zp_sido] $row[zp_gugun] $row[zp_dong]";
        $list[$i][bunji] = $row[zp_bunji];
        $list[$i][encode_addr] = urlencode($list[$i][addr]);
        $search_count++;
    }

    if (!$search_count)
        alert("찾으시는 주소가 없습니다.");
}
*/

$g4[title] = "우편번호 검색";
include_once("$g4[path]/head.sub.php");

$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";
include_once("$member_skin_path/zip.skin.php");

include_once("$g4[path]/tail.sub.php");
?>
