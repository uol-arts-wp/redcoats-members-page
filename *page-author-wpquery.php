<?php 


/*

Template Name: Author Page

*/


get_header(); ?>

<p>This is the page-author.php page</p>

<code>Test 23rd Sept</code>


<!--============== basic loop ==============-->

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php the_content(); ?>

<!--
	
	<div class="author-container group">
	<?php wp_list_authors(); ?>
	</div>


	<h1><?php the_title();?></h1>
  	<?php wp_list_authors(); ?>
  	<?php get_users(); ?> // requires WP_Query

-->

<?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>


<!-- custom query starts -->


<?php

  wp_reset_postdata();

  $args = array(

  	  'category_name' => 'contributor',
    	'orderby' => 'name',
      'order' => 'ASC',
      'posts_per_page' => 8
  	
  	);

  $user_query = new WP_Query( $args);

?>


<?php while ($user_query->have_posts() ) : $user_query->the_post(); ?>

	<div class="author-container group">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
  	</div>



<?php endwhile?>



<!-- custom query fin -->

<?php get_footer(); ?>