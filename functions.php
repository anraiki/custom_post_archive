<?php

//User friendly implementation of having all post type shown in the archives
function custom_post_in_archive($query){
    if($query->is_archive) {

        //By setting '_builtin' to false, we exclude the WordPress built-in public post types.
        $args = array(
            'public'   => true,
            '_builtin' => false
        );

        //Get all Custom Post Types
        $customPostType = get_post_types( $args );

        //Also add "Posts" to be in the loop.
        $customPostType[] = "post";

        //Make the Query
        $query->set( 'post_type', $customPostType );

    }
}
add_action( 'pre_get_posts', 'custom_post_in_archive' );

?>
