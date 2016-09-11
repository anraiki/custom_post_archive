<?php

//User friendly implementation of having all post type shown in the archives
function custom_post_in_archive($query){
    if(is_archive()) {
        global $wpdb;

        //Post Types of Wordpress
        $wordPress_postType = array(
            'post',
            'page',
            'attachment',
            'revision',
            'nav_menu_item'
        );

        //A SQL Query to grab the post types.
        $cptQuery = "Select `post_type` FROM `" . $wpdb->prefix . "posts` GROUP BY `post_type`";
        $results = $wpdb->get_results($cptQuery);

        //Ensure we grab a custom post type by comparing it to WordPress's post types
        foreach($results as $key => $result) {
            if( !in_array($result->post_type, $wordPress_postType) )
                $customPostType[] = $result->post_type;
        }

        //Make the Query
        $query->set( 'post_type', $customPostType );
    }
}
add_action( 'pre_get_posts', 'custom_post_in_archive' );

?>
