<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package yp
 */

get_header(); ?>
<?php $post_page_title = get_the_title( get_option('page_for_posts', true) ); ?>
<section class="header black__bg">
    <div class="container">
        <div class="row">
            <div class="col-12 text-left text-white"><h1><?php echo $post_page_title ?></h1></div>
        </div>
    </div>
</section>
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
                           <h2 class="accordeon-header" data-for="category"><?php echo __('Категории'); ?></h2>
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
            <div class="col-12 col-xl-9 grid-content white__bg" style="height: max-content;">        
                 <?php $categories = get_categories( array(
                        'taxonomy'     => 'category',
                        'type'         => 'post',
                        'orderby'      => 'name',
                        'order'        => 'ASC',
                        'hide_empty'   => 0,
                        'hierarchical' => 0,
                        'exclude'      => '1',
                    ) ); ?>
                    <?php if( $categories ) : ?>
                            <?php foreach( $categories as $category ) : ?>
                               <article class="d-flex flex-column">
                                <a href="<?php echo get_category_link( $category->term_id ); ?>" class="d-flex flex-column article-wrapper">
                                    <?php $term_id = $category->term_id;
                                          $image_id = get_term_meta( $term_id, '_thumbnail_id', 1 );
                                          $image_url = wp_get_attachment_image_url( $image_id, 'full' ); 
                                    ?>
                                    <?php if($image_url) : ?>
                                        <?php echo '<img src="'. $image_url .'" alt="" />'; ?>
                                    <?php endif; ?>
                                    <?php echo '<span class="ask text-center main">' . $category->name.'</span> '; ?>
                                </a>
                               </article>
                            <?php endforeach; ?>
                    <?php endif; ?>    
            </div>
               <?php if( wp_is_mobile() ) { $post_per_page = 3; } else { $post_per_page = 9; } ?>
                            <?php if ( get_query_var('paged') ) {
                                            $paged = get_query_var('paged');
                                  } elseif ( get_query_var('page') ) { // на статической главной странице используется 'page' вместо 'paged' 
                                            $paged = get_query_var('page');
                                  } else {
                                            $paged = 1;
                                  }?>
                <?php $query = new WP_Query( array( 'post_type' => 'post', 'order' => 'ASC', 'posts_per_page' => $post_per_page, 'paged' => $paged, 'cat' => '1') ); ?>
                 <?php if ($query->have_posts()) : ?>
                        <h2 class="col-12 white__bg"><?php __('Без категории'); ?></h2>
                        <div class="col-12 col-xl-9 grid-content white__bg item-container">  
                            <?php while ($query->have_posts()) : $query->the_post(); ?>
                                <article class="d-flex flex-column item">
                                    <a href="<?php the_permalink(); ?>" class="d-flex flex-column article-wrapper">
                                        <span class="title text-white"><?php the_title(); ?></span>
                                        <?php the_post_thumbnail(); ?>
                                        <span class="ask text-center"><?php echo __('Сделать запрос'); ?></span>
                                    </a>
                                </article>
                            <?php endwhile; ?>    
                            <?php wp_reset_query(); ?>
                        </div>
                        <?php if (function_exists('the_posts_pagination') ) : ?>
                            <div class="d-none d-xl-block col-xl-3"></div>
                            <div class="col-12 col-xl-9 black__bg d-flex align-items-center justify-content-center"><?php the_posts_pagination(); ?></div>
                        <?php endif; ?>
                <?php endif; ?>
        </div>
    </div>
</section>
<?php get_footer();
