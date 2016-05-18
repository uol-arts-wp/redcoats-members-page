<?php 
/*
Template Name: Author Page
*/
get_header(); ?>

<!--============== basic loop pulling in page content ==============-->

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php the_content(); ?>

<?php endwhile; endif; ?>

<!--=============== advanced loop =============================-->

<?php

// Get pagination parameters
$currentpage = max( 1, get_query_var('paged') );
$per_page = 16; // was set to 2
$offset = ( ( $currentpage - 1 ) * $per_page ); 

// Get the authors from the database ordered by user nicename
$args = array( array (
	/* filter by Role */
	'role' => 'Author', 'Administrator'),
	/* could order by surname if all users have this completed
	'orderby' => 'meta_value',
	'meta_key' => 'last_name',
	*/
	'orderby' => 'nicename',
	'number' => $per_page,
	'offset' => $offset 
);

// use WP_User_Query as get_users cannot return the total number of users (needed for paging)
// https://codex.wordpress.org/Class_Reference/WP_User_Query

// code to set variables (SH)
$user_query = new WP_User_Query( $args );

// get the total number of users
$total_users = $user_query->get_total(); // get_total is WPUQ property 'returns total number of users for the current query' (SH)

// get the total number of pages
$total_pages = ceil($total_users / $per_page); // ceil rounds up maths of equation in paranthesis (SH)

// $page args is used in paginalte_links
// https://codex.wordpress.org/Function_Reference/paginate_links

$page_args = array(
	/* format for non-pretty permalinks is '?page=%#%' */
	'format'             => '/page/%#%',
	'total'              => $total_pages,
	'current'            => $currentpage,
	'show_all'           => false,
	'end_size'           => 1,
	'mid_size'           => 2,
	'prev_next'          => true,
	'prev_text'          => __('« Previous'),
	'next_text'          => __('Next »'),
	'type'               => 'plain',
	'add_args'           => False,
	'add_fragment'       => '',
	'before_page_number' => '',
	'after_page_number'  => ''
);

// User Loop
if ( ! empty( $user_query->results ) ) {

	if ( $total_users > 1 ) {
		$from = ( ( ( $currentpage - 1 ) * $per_page ) + 1 );
		$to = min( $total_users, ( $currentpage * $per_page ) );
		printf('<p>%d users found. Showing users %d - %d</p>', $total_users, $from, $to );

	} else {
		printf('<p>1 user found</p>');
	}

//	echo paginate_links( $page_args );

	foreach ( $user_query->results as $user ) {


		// Get link to author page
		$user_link = get_author_posts_url($user->ID);

		?>

		<div class="author-container">

			<a href="<?php echo $user_link; ?>" title="<?php echo esc_attr($user->display_name); ?>"><?php echo $user->display_name; ?></a><br />
			<a href="<?php echo $user_link; ?>" title="<?php echo esc_attr($user->display_name); ?>"><?php echo get_avatar($user->user_email); ?></a>
		    
		<!--code below pulls in bio info -->
				
			<p> 
				<?php echo $user->description; ?>
			</p>

		</div>
		
		<?php
	}

	echo paginate_links( $page_args );

} else {
	echo '<p>No users found.</p>';
}

get_footer(); ?>