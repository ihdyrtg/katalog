<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-07-07 20:14:25
 * @modify date 2022-07-14 18:56:45
 * @license GPLv3
 * @desc [description]
 */

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

// set execute time
set_time_limit(0);

// Error check
$errorCheck = array_filter([
    [!extension_loaded('gd'), __('<strong>PHP GD</strong> extension is not installed. Please install it or application won\'t be able to create image thumbnail and barcode.')], 
    [(!is_writable(IMGBS) OR !is_writable(IMGBS . 'barcodes') OR !is_writable(IMGBS . 'persons') OR !is_writable(IMGBS . 'docs')), __('<strong>Images</strong> directory and directories under it is not writable. Make sure it is writable by changing its permission or you won\'t be able to upload any images and create barcodes')],
    [!is_writable(REPOBS), __('<strong>Repository</strong> directory is not writable. Make sure it is writable (and all directories under it) by changing its permission or you won\'t be able to upload any bibliographic attachments.')],
    [!is_writable(UPLOAD), __('<strong>File upload</strong> directory is not writable. Make sure it is writable (and all directories under it) by changing its permission or you won\'t be able to upload any file, create report files and create database backups.')]
], fn($item) => $item[0] === true);

// Loan check
$statement = \SLiMS\DB::getInstance()
                ->query(('SELECT 
                            COUNT(loan_id) AS total FROM loan AS l 
                            WHERE (l.is_lent=1 AND l.is_return=0 AND TO_DAYS(due_date) < TO_DAYS(\'' . date('Y-m-d') . '\')) 
                            GROUP BY member_id'));

// get loan data
$data = $statement->fetchObject();

if (is_dir(SB . 'install/')) {
    $errorCheck[] = [true, __('Installer folder is still exist inside your server. Please remove it or rename to another name for security reason.')];
}

if ($data && $data->total > 0)
{
   $errorCheck[] = [true, str_replace('{num_overdue}', $data->total, __('There are currently <strong>{num_overdue}</strong> library members having overdue. Please check at <b>Circulation</b> module at <b>Overdues</b> section for more detail'))];
}

// check need to be repaired mysql database
$query_of_tables = $dbs->query('SHOW TABLES');
$num_of_tables = $query_of_tables->num_rows;
$prevtable = '';
$repair = '';
$is_repaired = false;

if ($_SESSION['uid'] === '1') {
    $errorCheck[] = [true, __('<strong><i>You are logged in as Super User. With great power comes great responsibility.</i></strong>')];
    if (isset ($_POST['do_repair'])) {
        if ($_POST['do_repair'] == 1) {
            while ($row = $query_of_tables->fetch_row()) {
                $sql_of_repair = 'REPAIR TABLE ' . $row[0];
                $query_of_repair = $dbs->query($sql_of_repair);
            }
        }
    }

    while ($row = $query_of_tables->fetch_row()) {
        $query_of_check = $dbs->query('CHECK TABLE ' . $row[0]);
        while ($rowcheck = $query_of_check->fetch_assoc()) {
            if (!(($rowcheck['Msg_type'] == "status") && ($rowcheck['Msg_text'] == "OK"))) {
                if ($row[0] != $prevtable) {
                    $repair .= '<li>' . __('Table') . ' ' . $row[0] . ' ' . __('might need to be repaired.') . '</li>';
                }
                $prevtable = $row[0];
                $is_repaired = true;
            }
        }
    }
    if (($is_repaired) && !isset($_POST['do_repair'])) {
        echo '<div class="message">';
        echo '<ul>';
        echo $repair;
        echo '</ul>';
        echo '</div>';
        echo ' <form method="POST" style="margin:0 10px;">
<input type="hidden" name="do_repair" value="1">
<input type="submit" value="' . __('Click Here To Repair The Tables') . '" class="button btn btn-block btn-default">
</form>';
    }
}

// if there any warnings
if ($errorCheck) {
    echo '<div class="alert alert-warning border-0 m-3">';
    foreach ($errorCheck as $message) {
        echo '<div class="p-3">' . $message[1] . '</div>';
    }
    echo '</div>';
}

?>