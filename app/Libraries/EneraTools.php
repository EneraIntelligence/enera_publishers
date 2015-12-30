<?php
/**
 * Created by PhpStorm.
 * User: pedroluna
 * Date: 12/30/15
 * Time: 5:05 PM
 */

namespace Publishers\Libraries;

class EneraTools
{
    static function Getfloat($str)
    {
        if (strstr($str, ",")) {
            $str = str_replace(".", "", $str); // replace dots (thousand seps) with blancs
            $str = str_replace(",", ".", $str); // replace ',' with '.'
        }

        if (preg_match("#([0-9\.]+)#", $str, $match)) { // search for number that may contain '.'
            return floatval($match[0]);
        } else {
            return floatval($str); // take some last chances with floatval
        }
    }
}