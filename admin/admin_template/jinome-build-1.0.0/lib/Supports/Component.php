<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-06-26 17:37:41
 * @modify date 2022-06-30 19:46:34
 * @license GPLv3
 * @desc [description]
 */

namespace Jinome\Supports;

class Component
{
    private static $directory = '';

    public static function setDirectory(string $directoryPath)
    {
        self::$directory = $directoryPath . DS;
    }

    public static function render(string $componentName, array $data = [])
    {
        extract($data);
        $fileAttribute = pathinfo($componentName);
        ob_start();
        include_once self::$directory . basename($fileAttribute['filename']) . '.php';
        echo ob_get_clean();
    }
}