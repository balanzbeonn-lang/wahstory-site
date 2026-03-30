<?php
// Original date and time
$datetime = "2025-02-10 13:25:00";
echo "Datime is: $datetime <br>";
// Original timezone
$timezoneA = new DateTimeZone('+5:30');

// Target timezone
$timezoneB = new DateTimeZone('-11:00');

// Create DateTime object with original time and timezone
$date = new DateTime($datetime, $timezoneA);

// Convert to new timezone
$date->setTimezone($timezoneB);

// Output the result
echo $date->format('Y-m-d H:i:s'); // Format it as desired
?>
