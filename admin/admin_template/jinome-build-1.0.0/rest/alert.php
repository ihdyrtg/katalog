<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-07-14 09:26:06
 * @modify date 2022-07-15 09:44:05
 * @license GPLv3
 * @desc [description]
 */

// check index authentication
defined('INDEX_AUTH') or die('Direct access not allowed!');

// clean previous buffer
ob_end_clean();

// Set header
header('Content-Type: application/json');

// set execute time
set_time_limit(0);

// Error check
$errorCheck = array_filter([
    !extension_loaded('gd'), 
    (!is_writable(IMGBS) OR !is_writable(IMGBS . 'barcodes') OR !is_writable(IMGBS . 'persons') OR !is_writable(IMGBS . 'docs')),
    !is_writable(REPOBS),
    !is_writable(UPLOAD)
], fn($item) => $item === true);

// Loan check
$statement = \SLiMS\DB::getInstance()
                ->query(('SELECT 
                            COUNT(loan_id) AS total FROM loan AS l 
                            WHERE (l.is_lent=1 AND l.is_return=0 AND TO_DAYS(due_date) < TO_DAYS(\'' . date('Y-m-d') . '\')) 
                            GROUP BY member_id'));
// get loan data
$data = $statement->fetchObject();

if (!$data) {$data = new stdClass; $data->total = 0;}

// check need to be repaired mysql database
$query_of_tables = \SLiMS\DB::getInstance('mysqli')->query('SHOW TABLES');
$num_of_tables = $query_of_tables->num_rows;
$prevtable = '';
$repair = '';
$is_repaired = false;

if ($_SESSION['uid'] === '1') {
    $data->total++;
    while ($row = $query_of_tables->fetch_row()) {
        $query_of_check = \SLiMS\DB::getInstance('mysqli')->query('CHECK TABLE `' . $row[0] . '`');
        while ($rowcheck = $query_of_check->fetch_assoc()) {
            if (!(($rowcheck['Msg_type'] == "status") && ($rowcheck['Msg_text'] == "OK"))) {
                if ($row[0] != $prevtable) {
                    $data->total++;
                }
            }
        }
    }
}

// send output
echo json_encode([
    'status' => true, 
    'total_alert' => (
        count($errorCheck) + 
        (is_dir(SB . 'install/') ? 1 : 0) + 
        $data->total)
    ]);