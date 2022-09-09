<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-07-15 07:36:40
 * @modify date 2022-07-15 08:23:47
 * @license GPLv3
 * @desc [description]
 */

namespace Jinome\Supports;

use simbio_file_upload;

class Upload extends simbio_file_upload
{
    public $allowable_ext = array('.jpg', '.jpeg', '.gif', '.png', '.html', '.htm', '.pdf', '.doc', '.txt');
    public $max_size = 1024000; // in bytes
    public $upload_dir = './';

    public function multipleUpload($file_input_name, $str_new_filename = 'loopID')
    {
        $success = 0;
        $this->error = [];
        for ($i=1; $i <= count($_FILES[$file_input_name]); $i++) { 
            if (empty($_FILES[$file_input_name]['name'][$i])) continue;
            // get file extension
            $file_ext = substr($_FILES[$file_input_name]['name'][$i], strrpos($_FILES[$file_input_name]['name'][$i], '.'));
            if (empty($str_new_filename)) {
                $this->new_filename = basename($_FILES[$file_input_name]['name'][$i]);
            } else {
                $this->new_filename = $str_new_filename === 'loopID' ? ($i).$file_ext : $str_new_filename.$file_ext;
            }

            $_isTypeAllowed = 0;
            // checking file extensions
            if ($this->allowable_ext != '*') {
                foreach ($this->allowable_ext as $ext) {
                    if ($ext == $file_ext) {
                        $_isTypeAllowed++;
                    }
                }

                if (!$_isTypeAllowed) {
                    $this->error[] = 'Background_' . $i . ' : Filetype is forbidden';
                    continue;
                }
            }

            // check for file size
            $_size_kb = ((integer)$this->max_size)/1024;
            if ($_FILES[$file_input_name]['size'][$i] > $this->max_size) {
                $this->error[] = 'Background_' . $i . ' : Filesize is excedded maximum uploaded file size';
                continue;
            }

            // uploading file
            if (self::chunkUpload($_FILES[$file_input_name]['tmp_name'][$i], $this->upload_dir.'/'.$this->new_filename)) {
                $success++;
            } else {
                $upload_error = error_get_last();
                $error_msg = '';
                if ($upload_error) {
                    $error_msg = 'PHP Error ('.$upload_error['message'].')';
                }
                $this->error[] = 'Background_' . $i . ' : Upload failed. Upload directory is not writable or not exists. '.$error_msg;
            }
        }
    }
}