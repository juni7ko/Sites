<?php
    // 문자메세지 받는 사람 3명(예약자, 펜션관리자, 스테이스토어)
    $phone[0] = "123"; //펜션관리자
    $phone[1] = "456"; // 스테이스토어
    $phone[2] = "789";
    $rcv_number = join(",", $phone);
    echo $rcv_number;
?>