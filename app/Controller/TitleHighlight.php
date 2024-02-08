<?php

namespace App\Controller;

class TitleHighlight
{
    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'addMetaBoxes']);
        add_action('save_post', [$this, 'saveTextToHighLight']);
        add_filter('the_title', [$this, 'filterTitle'], 10, 2);
        add_action('wp_enqueue_scripts', [$this, 'enqueueStyles']);
        add_action('admin_enqueue_scripts', [$this, 'enqueueAdminScripts']);
    }

    public function addMetaBoxes()
    {
        add_meta_box('custom_title_highlight', 'Title Highlight', [$this, 'addInnerMetaBox'], ['post', 'page'], 'side', 'high');
    }

    public function addInnerMetaBox($post)
    {
        /** @var string $highlighted_text*/
        $highlighted_text = get_post_meta($post->ID, '_custom_title_highlight_text', true);

        /** @var string $highlight_style*/
        $highlight_style = get_post_meta($post->ID, '_custom_title_highlight_style', true);

        /** @var string $highlight_style*/
        $highlight_color = get_post_meta($post->ID, '_custom_title_highlight_color', true);

        /** @var number $highlight_bold*/
        $highlight_bold = get_post_meta($post->ID, '_custom_title_highlight_bold', true);

        // Security field
        wp_nonce_field('custom_title_highlight_nonce', 'custom_title_highlight_nonce_field');
       
        include_once(HL_TITLE_TEXT_PATH . '/views/MetaboxView.php');
    }

    public function saveTextToHighLight($post_id)
    {
        file_put_contents('testing.txt', json_encode($_POST));
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

        if (isset($_POST['custom_title_highlight_bold'])) {
            $is_bold = isset($_POST['custom_title_highlight_bold']) ? 1 : 0;
            update_post_meta($post_id, '_custom_title_highlight_bold', $is_bold);
        }
    }

    private function addSpanWithClasses($title, $highlight, $style, $color)
    {
        $valid_styles = ['background', 'square', 'circle', 'underline', 'border', 'arrow'];

        if (!in_array($style, $valid_styles)) {
            $style = 'background';
        }

        $styleClass = "highlight-$style";

        $pos = stripos($title, $highlight);

        if ($pos !== false) {

            $is_bold = get_post_meta(get_the_ID(), '_custom_title_highlight_bold', true);

            $before =  $is_bold ? "<span class='{$styleClass} title-highlight-bold' style='--highlight-color: {$color};'>" : "<span class='{$styleClass} style='--highlight-color: {$color};''>";
            $after = "</span>";

            $actualText = substr($title, $pos, strlen($highlight));

            $title = substr_replace($title, $before . $actualText . $after, $pos, strlen($highlight));
        }

        return $title;


    }

    public function filterTitle($title, $id = null)
    {
        if (is_admin() || doing_filter('get_the_excerpt')) {
            return $title;
        }

        $highlight = get_post_meta(get_the_ID(), '_custom_title_highlight_text', true);

        if (empty($highlight)) {
            return $title;
        }

        $style = get_post_meta(get_the_ID(), '_custom_title_highlight_style', true);
        $color = get_post_meta(get_the_ID(), '_custom_title_highlight_color', true);

       
        return $this->addSpanWithClasses($title, $highlight, $style, $color);
    }

    public function enqueueStyles()
    {
        wp_enqueue_style('custom-title-highlight-style', HL_TITLE_TEXT_URL . 'assets/css/styles.css');
    }

    public function enqueueAdminScripts()
    {
        // Enqueue the color picker CSS
        wp_enqueue_style('wp-color-picker');

        // Enqueue the script to add the color picker
        $screen = get_current_screen();

        if ($screen->base == 'post') {
            wp_enqueue_script('custom-title-highlight-color-picker', HL_TITLE_TEXT_URL . 'assets/js/disclaimer.js', ['wp-color-picker'], filemtime(HL_TITLE_TEXT_URL . 'assets/js/disclaimer.js'), true);
        }
    }
}
