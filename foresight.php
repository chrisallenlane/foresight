<?php

/**
 * @package cal_foresight
 */
 
/*
Plugin Name: Foresight
Plugin URI: http://chris-allen-lane.com
Description: Helps you to keep an eye on Wordpress exploits.
Author: Chris Lane
Version: 1.0
Author URI: http://chris-allen-lane.com
*/

/**
 * Menu Registration
 */ 
add_action('admin_menu', 'cal_fs_create_admin_menus');
function cal_fs_create_admin_menus(){
	wp_register_style('cal_fs_main', "http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/smoothness/jquery-ui.css");
	wp_enqueue_style('cal_fs_main');
	
	# main menu
	add_menu_page(
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
	$html ="<div id='cal_fs_tabs'>
		<ul>
	";
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
	<!-- use jQuery UI to implement the tabs -->
	<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js'></script>
	
	<!-- size the iframe dynamically -->
	<script type='text/javascript'>
		wrapper_height = jQuery('div#wpwrap').height();
		nag_height     = jQuery('div.update-nag').height();
		jQuery("#cal_fs_tabs").tabs();
		jQuery('div#cal_fs_tabs iframe').css('height', (wrapper_height - 180) - nag_height);
	</script>
HTML;
	echo $html;
}
