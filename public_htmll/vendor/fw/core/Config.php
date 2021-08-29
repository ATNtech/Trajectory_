<?php

namespace fw\core;

class Config {

    use TSingletone;

    protected static $values = [];

    private function __construct() {
        self::$values = include ROOT . '/config/config.php';
    }

    public static function set($key, $value = null)
    {
        $keys = is_array($key) ? $key : [$key => $value];

        foreach ($keys as $key => $value) {
            static::arr_set(self::$values, $key, $value);
        }
    }

    public static function get($key, $default = null)
    {
        if (is_array($key)) {
            return static::getMany($key);
        }

        return static::arr_get(self::$values, $key, $default);
    }

    public static function all() {
        return self::$values;
    }

    public function __clone() {
        throw new Exception('You cannot clone singleton object');
    }

    public static function accessible($value) {
        return is_array($value) || $value instanceof ArrayAccess;
    }

    public static function exists($array, $key) {
        if ($array instanceof ArrayAccess) {
            return $array->offsetExists($key);
        }

        return array_key_exists($key, $array);
    }

    public static function getMany($keys) {
        $config = [];

        foreach ($keys as $key => $default) {
            if (is_numeric($key)) {
                [$key, $default] = [$default, null];
            }

            $config[$key] = static::arr_get(self::$values, $key, $default);
        }

        return $config;
    }

    private static function arr_set(&$array, $key, $value) {
        if (is_null($key)) {
            return $array = $value;
        }

        $keys = explode('.', $key);

        foreach ($keys as $i => $key) {
            if (count($keys) === 1) {
                break;
            }

            unset($keys[$i]);

            if (! isset($array[$key]) || ! is_array($array[$key])) {
                $array[$key] = [];
            }

            $array = &$array[$key];
        }

        $array[array_shift($keys)] = $value;

        return $array;
    }

    public static function arr_get($array, $key, $default = null) {
        if (! static::accessible($array)) {
            return value($default);
        }

        if (is_null($key)) {
            return $array;
        }

        if (static::exists($array, $key)) {
            return $array[$key];
        }

        if (strpos($key, '.') === false) {
            return $array[$key] ?? value($default);
        }

        foreach (explode('.', $key) as $segment) {
            if (static::accessible($array) && static::exists($array, $segment)) {
                $array = $array[$segment];
            } else {
                return value($default);
            }
        }

        return $array;
    }

}
