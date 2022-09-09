<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-07-14 19:22:54
 * @modify date 2022-07-15 07:21:49
 * @license GPLv3
 * @desc [description]
 */

namespace Jinome\Supports;

use SLiMS\DB;

class Config
{
    public static function get(string $configKey)
    {
        $settingState = DB::getInstance()->prepare('SELECT `setting_value` FROM `setting` WHERE `setting_name` = ?');
        $settingState->execute([$configKey]);

        return self::processing($settingState);
    }

    public static function put(string $configKey, $value)
    {
        addOrUpdateSetting($configKey, $value);
    }

    private static function processing($result)
    {
        if (!$result) return null;
        $data = $result->fetchObject();
        return unserialize($data->setting_value??'')??null;
    }
}