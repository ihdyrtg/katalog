<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-07-15 09:41:13
 * @modify date 2022-07-15 09:41:16
 * @license GPLv3
 * @desc [description]
 */

defined('INDEX_AUTH') or die('Direct access is not allowed');

?>
<section class="flex flex-col items-center mt-64 mb-2 w-9/12 animate__animated animate__fadeIn">
    <h1 class="text-3xl w-max font-bold text-gray-100 px-2 py-1 rounded-xl">
        Hi, <?= $_SESSION['realname']?>
    </h1>
    <!-- <input type="text" class="font-bold w-6/12 outline-none px-3 py-2 mt-3 mb-1 rounded-xl text-lg" placeholder="Cari menu?"/>
    <div class="w-6/12 bg-white px-3 py-2 rounded-xl">
        Tunggu
    </div> -->
</section>