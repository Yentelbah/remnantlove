
<?php
use Carbon\Carbon;

if (!function_exists('generateChurchID')) {
    function generateChurchID($churchId)
    {
        $year = date('y');
        $month = date('m');
        $randomNumber = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        $churchId = $year . $month . $randomNumber;

        return $churchId;
    }
}


?>

