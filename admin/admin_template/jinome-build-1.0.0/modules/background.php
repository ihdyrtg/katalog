<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-07-07 20:14:25
 * @modify date 2022-07-15 08:27:39
 * @license GPLv3
 * @desc [description]
 */

use Jinome\Supports\{Component,Config,Upload};

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
require SIMBIO . 'simbio_GUI/table/simbio_table.inc.php';
require SIMBIO . 'simbio_GUI/form_maker/simbio_form_table_AJAX.inc.php';
require SIMBIO . 'simbio_FILE/simbio_file_upload.inc.php';
include __DIR__ . DS . '..' . DS . 'lib' . DS . 'autoload.php';

if (isset($_POST['saveData']))
{
    $data = [];
    $data['type'] = $_POST['backgroundtype'];

    if ($_POST['backgroundtype'] == 0)
    {
        $image_upload = new Upload();
        $image_upload->allowable_ext = $sysconf['allowed_images'];
        $image_upload->max_size = ($sysconf['max_image_upload'] * 3) * 1024;
        $image_upload->upload_dir = __DIR__ . DS . '..'. DS . 'static' . DS . 'images' . DS;
        $status = $image_upload->multipleUpload('background');
        
        if ($status > 0)
        {
            utility::jsToastr('Sukses', 'Berhasil mengupload ' . $status . ' gambar.', 'Success');
        }

        if (count($image_upload->error) > 0)
        {
            utility::jsToastr('Galat', implode('\n', $image_upload->error), 'error');
        }
    }

    Config::put('jinomeBackground', $data);
    utility::jsToastr('Sukses', 'Berhasil memperbaharui background', 'success');
    $url = AWB;
    echo <<<HTML
    <script>setTimeout(() => top.window.location = '{$url}', 2500)</script>
    HTML;
    exit;
}

?>
<div class="menuBox">
    <div class="menuBoxInner biblioIcon">
        <div class="per_title">
            <h2><?= "Theme Configuration" ?></h2>
        </div>
    </div>
</div>
<?php
// create new instance
$form = new simbio_form_table_AJAX('mainForm', $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'], 'post');
$form->submit_button_attr = 'name="saveData" value="' . __('Save') . '" class="s-btn btn btn-default"';
// form table attributes
$form->table_attr = 'id="dataList" cellpadding="0" cellspacing="0"';
$form->table_header_attr = 'class="alterCell"';
$form->table_content_attr = 'class="alterCell2"';

// Background type
$form->addSelectList('backgroundtype', 'Tipe Background', [[0, 'Lokal Acak'],[1, 'Picsum Acak']], (int)(Config::get('jinomeBackground')['type']??0), 'class="select2"');
// set url
$url = jinomeUrl('static/images/');

$image = '<div class="flex flex-row gap-4">';
for($img = 1; $img <=5 ; $img++)
{
    $time = date('this');
    $image .= <<<HTML
    <div class="flex flex-col">
        <img src="{$url}{$img}.jpg?v={$time}" id="img-{$img}" class="w-32 h-32 rounded-xl shadow-2xl">
        <input data-id="{$img}" type="file" name="background[{$img}]" id="file-{$img}" class="hidden"/>
        <button data-id="{$img}" class="changeBackground btn btn-sm btn-outline-primary rounded-xl my-3 notAJAX">Ganti</button>
    </div>
    HTML;
}
$image .= '</div>';

$form->addAnything('Gambar', $image);

echo $form->printOut();
?>
<script>
    $(document).ready(function(){
        $('.changeBackground').click(function(){
            let id = $(this).data('id');

            $(`#file-${id}`).trigger('click');
        });

        $('input[type="file"]').change(function(){
            let input = this;
            let id = $(this).data('id');
            let url = $(this).val();
            let ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();

            if (input.files && input.files[0] && (ext == "png" || ext == "jpeg" || ext == "jpg")) 
            {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(`#img-${id}`).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        })
    })
</script>