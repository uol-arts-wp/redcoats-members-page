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
		$members = get_userdata($author->ID);
		// If user level is above 0 or login name is "admin", display profile
		if($members->user_level > 0 || $members->user_login == 'admin') :
		// Get link to author page
		$user_link = get_author_posts_url($members->ID);
	?>

			<div class="author-container">
				<a href="<?php echo $user_link; ?>" title="<?php echo $members->display_name; ?>" class="small-text"><?php echo $members->display_name; ?></a><br />
				<a href="<?php echo $user_link; ?>" title="<?php echo $members->display_name; ?>">
					<?php echo get_avatar($members->user_email, '96', $avatar); ?>
				</a>
				    
			<!-- Pull in bio info -->
						
				<p> 
				<?php echo $members->description; ?>
				</p>
			</div><!-- close author-container -->

		<?php endif; ?>
		<?php endforeach; ?>


<?php get_footer(); ?>
