<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-06-30 19:36:31
 * @modify date 2022-06-30 19:51:20
 * @license GPLv3
 * @desc [description]
 */

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    header('Content-Type: application/json');
    // Cache check
    $cachePath = __DIR__ . DS . '..' . DS . 'cache/searchmenu-' . $_SESSION['uid'] . '.json';
    if (file_exists($cachePath))
    {
        exit(file_get_contents($cachePath));
    }

    // indexing
    $menus = [];
    foreach ($_SESSION['priv'] as $module => $attribute) {
        if (file_exists($submenu = MDLBS . $module . DS . 'submenu.php'))
        {
            include $submenu;
        }
    }

    // put a cache
    file_put_contents($cachePath, $json = json_encode($menus));
    exit($json);
}