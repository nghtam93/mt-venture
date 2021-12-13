<?php
/**
 * Template for displaying search forms in Twenty Seventeen
 *
 * @package    WordPress
 * @subpackage Dntheme
 * @version 1.0
 */

?>

<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>
<form role="search" method="get" class="search-form search__form" action="<?php echo esc_url( home_url( ) ); ?>">

	<input type="search" id="<?php echo $unique_id; ?>" class="search-field form-control" placeholder="<?php echo esc_attr_x( 'Nhập từ khóa cần tìm &hellip;', 'placeholder', 'dntheme' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button class="search-submit" type="submit"><span class="icon-search"></span></button>

</form>
