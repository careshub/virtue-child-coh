<?php

// Add a body class.
add_filter( 'body_class', function( $classes ) {
    return array_merge( $classes, array( 'coh' ) );
} );

/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.1
 */
function virtue_child_arc_scripts() {
	// Include the needed js file.
	wp_enqueue_script( 'virtue-child-coh-base-scripts', get_theme_file_uri( '/js/public.js' ), array( 'jquery' ), '1.0.1', true );

	// Dequeue the Virtue version of Bootstrap on the reports page
	if ( is_page( array( 'assessment' ) ) ) {
		wp_dequeue_script( 'bootstrap' );
	}
}
add_action( 'wp_enqueue_scripts', 'virtue_child_arc_scripts', 999 );

/**
 * Add a sidebar that spans the width of the footer area.
 *
 * @since 1.0.0
 */
function coh_register_sidebars() {
	register_sidebar( array(
		'name' => 'Footer Logos Bar',
		'id' => 'footer_logos_bar',
		'before_widget' => '<div class="footer-widget full-width sidebar-footer-logos"><aside id="%1$s" class="%2$s">',
		'after_widget' => '</aside></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'coh_register_sidebars', 99 );

/**
 * Add the Google "noscript" tag immediately after the opening of the body element.
 *
 * @since 1.0.1
 *
 */
function cares_hestia_child_add_google_tag_manager_noscript_tag() {
	// CARES Network Sites container ID: GTM-PQGZB4S
	?>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PQGZB4S"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<?php
}
add_action( 'virtue_after_body', 'cares_hestia_child_add_google_tag_manager_noscript_tag' );

/**
 * Add the Google Tag Manager script call.
 *
 * @since 1.0.1
 *
 */
function cares_hestia_child_add_google_tag_manager_script() {
	// CARES Network Sites container ID: GTM-PQGZB4S
	?>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-PQGZB4S');</script>
	<!-- End Google Tag Manager -->
	<?php
}
add_action( 'wp_head', 'cares_hestia_child_add_google_tag_manager_script' );
