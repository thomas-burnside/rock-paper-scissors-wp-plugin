<?php
/**
 *Plugin Name: TB #6 Rock Paper Scissors 
 * Description: A simple JS game embedded via shortcode.
 * Version: 1.0.0
 * Author: Thomas Burnside
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Enqueue styles and scripts
function rock_paper_scissors_enqueue_assets() {
    if (is_singular() && has_shortcode(get_post()->post_content, 'rock_paper_scissors')) {
        wp_enqueue_style(
            'rock-paper-scissors-style',
            plugin_dir_url(__FILE__) . 'assets/css/style.css'
        );

        wp_enqueue_script(
            'rock-paper--scissors-script',
            plugin_dir_url(__FILE__) . 'assets/js/script.js',
            [],
            null,
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'rock_paper_scissors_enqueue_assets');

// Add shortcode for the game
function rock_paper_scissors_shortcode() {
    ob_start();
    ?>
<div class="game">
        <h1>Rock Paper Scissors!</h1>
        <p>Choose your move...</p>
        <div class="buttons">
            <button id="rock">&#x1F44A</button>
            <button id="paper">&#x1f590</button>
            <button id="scissors">&#x270c</button>
        </div>
        <p id="result"></p>
        <p id="scores">
            Your score: <span id="user-score">0</span>
            Computer's score: <span id="computer-score">0</span></p>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('rock_paper_scissors', 'rock_paper_scissors_shortcode');