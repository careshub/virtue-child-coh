<?php
global $virtue_sidebar;
if( virtue_display_sidebar() ) {
	$virtue_sidebar = true;
} else {
	$virtue_sidebar = false;
}
do_action( 'virtue_single_post_begin' );
?>
<div id="content" class="container">
	<div class="row single-article" itemscope itemtype="https://schema.org/BlogPosting">
		<div class="main <?php echo esc_attr( virtue_main_class() ); ?>" role="main">
		<?php while ( have_posts() ) : the_post();
		do_action( 'virtue_single_post_before' );
		?>
			<article class="Media">
				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="Media-figure"><?php the_post_thumbnail(  'thumbnail'  ); ?></figure>
				<?php endif; ?>
				<div class="Media-body">
					<header>
						<h1 class="entry-title" itemprop="name headline"><?php the_title(); ?></h1>
					</header>

					<div class="entry-content" itemprop="articleBody">
						<?php the_content(); ?>
						<?php if ( function_exists( '\CARES_Resources\get_resource_meta' ) ) : ?>
							<div class="resource_meta content-row">
								<?php echo  \CARES_Resources\render_resource_meta( get_the_ID() ); ?>
							</div>
						<?php endif; ?>
						<?php if ( function_exists( '\CARES_Resources\get_the_term_list' ) ) : ?>
							<div class="resources_categories content-row">
								<?php echo \CARES_Resources\get_the_term_list( get_the_ID(), 'resources_categories' ); ?>
							</div>
							<div class="resources_tags content-row">
								<?php echo \CARES_Resources\get_the_term_list( get_the_ID(), 'resources_tags' ); ?>
							</div>
						<?php endif; ?>
					</div>

					<footer class="single-footer">
					</footer>
				</div>
			</article>
		<?php endwhile; ?>
		</div>
		<?php
		do_action( 'virtue_single_post_end' );