<?php
/**
 * Template Name: Page Contact
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @package    WordPress
 * @subpackage Dntheme
 * @version 1.0
 */
global $dn_options;
get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>


  <section class="page__header text-center">
    <div class="container">
      <?php the_title( '<h1 class="entry-title">', '</h1>' );?>
    </div>
  </section>

  <div class="page__contact">
    <div class="container">
      <?php the_content() ?>
    </div>
  </div>

<?php endwhile; ?>
<?php get_footer();