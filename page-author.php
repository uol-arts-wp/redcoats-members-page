<?php 


/*

Template Name: Author Page

*/


get_header(); ?>

<p>This is the page-author.php page in redcoats</p>

<!--============== basic loop pulling in page content ==============-->

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php the_content(); ?>

<?php endwhile; endif; ?>

<!--=============== advanced loop =============================-->

<?php

// Get the authors from the database ordered by user nicename
	global $wpdb;
	$query = "SELECT ID, user_nicename from $wpdb->users ORDER BY user_nicename";
	$author_ids = $wpdb->get_results($query);

// Loop through each author
	foreach($author_ids as $author) :

	// Get user data
		$banana = get_userdata($author->ID);

	// If user level is above 0 or login name is "admin", display profile
		if($banana->user_level > 0 || $banana->user_login == 'admin') :

		// Get link to author page
			$user_link = get_author_posts_url($banana->ID);
	?>


<div class="author-container">

	<a href="<?php echo $user_link; ?>" title="<?php echo $banana->display_name; ?>" class="small-text"><?php echo $banana->display_name; ?></a><br />

		
	<a href="<?php echo $user_link; ?>" title="<?php echo $banana->display_name; ?>">
		<?php echo get_avatar($banana->user_email, '96', $avatar); ?>
	</a>
	
	
	
	
	
 <!--
	<p> 
		<?php echo $banana->description; ?>
	</p>
-->

</div>



<?php endif; ?>

	<?php endforeach; ?>


<?php get_footer(); ?>