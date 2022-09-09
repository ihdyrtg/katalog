<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-06-10 08:14:49
 * @modify date 2022-06-26 01:00:35
 * @license GPLv3
 * @desc [description]
 */

namespace Jinome\Supports;

class Http
{
    public static function getBaseUrl(string $additionalUrl = '')
    {
        $protocol = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != '443' ? 'http://' : 'https://';
        $host = $_SERVER['HTTP_HOST'];
        $port = !in_array($_SERVER['SERVER_PORT'], ['80','443']) ? ':' . $_SERVER['SERVER_PORT'] : '';


        return $protocol . str_replace($port, '', $host) . $port . $additionalUrl;
    }

    public static function redirect(string $url, $callback = '')
    {
        if (is_callable($callback)) exit($callback($url));
        header('location: ' . $url);
        exit;
    }

    public static function simbioAjax(string $url, $callback = '', string $position = 'top')
    {
        if (is_callable($callback)) exit($callback($url));

        echo <<<HTML
            <script>
                {$position}.$('#mainContent').simbioAJAX('{$url}');
            </script>
        HTML;
        exit;
    }
}
