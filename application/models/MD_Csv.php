<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Csv extends CI_Model{
    public function removePercentage($value) {
        return str_replace('%', '', $value);
    }
    public function is_valid_date($date_str, $format = 'd/m/Y') {
        $d = DateTime::createFromFormat($format, $date_str);
        if ($d && $d->format($format) === $date_str) {
            return $d->format('Y-m-d'); 
        }
        return false;
    }
    function validateDateString($dateString) {
        // Define the expected formats
        $formats = array(
            "d/m/Y",
            "m/d/Y"
        );
        
        // Set the desired timezone
        date_default_timezone_set('UTC'); // Change 'UTC' to your desired timezone
        
        foreach ($formats as $format) {
            $dateTime = DateTime::createFromFormat($format, $dateString);
            
            // Check if the date was successfully parsed
            if ($dateTime && $dateTime->format('d/m/Y') == $dateString) {
                return true;
            }
        }
        
        // Return false if no valid format was found
        return false;
    }
    
    public function is_valid_time($time_str, $format = 'H:i:s') {
        $d = DateTime::createFromFormat($format, $time_str);
        if ($d && $d->format($format) === $time_str) {
            return $d->format($format);
        }
        return false;
    }    
    public function is_valid_datetime($datetime_str, $format = 'd/m/Y H:i:s') {
        $d = DateTime::createFromFormat($format, $datetime_str);
        if ($d && $d->format($format) === $datetime_str) {
            return $d->format($format);
        }
        return false;
    }
    
    public function is_positive($amount) {
        return $amount >= 0;
    }
    public function is_decimal($amount) {
        return is_float($amount) || is_numeric($amount) && strpos($amount, '.') !== false;
    }
}
?>