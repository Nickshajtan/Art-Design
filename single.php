<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package yp
 */

get_header(); ?>
<?php if( is_plugin_active('advanced-custom-fields-pro-master/acf.php') ) : ?>
    <?php if ( have_posts() ) : ?>
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <?php  while ( have_posts() ) : the_post(); ?>
                <section class="header black__bg">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 text-left text-white"><h1><?php the_title(); ?></h1></div>
                        </div>
                    </div>
                </section>
                <section class="padding-50-50 single-content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-lg-6 single-slider single-content">
                                <div class="row">
                                    <?php $cycle = get_field('fotos'); ?>
                                    <?php if( $cycle ) : ?>
                                                <div class="slider col-12">
                                                    <div class="row slick d-flex justify-content-center text-center align-items-center flex-row">
                                                        <?php foreach($cycle as $cycl): ?>
                                                            <?php $slide = $cycl['slide']; ?>
                                                            <?php   
                                                                        $img = $cycl['foto'];
                                                                        $size = 'tovar';
                                                                        $thumb = $img['sizes'][ $size ];
                                                                        $width = $img['sizes'][ $size . '-width' ];
                                                                        $height = $img['sizes'][ $size . '-height' ];
                                                            ?>
                                                            <?php if( !empty( $img ) ) : ?>
                                                                    <a href="<?php echo $img['url']; ?>" class="fancybox" >
                                                                         <img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" class="text-center d-block ml-auto img-responsive">
                                                                    </a>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                    <?php endif; ?>
                                    <div class="col-12 single-add d-none d-md-block d-xl-none"><?php echo __('Также мы можем помочь Вам с расчётом, для этого обратитесь '); ?><a href="<?php echo home_url(); ?>/calc" rel="nofollow" class="red-text"><?php echo __('сюда '); ?></a></div>
                                    <div class="col-12 single-add d-none d-md-block d-xl-none"><?php echo __('Присмотреть другие варианты Вы сможете в '); ?><a href="<?php echo home_url(); ?>/catalogs" rel="nofollow" class="red-text"><?php echo __('нашем каталоге '); ?></a></div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="row">
                                    <h2 class="col-12 left-50 accordeon-header" data-for="text-one"><?php echo __('Описание'); ?></h2>
                                    <div data-body="text-one" class="col-12 left-50 single-content accordeon-text"><?php the_field('text_one'); ?></div>
                                    <h2 class="col-12 left-50 accordeon-header" data-for="text-two"><?php echo __('Эксплуатационные данные'); ?></h2>
                                    <div data-body="text-two" class="col-12 left-50 single-content accordeon-text"><?php the_field('text_two'); ?></div>
                                    <div class="col-6 col-md-6  col-lg-4 left-50 single-content"><?php echo __('Модель'); ?></div><div class="col-6 col-md-6  col-lg-8"><?php the_field('model'); ?></div>
                                    <div class="col-6 col-md-6  col-lg-4 left-50 single-content"><?php echo __('Высота, мм'); ?></div><div class="col-6 col-md-6  col-lg-8"><?php the_field('height'); ?></div>
                                    <div class="col-6 col-md-6  col-lg-4 left-50 single-content"><?php echo __('Цвет по RAL'); ?></div><div class="col-6 col-md-6  col-lg-8"><?php the_field('color'); ?></div>
                                    <div class="col-12 col-md-6 left-50" style="padding-top:20px"><a href="<?php echo home_url(); ?>/calc" class="btn red__btn text-white d-flex justify-content-center text-center align-items-center btn" style="height:50px"><?php echo __('Сделать запрос'); ?></a></div>
                                </div>
                            </div>
                            <div class="col-12 single-add d-block d-md-none d-xl-block"><?php echo __('Также мы можем помочь Вам с расчётом, для этого обратитесь '); ?><a href="<?php echo home_url(); ?>/calc" class="red-text"><?php echo __('сюда '); ?></a></div>
                            <div class="col-12 single-add d-block d-md-none d-xl-block"><?php echo __('Присмотреть другие варианты Вы сможете в '); ?><a href="<?php echo home_url(); ?>/catalogs" class="red-text"><?php echo __('нашем каталоге '); ?></a></div>
                        </div>
                    </div>
                </section>
                <?php endwhile; ?>
            </main><!-- #main -->
        </div><!-- #primary -->
    <?php endif; ?>
<?php else : ?>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center"><?php echo __('Активируйте плагин Advanced Custom Fields в админ-панели сайта для корректного отображения контента'); ?></div>
        </div>
    </div>
<?php endif; ?>
<?php get_footer(); ?>