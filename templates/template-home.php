<?php
/*
  * Template name: Home page
  * */
get_header(); ?>
<?php if( is_plugin_active('advanced-custom-fields-pro-master/acf.php') ) : ?>
<!--First Section        -->
<?php $cycle = get_field('main_slider'); ?>
<?php if( $cycle ) : ?>
<section id="main__slider">
           <div class="slick">
               <?php foreach($cycle as $cycl): ?>
                   <div class="slide" style="background-image: url('<?php echo $cycl['slide']; ?>');"></div>
                <?php endforeach; ?>
           </div>
           <div class="text-right text-white slick-counter slick-sum">
                    <div class="current text-white">
                        <?php $array_length = count($cycle); ?>
                        <?php if( $array_length <= 9 ) : ?>0<?php endif; ?><span></span></div>
                    <div class="all text-white">
                        <?php if( $array_length <= 9 ) : ?>
                                | 0<?php echo $array_length; ?>
                        <?php else : ?>
                                    | <?php echo $array_length; ?> 
                        <?php endif; ?>  
                    </div>    
           </div>    
</section>
<script>
    jQuery(document).ready(function($){
        var $slickElement = $('#main__slider .slick');
        var $status = $('.slick-counter .current span');
        $slickElement.on('init reInit afterChange', function(event, slick, currentSlide, nextSlide){
            var i = (currentSlide ? currentSlide : 0) + 1;
                $status.text(i);
        });
    });
</script>
<?php endif; ?>
<!--End of First Section-->
<!--Second Section       -->
<section>
    <div class="container">
        <div class="row">
            <div class="d-none d-xl-block col-lg-5 text-left art__img">
                <img src="<?php echo get_template_directory_uri(); ?>/app/svg/text.svg" alt="" class="img-responsive">
            </div>
            <div class="col-12 col-lg-10 col-xl-7">
                <h2 class="main__title"><span class="w-100 d-block text-left"><?php the_field('second_section_header'); ?></span><small class="w-100 d-block text-right"><?php the_field('second_section_subheader'); ?></small></h2>
                <div class="section-content padding-r-30">
                    <?php the_field('second_section_text'); ?>
                </div>
            </div>
            <strong class="col-12 text-left add__text"><?php echo __('Заполните анкету и получите скидку'); ?></strong>
        </div>
    </div>
</section>
<!--End of Second Section-->
<!--Third Section       -->
<?php $cycle = get_field('third_section_special'); ?>
<?php if( $cycle ) : ?>
<section>
    <div class="container">
        <div class="row">
            <h2 class="col-12 text-left"><?php the_field('third_section_header'); ?></h2>
        </div>
    </div>
    <div class="grid home-grid">
            <?php foreach($cycle as $cycl): ?>
                <div class="w-100 grid__block" style="background-image: url('<?php echo $cycl['image']; ?>');">
                    <span class="d-flex justify-content-center text-center align-items-center"><?php echo $cycl['who']; ?></span>
                    <a href="<?php echo home_url(); ?>/<?php echo $cycl['link']; ?>" class="text-white btn red__btn justify-content-center text-center align-items-center"><?php echo __('Заполнить анкету'); ?></a>
                </div>
            <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>
<!--End of Third Section-->
<!--Fourth Section       -->
<?php $cycle = get_field('fourth_section_portfolio'); ?>
<?php if( $cycle ) : ?>
<section class="black__bg portfolio padding__120">
    <div class="container">
        <div class="row">
            <div class="col-12 text-left text-white"><?php echo __('Портфолио наших работ'); ?></div>
            <h2 class="col-12 text-left text-white"><?php the_field('fourth_section_header'); ?></h2>
        </div>
        <div class="row masonry" data-columns="" dir="rtl">
            <?php $count = 1; ?>
            <?php foreach($cycle as $cycl): ?>
               <?php if( !wp_is_mobile() ){
                        if( $count < 4 && $count % 2 == 0 ){
                        $padding = 'style="padding-top: 140px; "';
                         }
                         if( $count < 4 && $count % 3 == 0 ){
                            $padding = 'style="padding-top: 35px; "';
                         }
                         if( $count > 3 ){
                            $padding = '';
                         }
                    }
                ?>
                <div class="card__wrapper" <?php echo $padding; ?> >
                     <?php   
                                    $img = $cycl['image'];
                                    $size = 'portfolio';
                                    $thumb = $img['sizes'][ $size ];
                                    $width = $img['sizes'][ $size . '-width' ];
                                    $height = $img['sizes'][ $size . '-height' ];
                    ?>
                    <?php   
                                    $img_big = $cycl['image'];
                                    $size_big = 'full';
                                    $thumb_big = $img_big['sizes'][ $size_big ];
                                    $width_big = $img_big['sizes'][ $size_big . '-width' ];
                                    $height_big = $img_big['sizes'][ $size_big . '-height' ];
                    ?>
                    <?php if( !empty( $img ) ) : ?>
                        <a href="<?php echo $img_big['url']; ?>" class="fancybox" rel="gallery" data-fancybox="gallery" >
                            <img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" class="text-center d-block ml-auto mr-auto img-responsive">
                        </a>
                    <?php endif; ?>
                </div>
            <?php $count++; endforeach; ?>
        </div>
        <div class="row d-flex d-lg-none justify-content-center text-center align-items-center padding_50">
            <a href="#" class="btn black__btn d-flex justify-content-center text-center align-items-center ml-auto mr-auto" rel="nofollow"><?php echo __("Сделать запрос"); ?></a>
        </div>
    </div>
</section>
<?php endif; ?>
<!--End of Fourth Section-->
<!--Fifth Section       -->
<?php $cycle = get_field('fifth_section_slider'); ?>
<?php if( $cycle ) : ?>
<section>
    <div class="container">
        <div class="row">
            <div class="text-left col-12 add__text" style="padding-top: 80px"><?php echo __('Люди, которые помогут Вам с выбором'); ?></div>
            <h2 class="col-12 text-left"><?php echo __('Наши сотрудники'); ?></h2>
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
<!--End of Fifth Section-->
<!--Sixth Section       -->
<?php $cycle = get_field('sixth_section'); ?>
<?php if( $cycle ) : ?>
<section class="black__bg padding__120">
    <div class="container">
        <div class="row">
             <?php foreach($cycle as $cycl): ?>
                <div class="col-12 col-md-4 col-lg-4">
                    <?php   
                                    $img = $cycl['icon'];
                                    $size = 'icon';
                                    $thumb = $img['sizes'][ $size ];
                                    $width = $img['sizes'][ $size . '-width' ];
                                    $height = $img['sizes'][ $size . '-height' ];
                    ?>
                    <?php if( !empty( $img ) ) : ?>
                        <img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" class="text-center d-block ml-auto mr-auto" style="margin-bottom:30px;">
                    <?php endif; ?>
                    <p class="text-center text-white d-block ml-auto mr-auto icon__text"><?php echo $cycl['text']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
<!--End of Sixth Section-->
<!--Seventh Section       -->
<?php $cycle = get_field('seventh_section'); ?>
<?php if( $cycle ) : ?>
<section class="padding_50">
    <div class="container">
        <div class="row">
           <h2 class="col-12"><?php echo __('Сертификаты'); ?></h2>
           <?php foreach($cycle as $cycl): ?>
               <div class="col-12 col-md-4 col-lg-4">
                   <?php   
                                    $img = $cycl['sertificate'];
                                    $size = 'sertificate';
                                    $thumb = $img['sizes'][ $size ];
                                    $width = $img['sizes'][ $size . '-width' ];
                                    $height = $img['sizes'][ $size . '-height' ];
                    ?>
                    <?php   
                                    $img_big = $cycl['sertificate'];
                                    $size_big = 'full';
                                    $thumb_big = $img_big['sizes'][ $size_big ];
                                    $width_big = $img_big['sizes'][ $size_big . '-width' ];
                                    $height_big = $img_big['sizes'][ $size_big . '-height' ];
                    ?>
                    <?php if( !empty( $img ) ) : ?>
                       <a href="<?php echo $img_big['url']; ?>" class="fancybox" rel="sertificate" data-fancybox="sertificate" >
                            <img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" class="text-center d-block ml-auto mr-auto img-responsive">
                       </a>
                    <?php endif; ?>
               </div>
           <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
<!--End of Seventh Section-->
<!--Eighth Section       -->
<section>
    <div class="container">
        <div class="row">
            <h2 class="col-12"><?php echo __('Доставка по всей России'); ?></h2>
            <img src="<?php echo get_template_directory_uri(); ?>/app/svg/map.svg" alt="" class="col-12 img-responsive">
        </div>
    </div>
</section>
<!--End of Eighth Section-->
<?php else: ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <?php echo __('Включите плагин Advanced Custom Fields в админ-панели для корректной работы сайта'); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php if( is_home() || is_front_page() ) : ?>
    <script>
    jQuery(document).ready(function($) {
        var column = $('.masonry .col-lg-4:eq(1)').addClass('middle-column').css({'position':'relative'});
        column.append('<a href="#" class="btn black__btn d-flex justify-content-center text-center align-items-center ml-auto mr-auto" style="position: absolute;bottom: 0;left: 0;right: 0;"><?php echo __("Сделать запрос"); ?></a>');
    });
    </script>
<?php endif; ?>
<?php get_footer(); ?>