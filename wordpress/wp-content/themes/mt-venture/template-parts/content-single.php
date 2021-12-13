<?php
/**
 * Template part for displaying posts
 *
 * @package    WordPress
 * @subpackage Dntheme
 * @version 1.0
 */
$categories = get_the_category(get_the_ID());
$cat_name = $categories[0]->name;
$cat_link = get_category_link($categories[0]);
?>

<section class="page__header single__header text-center">
    <div class="container">
      <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </div>
</section>

<div class="single__header text-center">
    <div class="container">
      <div class="single__featured">
        <?php the_post_thumbnail('full',array( 'class' => 'img-fluid','alt'   => get_the_title() )); ?>
      </div>
    </div>
</div>

<div class="single-content__wrapper">
    <div class="container">

      <div class="single__share">
            <p>Share</p>
            <a href="https://www.facebook.com/sharer.php?u=<?php the_permalink() ?>" class="-fb" target="_blank"><span class="icon-facebook"></span></a>
            <a href="https://twitter.com/intent/tweet?&url=<?php the_permalink() ?>" class="-tw" target="_blank"><span class="icon-twitter"></span></a>
            <a href="https://telegram.me/share/url?url=<?php the_permalink() ?>&text=<?php the_title() ?>" class="-tele" target="_blank"><span class="icon-telegram"></span></a>
        </div>
      <div class="single-content">
        <div class="single__meta">
          <div class="">
            <div class="single__tax">
              <a href="<?php echo $cat_link; ?>"><?php echo $cat_name; ?></a>
            </div>
            <p class="single__date"><?php echo get_the_time("d/m/Y"); ?></p>
          </div>
        </div>
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
        <div class="single__tag">
            <?php
                echo get_the_tag_list( sprintf( '<p>%s: ', __( 'Tags', 'dntheme' ) ), ' ', '</p>' );
            ?>
        </div>

        <?php
            related_category_fix(
                array(
                    'posts_per_page'    => 4,
                    'related_title'     => __( 'Bài viết liên quan', 'dntheme' ),
                    'template_type'     => '', // slider , widget
                    'template'          => 'content-archive',
                    'set_taxonomy'      => null,
                    'class_item'        => 'col-12 col-md-6',
                )
            );
        ?>
      </div>

    </div>
  </div>