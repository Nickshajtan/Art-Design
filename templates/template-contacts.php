<?php
/*
  * Template name: Contact page
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
    <?php $cycle = get_field('fifth_section_slider', 2); ?>
    <?php if( $cycle ) : ?>
    <section class="padding_50">
        <div class="container">
            <div class="row">
                <div class="slider col-12">
                    <div class="row slick d-flex justify-content-center text-center align-items-center flex-row">
                        <?php foreach($cycle as $cycl): ?>
                            <?php $slide = $cycl['slide']; ?>
                            <?php   
                                        $img = $cycl['slide']['foto'];
                                        $size = 'slide';
                                        $thumb = $img['sizes'][ $size ];
                                        $width = $img['sizes'][ $size . '-width' ];
                                        $height = $img['sizes'][ $size . '-height' ];
                            ?>
                          <div class="col-12 d-flex justify-content-center text-center align-items-center">
                              <div class="row d-flex justify-content-center text-center align-items-center padding_100" style="">
                                    <?php if( !empty( $img ) ) : ?>
                                    <div class="col-12 col-md-6 col-lg-4 col-xl-4 person__wrapper">
                                         <img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" class="text-center d-block ml-auto mr-auto img-responsive">
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-12 col-md-6 col-lg-8 col-xl-6">
                                        <p class="d-block text-left"><?php echo $slide['position']; ?></p>
                                        <div class="duties d-block text-left"><?php echo $slide['duties']; ?></div>
                                        <p><b class="d-block text-left"><?php echo $slide['name']; ?></b></p>
                                        <div class="d-block text-left"><?php echo $slide['description']; ?></div>
                                        <b><a href="tel:<?php echo $slide['phone_tel']; ?>" class="text-left text-dark d-block"><?php echo $slide['phone']; ?></a></b>
                                        <b><a href="mailto:<?php echo $slide['email']; ?>" class="text-left text-dark d-block"><?php echo $slide['email']; ?></a></b>
                                        <a href="mailto:<?php echo $slide['email']; ?>" class="btn red__btn text-white d-flex justify-content-center text-center align-items-center"><?php echo __('Написать'); ?></a>
                                    </div>
                              </div>
                          </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <section class="padding-100">
        <div class="container-fluid">
            <div class="row">
               <?php $html_map = get_field('map_html'); ?>
               <?php $js_map = get_field('js_map_link'); ?>
                <div class="col-12 col-lg-12 col-xl-7"><div id="map" class="d-flex w-100 h-100"><?php if( empty( $js_map) && !empty( $html_map ) ){ echo $html_map; } ?></div></div>
                <div class="col-12 col-lg-12 col-xl-5 contact-info">
                    <?php the_content(); ?>
                    <div class="row">
                        <?php $cycle = get_field('write_us'); ?>
                        <?php if($cycle) : ?>
                            <div class="col-12 text-left"><?php echo __('Написать нам:'); ?></div>
                            <?php foreach( $cycle as $cycl ) : ?>
                               <div class="col-12 col-md-4 col-lg-4 d-flex justify-content-center text-center align-items-center" style="margin-top:30px">
                                   <a href="<?php echo $cycl['button_link']; ?>" class=" white__btn btn"><?php echo $cycl['button_text']; ?></a>
                               </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endwhile; endif; ?>
    <?php if( empty( $js_map ) && empty( $html_map ) ) : ?>
        <script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <?php elseif( !empty( $js_map ) && empty( $html_map ) ) : ?>
        <script src="<?php echo $js_map; ?>" type="text/javascript"></script>
    <?php endif; ?>
    <?php if( empty( $html_map ) ) : ?>
        <script type="text/javascript">
            try {
                ymaps.ready(function () {

                 var myMap = new ymaps.Map('map', {
                 center: [<?php trim(the_field('coordinats_center')); ?>],
                 zoom: 15,
                 behaviors: ['default', 'scrollZoom'],
                 controls: ['zoomControl', 'geolocationControl',]
                 }, {
                 searchControlProvider: 'yandex#search'
                 }),

                 myPlacemark = new ymaps.Placemark([<?php trim(the_field('coordinats')); ?>], 
                 <?php $img = get_field('logo', 'options'); ?>
                 {balloonContent: "<div class='ballon-point'><div class='ballon-img'><?php if( !empty( $img ) ) : ?><img src='<?php echo $img['url']; ?>' alt='<?php echo $img['alt']; ?>' class='img-responsive'><?php endif; ?></div><div class='ballon-content'><?php the_field('map_text'); ?></div></div>"},

                 {
                 iconLayout: 'default#image',
                 iconImageHref: '<?php echo get_template_directory_uri() ?>/app/img-optimize/mark.png',
                 iconImageSize: [80, 90],
                 iconImageOffset: [-30, -90]
                 });

                 myMap.geoObjects.add(myPlacemark);
                 myMap.behaviors.disable('scrollZoom');

                });
            }catch (e) {
                document.getElementById('map').innerHTML='<div class="w-100 justify-content-center text-center align-items-center d-flex" style="background-color: #ddd;"><?php echo __('Извините, произошла ошибка'); ?></div>';
            }
        </script>
    <?php endif; ?>
    <script src="<?php echo get_template_directory_uri() ?>\app\libs\jquery\slick\slick.js"></script>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>\app\libs\jquery\slick\slick.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>\app\libs\jquery\slick\slick-theme.css">
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
<?php else : ?>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center"><?php echo __('Активируйте плагин Advanced Custom Fields в админ-панели сайта для корректного отображения контента'); ?></div>
        </div>
    </div>
<?php endif; ?>
<?php get_footer(); ?>