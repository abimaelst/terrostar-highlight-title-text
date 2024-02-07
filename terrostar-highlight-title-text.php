<?php

/*
Terrostar Highlight Title Text is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Terrostar Highlight Title Text is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Terrostar Highlight Title Text. If not, see http://www.wordpress.org/terrostar_highlight_title_text
*/


/**
 * Plugin Name: Terrostar Highlight Title Text
 * Plugin URI: https://github.com/abimaelst
 * Description: Allows users to highlight words or phrases in post and page titles.
 * Version: 1.0
 * Requires at least: 6.2
 * License: GPL v2 or later
 * Author: Abimael Tavares
 * Text Domain: terrostar-highlight-title-text
 * Author URI: https://github.com/abimaelst/terrostar-highlight-title-text

 **/



if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Highlight_Title_Text')) {
    class Highlight_Title_Text
    {
        public function __construct()
        {
            $this->define_constants();
            require_once HL_TITLE_TEXT_PATH . 'controller/class-highlight-title-text-controller.php';
            new Controller_Title_Highlight();
        }

        public function define_constants()
        {
            define('HL_TITLE_TEXT_PATH', plugin_dir_path(__FILE__));
            define('HL_TITLE_TEXT_URL', plugin_dir_url(__FILE__));
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
    }

    if (class_exists('Highlight_Title_Text')) {
        register_activation_hook(__FILE__, ['Highlight_Title_Text', 'activate']);
        register_deactivation_hook(__FILE__, ['Highlight_Title_Text', 'deactivate']);
        register_uninstall_hook(__FILE__, ['Highlight_Title_Text', 'uninstall']);
        new Highlight_Title_Text();
    }
}
