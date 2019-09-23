<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package yp
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1" /> 
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php echo carbon_get_theme_option('body_scripts'); ?>
<div id="page" class="site">

	<header class="site-header <?php if( is_home() || is_front_page() ) : ?> black__bg<?php else : ?> grey__bg<?php endif; ?>">
        <div class="container-fluid">
            <div class="row">
                <?php if( is_plugin_active('advanced-custom-fields-pro-master/acf.php') ) : ?>
                    <div class="col-12">
                        <div class="row d-flex flex-row nav-wrapper justify-content-center">
                            <div class="col-4 col-xl-2 d-flex box box-one">
                                <?php           $img =   get_field('logo', 'options');
                                                    $size = 'logo';
                                                    $thumb = $img['sizes'][ $size ];
                                                    $width = $img['sizes'][ $size . '-width' ];
                                                    $height = $img['sizes'][ $size . '-height' ];
                                     ?>
                                     <?php if( !empty( $img ) ) : ?>
                                     <a href="<?php echo home_url(); ?>" class="logo">
                                         <img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" class="img-responsive">
                                     </a>
                            <?php endif; ?>
                            </div>
                            <div class="col-4 col-xl-8 d-flex box box-two">
                            <?php if (has_nav_menu('menu-1')) : ?>
                                <?php wp_nav_menu( array( 'menu' => 'menu-1', 'theme_location'  => 'menu-1', 'container' => 'nav', 'container_class' => 'h-100 d-flex align-items-center',  'menu_class' => 'w-100 h-100 flex-row align-items-center menu justify-space-between', 'depth' => 0,) ); ?>
                            <?php else : ?>
	                            <ul class="menu w-100 h-100 d-flex flex-row align-items-center menu justify-space-between">
	                                <?php wp_list_pages( array('depth' => 1, 'title_li' => '' )); ?>
	                            </ul>
                            <?php endif; ?>
                            <?php if( wp_is_mobile() ) : ?>
                                    <?php $cycle = get_field('phones', 'options'); ?>
                                    <?php if( $cycle ) : ?>
                                            <div class="contact-wrapper menu-contact w-100">
                                                <?php foreach($cycle as $cycl): ?>
                                                    <a href="tel:<?php echo $cycl['phone_tel']; ?>" class="d-block text-white w-100 contact-part"><?php echo $cycl['phone']; ?></a>
                                                <?php endforeach; ?>
                                            </div>
                                    <?php endif; ?>
                            <?php endif; ?>
                            <div class="closer">
                                <span class="first"></span>
                                <span class="second"></span>
                            </div>
                            </div>
                            <div class="col-4 col-xl-2 d-flex align-items-center box box-three">
                                <?php $cycle = get_field('phones', 'options'); ?>
                                <?php if( $cycle ) : ?>
                                        <div class="contact-wrapper">
                                            <?php foreach($cycle as $cycl): ?>
                                                <b><a href="tel:<?php echo $cycl['phone_tel']; ?>" class="d-block contact-part"><?php echo $cycl['phone']; ?></a></b>
                                            <?php endforeach; ?>
                                        </div>
                                <?php endif; ?>
                                <div class="search-wrapper">
                                    <?php if( is_home() || is_front_page() ) : ?>
                                        <div class="search-icon d-flex align-items-center justify-content-center"><img src="<?php echo get_template_directory_uri() ?>/app/img-optimize/search-white.svg" alt=""></div>
                                    <?php else : ?>
                                        <div class="search-icon d-flex align-items-center justify-content-center"><img src="<?php echo get_template_directory_uri() ?>/app/img-optimize/search.svg" alt=""></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="col-12 text-center"><?php echo __('Активируйте плагин Advanced Custom Fields в админ-панели сайта для корректного отображения контента'); ?></div>
                <?php endif; ?>
            </div>
        </div>
        <div class="burger">
            <span></span>
            <span></span>
            <span></span>
        </div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
