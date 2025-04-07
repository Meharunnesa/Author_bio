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

function ab_styles(){

    wp_enqueue_style( 'custom-style', plugin_dir_url(__FILE__) . 'style.css', array(), '1.0.0', 'all' );
   
}

add_action('wp_enqueue_scripts', 'ab_styles');

function display_author_bio($content){
   
    global $post;

    if (is_single() && !empty($post)) {
        $author_name = get_the_author_meta('display_name', $post->post_author);
        $author_mail = get_the_author_meta('email', $post->post_author);
        $author_url = get_the_author_meta('url', $post->post_author);
        $author_description = get_the_author_meta('description', $post->post_author);
        $author_fb = get_the_author_meta('ab_facebook', $post->post_author);
        $author_twi = get_the_author_meta('ab_twitter', $post->post_author);
        $author_link = get_the_author_meta('ab_linkedin', $post->post_author);
        $author_pic = get_avatar( $post->post_author, 96 );


        //$author_bio = '<p><strong>Author Bio: </strong>' .'<br>' .$author_pic .'<br>' . esc_html($author_name) .'<br>' .esc_html($author_mail) .'<br>' .esc_html($author_url) .'<br>' .esc_html($author_description) .'<br>' .esc_html($author_fb) .'<br>' .esc_html($author_twi) .'<br>' .esc_html($author_link) . '</p>';

        ob_start();
        
       ?>

        <div class="author-box">
            <div class="info">
                <div class="img">
                    <?php echo $author_pic;?>
                </div>
                <div class="content">
                    <p class="title"><?php echo esc_html($author_name);?></p>
                    <p class="des"><?php echo esc_html($author_description);?></p>
                </div>
            </div>
           
            <div class="social">
                <div class="mail">
                        <a href="<?php echo $author_mail;?>">
                            <p class="dashicons dashicons-email"></p>
                        </a>
                </div>
                <div class="url">
                        <a href="<?php echo $author_url;?>">
                            <p class="dashicons dashicons-admin-site-alt3"></p>
                        </a>
                    </div>
                <div class="fb">
                        <a href="<?php echo $author_fb;?>">
                            <p class="dashicons dashicons-facebook"></p>
                        </a>
                </div>
                <div class="twi">
                        <a href="<?php echo $author_twi;?>">
                            <p class="dashicons dashicons-twitter"></p>
                        </a>
                </div>
                <div class="link">
                        <a href="<?php echo $author_link;?>">
                            <p class="dashicons dashicons-linkedin"></p>
                        </a>
                </div>
                   
            </div>
        </div>
        
        
        <?php

        $author_html = ob_get_clean(); 
        return $content . $author_html;
        
    }

    return $content;
    
}


add_filter('the_content' , 'display_author_bio');

add_filter( 'user_contactmethods', 'modify_user_contact_methods' );

function modify_user_contact_methods( $methods ) {

	
	$methods['ab_facebook']   = __( 'Facebook' );
	$methods['ab_twitter'] = __( 'Twitter' );
    $methods['ab_linkedin']   = __( 'linkedin' );
	

	return $methods;
}




?>