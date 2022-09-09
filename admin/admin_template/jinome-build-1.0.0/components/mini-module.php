<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-06-26 17:16:26
 * @modify date 2022-07-08 21:33:40
 * @license GPLv3
 * @desc [description]
 */

defined('INDEX_AUTH') or die('No direect access!');

$defaultModules = ['bibliography','circulation','membership','reporting','system'];
$modules = include __DIR__ . DS . '..' . DS . 'config' . DS . 'modules.php';

utility::loadSettings($dbs);

if (isset($sysconf['jinome_default_modules']))
{
    $defaultModules = $sysconf['jinome_default_modules'];
}
?>
<section class="flex flex-row gap-3 animate__animated animate__bounceInUp">
    <?php foreach($defaultModules as $module): ?>
        <?php if (isset($_SESSION['priv'][$module])): ?>
        <div class="flex flex-col items-center cursor-pointer openDragWindow" data-module="<?= $module ?>" data-label="<?= ucwords(__($module)) ?>">
            <div class="flex items-center justify-center <?= $modules[$module]['color'] ?> w-16 h-16 my-2 text-white rounded-xl  cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-bookmarks-fill" viewBox="0 0 16 16">
                    <?= $modules[$module]['icon'] ?>
                </svg>
            </div>
            <label class="text-white"><?= __(ucwords(str_replace('_', ' ', $module))) ?></label>
        </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <div class="flex flex-col items-center openDragWindow" data-module="othermodule" data-label="<?= ucwords('Modul lain') ?>">
        <div class="flex items-center justify-center bg-zinc-500 hover:bg-zinc-600 w-16 h-16 my-2 text-white rounded-xl cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-bookmarks-fill" viewBox="0 0 16 16">
                <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
            </svg>
        </div>
        <label class="text-white">Other Module</label>
    </div>
</section>