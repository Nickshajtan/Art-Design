<?php
/*
  * Template name: Payment page
  * */
get_header(); ?>
<?php if( is_plugin_active('advanced-custom-fields-pro-master/acf.php') ) : ?>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <section class="header black__bg">
        <div class="container">
            <div class="row">
                <div class="col-12 text-left text-white"><h1><?php the_title(); ?></h1></div>
            </div>
        </div>
    </section>
    <section class="padding_50">
        <div class="container-fluid">
            <div class="row">
                <div class="d-none d-xl-block col-lg-5 text-left art__img">
                    <img src="<?php echo get_template_directory_uri(); ?>/app/svg/text.svg" alt="" class="img-responsive">
                </div>
                <div class="col-12 col-lg-12 col-xl-7 sale-methods">
                    <div class="row">
                        <?php $cycle = get_field('first_cycle'); ?>
                        <?php if($cycle) : ?>
                            <h2 class="text-left col-12"><?php echo __('Способы оплаты'); ?></h2>
                            <?php $count = 1; ?>
                            <?php foreach( $cycle as $cycl ) : ?>
                                <div class="<?php echo ( $count % 2 ==0 ) ? 'col-5': 'col-7'; ?> col-md-6 col-lg-4">
                                    <?php   
                                        $img = $cycl['icon'];
                                        $size = 'icon-small';
                                        $thumb = $img['sizes'][ $size ];
                                        $width = $img['sizes'][ $size . '-width' ];
                                        $height = $img['sizes'][ $size . '-height' ];
                                    ?>
                                    <div class="w-100 d-flex align-items-center justify-content-start">
                                        <span class="count"><ol style="width: calc(30px + <?php echo $count; ?>0px);"><?php for( $i = 1; $i <= $count; $i++ ) : ?><li style="<?php if( $i != $count ){ echo 'list-style:none;'; } ?>"></li><?php endfor; ?></ol></span><img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" class="text-center d-block mr-auto img-responsive">
                                    </div>
                                    <div class="w-100 bold-wrapper"><b><?php echo $cycl['header']; ?></b></div>
                                    <div class="w-100 d-none d-md-block"><?php echo $cycl['text']; ?></div>
                                </div>
                            <?php $count++; endforeach; ?>
                        <?php endif; ?>
                        <?php $cycle = get_field('second_cycle'); ?>
                        <?php if($cycle) : ?>    
                            <h2 class="text-left col-12"><?php echo __('Способы доставки'); ?></h2>
                            <?php $count = 1; ?>
                            <?php foreach( $cycle as $cycl ) : ?>
                                <div class="<?php echo ( $count % 2 ==0 ) ? 'col-5':  'col-7'; ?> col-md-6 col-lg-4">
                                    <?php   
                                        $img = $cycl['icon'];
                                        $size = 'icon-small';
                                        $thumb = $img['sizes'][ $size ];
                                        $width = $img['sizes'][ $size . '-width' ];
                                        $height = $img['sizes'][ $size . '-height' ];
                                    ?>
                                    <div class="w-100 d-flex align-items-center justify-content-start">
                                        <span class="count"><ol style="width: calc(30px + <?php echo $count; ?>0px);"><?php for( $i = 1; $i <= $count; $i++ ) : ?><li style="<?php if( $i != $count ){ echo 'list-style:none;'; } ?>"></li><?php endfor; ?></ol></span><img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" class="text-center d-block mr-auto img-responsive">
                                    </div>
                                    <div class="w-100 bold-wrapper"><b><?php echo $cycl['header']; ?></b></div>
                                    <div class="w-100 d-none d-md-block"><?php echo $cycl['text']; ?></div>
                                </div>
                            <?php $count++; endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endwhile; endif; ?>
<?php else : ?>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center"><?php echo __('Активируйте плагин Advanced Custom Fields в админ-панели сайта для корректного отображения контента'); ?></div>
        </div>
    </div>
<?php endif; ?>
<?php get_footer(); ?>