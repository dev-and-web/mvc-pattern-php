<?php

namespace Core\Http;

/**
 * Input
 */
class Input
{
    /**
     * Check if data sent in POST exists.
     *
     * @param string $name
     * @return bool
     */
    public static function hasPost(string $name): bool
    {
        return array_key_exists($name, $_POST);
    }

    /**
     * If data is sent in POST, and if this $name exists -> return $_POST['name'].
     *
     * @param string $name
     * @return array|string
     */
    public static function post(string $name)
    {
        return isset($_POST[$name]) && $_POST[$name] !== '' ? $_POST[$name] : '';
    }

    /**
     * Check if data sent in GET exists.
     *
     * @param string $name
     * @return bool
     */
    public static function hasGet(string $name): bool
    {
        return array_key_exists($name, $_GET);
    }

    /**
     * If data is sent in GET, and if this $name exists -> return $_GET['name'].
     *
     * @param string $name
     * @return array|string
     */
    public static function get(string $name)
    {
        return isset($_GET[$name]) && $_GET[$name] !== '' ? $_GET[$name] : '';
    }
}
