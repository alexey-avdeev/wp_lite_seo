<?php
/*
Plugin Name: lite_seo
Plugin URI: https://github.com/avdeevalexsey/wp_lite_seo
Description: This plugin adds SEO headers to your website (Title, Keywords, Description). Editable fields will appear for posts, pages, tags and categories. The plugin is implemented as minimalist as possible and does not require a large amount of resources.
Version: 1.0
Author: Alexey Avdeev
Author URI: https://github.com/avdeevalexsey
*/

add_action( 'admin_init', 'lite_seo_init');

function lite_seo_init(){
    add_action('add_meta_boxes', 'lite_seo_fields', 1);
    add_action('save_post', 'lite_seo_fields_update', 0);

    add_action( 'category_edit_form_fields', 'lite_seo_show_form_fileds_taxonomy', 10, 2);
    add_action( 'post_tag_edit_form_fields', 'lite_seo_show_form_fileds_taxonomy', 10, 2);
    add_action( 'category_add_form_fields',  'lite_seo_show_form_fileds_taxonomy', 10, 2);
    add_action( 'post_tag_add_form_fields',  'lite_seo_show_form_fileds_taxonomy', 10, 2);

    add_action("create_category", 'lite_seo_save_taxonomy_meta');
    add_action("edited_category", 'lite_seo_save_taxonomy_meta');

    add_action("create_post_tag", 'lite_seo_save_taxonomy_meta');
    add_action("edited_post_tag", 'lite_seo_save_taxonomy_meta');
}


// Posts' meta box

function lite_seo_fields() {
    add_meta_box( 'lite_seo_fields', 'SEO', 'lite_seo_fields_box', array('post','page'), 'normal', 'high'  );
}

function lite_seo_fields_box( $post ){
    include_once (__DIR__.'/teamplates/post.php');
}



function lite_seo_fields_update( $post_id ){



        if (!isset($_POST['lite_seo_fields_nonce']) || !wp_verify_nonce($_POST['lite_seo_fields_nonce'], 'Df#FcdSf34Dfs')) return false;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return false;
        if (!current_user_can('edit_post', $post_id)) return false;

        if (!isset($_POST['lite_seo'])) return false;


        $_POST['lite_seo'] = array_map('trim', $_POST['lite_seo']);
        foreach ($_POST['lite_seo'] as $key => $value) {
            if (empty($value)) {
                delete_post_meta($post_id, $key);
                continue;
            }

            update_post_meta($post_id, $key, $value);
        }
        return $post_id;

}




// Taxonomies' meta box


function lite_seo_show_form_fileds_taxonomy($taxonomy) {
    if (!empty($taxonomy->term_id)) {
        include_once(__DIR__ . '/teamplates/taxonomy_edit.php');
    }else{
        include_once(__DIR__ . '/teamplates/taxonomy_new.php');

    }
}

function lite_seo_save_taxonomy_meta($term_id) {

    if (!isset($_POST['lite_seo_fields_nonce']) || !wp_verify_nonce($_POST['lite_seo_fields_nonce'], 'Df#FcdSf34Dfs')) return false;
    if ( ! current_user_can('edit_term', $term_id) ) return;
    if (!isset($_POST['lite_seo'])) return false;

    $_POST['lite_seo'] = array_map('trim', $_POST['lite_seo']);
    foreach ($_POST['lite_seo'] as $key => $value) {
        if(!$value)
            delete_term_meta( $term_id, $key );
        else
            update_term_meta( $term_id, $key, $value);

      }

    return $term_id;
}



// SHOW SEO

add_filter( 'wp_title', 'lite_seo_return', 10, 3 );


function lite_seo_return($title, $sep, $seplocation) {
    if (is_single() OR is_page()) {
        $post_title = get_post_meta(get_the_ID(), 'lite_seo_title', 1);
        if (!empty($post_title)){
            return $post_title;
        }
    }

    if (is_category() OR is_tag()){
        $taxonomy_title = get_term_meta(get_queried_object()->term_id,'lite_seo_title',1);
        if (!empty($taxonomy_title)){
            return $taxonomy_title;
        }
    }
    return $title;

}


add_action("wp_head", "wp_head_lite_seo");

function wp_head_lite_seo() {
    if (is_single() OR is_page()) {
        $post_keywords = get_post_meta(get_the_ID(), 'lite_seo_keywords', 1);

        if (!empty($post_keywords)){
            echo "<meta name='keywords' content='$post_keywords' />";
        }

        $post_description = get_post_meta(get_the_ID(), 'lite_seo_description', 1);

        if (!empty($post_description)){
            echo "<meta name='description' content='$post_description' />";
        }

    }

    elseif (is_category() OR is_tag()){

        $taxonomy_keywords = get_term_meta(get_queried_object()->term_id,'lite_seo_keywords',1);
        if (!empty($taxonomy_keywords)){
            echo "<meta name='keywords' content='$taxonomy_keywords' />";
        }

        $taxonomy_description = get_term_meta(get_queried_object()->term_id,'lite_seo_description',1);
        if (!empty($taxonomy_description)){
            echo "<meta name='description' content='$taxonomy_description' />";
        }
    }
}

