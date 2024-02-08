<?php

declare(strict_types=1);

$path = sprintf('%s%svendor%sautoload.php', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);

require_once $path;

use App\Bootstrap;

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
 * Domain Path: /languages
 * Author URI: https://github.com/abimaelst/terrostar-highlight-title-text
 **/

 if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Bootstrap')) {
    new Bootstrap();
}

if (class_exists('Bootstrap')) {
    register_uninstall_hook(__FILE__, ['Bootstrap', 'uninstall']);
}