<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-07-15 09:41:00
 * @modify date 2022-07-15 09:41:04
 * @license GPLv3
 * @desc [description]
 */

defined('INDEX_AUTH') or die('Direct access is not allowed');

use Jinome\Supports\Component;
$mainModule = !in_array($module, ['othermodule','alert','background']);

$moduleUrl = AWB . 'modules/'. $module . '/index.php';
if (!$mainModule):
    $moduleUrl = jinomeUrl('modules/' . $module . '.php');
endif;
?>
<body>
    <div class="loader">
        <?php Component::render('wave') ?>
    </div>
    <?php if ($mainModule): ?>
    <?php Component::render('submenu', ['module' => $module, 'dbs' => $dbs, 'sysconf' => $sysconf]) ?>
    <?php Component::render('submenu-trigger') ?>
    <?php endif; ?>
    <div class="w-full pb-32" id="mainContent"></div>
    <script>
        $(document).ready(function() {$('#mainContent').simbioAJAX('<?= $moduleUrl ?>');});
    </script>
    <iframe name="blindSubmit" class="hidden"></iframe>
    <iframe name="submitExec" class="hidden"></iframe>
</body>