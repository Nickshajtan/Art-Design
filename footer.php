<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package yp
 */

?>

	</div><!-- #content -->
    <?php if( is_plugin_active('advanced-custom-fields-pro-master/acf.php') ) : ?>
	<footer class="site-footer">
		<div class="container-fluid">
		    <div class="row">
		        <div class="footer-grid grid">
                    <div class="grid-box box-one">
                            <?php           $img =   get_field('logo', 'options');
                                            $size = 'logo';
                                            $thumb = $img['sizes'][ $size ];
                                            $width = $img['sizes'][ $size . '-width' ];
                                            $height = $img['sizes'][ $size . '-height' ];
                             ?>
                             <?php if( !empty( $img ) ) : ?>
                             <a href="<?php echo home_url(); ?>" class="logo">
                                 <img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" class="text-left img-responsive">
                             </a>
                             <?php endif; ?>
                             <p class="text-white copyright text-left d-none d-md-block"><?php echo __('© Все права защищены ') . date('Y'); ?></p>
                             <?php if( wp_is_mobile() ) : ?>
                             <div class="d-block d-xl-none">
                                 <?php $cycle = get_field('phones', 'options'); ?>
                                     <?php if( $cycle ) : ?>
                                        <?php foreach($cycle as $cycl): ?>
                                            <a href="tel:<?php echo $cycl['phone_tel']; ?>" class="text-white d-block contact-part"><?php echo $cycl['phone']; ?></a>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <?php $cycle = get_field('emails', 'options'); ?>
                                    <?php if( $cycle ) : ?>
                                        <?php foreach($cycle as $cycl): ?>
                                            <a href="mailto:<?php echo $cycl['email']; ?>" class="text-white d-block contact-part"><?php echo $cycl['email']; ?></a>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <?php $cycle = get_field('social', 'options'); ?>
                                    <?php if( $cycle ) : ?>
                                        <div class="d-flex w-50 align-items-center justify-content-between social-wrapper">
                                        <?php foreach($cycle as $cycl): ?>
                                            <?php       $img =  $cycl['icon'];
                                                        $size = 'social';
                                                        $thumb = $img['sizes'][ $size ];
                                                        $width = $img['sizes'][ $size . '-width' ];
                                                        $height = $img['sizes'][ $size . '-height' ];
                                            ?>
                                            <?php if( !empty( $img ) ) : ?>
                                            <a href="<?php echo $cycl['link']; ?>" target="_blank">
                                                <img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" class="text-center d-block ml-auto mr-auto img-responsive">
                                            </a>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                             </div>
                             <?php endif; ?>
                    </div>
                    <nav class="grid-box box-two">
                            <?php $category = get_category(2); 
                                  echo '<p><a href="' . get_category_link( $category->term_id ) . '" class="text-white title">' . $category->name.'</a> </p> ' ?>
                            <?php if( wp_is_mobile() ) : ?>
                            <div class="d-block d-xl-none">
                                <?php $category = get_category(9); 
                                  echo '<p><a href="' . get_category_link( $category->term_id ) . '" class="text-white title">' . $category->name.'</a> </p> ' ?>
                                <?php $category = get_category(13); 
                                  echo '<p><a href="' . get_category_link( $category->term_id ) . '" class="text-white title">' . $category->name.'</a> </p> ' ?>
                                <?php wp_nav_menu( array( 'menu' => 'menu-2', 'menu_class' => 'menu text-white') ); ?>
                            </div>
                            <?php endif; ?>
                            <?php $categories = get_categories( array(
                                'taxonomy'     => 'category',
                                'type'         => 'post',
                                'child_of'     => 2,
                                'parent'       => 2,
                                'orderby'      => 'name',
                                'order'        => 'ASC',
                                'hide_empty'   => 0,
                                'hierarchical' => 1,
                                'exclude'      => '',
                            ) ); ?>
                            <?php if( $categories && !wp_is_mobile() ) : ?>
                                <ul class="text-white d-none d-lg-block">
                                    <?php foreach( $categories as $category ) : ?>
                                        <?php echo '<li><a href="' . get_category_link( $category->term_id ) . '" class="text-white">' . $category->name.'</a> </li> '; ?>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                    </nav>
                    <?php if( !wp_is_mobile() ) : ?>
                    <nav class="grid-box box-three">
                         <?php $category = get_category(9); 
                                  echo '<p><a href="' . get_category_link( $category->term_id ) . '" class="text-white title">' . $category->name.'</a> </p> ' ?>
                         <?php $categories = get_categories( array(
                                'taxonomy'     => 'category',
                                'type'         => 'post',
                                'child_of'     => 9,
                                'parent'       => 9,
                                'orderby'      => 'name',
                                'order'        => 'ASC',
                                'hide_empty'   => 0,
                                'hierarchical' => 1,
                                'exclude'      => '',
                            ) ); ?>
                            <?php if( $categories && !wp_is_mobile() ) : ?>
                                <ul class="text-white d-none d-lg-block">
                                    <?php foreach( $categories as $category ) : ?>
                                        <?php echo '<li><a href="' . get_category_link( $category->term_id ) . '" class="text-white">' . $category->name.'</a> </li> '; ?>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            <?php $category = get_category(13); 
                                  echo '<p><a href="' . get_category_link( $category->term_id ) . '" class="text-white title">' . $category->name.'</a> </p> ' ?>
                             <?php $categories = get_categories( array(
                                'taxonomy'     => 'category',
                                'type'         => 'post',
                                'child_of'     => 13,
                                'parent'       => 13,
                                'orderby'      => 'name',
                                'order'        => 'ASC',
                                'hide_empty'   => 0,
                                'hierarchical' => 1,
                                'exclude'      => '',
                            ) ); ?>
                            <?php if( $categories && !wp_is_mobile() ) : ?>
                                <ul class="text-white d-none d-lg-block">
                                    <?php foreach( $categories as $category ) : ?>
                                        <?php echo '<li><a href="' . get_category_link( $category->term_id ) . '" class="text-white">' . $category->name.'</a> </li> '; ?>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                    </nav>
                    <?php if (has_nav_menu('menu-2')) : ?>
                        <nav class="grid-box box-four"><?php wp_nav_menu( array( 'menu' => 'menu-2', 'theme_location'  => 'menu-2', 'menu_class' => 'menu text-white', 'depth' => 1,) ); ?></nav>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if( !wp_is_mobile() ) : ?>
                    <div class="grid-box box-five">
                         <?php $cycle = get_field('phones', 'options'); ?>
                         <?php if( $cycle ) : ?>
                            <?php foreach($cycle as $cycl): ?>
                                <a href="tel:<?php echo $cycl['phone_tel']; ?>" class="text-white d-block contact-part"><?php echo $cycl['phone']; ?></a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php $cycle = get_field('emails', 'options'); ?>
                        <?php if( $cycle ) : ?>
                            <?php foreach($cycle as $cycl): ?>
                                <a href="mailto:<?php echo $cycl['email']; ?>" class="text-white d-block contact-part"><?php echo $cycl['email']; ?></a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php $cycle = get_field('social', 'options'); ?>
                        <?php if( $cycle ) : ?>
                            <div class="d-flex w-50 align-items-center justify-content-between social-wrapper">
                            <?php foreach($cycle as $cycl): ?>
                                <?php       $img =  $cycl['icon'];
                                            $size = 'social';
                                            $thumb = $img['sizes'][ $size ];
                                            $width = $img['sizes'][ $size . '-width' ];
                                            $height = $img['sizes'][ $size . '-height' ];
                                ?>
                                <?php if( !empty( $img ) ) : ?>
                                <a href="<?php echo $cycl['link']; ?>" target="_blank">
                                    <img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" class="text-center d-block ml-auto mr-auto img-responsive">
                                </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
		    </div>
		</div>
	</footer>
	<?php endif; ?>
</div><!-- #page -->
<?php if( is_plugin_active('advanced-custom-fields-pro-master/acf.php') ) : ?>
    <?php $page_template = get_post_meta($post_ID, '_wp_page_template', true); ?>
    <?php if( is_home() || is_front_page() || is_single() || ( $page_template == 'templates/template-contacts.php') ) : ?>
    <script>
        jQuery(document).ready(function($){
             $('.slick').slick({
                 slidesToShow: 1,
                 infinite: true,
                 slidesToScroll: 1,
                 dots: true,
                 arrows: true,
                 prevArrow:"<button type='button' class='slick-prev pull-left'><img src='<?php echo get_template_directory_uri() ?>/app/svg/arrow-left.svg'></button>",
                 nextArrow:"<button type='button' class='slick-next pull-right'><img src='<?php echo get_template_directory_uri() ?>/app/svg/arrow-right.svg'></button>",
             });
             $('.slick').each(function(){
                var list = $(this).find('.slick-dots');
                var next = $(this).find('.slick-next');
                var prev = $(this).find('.slick-prev');
                list.prepend(next);
                list.prepend(prev);
             });
        });
    </script>
    <?php endif; ?>
    <?php $ais = carbon_get_theme_option('ais'); ?>
    <?php if( ( is_home() || is_category() || is_archive() || is_tax() ) && $ais ) : ?>
        <script>
         jQuery(document).ready(function($){
                        var ias = jQuery.ias( {
                          container: ".<?php echo carbon_get_theme_option('ais_container'); ?>",
                          item: ".<?php echo carbon_get_theme_option('ais_item'); ?>",
                          pagination: ".<?php if( !empty( carbon_get_theme_option('ais_pagination') ) ) : echo carbon_get_theme_option('ais_pagination'); else: ?>nav-links<?php endif; ?>",
                          next: ".<?php if( !empty( carbon_get_theme_option('ais_pagination') ) ) : echo carbon_get_theme_option('ais_pagination'); else: ?>nav-links <?php endif; ?>.<?php if( !empty( carbon_get_theme_option('ais_next') ) ) : echo carbon_get_theme_option('ais_next'); else: ?>next<?php endif; ?>",
                        } );
                        ias.extension( new IASTriggerExtension( { offset: <?php if( !empty( carbon_get_theme_option('ais_offset') && is_numeric( carbon_get_theme_option('ais_offset') ) ) ) : echo carbon_get_theme_option('ais_offset'); else: echo 1; endif; ?> } ) );
                        ias.extension( new IASSpinnerExtension() );
                        ias.extension( new IASNoneLeftExtension() );  
         });
        </script>
    <?php endif; ?>
<?php endif; ?>

<script type="text/javascript">
    var templateUrl = '<?= get_template_directory_uri(); ?>';
    var home_url = '<?php echo home_url(); ?>';
</script>

<?php wp_footer(); ?>
</body>
</html>
