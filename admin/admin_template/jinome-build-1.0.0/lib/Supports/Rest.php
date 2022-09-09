<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-06-30 19:28:06
 * @modify date 2022-07-14 09:40:32
 * @license GPLv3
 * @desc [description]
 */

namespace Jinome\Supports;

class Rest
{
    private static $directory = '';

    public static function setDirectory(string $directoryPath)
    {
        self::$directory = $directoryPath . DS;
    }
    
    public static function handle(string $restName)
    {
        $fileAttribute = pathinfo($restName);
        if (file_exists($path = self::$directory . basename($fileAttribute['filename']) . '.php'))
        {
            ob_start();
            include_once $path;
            exit;
        }
    }    
}