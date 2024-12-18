<?php

namespace App\Utils;

class Helpers {
    /**
     * Retrieves the value of a specific setting from an array of settings.
     *
     * @param array $object The array of settings.
     * @param string $option_value The name of the setting to retrieve.
     * @return mixed|null The value of the setting, or null if it is not found.
     */
    public static function getSettings($object, $option_value) {
        $config = null;

        foreach ($object as $value) {
            //$value['option_name'] = json_decode($value['option_value'], true);
            if ($value['option_name'] == $option_value) {
                $config = $value['option_value'];
            }
        }

        return $config;
    }

    /**
     * Converts a string to camel case.
     *
     * @param string $string The string to be converted.
     * @return string The converted string in camel case.
     */
    public static function camel_case($string) {
        $result = strtolower($string);
        preg_match_all('/_[a-z]/', $result, $matches);
        foreach ($matches[0] as $match) {
            $c = str_replace('_', '', strtoupper($match));
            $result = str_replace($match, $c, $result);
        }
        return $result;
    }
}
