<?php

namespace Ninjify\Nunjuck;

final class Notes
{

    /** @var array */
    public static $notes = [];

    /**
     * @param string $message
     * @return void
     */
    public static function add($message)
    {
        self::$notes[] = $message;
    }

    /**
     * @return void
     */
    public static function clear()
    {
        self::$notes = [];
    }

    /**
     * @return array
     */
    public static function fetch()
    {
        $res = self::$notes;
        self::$notes = [];

        return $res;
    }

}
