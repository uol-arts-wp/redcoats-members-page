<?php 


/*

Template Name: Author Page

*/


get_header(); ?>

<p>This is the page-author.php page</p>

<code>23rd Sept</code>

<!--============== basic loop ==============-->

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php the_content(); ?>

<?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>


<!--=============== custom query starts =========================-->

<?php

// set args
  
     $args = array(
    'role' => 'Author',
    'number' => 6
   
   );

// the query

   $user_query = new WP_User_Query( $args ); 

// if specified users exist echo out with appropriate styling

if ( ! empty( $user_query->results ) ) {
  foreach ( $user_query->results as $user ) {
    echo '<p class="author-container">' . $user->display_name . '</p>';
  }

} else {
  echo 'No users found.';
}

?>

<!--================= custom query fin ==============================-->

<?php get_footer(); ?>