<?php

declare(strict_types=1);
/**
 *  @author   jiongruan
 *  @email    github@jiongruan.com
 */
namespace Jiongruan\HyperfUtils;

class ObjetcUtil
{
    /**
     * object  to array.
     * @param $object
     * @return mixed
     */
    public static function toArray($object)
    {
        return json_decode(json_encode($object), true);
    }

    /** object to array with camel key to underline.
     * @param $object
     * @return null|array|bool|string
     */
    public static function toArrayWithCamelKeytoUnderLine($object)
    {
        $array = self::toArray($object);
        return self::arrayCamelKeytoUnderLine($array);
    }

    /**
     * arrayCamelKeytoUnderLine
     * @param $array
     * @return array|bool|string|null
     */
    protected static function arrayCamelKeytoUnderLine($array)
    {
        if (is_numeric($array)) {
            // 数字时，防止字符太长被转换
            return strval($array);
        }
        if (is_bool($array) || is_string($array) || is_null($array)) {
            return $array;
        }
        $return = [];
        foreach ($array as $key => $value) {
            $return[self::camelStringtoUnderLineString($key)] = self::arrayCamelKeytoUnderLine($value);
        }
        return $return;
    }

    /**
     * camelStringtoUnderLineString
     * @param $string
     * @return string
     */
    protected static function camelStringtoUnderLineString($string)
    {
        $callback = preg_replace_callback('/([A-Z]+)/', function ($matchs) {
            return '_' . strtolower($matchs[0]);
        }, $string);
        $string = trim(preg_replace('/_{2,}/', '_', $callback), '_');
        $callback = preg_replace_callback('/([0-9]+)/', function ($matchs) {
            return '_' . strtolower($matchs[0]);
        }, $string);
        return trim(preg_replace('/_{2,}/', '_', $callback), '_');
    }
}
