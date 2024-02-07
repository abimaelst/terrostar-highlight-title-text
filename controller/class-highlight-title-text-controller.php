<?php

class Controller_Title_Highlight
{
    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'add_meta_boxes']);
        add_action('save_post', [$this, 'save_post']);
        add_filter('the_title', [$this, 'filter_the_title'], 10, 2);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);
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

    public function filter_the_title($title, $id = null)
    {
        if (is_admin() || doing_filter('get_the_excerpt')) {
            return $title;
        }

        $highlight = get_post_meta(get_the_ID(), '_custom_title_highlight_text', true);

        if (empty($highlight)) {
            return $title;
        }

        $style = get_post_meta(get_the_ID(), '_custom_title_highlight_style', true);

        $valid_styles = ['background', 'circle', 'underline'];
        if (!in_array($style, $valid_styles)) {
            $style = 'background';
        }

        $styleClass = "highlight-$style";

        $pos = stripos($title, $highlight);

        if ($pos !== false) {
            $before = "<span class='{$styleClass}'>";
            $after = "</span>";

            $actualText = substr($title, $pos, strlen($highlight));

            $title = substr_replace($title, $before . $actualText . $after, $pos, strlen($highlight));
        }

        return $title;
    }

    public function enqueue_styles()
    {
        wp_enqueue_style('custom-title-highlight-style', plugins_url('/assets/css/styles.css', __DIR__));
    }

    public function enqueue_admin_scripts()
    {
        // Enqueue the color picker CSS
        wp_enqueue_style('wp-color-picker');

        // Enqueue the script to add the color picker
        wp_enqueue_script('custom-title-highlight-color-picker', plugins_url('/assets/js/color-picker.js', __DIR__), ['wp-color-picker'], false, true);
    }
}
