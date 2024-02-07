<?php

namespace App;

use App\Controller\TitleHighlight;

class Bootstrap
{
    // if (!defined('ABSPATH')) {
    //     exit;
    // }

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

    public static function activate()
    {
    }

    public static function deactivate()
    {
    }

    public static function uninstall()
    {
    }

    // if (class_exists('Highlight_Title_Text')) {
    //     register_activation_hook(__FILE__, ['Highlight_Title_Text', 'activate']);
    //     register_deactivation_hook(__FILE__, ['Highlight_Title_Text', 'deactivate']);
    //     register_uninstall_hook(__FILE__, ['Highlight_Title_Text', 'uninstall']);
    //     new Highlight_Title_Text();
    // }
}
