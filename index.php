<?php
/*
 * Plugin Name:       Author Bio
 * Description:       This plugin display an author bio box below each post
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Bristy
 * Text Domain:       AB
*/

function display_author_bio($content){
   
    global $post;

    if (is_single() && !empty($post)) {
        $author_name = get_the_author_meta('display_name', $post->post_author);
        $author_bio = '<p><strong>Author: ' . esc_html($author_name) . '</strong></p>';
        return $content . $author_bio;
    }

    return $content;
    
}


add_filter('the_content' , 'display_author_bio');






?>