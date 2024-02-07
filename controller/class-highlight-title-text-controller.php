<?php

class Controller_Title_Highlight
{
    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'add_meta_boxes']);
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
}
