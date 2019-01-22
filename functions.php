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
function virtue_child_coh_scripts() {
	// Include the needed js file.
	wp_enqueue_script( 'virtue-child-coh-base-scripts', get_theme_file_uri( '/js/public.js' ), array( 'jquery' ), '1.0.1', true );

	// Dequeue the Virtue version of Bootstrap on the reports page
	if ( is_page( array( 'assessment' ) ) ) {
		wp_dequeue_script( 'bootstrap' );
	}
}
add_action( 'wp_enqueue_scripts', 'virtue_child_coh_scripts', 999 );

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
function virtue_child_coh_add_google_tag_manager_noscript_tag() {
	// CARES Network Sites container ID: GTM-PQGZB4S
	?>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PQGZB4S"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<?php
}
add_action( 'virtue_after_body', 'virtue_child_coh_add_google_tag_manager_noscript_tag' );

/**
 * Add the Google Tag Manager script call.
 *
 * @since 1.0.1
 *
 */
function virtue_child_coh_add_google_tag_manager_script() {
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
add_action( 'wp_head', 'virtue_child_coh_add_google_tag_manager_script' );

/**
 * Use the directory title setting for the Docs archive.
 * Virtue has its own title function that ignores the setting.
 *
 * @since 1.0.1
 */
function virtue_child_coh_docs_title( $title ) {
	if ( is_archive( 'bp_doc' ) ) {
		$title = bp_docs_get_docs_directory_title();
	}
	return $title;
}
add_filter( 'virtue_title', 'virtue_child_coh_docs_title' );

/**
 * Add a taxonomy to use with BP Docs to organize docs in the global library.
 *
 * @since 1.0.1
 */
function virtue_child_coh_create_resource_cat_tax() {
	$labels = array(
		'name'              => _x( 'Resource Categories', 'taxonomy general name', 'virtue-child-coh' ),
		'singular_name'     => _x( 'Resource Category', 'taxonomy singular name', 'virtue-child-coh' ),
		'search_items'      => __( 'Search Resource Categories', 'virtue-child-coh' ),
		'all_items'         => __( 'All Resource Categories', 'virtue-child-coh' ),
		'parent_item'       => __( 'Parent Resource Category', 'virtue-child-coh' ),
		'parent_item_colon' => __( 'Parent Resource Category:', 'virtue-child-coh' ),
		'edit_item'         => __( 'Edit Resource Category', 'virtue-child-coh' ),
		'update_item'       => __( 'Update Resource Category', 'virtue-child-coh' ),
		'add_new_item'      => __( 'Add New Resource Category', 'virtue-child-coh' ),
		'new_item_name'     => __( 'New Resource Category Name', 'virtue-child-coh' ),
		'menu_name'         => __( 'Resource Category', 'virtue-child-coh' ),
	);
	$args = array(
		'labels' => $labels,
		'description' => __( 'Use organize BP Docs in the global library', 'virtue-child-coh' ),
		'hierarchical' => true,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => false,
		'show_tagcloud' => false,
		'show_in_quick_edit' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
	);
	register_taxonomy( 'resource_category', array('bp_doc'), $args );
}
add_action( 'init', 'virtue_child_coh_create_resource_cat_tax' );
