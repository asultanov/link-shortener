<?php

namespace App\Core\Config;

class Config
{

    /**
     * @param $key
     * @param $group
     * @return mixed|null
     * @throws \Exception
     */
    public static function item($key, $group = 'items')
    {
        $groupItems = static::file($group);
        return isset($groupItems[$key]) ? $groupItems[$key] : null;
    }

    /**
     * @param $group
     * @return array
     * @throws \Exception
     */
    public static function file($group)
    {
        $patch = ROOT_DIR . '/configs/' . $group . '.php';

        if (file_exists($patch)) {
            $items = require_once $patch;
            if (is_array($items)) {
                return $items;
            } else
                throw new \Exception(sprintf('The configuration file <strong>%s</strong> must be an array.', $patch));

        } else
            throw new \Exception(sprintf('Cannot load config from file, file <strong>%s</strong> does not exist.', $patch));

        return false;
    }
}