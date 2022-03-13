<?php

namespace nakidori\FakeBAN;

class FormatTranslator {
    
    public static function translate(String $format, $array) : string{
        $parameters = self::getParameters($format);
        $key = 0;
        foreach ($parameters as $param) {
            var_dump($param[0]." => ".$array[$key]);
            $format = str_replace($param[0], $array[$key] ?? "", $format);
            $key++;
        }
        return $format;
    }

    public static function getParameters(String $format) : array{
        preg_match_all("/{.+}/", $format, $mathces, PREG_SET_ORDER);
        return $mathces;
    }

}
