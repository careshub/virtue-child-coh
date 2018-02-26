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

	// Dequeue the Virtue theme "plugins" script on the reports page
	if ( is_page( array( 'assessment' ) ) ) {
		wp_dequeue_script( 'virtue_plugins' );
		wp_enqueue_script( 'virtue-plugins-alt', get_theme_file_uri( '/js/virtue-alt-plugins.js' ), array( 'jquery' ), '1.0.1', true );
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
