<?php get_header(); ?>

<p>This is the author.php page</p>

test!

<!--============== basic loop ==============-->

<div>
	<h1>Author: <?php the_author(); ?></h1>
	<p>Bio: <?php the_author_meta('description'); ?></p>

	
		<h2>Posts and articles</h2>

		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
	
   
    
<?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

</div>
<?php get_footer(); ?>