<?php
/**
 * The template for displaying all Custom Pages
 * 
 * @package    Default_Page_Personalizer
 * @subpackage Default_Page_Personalizer/templates
 * @since 1.0.0
 */
?>
<?php 
	get_header();
	the_post();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php the_content() ?>
</article><!-- #post-${ID} -->

<style>
	.custom-form
	{
		background-color : <?php echo(get_option('custom_form_background_color')) ? get_option('custom_form_background_color') : '#f7f7f7' ?> ;
	}
	.custom-form h2
	{
		color : <?php echo(get_option('custom_form_heading_color')) ? get_option('custom_form_heading_color') : '#000000' ?> ;
		font-size : <?php echo(get_option('custom_form_heading_font_size')) ? get_option('custom_form_heading_font_size') : 30?>px ;
	}
	.custom-form p
	{
		color : <?php echo(get_option('custom_form_paragraph_color')) ? get_option('custom_form_paragraph_color') : '#000000' ?> ;
		font-size : <?php echo(get_option('custom_form_paragraph_font_size')) ? get_option('custom_form_paragraph_font_size') : 12?>px ;
	}
	.custom-form label
	{
		color : <?php echo(get_option('custom_form_label_color')) ? get_option('custom_form_label_color') : '#000000' ?> ;
		font-size : <?php echo(get_option('custom_form_label_font_size')) ? get_option('custom_form_label_font_size') : 14?>px ;
	}
	.custom-form form input
	{
		background-color : <?php echo(get_option('custom_form_input_background_color')) ? get_option('custom_form_input_background_color') : '#f7f7f7' ?> ;
		color : <?php echo(get_option('custom_form_input_color')) ? get_option('custom_form_input_color') : '#000000' ?> ;
		font-size : <?php echo(get_option('custom_form_input_font_size')) ? get_option('custom_form_input_font_size') : 14?>px ;
	}
	.custom-form form a
	{
		color : <?php echo(get_option('custom_form_link_color')) ? get_option('custom_form_link_color') : '#000000' ?> ;
		font-size : <?php echo(get_option('custom_form_link_font_size')) ? get_option('custom_form_link_font_size') : 14?>px;
	}
	.custom-form form a:hover
	{
		color : <?php echo(get_option('custom_form_link_hover_color')) ? get_option('custom_form_link_hover_color') : '#000000' ?> ;
		font-size : <?php echo(get_option('custom_form_link_hover_font_size')) ? get_option('custom_form_link_hover_font_size') : 14?>px;
	}
	.custom-form form .button
	{
		background-color : <?php echo(get_option('custom_form_button_background_color')) ? get_option('custom_form_button_background_color') : '#f7f7f7' ?> ;
		color : <?php echo(get_option('custom_form_button_color')) ? get_option('custom_form_button_color') : '#000000' ?> ;
		font-size : <?php echo(get_option('custom_form_button_font_size')) ? get_option('custom_form_button_font_size') : 14?>px ;
	}
	.custom-form form .button:hover
	{
		background-color : <?php echo(get_option('custom_form_button_hover_background_color')) ? get_option('custom_form_button_hover_background_color') : '#e0e0e0' ?> ;
		color : <?php echo(get_option('custom_form_button_hover_color')) ? get_option('custom_form_button_hover_color') : '#000000' ?> ;
		font-size : <?php echo(get_option('custom_form_button_hover_font_size')) ? get_option('custom_form_button_hover_font_size') : 14?>px ;
	}
</style>