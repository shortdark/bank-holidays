<?php
/**
 * Created by PhpStorm.
 * User: Neil
 * Date: 17/02/2019
 * Time: 19:16
 */

$json_url = 'https://www.gov.uk/bank-holidays.json';
$data = file_get_contents($json_url);
$hols = json_decode($data, true);

/**
 * Get all bank holidays this year and make the future bank holidays BOLD
 */
foreach ($hols['england-and-wales']['events'] as $hol){
    if(date('Y') == substr($hol['date'], 0,4)){

/*
        $date1 = DateTime::createFromFormat('Y-m-d', $hol['date']);
        echo "<p>Date: " . $date->format('l dS M, Y') . "</p>\n";
        $unix_timestamp1 = $date1->format('U'); // This would create the unix timestamp for the correct day, but it would be at the current time which is not what we want.
*/

//        Use mktime to create the unix timestamp for the start of the bank holiday
        $unix_timestamp2 = mktime(0, 0, 0, substr($hol['date'], 5,2), substr($hol['date'], 8,2), substr($hol['date'], 0,4));

        if($hol['date'] == date('Y-m-d')) {
            // The bank holiday is today, yippeeee!
            echo "<p style='color:red;'><strong>{$hol['date']}</strong></p>\n";
        }elseif($hol['date'] > date('Y-m-d')){
            // Future Bank Holidays this year
            echo "<p><strong>{$hol['date']}</strong> - $unix_timestamp2</p>\n";
        }else{
            // Bank Holidays that are in the past
            echo "<p>{$hol['date']}</p>\n";
        }
    }
}
