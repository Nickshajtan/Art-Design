<?php get_header(); ?>
<?php $post_page_title = get_the_title( get_option('page_for_posts', true) ); ?>
<section class="header black__bg">
    <div class="container">
        <div class="row">
            <div class="col-12 text-left text-white"><h1><?php single_cat_title();  ?></h1></div>
        </div>
    </div>
</section>
<?php if ( have_posts() ) : ?>
<section class="<?php if( !wp_is_mobile() ) : ?> black__bg<?php else : ?> white__bg <?php endif; ?>">
    <div class="container-fluid">
        <div class="row">
            <aside class="col-12 col-xl-3 <?php if( !wp_is_mobile() ) : ?> black__bg<?php else : ?> white__bg <?php endif; ?> padding-50">
                <?php $categories = get_categories( array(
                        'taxonomy'     => 'category',
                        'child_of'     => get_queried_object()->term_id,
                        'parent'       => get_queried_object()->term_id,
                        'type'         => 'post',
                        'orderby'      => 'name',
                        'order'        => 'ASC',
                        'hide_empty'   => 0,
                        'hierarchical' => 0,
                        'exclude'      => '1',
                    ) ); ?>
                    <?php if( $categories ) : ?>
                           <h2 class="accordeon-header" data-for="category"><?php echo __('Подкатегории'); ?></h2>
                           <div data-body="category" class="categories cut black__bg accordeon-text">
                            <?php foreach( $categories as $category ) : ?>
                                <a href="<?php echo get_category_link( $category->term_id ); ?>" class="d-flex flex-column">
                                    <?php if( $category->parent  ){ $clss ='chld'; } ?>
                                    <?php echo '<p class="' . $category->parent . ' ' . $clss . ' text-white">'  . $category->name.'</p> '; ?>
                                </a>
                            <?php endforeach; ?>
                            </div>
                    <?php endif; ?>
                    <?php $categories = get_categories( array(
                        'taxonomy'     => 'taxonomy',
                        'type'         => 'post',
                        'orderby'      => 'name',
                        'order'        => 'ASC',
                        'hide_empty'   => 0,
                        'hierarchical' => 0,
                        'exclude'      => '1',
                    ) ); ?>
                    <?php if( $categories ) : ?>
                            <h2 class="accordeon-header" data-for="brand"><?php echo __('Бренд'); ?></h2>
                            <div data-body="brand" class="categories brands black__bg accordeon-text">
                            <?php foreach( $categories as $category ) : ?>
                                <a href="<?php echo get_category_link( $category->term_id ); ?>" class="d-flex flex-row align-items-center">
                                    <span class="check"></span><?php echo '<p class="' . $category->parent . ' text-white">' . $category->name.'</p> '; ?>
                                </a>
                            <?php endforeach; ?>
                            </div>
                    <?php endif; ?>
            </aside>
            <div class="col-12 col-xl-9 grid-content white__bg item-container">
                <?php  while ( have_posts() ) : the_post(); ?>
                    <article class="d-flex flex-column item">
                        <a href="<?php the_permalink(); ?>" class="d-flex flex-column article-wrapper">
                            <span class="title text-white"><?php the_title(); ?></span>
                            <?php the_post_thumbnail(); ?>
                            <span class="ask text-center"><?php echo __('Сделать запрос'); ?></span>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>
            <?php if (function_exists('the_posts_pagination') ) : ?>
                <div class="d-none d-xl-block col-xl-3"></div>
                <div class="col-12 col-xl-9 black__bg d-flex align-items-center justify-content-center"><?php the_posts_pagination(); ?></div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php get_footer(); ?>
