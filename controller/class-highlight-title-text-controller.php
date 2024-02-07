<?php

class Controller_Title_Highlight
{
    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'add_meta_boxes']);
        add_action('save_post', [$this, 'save_post']);
    }

    public function add_meta_boxes()
    {
        add_meta_box('custom_title_highlight', 'Title Highlight', [$this, 'add_inner_meta_box'], ['post', 'page'], 'side', 'high');
    }

    public function add_inner_meta_box($post)
    {
        $highlighted_text = get_post_meta($post->ID, '_custom_title_highlight_text', true);
        $highlight_style = get_post_meta($post->ID, '_custom_title_highlight_style', true);
        $highlight_color = get_post_meta($post->ID, '_custom_title_highlight_color', true);

        // Security field
        wp_nonce_field('custom_title_highlight_nonce', 'custom_title_highlight_nonce_field');

        include_once(HL_TITLE_TEXT_PATH . 'views/metabox-view.php');
    }

    public function save_post($post_id)
    {
        if (!isset($_POST['custom_title_highlight_nonce_field']) || !wp_verify_nonce($_POST['custom_title_highlight_nonce_field'], 'custom_title_highlight_nonce') || !current_user_can('edit_post', $post_id)) {
            return;
        }

        if (isset($_POST['custom_title_highlight_text'])) {
            update_post_meta($post_id, '_custom_title_highlight_text', sanitize_text_field($_POST['custom_title_highlight_text']));
        }
        if (isset($_POST['custom_title_highlight_style'])) {
            update_post_meta($post_id, '_custom_title_highlight_style', $_POST['custom_title_highlight_style']);
        }
        if (isset($_POST['custom_title_highlight_color'])) {
            update_post_meta($post_id, '_custom_title_highlight_color', sanitize_hex_color($_POST['custom_title_highlight_color']));
        }
    }
}
