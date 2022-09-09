<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-06-26 01:01:38
 * @modify date 2022-07-15 08:29:09
 * @license GPLv3
 * @desc [description]
 */

if (!function_exists('jinomeUrl'))
{
    function jinomeUrl(string $additionalUrlPath = '')
    {
        return \Jinome\Supports\Http::getBaseUrl(AWB . 'admin_template/' . jinomeDir() . '/' . $additionalUrlPath);
    }
}

if (!function_exists('jinomeUrlStatic'))
{
    function jinomeUrlStatic(string $additionalUrlPath)
    {
        return jinomeUrl('static/' . $additionalUrlPath);
    }
}

if (!function_exists('jinomeDir'))
{
    function jinomeDir()
    {
        return basename(str_replace('lib', '', __DIR__));
    }
}

if (!function_exists('jinomeBackground'))
{
    function jinomeBackground($type = '')
    {
        switch ($type) {
            case '1':
                return 'linear-gradient(180deg,rgb(57 57 57 / 0%) 0,rgba(63,71,74,.8)),url(https://picsum.photos/1000/500)';
                break;
            
            default:
                $time = date('this');
                return 'linear-gradient(180deg,rgb(57 57 57 / 0%) 0,rgba(63,71,74,.8)),url(' . jinomeUrlStatic('images/' . rand(1,5) . '.jpg?v=' . $time) .')';
                break;
        }
    }
}

if (!function_exists('addOrUpdateSetting')) {
    /**
     * Took from index.php at system modules
     *
     * @param [type] $name
     * @param [type] $value
     * @return void
     */
    function addOrUpdateSetting($name, $value) {
        global $dbs;
        $sql_op = new simbio_dbop($dbs);
        $data['setting_value'] = $dbs->escape_string(serialize($value));

        $query = $dbs->query("SELECT setting_value FROM setting WHERE setting_name = '{$name}'");
        if ($query->num_rows > 0) {
            // update
            $sql_op->update('setting', $data, "setting_name='{$name}'");
        } else {
            // insert
            $data['setting_name'] = $name;
            $sql_op->insert('setting', $data);
        }
    }
}