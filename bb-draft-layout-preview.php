<?php

/*
** Allow for viewing of Beaver Builder layout drafts when using Public Post Preview
** plugin. From https://github.com/ocean90/public-post-preview/issues/172.
*/

add_filter( 'fl_render_content_by_id_can_view', function( $can_view, $post_id ) {
	if ( class_exists( 'DS_Public_Post_Preview' ) ) {
		$post_ids = get_option( 'public_post_preview', array() );
		$post_ids = array_map( 'intval', $post_ids );
		$can_view = ( in_array( $post_id, $post_ids ) ) ? true : $can_view;
	}
	return $can_view;
}, 10, 2 );
