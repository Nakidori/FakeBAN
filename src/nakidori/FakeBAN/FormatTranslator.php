<?php

namespace nakidori\FakeBAN;

class FormatTranslator {
    
    public static function translate(String $format, $array) : string{
        $parameters = self::getParameters($format);
        foreach ($parameters as $key => $param) {
            $format = str_replace($param[0], $array[$key] ?? "", $format);
        }
        return $format;
    }

    public static function getParameters(String $format) : array{
        preg_match_all("/{.+}/", $format, $mathces, PREG_SET_ORDER);
        return $mathces;
    }

}
