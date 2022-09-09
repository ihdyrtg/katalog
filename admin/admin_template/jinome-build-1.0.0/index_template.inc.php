<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-06-26 01:12:38
 * @modify date 2022-07-15 09:37:19
 * @license GPLv3
 * @desc [description]
 */

use Jinome\Supports\Component;
use Jinome\Supports\Rest;

include __DIR__ . '/lib/autoload.php';

Rest::handle($_GET['rest']??'');
?>
<!DOCTYPE Html>
<!--
   _ _                            
  (_|_)_ __   ___  _ __ ___   ___ 
  | | | '_ \ / _ \| '_ ` _ \ / _ \
  | | | | | | (_) | | | | | |  __/
 _/ |_|_| |_|\___/|_| |_| |_|\___|
|__/  
                             by Drajat Hasan (drajathasan20@gmail.com)
-->
<html>
    <head>
        <title><?= $page_title ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, post-check=0, pre-check=0" />
        <meta http-equiv="Expires" content="Sat, 26 Jul 1997 05:00:00 GMT" />

        <link rel="icon" href="<?php echo SWB; ?>webicon.ico" type="image/x-icon" />
        <link href="<?php echo SWB; ?>css/bootstrap.min.css?<?php echo date('this') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo SWB; ?>css/core.css?<?php echo date('this') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo JWB; ?>colorbox/colorbox.css?<?php echo date('this') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo JWB; ?>chosen/chosen.css?<?php echo date('this') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo JWB; ?>toastr/toastr.min.css?<?php echo date('this') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo JWB; ?>jquery.imgareaselect/css/imgareaselect-default.css" rel="stylesheet" type="text/css" />
        <link href="<?= jinomeUrl('dist/app.css') ?>" rel="stylesheet">

        <script type="text/javascript" src="<?php echo JWB; ?>jquery.js"></script>
        <script type="text/javascript" src="<?php echo JWB; ?>updater.js"></script>
        <script type="text/javascript" src="<?php echo JWB; ?>gui.js?"></script>
        <script type="text/javascript" src="<?php echo JWB; ?>form.js"></script>
        <script type="text/javascript" src="<?php echo JWB; ?>calendar.js?v=<?php echo date('this') ?>"></script>
        <script type="text/javascript" src="<?php echo JWB; ?>chosen/chosen.jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo JWB; ?>chosen/ajax-chosen.min.js"></script>
        <script type="text/javascript" src="<?php echo JWB; ?>ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="<?php echo JWB; ?>tooltipsy.js"></script>
        <script type="text/javascript" src="<?php echo JWB; ?>colorbox/jquery.colorbox-min.js"></script>
        <script type="text/javascript" src="<?php echo JWB; ?>jquery.imgareaselect/scripts/jquery.imgareaselect.pack.js"></script>
        <script type="text/javascript" src="<?php echo JWB; ?>webcam.js"></script>
        <script type="text/javascript" src="<?php echo JWB; ?>scanner.js"></script>
        <script type="text/javascript" src="<?php echo SWB; ?>js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo SWB; ?>js/popper.min.js"></script>
        <script type="text/javascript" src="<?php echo JWB; ?>toastr/toastr.min.js"></script>
    </head>
    <?php
    if (!isset($_GET['module']))
    {
        Component::render('dashboard', ['dbs' => $dbs, 'sysconf' => $sysconf]);
    }
    else
    {
        Component::render('loader', [
            'module' => str_replace(['"','\''], '', basename(strip_tags($_GET['module']))), 
            'dbs' => $dbs, 
            'sysconf' => $sysconf, 
            'sub_menu' => $sub_menu
        ]);
    }
    ?>
    <script src="<?= jinomeUrl('dist/app.js') ?>"></script>
</html>