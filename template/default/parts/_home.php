<?php
# @Author: Waris Agung Widodo <user>
# @Date:   2018-01-23T11:27:04+07:00
# @Email:  ido.alit@gmail.com
# @Filename: _home.php
# @Last modified by:   user
# @Last modified time: 2018-01-26T18:43:45+07:00

?>

<section id="section1 container-fluid">
    <header class="c-header">
        <div class="mask"></div>
      <?php
      // ------------------------------------------------------------------------
      // include navbar
      // ------------------------------------------------------------------------
      include '_navbar.php'; ?>
    </header>
  <?php
  // --------------------------------------------------------------------------
  // include search form part
  // --------------------------------------------------------------------------
  include '_search-form.php'; ?>
</section>

<div id="slims-home">
<section class="mt-5 container">
    <h4 class="text-secondary text-center text-thin mt-5 mb-4"><?php echo __('Select the topic you are interested in'); ?></h4>
    <ul class="topic d-flex flex-wrap justify-content-center px-0">
        <li class="d-flex justify-content-center align-items-center m-2">
            <a href="index.php?callnumber=8&search=search" class="d-flex flex-column">
                <img src="<?php echo assets('images/8-books.png'); ?>" width="80" class="mb-3 mx-auto"/>
                <?php echo __('Literature'); ?>
            </a>
        </li>
        <li class="d-flex justify-content-center align-items-center m-2">
            <a href="index.php?callnumber=3&search=search" class="d-flex flex-column">
                <img src="<?php echo assets('images/3-diploma.png'); ?>" width="80" class="mb-3 mx-auto"/>
                <?php echo __('Social Sciences'); ?>
            </a>
        </li>
        <li class="d-flex justify-content-center align-items-center m-2">
            <a href="index.php?callnumber=6&search=search" class="d-flex flex-column">
                <img src="<?php echo assets('images/6-blackboard.png'); ?>" width="80" class="mb-3 mx-auto"/>
                <?php echo __('Applied Sciences'); ?>
            </a>
        </li>
        <li class="d-flex justify-content-center align-items-center m-2">
            <a href="index.php?callnumber=7&search=search" class="d-flex flex-column">
                <img src="<?php echo assets('images/7-quill.png'); ?>" width="80" class="mb-3 mx-auto"/>
                <?php echo __('Art & Recreation'); ?>
            </a>
        </li>
        <li class="d-flex justify-content-center align-items-center m-2">
            <a href="javascript:void(0)" class="d-flex flex-column" data-toggle="modal" data-target="#exampleModal">
                <img src="<?php echo assets('images/icon/grid_icon.png'); ?>" width="80"
                     class="mb-3 mx-auto"/>
                <?php echo __('see more..'); ?>
            </a>
        </li>
    </ul>
</section>

<?php if ($sysconf['template']['classic_popular_collection']) : ?>
<section class="mt-5 container">
    <h4 class=" mb-4">
        <?php echo __('Popular among our collections'); ?>
        <br>
        <small class="subtitle-section"><?php echo __('Our library\'s line of collection that have been favoured by our users were shown here. Look for them. Borrow them. Hope you also like them');?></small>
    </h4>

    <slims-group-subject url="index.php?p=api/subject/popular"></slims-group-subject>
    <slims-collection url="index.php?p=api/biblio/popular"></slims-collection>

</section>
<?php endif; ?>

<?php if ($sysconf['template']['classic_new_collection']) : ?>
<section class="mt-5 container">
    <h4 class=" mb-4">
        <?php echo __('New collections + updated');?>
        <br>
        <small class="subtitle-section"><?php echo __('These are new collections list. Hope you like them. Maybe not all of them are new. But in term of time, we make sure that these are fresh from our processing oven');?></small>
    </h4>

    <slims-group-subject url="index.php?p=api/subject/latest"></slims-group-subject>
    <slims-collection url="index.php?p=api/biblio/latest"></slims-collection>

</section>
<?php endif; ?>

<?php if ($sysconf['template']['classic_top_reader']) : ?>
<section class="mt-5 bg-white">
    <div class="container py-5">
        <h4 class="mb-4">
            <?php echo __('Top reader of the year');?>
            <br>
            <small class="subtitle-section"><?php echo __('Our best users, readers, so far. Continue to read if you want your name being mentioned here');?></small>
        </h4>
        <slims-group-member url="index.php?p=api/member/top"></slims-group-member>
    </div>
</section>
<?php endif; ?>

<?php if ($sysconf['template']['classic_top_reader']) : ?>
<section class="mt-5 bg-white">
    <div class="container py-5"><h4 class=" mb-4">
        Statistik Dalam Angka
        <br> <small class="subtitle-section">Statistik Perpustakaan yang dapat dilihat dalam angka.</small></h4> 
        <div class="row"><div class="col-xs-6 col-md-3 col-lg-3"><div class="card border-0"><div class="card-body"><center><div class="s-widget-icon"><i class="fa fa-book"></i></div> <div class="s-widget-value">10,787</div> 
        <div class="s-widget-title">Eksemplar</div></center></div></div></div> <div class="col-xs-6 col-md-3 col-lg-3"><div class="card border-0"><div class="card-body"><center><div class="s-widget-icon"><i class="fa fa-user"></i></div> <div class="s-widget-value">44,809</div> 
        <div class="s-widget-title">Anggota</div></center></div></div></div> <div class="col-xs-6 col-md-3 col-lg-3"><div class="card border-0"><div class="card-body"><center><div class="s-widget-icon"><i class="fa fa-exchange-alt"></i></div> <div class="s-widget-value">493</div> 
        <div class="s-widget-title">Transaksi</div></center></div></div></div> <div class="col-xs-6 col-md-3 col-lg-3"><div class="card border-0"><div class="card-body"><center><div class="s-widget-icon"><i class="fa fa-users"></i></div> <div class="s-widget-value">49,046</div> 
        <div class="s-widget-title">Pengunjung Perpustakaan</div></center></div></div></div></div> <center><a title="More Statistic" href="index.php?p=statistik" class="btn btn-outline-success mb-2"><i class="fas fa-chart-bar mr-2"></i>Load More Statistic</a></center></div>
</section>
<?php endif; ?>

<?php if ($sysconf['template']['classic_map']) : ?>
<section class="my-5 container">
    <div class="row align-items-center"
         style="background-image: url('template/default/assets/images/slide2-lama.jpg');">
        <div class="col-md-6"> 
            <iframe class="embed-responsive"
                    src="<?= $sysconf['template']['classic_map_link']; ?>"
                    height="250" frameborder="40" style="border:2px" allowfullscreen></iframe>
        </div>
        <div class="col-md-6 pt-5 md:pt-0">
            <h4><?= $sysconf['library_name']; ?></h4>
            <p><?= $sysconf['template']['classic_map_desc']; ?></p>
            <p class="d-flex flex-row pt-2">
                <a target="_blank" href="<?= $sysconf['template']['classic_fb_link'] ?>" class="btn btn-primary mr-2" name="button"><i class="fab fa-facebook-square text-white"></i></a>
                <a target="_blank" href="<?= $sysconf['template']['classic_twitter_link'] ?>" class="btn btn-info mr-2" name="button"><i class="fab fa-twitter-square text-white"></i></a>
                <a target="_blank" href="<?= $sysconf['template']['classic_youtube_link'] ?>" class="btn btn-danger mr-2" name="button"><i class="fab fa-youtube text-white"></i></a>
                <a target="_blank" href="https://www.instagram.com/iain_padangsidimpuan/" class="btn btn-dark mr-2" name="button"><i class="fab fa-instagram text-white"></i></a>
            </p>
        </div>
    </div>
</section>
<?php endif; ?>

</div>