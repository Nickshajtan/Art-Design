<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package yp
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			 <section class="header black__bg">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 text-left text-white"><h1><?php if( !wp_is_mobile() ){ echo __('Ошибка 404: запрашиваемая страница не найдена'); } else { echo  __('Ошибка 404'); }?></h1></div>
                        </div>
                    </div>
                </section>
                <section class="white__bg padding-200-100">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-xl-6 rectangle-wrapper d-flex justify-content-center">
                                <div class="rectangle-black d-flex justify-content-center align-items-center">
                                    <div class="d-block d-xl-none text-white" style="font-size:9rem">404</div>
                                </div>
                            </div>
                            <div class="col-12 col-xl-6 d-flex align-items-center">
                                <div class="row">
                                    <div class="col-12 text-center big-text d-none d-xl-block">404</div>
                                    <div class="col-12 text-center middle-text"><?php echo __('Такой страницы не существует'); ?></div>
                                    <div class="col-12 text-center"><?php echo __('Но Вы можете просмотреть другие страницы '); ?><a href="<?php echo home_url(); ?>/catalogs" class="red-text">каталога</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
