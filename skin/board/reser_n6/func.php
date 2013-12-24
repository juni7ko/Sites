<?php 

        function get_this_days_reservation($month, $day, $year, $toopenwindow){ 
                $date_timetable = mktime(0,0,0, $month, $day, $year); 
                $query = "select * from blue_list where blue_date=$date_timetable order by blue_date desc"; 
                $result = mysql_query($query); 
                $total = mysql_num_rows($result); 
                for($i = 0; $i < $total; $i++){ 
                        $row = mysql_fetch_row($result); 
                        $start_time = date('H:i', $row[3]); 
                        $end_time = date('H:i', $row[4]); 
                        $output = $output . "<center><br>[$start_time~$end_time]<br><a href=# onclick=\"javascript:window.open('$toopenwindow?no=$row[0]','showDetail','status=no,toolbar=no,menubar=no,resizable=no,width=400,height=500')\">$row[1]</a></center>"; 
                } 
                return $output; 
        } 
        
    function alert_and_close($mes){ 
                echo("<script language=javascript> 
                        <!-- 
                                alert('$mes'); 
                                window.close(); 
                        //--> 
                        </script>"); 
                return; 
        } 
        function alert_and_back($mes){ 
                echo("<script language=javascript> 
                        <!-- 
                                alert('$mes'); 
                                history.back(); 
                        //--> 
                        </script>"); 
    } 
        function check_the_week($ca_date, $memb){ 
                $tmp_w = date('w', $ca_date); 
                $find_week1 = $ca_date - (86400 * $tmp_w); 
                $find_week2 = $ca_date - ((6 - $tmp_w) * 86400); 
                $query_day = "blue_date >= $find_week1 and blue_union = \"$memb\""; 
                $query = "select * from blue_list where $query_day limit 1"; 
                $result = mysql_query($query); 
                $total_line = mysql_num_rows($result); 
                if (!$total_line) { 
                        return true; 
                } else { 
                        return false; 
                } 
        } 
?> 

