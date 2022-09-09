<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-07-15 09:39:00
 * @modify date 2022-07-15 09:40:44
 * @license GPLv3
 * @desc [description]
 */
use Jinome\Supports\{Component,Config};

defined('INDEX_AUTH') or die('Direct access is not allowed');
?>
<body class="min-h-screen overflow-hidden" style="background-image: <?= jinomeBackground(Config::get('jinomeBackground')['type']??'') ?>;">
    <?php Component::render('header') ?>
    <main class="flex flex-col items-center content-center min-h-screen">
        <?php Component::render('searchbox') ?>
        <?php Component::render('mini-module', ['dbs' => $dbs, 'sysconf' => $sysconf]) ?>
        <?php Component::render('windows', ['dbs' => $dbs, 'sysconf' => $sysconf]) ?>
    </main>
</body>