<?php
/**
 * Created by PhpStorm.
 * User: Neil
 * Date: 17/02/2019
 * Time: 19:16
 */

$json_url = 'https://www.gov.uk/bank-holidays.json';

/*
 * england-and-wales
 * events
 * title, date
 */

$data = file_get_contents($json_url);
$hols = json_decode($data, true);

//var_dump($hols);
//var_dump($hols['england-and-wales']['events']);

foreach ($hols['england-and-wales']['events'] as $hol){
    if(date('Y') == substr($hol['date'], 0,4)){
        $date = DateTime::createFromFormat('Y-m-d', $hol['date']);
        echo "<p>Date: " . $date->format('l dS M, Y') . "</p>\n";
    }
}
