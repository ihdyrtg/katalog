<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-07-15 09:41:22
 * @modify date 2022-07-15 09:41:27
 * @license GPLv3
 * @desc [description]
 */

defined('INDEX_AUTH') or die('Direct access is not allowed');

?>
<div id="submenu" class="flex flex-col hidden">
    <div class="flex items-center justify-center text-white font-bold h-40" style="background-image: linear-gradient(180deg,rgb(57 57 57 / 0%) 0,rgba(63,71,74,.8)),url(<?= jinomeUrlStatic('images/' . rand(1,5) . '.jpg') ?>);">
        <h1 class="text-2xl"><?= ucwords(__($module)) ?></h1>
    </div>
    <div class="flex w-full justify-center items-center my-3">
        <input type="text" id="searchSubmenu" class="focus:bg-gray-200 bg-gray-300 placeholder:text-gray-800 outline-none px-3 py-2 w-3/6 rounded-lg" placeholder="<?= __('Search') ?>"/>
    </div>
    <?php
    if (file_exists($submenu = MDLBS . $module . DS . 'submenu.php'))
    {
        include $submenu;

        $privilegesMenu = $_SESSION['priv'][$module]['menus']??[];
        $menus = array_merge($menu, [['Header', 'Plugin']], array_values(\SLiMS\Plugins::getInstance()->getMenus($module)));

        $html = [];
        $headerKey = 0;
        foreach ($menus as $index => $list) {
            $headerLabel = __($list[1]);
            if ($list[0] === 'Header'):
                $headerKey++;
                $html[$headerKey] = [];
                $html[$headerKey][] = <<<HTML
                    <h3 class="text-lg font-bold col-span-3 w-full">{$headerLabel}</h3>
                HTML;
                if (!isset($menus[($index+1)])):
                    unset($html[$headerKey]);
                endif;
            else:
                if (!isset($list[2])) $list[2] = '';
                list($label, $url, $title) = $list;
                if ($_SESSION['uid'] == 1):
                    $html[$headerKey][] = trim(<<<HTML
                        <a href="{$url}" class="submenu col-span-1 w-3/12 px-3 py-2 font-bold hover:bg-gray-200 loadContent" title="{$title}">{$label}</a>
                    HTML);
                elseif (in_array(md5($url), $privilegesMenu)):
                    $html[$headerKey][] = trim(<<<HTML
                        <a href="{$url}" class="submenu col-span-1 w-3/12 px-3 py-2 font-bold hover:bg-gray-200 loadContent" title="{$title}">{$label}</a>
                    HTML);
                endif;
            endif;
        }
        $prefix = '<div class="flex flex-wrap gap-1 mt-4 px-5">';
        $suffix = '</div>';
        
        foreach ($html as $list) {
            $group = implode($list);
            echo $prefix . $group . $suffix;
        }
    }
    ?>
</div>