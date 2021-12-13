<?php
/**
 * The template for displaying archive pages
 *
 * @package    WordPress
 * @subpackage Dntheme
 * @version 1.0
 */

get_header();
$term = get_queried_object();
$term_id = $term->term_id;
?>
<section class="page__header text-center">
  <div class="container">
    <?php the_archive_title();?>
    <?php dntheme_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
  </div>
</section>

<div class="archive__content">
  <div class="container">

    <?php if($term->parent == 0): ?>
        <div class="row mb-4 gx-lg-5">
          <div class="col-lg-4 order-lg-2">
            <section class="widget widget_search">
              <?php get_search_form() ?>
            </section>

            <div class="archive__featured">
              <div class="list__item__title"><?php _e('Featured','dntheme'); ?></div>
              <?php
              $args = array(
                  'post_type' => 'post',
                  'posts_per_page' =>5,
                  'meta_key' => '_jsFeaturedPost',
                  "meta_value" => 'yes'
              );
              $the_query = new WP_Query( $args );
              if ( $the_query->have_posts() ) : ?>
                <ul class="list__item">
                  <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                        <li><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></li>
                    <?php endwhile; ?>
                </ul>
                <?php wp_reset_postdata(); ?>
              <?php else :
                  get_template_part( 'template-parts/content', 'none' );
              endif; ?>
            </div>
          </div>

          <div class="col-lg-8">
            <?php
             if ( have_posts() ) :
                echo '<div class="row">';
                while ( have_posts() ) : the_post();?>
                    <div class="new__item -large">
                      <a href="<?php the_permalink(); ?>">
                        <div class="new__item__thumb ef--zoomin">
                          <div class="dnfix__thumb">
                            <?php the_post_thumbnail('large',array( 'class' => 'img-fluid','alt'   => get_the_title() )); ?>
                          </div>
                          <div class="new__item__tax"><?php echo $term->name; ?></div>
                        </div>
                        <div class="new__item__meta">
                          <h3 class="new__item__title text__truncate -n2"><?php the_title() ?></h3>
                          <div class="new__item__date"><?php echo get_the_time("d/m/Y"); ?></div>
                          <div class="new__item__excerpt text__truncate -n3"><?php dn_excerpt(250); ?></div>
                          <div class="new__item__readmore"><?php _e('Read more','dntheme'); ?></div>
                        </div>
                      </a>
                    </div>
                  <?php
                break;
                endwhile;
                echo '</div>';
             else :
                 get_template_part( 'template-parts/content', 'none' );
             endif;
            wp_reset_postdata();
            ?>
          </div>
        </div>

        <hr>

        <ul class="archive__cat">
        <?php
          $categories=get_categories(
              array(
                'parent' => $term_id,
                'hide_empty'      => false
            )
          );
          foreach ($categories as $category) {
            $check_active = ($category->term_id == $term_id) ? 'active' : '';
            echo '<li class="'.$check_active.'"><a href="'.get_category_link($category).'">'.$category->name.'</a></li>';
          }
         ?>
        </ul>
    <?php endif; ?>
    <?php
    if ( have_posts() ) : //$i=0;
        echo '<div class="row">';
        while ( have_posts() ) : the_post(); //$i++;
          // if($i>=2){
          ?>
            <div class="col-lg-4 col-md-6 d-md-flex">
                <?php get_template_part( 'template-parts/content','archive'); ?>
            </div>
        <?php
          // }
        endwhile;
        echo '</div>';
        dntheme_paging_nav();
    endif;
    ?>
  </div>
</div>

<?php get_footer();
