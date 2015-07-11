<?php
/**
 * The Header for Customizr.
 *
 * Displays all of the <head> section and everything up till <div id="main-wrapper">
 *
 * @package Customizr
 * @since Customizr 1.0
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->



<html <?php language_attributes(); ?>>                          
<!--<![endif]-->

	<?php 
		//the '__before_body' hook is used by TC_header_main::$instance->tc_head_display()
		do_action( '__before_body' ); 
	?>
	<meta name="p:domain_verify" content="9e3d4bbb35b25a121ffe031e7784ca40"/>

<!-- Core CSS file -->
<link rel="stylesheet" href="/wp-content/themes/customizr/node_modules/photoswipe/dist/photoswipe.css"> 

<!-- Skin CSS file (styling of UI - buttons, caption, etc.)
     In the folder of skin CSS file there are also:
     - .png and .svg icons sprite, 
     - preloader.gif (for browsers that do not support CSS animations) -->
<link rel="stylesheet" href="/wp-content/themes/customizr/node_modules/photoswipe/dist/default-skin/default-skin.css"> 

<!-- Core JS file -->
<script src="/wp-content/themes/customizr/node_modules/photoswipe/dist/photoswipe.min.js"></script> 

<!-- UI JS file -->
<script src="/wp-content/themes/customizr/node_modules/photoswipe/dist/photoswipe-ui-default.min.js"></script>


	<body <?php body_class(); ?> <?php echo tc__f('tc_body_attributes' , 'itemscope itemtype="http://schema.org/WebPage"') ?>>
		
		
		<?php do_action( '__before_header' ); ?>

	   	<header class="<?php echo tc__f('tc_header_classes', 'tc-header clearfix row-fluid') ?>" role="banner">
			<div id="header-content">
			<?php 
			//the '__header' hook is used by (ordered by priorities) : TC_header_main::$instance->tc_logo_title_display(), TC_header_main::$instance->tc_tagline_display(), TC_header_main::$instance->tc_navbar_display()
				do_action( '__header' ); 
			?>
		<meta name="p:domain_verify" content="9e3d4bbb35b25a121ffe031e7784ca40"/>
		</div>
		</header>

		<?php 
		 	//This hook is filtered with the slider : TC_slider::$instance->tc_slider_display()
			do_action ( '__after_header' )
		?>
