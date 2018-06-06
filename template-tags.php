<?php

/**
 * Site top bar - really made to be overridden
 */
if ( ! function_exists( 'spr_do_top_bar' ) ) :
    function spr_do_top_bar() { ?>
        <section id="top-bar" class="py-2 px-lg-4 d-flex align-items-center">
            <div class="container-fluid">
                <div class="row">
                <!-- justify-content-md-end -->
                    <div class="d-flex col-5 justify-content-start align-items-center">
                    <?php spr_do_link( '(08) 9485 0801', 'tel:+61 8 9485 0801', false ) ?></div>
                    <div class="col-7 d-flex justify-content-end">Level 2, Trinity Arcade ( Hay Street Mall ), Perth</div>
                </div>
            </div>		
        </section>
    <?php }
endif;




/**
 * Call to action
 * @param string $cta_text The CTA text
 * @param string $btn_text The text in the button, default is 'Shop Now'
 * @param string $btn_link The page to link to, default is 'shop'
 * @param string $color The text / button color, either 'red', 'green' or 'grey' (default is red)
 * @param string $bg_color Background colour, either 'cream' or 'white'. Default 'white'
 */
if ( ! function_exists( 'spr_do_cta' ) ) :
    function spr_do_cta( $cta_text = '', $btn_text = '', $btn_link = '', $color = '', $bg_color = '' ) {
        if ( !empty( $color ) ) {
            $txt_color_css = 'txt-' . $color;
            $btn_color_css = 'btn-' . $color;
        }
        $bg_color_css = ( !empty( $bg_color ) ) ? 'bg-' . $bg_color : '';
        ?>
        <section class="cta <?= $bg_color_css . ' ' . $txt_color_css ?>">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p class="cta-text"><?= $cta_text ?></p>
                        <p class="text-center"><a class="btn btn-primary <?= $btn_color_css ?>" href="<?= site_url( $btn_link ) ?>"><?= $btn_text ?></a></p>
                    </div>
                </div>
            </div>
        </section>
    <?php } 
endif;


/**
 * get_image
 * Get an image from theme images dir
 * @param string $filename.  The path will be prepended automatically.
 */
if ( ! function_exists( 'spr_get_img' ) ) :
    function spr_get_img( $filename ) {
        return get_stylesheet_directory_uri() . '/images/' . $filename;
    } 
endif;

/**	
 * Just output a simple link, to save doing the annoying quotation mark thing each time
 * @param string $text The link text, no default
 * @param string $link The URL, no default 
 * @param bool $internal If it's internal we prepend the site url 
 * @param bool $new_window, whether open in new window
 * @param string $classes Extra CSS classes to add
 * @return nothing Just echoes the link 
 * No default params because we want it to fail noisily, to indicate a logic error elsewhere
 * TODO: create a title from the link text
 */
if ( ! function_exists( 'spr_do_link' ) ) :
    function spr_do_link( $text, $link, $internal = true, $new_window = false, $classes = '' ) {
        echo spr_get_link( $text, $link, $internal, $new_window, $classes );
    }
endif;

/**	
 * Return a simple link, to save doing the annoying quotation mark thing each time.
 * The 'type' param has been removed, just include it as part of the link eg mailto:email@test.com
 * @param string $text The link text, no default
 * @param string $link The URL, no default 
 * @param bool $internal If it's internal we prepend the site url 
 * @param bool $new_window, whether open in new window
 * @param string $classes Extra CSS classes to add
 * @return URL The fully formed link 
 * TODO: create a title from the link text
 */
if ( ! function_exists( 'spr_get_link' ) ) :
    function spr_get_link( $text, $link, $internal = true, $new_window = false, $classes = '' ) {

        //prepend tel: or mailto: etc
        if ( $internal ) $link = get_site_url() . '/' . $link;
        if ( !empty( $type ) ) $link = $type . ':' . $link;
        $link = '<a href="' .$link . '" class="' . $classes . '"';
        if ($new_window) $link .= ' target="_blank" rel="noopener noreferrer"';
        $link .= '>' .$text . '</a>';
        return $link;
    }
endif;


/**
 * spr_do_content
 * Output the content from a page or post
 * @param post_id The id of the page or post that the content is from.
 */
if ( ! function_exists( 'spr_do_content' ) ) :
    function spr_do_content( $post_id = '' ) {
        if ( empty( $post_id ) ) {
            global $post;
            $post_id = $post->ID;
        }
        ?>
        <div class="content">
            <?php
                $post = get_post( $post_id );
                echo apply_filters( 'the_content', $post->post_content );
            ?>
        </div>
    <?php }
endif;


/**
 * Output a link to a single category for a given post ID
 * @param int $post_ID
 * @return output link to the category with category name as the link text
 */
if ( ! function_exists( 'spr_get_category_link' ) ) :
    function spr_get_category_link( $post_ID = '' ) {
        if ( $category = get_the_category( $post_ID ) ) {
            $first_category = $category[0];
            return sprintf( '<a href="%s">%s</a>', get_category_link( $first_category ), $first_category->name );
        }
    }
endif;


/**
 * Return a link to the first category for a given post ID. Uses spr_get_category_link
 * @param int $post_ID
 * @return output the link
 */
if ( ! function_exists( 'spr_do_category_link' ) ) :
    function spr_do_category_link( $post_ID = '' ) {
        echo spr_get_category_link( $post_ID );
    }
endif;


/**
 * spr_do_excerpt
 * Display an excerpt if there is one, else trim the post content
 * @param int $post_id The post to display the excerpt for.
 * EXCERPT ISSUES: when get_the_excerpt is called outside the loop and there is NO EXCERPT SET FOR A POST,
 * it will trim get_the_content(), but it will NOT pass the post_id, so it will get the GLOBAL POST CONTENT.
 * So to use get_the_excerpt outside the loop we need to setup_post_data, or get the post_excerpt DIRECTLY FROM THE OBJECT
 * https://codex.wordpress.org/Function_Reference/get_the_excerpt
 */
if ( ! function_exists( 'spr_do_excerpt' ) ) :
    function spr_do_excerpt( $post_id ) {
        $post = get_post( $post_id );
        //DON'T use get_the_excerpt, if not set it will fail
        if ( $post->post_excerpt ) echo $post->post_excerpt;
        else {
            $content = apply_filters( 'the_content', $post->post_content ); //using the_content hook 
            echo wp_trim_words( $content ); 		
        }
    }
endif;


/**
 * spr_get_featured_img_url()
 * Get the featured image URL for post ID.  If using outside the loop, pass post_id as param.
 * @param int $post_id The post or page the featured image is attached to. Optional, if empty use the global $post object.
 * @return mixed $url string if found, else false if no image
 */
if ( ! function_exists( 'spr_get_featured_img_url' ) ) :
    function spr_get_featured_img_url( $post_id = '' ) {
        if ( empty( $post_id ) ) {
            global $post;
            $post_id = $post->ID;
        }
        $arr_img = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full' ); 
        if ( is_array( $arr_img ) && ( sizeof( $arr_img ) >= 1 ) )  {
            return $arr_img[0];
        }
        return false;
    }
endif;