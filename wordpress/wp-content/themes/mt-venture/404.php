<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package    WordPress
 * @subpackage Dntheme
 * @version 1.0
 */
global $dn_options;
get_header(); ?>

<section class="page__header text-center">
  <div class="container">
    <div class="text-center">
			<h1 class="exception__code entry-title">404</h1>
			<p class="exception__text">ERROR</p>
		</div>
  </div>
</section>

<div class="archive__content">
  <div class="container">

    <div class="archive__content">
      <section class="error-404 not-found text-center">

				<header class="page-header">
					<p class="page-title"><?php _e( 'Oops!', 'dntheme' ); ?></p>
					<p><?php _e('Page not found','dntheme'); ?></p>
				</header><!-- .page-header -->
				<div class="page-content entry-content">
					<p><?php _e( "It looks like the page you're trying to reach doesn't exist anymore, or maybe it just moved.", 'dntheme' ); ?></p>
					<a href="<?php echo site_url(); ?>" class="return__home"><?php _e( 'Back Homepage', 'dntheme' ); ?></a>
				</div><!-- .page-content -->

			</section><!-- .error-404 -->
    </div>

  </div>
</section>

<?php get_footer();
