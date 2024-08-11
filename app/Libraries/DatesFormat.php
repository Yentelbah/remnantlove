
<?php
use Carbon\Carbon;

if (!function_exists('formatDateForDisplay')) {
    function formatDateForDisplay($date)
    {
        $now = Carbon::now();
        $diffInDays = $now->diffInDays($date);

        if ($diffInDays == 1) {
            return $date->format('H:i'); // Time if sent within the day
        } elseif ($diffInDays <= 6) {
            return $date->diffForHumans(); // "X days ago" if sent within the last 6 days
        } else {
            return $date->format('Y-m-d'); // Date in Y-m-d format if sent on or before the 7th day
        }
    }
}


?>
