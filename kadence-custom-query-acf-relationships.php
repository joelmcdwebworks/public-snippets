// Filter to customize the query used in a Kadence advanced query loop block. Add this code to your
// theme's functions.php, a custom plugin, or php snippets plugin.

add_filter( 'kadence_blocks_pro_query_loop_query_vars', function( $query, $ql_query_meta, $ql_id ) {

	if ( $ql_id == 27 ) { // This id should be the id of the query in Kadence you are targeting.

		global $post; // Ensure access to current post data being viewed.

		// Two options are provided below. Option 1 is for bi-directional relationships or when the relationship
		// is set on the child or related post. Option 2 is for when the relationship is only set on the
		// parent/primary post. Only one option should be commented out or kept in your final code.

		// ----------

		// Option 1: If bi-directional or relationship is set on "child" posts.

		$related_posts = get_posts( array(
			'post_type' => 'post',
			'meta_query' => array(
				array(
					'key' => 'related_posts',
					'value' => '"' . $post->ID . '"', // Find posts related to current post.
					'compare' => 'LIKE'
				),
			),
			'fields' => 'ids', // Return posts as an array of post IDs vs. objects.
		));

		// ----------

		// // Option 2: If relationship is only set on primary/parent post.

		// $related_posts = get_field( 'related_posts', $post->ID );

		// ----------

		// Be sure not to comment out the line below.

		$query['post__in'] = $related_posts; // Restrict posts returned to related posts.

	}
	
	return $query;

 }, 10, 3 );
