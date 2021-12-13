<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package    WordPress
 * @subpackage Dntheme
 * @version 1.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="wrapper">
  <header class="header -fix">
      <div class="container d-flex align-items-center">
        <?php dntheme_logo(); ?>
        <nav class="main__nav ms-auto d-none d-lg-block">
          <?php
            wp_nav_menu(
            array(
               'theme_location'  => 'primary',
               'container'       => 'ul',
               'container_class' => '',
               'menu_id'         => '',
               'menu_class'      => 'el__menu',
            ));
          ?>
        </nav>

        <div class="d-lg-none d-lg-none">
          <div class="menu-mb__btn">
            <span class="iconz-bar"></span>
            <span class="iconz-bar"></span>
            <span class="iconz-bar"></span>
          </div>
      </div>

      </div>
  </header>

<?php if(!is_front_page()): ?>
<div class="dn__breadcrumb d-none" typeof="BreadcrumbList" vocab="https://schema.org/">
  <div class="container">
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
  </div>
</div>

<?php endif; ?>