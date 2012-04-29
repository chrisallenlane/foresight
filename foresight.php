<?php

/**
 * @package cal_foresight
 */
 
/*
Plugin Name: Foresight
Plugin URI: http://chris-allen-lane.com
Description: Helps you to keep an eye on Wordpress exploits.
Author: Chris Lane
Version: 1.0.0
Author URI: http://chris-allen-lane.com
*/

/**
 * Menu Registration
 */ 
add_action('admin_menu', 'cal_fs_create_admin_menus');
function cal_fs_create_admin_menus(){
	wp_register_style('cal_fs_main', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/smoothness/jquery-ui.css');
	wp_enqueue_style('cal_fs_main');
	wp_register_script('cal_fs_main', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js');
	wp_enqueue_script('cal_fs_main');
	
	# main menu
	add_submenu_page(
		'tools.php',
		'Foresight',
		'Foresight',
		'manage_options',
		'cal_foresight',
		'cal_foresight_view'
	);
}

/**
 * Views
 */
function cal_foresight_view(){
	# enumerate the exploit trackers
	$trackers = array(
		'CVE'         => 'http://web.nvd.nist.gov/view/vuln/search-results?query=wordpress&search_type=all&cves=on',
		'CVE Details' => 'http://www.cvedetails.com/vendor/2337/Wordpress.html',
		'Exploit DB'  => 'http://www.exploit-db.com/search/?action=search&filter_page=1&filter_description=wordpress',
		'OSVDB'       => 'http://www.osvdb.org/search?search%5Bvuln_title%5D=wordpress&search%5Btext_type%5D=alltext',
		'Secunia'     => 'http://secunia.com/community/advisories/search/?search=wordpress',
		'1337Day'     => 'http://1337day.com/search',
	);
	
	# assemble the HTML
	$html =<<<HTML
	<div class='wrap'>
		<div id="icon-tools" class="icon32"></div>
		<h2>Foresight</h2>
		<div id='cal_fs_tabs' style='margin-top: 15px;'>
			<ul>
HTML;
	# print the tab navigation
	$i = 1;
	foreach($trackers as $tracker => $url){
		$html .= "<li><a href='#tabs-$i'>$tracker</a></li>";
		$i++;
	}	
	$html .= "</ul>";
	
		# iterate over the exploit trackers
		$i = 1;
		foreach($trackers as $tracker => $url){
			$html .=<<<HTML
			<div id='tabs-$i' class='tracker'>
				<iframe src='$url' style='width:100%'>
					Your browser does not support iframes.
				</iframe>
			</div>
HTML;
			$i++;
		}
	$html .= "</div>";
		
	# include the JavaScript dependencies
	$html .=<<<HTML
		<!-- size the iframe dynamically -->
		<script type='text/javascript'>
			// initialize the jQuery tabs UI
			jQuery("#cal_fs_tabs").tabs();
			
			// define the resize function
			function cal_fs_resize(){				
				window_height = jQuery(window).innerHeight();
				nag_height    = jQuery('div.update-nag').height();
				jQuery('div#cal_fs_tabs iframe').css('height', (window_height - 265) - nag_height);
			}
			
			// size the plugin on the first load
			cal_fs_resize();
			
			// resize the plugin on window.resize
			jQuery(window).resize(function(){
				cal_fs_resize();
			})
		</script>
		
		<p style='margin-bottom:0;text-align:center'>Plugin by <a href='http://chris-allen-lane.com?ref=foresight' target='_blank'>Chris Allen Lane</a>.</p>
	</div>
HTML;
	echo $html;
}
