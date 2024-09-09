<?php

if (!function_exists('format_number_short')) {
    function format_number_short($number, $precision = 1)
    {
        if ($number >= 1000000000) {
            // Billion
            return round($number / 1000000000, $precision) . 'B';
        } elseif ($number >= 1000000) {
            // Million
            return round($number / 1000000, $precision) . 'M';
        } elseif ($number >= 1000) {
            // Thousand
            return round($number / 1000, $precision) . 'K';
        }

        // Less than thousand
        return $number;
    }
}
