
<?php
use Carbon\Carbon;

if (!function_exists('formatShortDates')) {
    function formatShortDates($date)
    {
        $date = Carbon::parse($date);
        $now = Carbon::now();

        if ($date->isToday()) {
            return 'Today';
        } elseif ($date->isYesterday()) {
            return 'Yesterday';
        } elseif ($date->diffInDays($now) <= 2) {
            return $date->diffForHumans();
        } else {
            return $date->toFormattedDateString(); // or any other format you prefer
        }
    }
}

?>
