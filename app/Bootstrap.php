<?php

namespace App;

use App\Controller\TitleHighlight;

class Bootstrap
{
    public function __construct()
    {
        $this->defineConstants();
        new TitleHighlight();
    }

    public function defineConstants()
    {
        define('HL_TITLE_TEXT_PATH', dirname(__DIR__,));
        define('HL_TITLE_TEXT_URL', plugin_dir_url(realpath(__DIR__)));
        define('HL_TITLE_TEXT_VERSION', '1.0.0');
    }

    public static function uninstall()
    {
        if (!defined('WP_UNINSTALL_PLUGIN')) {
            exit;
        }

        global $wpdb;

        $meta_keys = [
            '_custom_title_highlight_text',
            '_custom_title_highlight_style',
            '_custom_title_highlight_color',
            '_custom_title_highlight_bold'
        ];
    
        foreach ($meta_keys as $meta_key) {
            $wpdb->delete($wpdb->postmeta, ['meta_key' => $meta_key]);
        }
    }

    
}
