<?php

/*$endmonth = '02';
$endyear = '2023';
$EndMonth = sprintf('%02d', $endmonth);
            $EndYear = $endyear;
            $durationto = "{$EndYear}-{$EndMonth}";
            echo $durationto;*/
            
            if(isset($_POST['currentstory']) && $_POST['currentstory'] != '') {
                return "success";
            }else {
                return "error";
            }
?> 