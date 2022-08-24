<?php
/**
 * Plugin Name: Lean More Filter
 * Description: to replace the word "Learn More" with "Learn More"
 * Version: 2.3.6
 * Author: Kelson da Costa Medeiros
 * Author URI: https://github.com/kelsoncm
 * License: GPL-3.0+
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: lean_more
 * Domain Path: /languages/
 * @package lean_more
 */

$acitem_lastid = 0;
add_shortcode('learn_more', 'learn_more_handler');
function learn_more_handler($atts, $content=null){
	global $acitem_lastid;
	$acitem_lastid += 1;
    $default = [
		'caption' => 'Click here to learn more',
		"state" => 'close',
		"id" => '',
		"class" => ''		
	];
	$content = do_shortcode($content);
    $a = shortcode_atts($default, $atts);
    wp_enqueue_style('learn_more-filter-style', plugins_url('assets/accordion.css?1.0.1', __FILE__), [], '1.0.1');
	// wp_enqueue_script( 'et-shortcodes-js' );
	$caption = $a['caption'];
	$id = ($a['id'] <> '') ? " id='" . esc_attr( $a['id'] ) . "'" : '';
	$class = ($a['class'] <> '') ? esc_attr( ' ' . $a['class'] ) : '';

	$divClass = ($state == 'close') ? 'et-learn-more' : 'et-learn-more et-open';
	$hClass = ($state == 'close') ? 'heading-more' : 'heading-more open';
	$divClass .= ' clearfix';	

	return <<<EOD
    <div class="lm-tab">
      <input id="lm-tab-$acitem_lastid" type="checkbox">
      <label for="lm-tab-$acitem_lastid">$caption</label>
      <div class="lm-content"><p>$content</p></div>
    </div>
EOD;
}
