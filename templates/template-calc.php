<?php
/*
  * Template name: Calc page
  * */
get_header(); ?>
<?php if( is_plugin_active('advanced-custom-fields-pro-master/acf.php') ) : ?>
    <?php if ( have_posts() ) : ?>
        <?php  while ( have_posts() ) : the_post(); ?>
    <section class="header black__bg">
        <div class="container">
            <div class="row">
                <div class="col-12 text-left text-white"><h1><?php the_title(); ?></h1></div>
            </div>
        </div>
    </section>
    <section class="padding_50">
        <div class="container">
            <div class="row">
                <form action="" method="post" class="col-12 text-left submit">
                   <?php $cycle = get_field('first'); ?>
                   <?php if( $cycle ) : ?>
                   <div class="form-group">
                       <p class="form-title"><b><?php echo __('Объект'); ?></b></p>
                       <?php foreach($cycle as $cycl): ?>
                       <div class="form-label left-100 d-inline-flex align-items-center w-100">
                           <div class="check"></div><span><?php echo $cycl['one']; ?></span>
                       </div>
                       <?php endforeach; ?>
                   </div>
                   <?php endif; ?>
                   <?php $cycle = get_field('second'); ?>
                   <?php if( $cycle ) : ?>
                   <div class="form-group">
                       <p class="form-title"><b><?php echo __('Какое оборудование подбираете'); ?></b></p>
                       <?php foreach($cycle as $cycl): ?>
                       <div class="form-label left-100 d-inline-flex align-items-center w-100">
                           <div class="check"></div><span><?php echo $cycl['one']; ?></span>
                       </div>
                       <?php endforeach; ?>
                   </div>
                   <?php endif; ?>
                   <?php $cycle = get_field('third'); ?>
                   <?php if( $cycle ) : ?>
                   <div class="form-group">
                       <p class="form-title"><b><?php echo __('Наличие Спецификации/плана объекта'); ?></b></p>
                       <?php foreach($cycle as $cycl): ?>
                       <div class="form-label left-100 d-inline-flex align-items-center w-100">
                           <div class="check"></div><span><?php echo $cycl['one']; ?></span>
                       </div>
                       <?php endforeach; ?>
                   </div>
                   <?php endif; ?>
                   <?php $cycle = get_field('fourth'); ?>
                   <?php if( $cycle ) : ?>
                   <div class="form-group">
                       <p class="form-title"><b><?php echo __('Когда планируется закупка оборудования'); ?></b></p>
                       <?php foreach($cycle as $cycl): ?>
                       <div class="form-label left-100 d-inline-flex align-items-center w-100">
                           <div class="check"></div><span><?php echo $cycl['one']; ?></span>
                       </div>
                       <?php endforeach; ?>
                   </div>
                   <?php endif; ?>
                   <?php $cycle = get_field('fifth'); ?>
                   <?php if( $cycle ) : ?>
                   <div class="form-group">
                       <p class="form-title"><b><?php echo __('Комплектация объекта'); ?></b></p>
                       <?php foreach($cycle as $cycl): ?>
                       <div class="form-label left-100 d-inline-flex align-items-center w-100">
                           <div class="check"></div><span><?php echo $cycl['one']; ?></span>
                       </div>
                       <?php endforeach; ?>
                   </div>
                   <?php endif; ?>
                   <div class="form-group">
                       <p class="form-title"><b><?php echo __('Дополнительные сведения, которые хотели-бы сообщить'); ?></b></p>
                       <div class="form-label left-100 d-inline-flex align-items-center w-100">
                           <textarea name="" id="" cols="30" rows="5" class="w-50"></textarea>
                       </div>
                   </div>
                   <input type="submit" value="<?php echo __('Сделать запрос'); ?>" class="text-center text-white btn red__btn d-flex align-items-center justify-content-center">
                </form>
            </div>
        </div>
    </section>
        <?php endwhile; ?>
    <?php endif; ?>
    <script src="<?php echo get_template_directory_uri() ?>\app\js\form-calc.js"></script>  
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
<?php get_footer(); ?>