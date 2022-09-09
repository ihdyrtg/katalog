<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-07-07 20:14:25
 * @modify date 2022-07-15 09:43:39
 * @license GPLv3
 * @desc [description]
 */

use Jinome\Supports\Component;

// key to authenticate
define('INDEX_AUTH', '1');

// required file
require __DIR__ . '/../../../../sysconfig.inc.php';
// IP based access limitation
require LIB.'ip_based_access.inc.php';
do_checkIP('smc');
// start the session
require SB.'admin/default/session.inc.php';
// session checking
require SB.'admin/default/session_check.inc.php';
require SIMBIO.'simbio_DB/simbio_dbop.inc.php';
include __DIR__ . DS . '..' . DS . 'lib' . DS . 'autoload.php';

if (isset($_POST['saveData']))
{
    addOrUpdateSetting('jinome_default_modules', $_POST['main']);
    utility::jsToastr('Success', 'data berhasil disimpan', 'success');
    echo <<<HTML
    <script>top.window.location.reload();</script>
    HTML;
    exit;
}

$page_title = 'Other Module';

$defaultModules = ['bibliography','circulation','membership','reporting','system'];
$modules  = include __DIR__ . DS . '..' . DS . 'config' . DS . 'modules.php';
utility::loadSettings($dbs);

if (isset($sysconf['jinome_default_modules']))
{
    $defaultModules = $sysconf['jinome_default_modules'];
}

ob_start();
?>

<form action="<?= $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'] ?>" target="blindSubmit" method="POST">
    <button type="submit" name="saveData" class="btn btn-primary float-right mx-3 mt-5">Simpan</button>
    <h3 class="px-5 pt-5 text-2xl">Daftar Modul Utama</h3>
    <section class="flex flex-row gap-5 animate__animated animate__fadeIn mx-5 mt-3">
        <?php foreach($modules as $module => $attribute): ?>
            <?php if (isset($_SESSION['priv'][$module])): ?>
            <div id="main-<?= $module ?>" class="<?= (in_array($module, ($defaultModules)) ? 'mainmodule' : '') ?> flex flex-col items-center w-32 cursor-pointer <?= (!in_array($module, ($defaultModules)) ? 'hidden' : '') ?>" data-module="<?= $module ?>" data-label="<?= ucwords(__($module)) ?>">
                <input id="input-<?= $module ?>" type="hidden" name="<?= (!in_array($module, ($defaultModules)) ? 'hidden[]' : 'main[]') ?>" value="<?= $module ?>"/>
                <div class="flex items-center justify-center <?= $attribute['color'] ?> w-16 h-16 my-2 text-white rounded-xl  cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-bookmarks-fill" viewBox="0 0 16 16">
                        <?= $attribute['icon'] ?>
                    </svg>
                </div>
                <label class="text-gray-800"><?= __(ucwords(str_replace('_', ' ', $module))) ?></label>
                <button data-hide-for="<?= $module ?>" class="hideModule btn btn-sm btn-outline-danger w-full">Hapus</button>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </section>
    <h3 class="px-5 pt-5 text-2xl">Daftar Modul Lain</h3>
    <section class="flex flex-row gap-5 animate__animated animate__fadeIn mx-5 mt-3">
        <?php foreach($modules as $module => $attribute): ?>
            <?php if (isset($_SESSION['priv'][$module])): ?>
            <div id="available-<?= $module ?>" class="availmodule flex flex-col items-center w-32 cursor-pointer <?= (in_array($module, ($defaultModules)) ? 'hidden' : '') ?>" data-module="<?= $module ?>" data-label="<?= ucwords(__($module)) ?>">
                <div class="flex items-center justify-center <?= $attribute['color'] ?> w-16 h-16 my-2 text-white rounded-xl  cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-bookmarks-fill" viewBox="0 0 16 16">
                        <?= $attribute['icon'] ?>
                    </svg>
                </div>
                <label class="text-gray-800"><?= substr(__(ucwords(str_replace('_', ' ', $module))), 0,20) ?></label>
                <button data-show-for="<?= $module ?>" class="btn btn-sm btn-outline-success w-full showModule" title="Tambah sebagai module utama">Tambah</button>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </section>
</form>
<?php
echo ob_get_clean();

// utility::loadUserTemplate($dbs,$_SESSION['uid']);

// require __DIR__ . DS . '..' . DS . 'index_template.inc.php';
