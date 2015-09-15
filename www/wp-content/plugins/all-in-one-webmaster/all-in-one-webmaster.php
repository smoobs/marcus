<?PHP
/*
Plugin Name: All in One Webmaster
Plugin URI: http://icrunched.co/all-in-one-webmaster/
Description: Sitemap Submission option to Google, Bing. Options to add Google, Bing, Alexa, Facebook Insights, Facebook, Blogcatalog Webmaster Meta Tag. Options to add Google, Quantcast.com, GetClicky.com, Compete.com Analytics scripts for your blogs.
Version: 8.0.0
Author: icrunched
Author URI: http://iCrunched.co
*/

/*
    Copyright (C) 2012 iCrunched.co

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//some default value

add_option('all_in_one_google_webmaster', '');
add_option('all_in_one_bing_webmaster', '');
add_option('all_in_one_alexa_webmaster', '');
add_option('all_in_one_bcatalog_webmaster', '');
add_option('all_in_one_fbinsights_webmaster', '');

add_option('all_in_one_google_analytics', '');
add_option('sitemap_URL', '');
add_option('all_in_one_clicky_analytics', '');
add_option('all_in_one_compete_analytics', '');
add_option('all_in_one_quantcast_analytics', '');
add_option('all_in_one_sitemeter_analytics', '');
add_option('all_in_one_placed_analytics', '');
add_option('all_in_one_placed_mobile_only', '-1');
add_option('all_in_one_placed_tag_type', '-1');


add_option('all_in_one_head_section', '');
add_option('all_in_one_footer_section', '');

add_option('all_in_one_banner', '-1');


function all_in_one_webmaster_head()
{
	$google_wm = get_option('all_in_one_google_webmaster');
	$alexa_wm = get_option('all_in_one_alexa_webmaster');
	$bcatalog_wm = get_option('all_in_one_bcatalog_webmaster');
	$fbinsights_wm = get_option('all_in_one_fbinsights_webmaster');

	$bing_wm = get_option('all_in_one_bing_webmaster');
	$google_an = get_option('all_in_one_google_analytics');
	$quantcast_an = get_option('all_in_one_quantcast_analytics');
	
	$placed_an = get_option('all_in_one_placed_analytics');
	$placed_mobile = get_option('all_in_one_placed_mobile_only');
	$placed_tag = get_option('all_in_one_placed_tag_type');
	
	
	$head_section = get_option('all_in_one_head_section');

	echo "<!-- All in One Webmaster plugin by iCrunched.co -->";
	if (!($head_section == ""))
	{
			echo $head_section . "\n";
	}
	if (!($google_wm == ""))
	{
		$google_wm_meta = '<meta name="google-site-verification" content="' . $google_wm . '" /> ';
		echo $google_wm_meta . "\n";
	}

	if (!($bing_wm == ""))
	{
		$bing_wm_meta = '<meta name="msvalidate.01" content="' . $bing_wm . '" />';
		echo $bing_wm_meta . "\n";
	}

	if (!($alexa_wm == ""))
	{
		$alexa_wm_meta = '<meta name="alexaVerifyID" content="' . $alexa_wm . '" />';
		echo $alexa_wm_meta . "\n";
	}
	if (!($bcatalog_wm == ""))
	{
		$bcatalog_wm_meta = '<meta name="blogcatalog" content="' . $bcatalog_wm . '" />';
		echo $bcatalog_wm_meta . "\n";
	}
	if (!($fbinsights_wm == ""))
	{
		$fbinsights_wm_meta = '<meta property="fb:admins" content="' . $fbinsights_wm . '" />';
		echo $fbinsights_wm_meta . "\n";
	}

	if (!($google_an == ""))
	{
		echo '<script type="text/javascript">'."\n";
		echo 'var _gaq = _gaq || [];'."\n";
		echo '_gaq.push([\'_setAccount\', \'' . $google_an . '\']);'."\n";
		echo '_gaq.push([\'_trackPageview\']);'."\n";
		echo '_gaq.push([\'_trackPageLoadTime\']);'."\n";
		echo '(function() {'."\n";
		echo 'var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;'."\n";
		echo 'ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';'."\n";
		echo 'var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);'."\n";
		echo ' })();'."\n";
		echo '</script>'."\n";
	}

	if (!($quantcast_an == ""))
	{
		echo '<script type="text/javascript">'."\n";
		echo '_qoptions={qacct:"' . $quantcast_an . '"};'."\n";
		echo '</script>'."\n";
		echo '<script type="text/javascript" src="http://edge.quantserve.com/quant.js"></script>'."\n";
	}
	
	$placed_mobile_value = "";
	$placed_tag_value = "";

	if ($placed_mobile == -1)
	{
		$placed_mobile_value = "t";
	}else
	{
		$placed_mobile_value = "f";
	} 

	if ($placed_tag == -1)
	{
		$placed_tag_value = "placed_agent_placed";
	}else
	{
		$placed_tag_value = "placed_agent";
	} 
	
	if (!($placed_an == ""))
	{
		echo '<script type="text/javascript">'."\n";
		echo 'var _swApiKey = _swApiKey || "";'."\n";
		echo 'var _swEvents = _swEvents || [];'."\n";
		echo 'var _swMobileOnly = _swMobileOnly || "";'."\n";
		echo '(function() {'."\n";
		echo 'var elem = document.createElement(\'script\');'."\n";
		echo 'elem.src = (document.location.protocol == "https:" ? "https:" : "http:") + "//d1uiiw95yqfkwo.cloudfront.net/'.$placed_tag_value.'.js";'."\n";
		echo 'elem.async = true;'."\n";
		echo 'elem.type = "text/javascript";'."\n";
		echo 'var scpt = document.getElementsByTagName(\'script\')[0];'."\n";
		echo 'scpt.parentNode.insertBefore(elem, scpt);'."\n";
		echo '})();'."\n";
		
		echo '_swApiKey = "' . $placed_an . '"'."\n";
		echo '_swMobileOnly = "'.$placed_mobile_value.'";'."\n";
		echo '_swEvents.push([\'_PageView\']);'."\n";
		echo '</script>'."\n";
	}
	
	echo "<!-- /All in One Webmaster plugin -->";

}

function all_in_one_webmaster_footer()
{

	$clicky_an = get_option('all_in_one_clicky_analytics');
	$compete_an = get_option('all_in_one_compete_analytics');

	$footer_section = get_option('all_in_one_footer_section');
	$sitemeter_an = get_option('all_in_one_sitemeter_analytics');

	if (!($footer_section == ""))
	{
		echo $footer_section . "\n";
	}

	if (!($clicky_an == ""))
	{
		echo '<script src="http://static.getclicky.com/js" type="text/javascript"></script>'."\n";
		echo '<script type="text/javascript">clicky.init('.$clicky_an.');</script>'."\n";
	}

	if (!($compete_an == ""))
	{
		echo '<script type="text/javascript">'."\n";
		echo '__compete_code = \'' . $compete_an . '\';'."\n";
		echo '(function () { var s = document.createElement(\'script\'),d = document.getElementsByTagName(\'head\')[0] || document.getElementsByTagName(\'body\')[0],t = \'https:\' == document.location.protocol ? \'https://c.compete.com/bootstrap/\' : \'http://c.compete.com/bootstrap/\'; s.src = t + __compete_code + \'/bootstrap.js\'; s.type = \'text/javascript\'; s.async = \'async\'; if (d) { d.appendChild(s); }}());'."\n";
		echo '</script>'."\n";
	}

	if (!($sitemeter_an == ""))
	{
		echo '<script type="text/javascript" src="'.$sitemeter_an.'"></script>'."\n";
	}

	$all_in_one_banner1 = get_option('all_in_one_banner');

}

function all_in_one_webmaster_sitemap_submit($sitemap_URL1,$search_engine,$OKmessage,$NOmessage)
{

	$DONE_MSG = 'DONE';
	$NOPE_MSG = 'NOPE';

	$pingurl = $search_engine.$sitemap_URL1;
	$source = @file_get_contents($pingurl);

	if ($source != false) {

		$source = strip_tags($source);
		$source = "WEBMASTER".$source;

		$isOKmessage = stripos($source,$OKmessage);
		$isNOmessage = stripos($source,$NOmessage);

		if (($isOKmessage != false)&&($isNOmessage == false))
		{
			$finalMessage = $DONE_MSG.$OKmessage;
		}
		if (($isOKmessage == false)&&($isNOmessage != false))
		{
			$finalMessage = $NOPE_MSG.$NOmessage;
		}
		if (($isOKmessage == false)&&($isNOmessage == false))
		{
			$finalMessage = $NOPE_MSG.'Submission error';
		}
	}
	else if ($source == false) {$finalMessage = $NOPE_MSG.'search_engine error';}
	return array($source, $finalMessage);
}

function all_in_one_webmaster_options_page() {


	$all_in_one_placed_mobile_only = $_POST['all_in_one_placed_mobile_only'];
	$all_in_one_placed_tag_type = $_POST['all_in_one_placed_tag_type'];
	
	if (isset($_POST['info_update2']))
	{
		update_option('sitemap_URL', (string)$_POST['sitemap_URL']);
		$sitemap_URL1 = get_option('sitemap_URL');

		$show_sitemap = '';
		$last3 = substr($sitemap_URL1, -1, 3);
		$last5 = substr($sitemap_URL1, -1, 5);
		$check1 = "xml";
		$icon_url = get_bloginfo( 'wpurl' );

		if($sitemap_URL1 == "")
		{
			$show_sitemap .= '<div id="message" class="updated fade"><p>'."Oops!! Blank field. Please provide sitemap URL" . '<br /><br /> Sitemap must ends with .xml or .xml.gz';
			$show_sitemap .= '</p></div>';
		}

		else
		{
				$webmasterlink = array(

					'goo' => array (
						'webmaster_engine' => 'Google',
						'search_engine' => 'http://www.google.com/webmasters/sitemaps/ping?sitemap=',
						'OKmessage' => 'Sitemap Notification Received',
						'NOmessage' => 'Bad Request'
					),

					'bin' => array (
							'webmaster_engine' => 'Bing',
							'search_engine' => 'http://www.bing.com/webmaster/ping.aspx?siteMap=',
							'OKmessage' => 'Thanks for submitting your sitemap',
							'NOmessage' => 'Bad Request'
					),

				);

				$show_sitemap .= '<div id="message" class="updated fade"><p>';

				foreach ($webmasterlink as $siln => $myArray1 )
				{
				$webmaster_engine	= $myArray1['webmaster_engine'];
				$search_engine	= $myArray1['search_engine'];
				$OKmessage	= $myArray1['OKmessage'];
				$NOmessage	= $myArray1['NOmessage'];

				list ($source, $finalMessage) =  all_in_one_webmaster_sitemap_submit($sitemap_URL1,$search_engine,$OKmessage,$NOmessage);

				$statusTag = substr($finalMessage,0,4);
				if ($statusTag == 'DONE') {
					$icon = '<img border="0" src="'.$icon_url.'/wp-content/plugins/all-in-one-webmaster/yes.jpg" /> ';
					$alter_link = '<br />';
					}
				else if ($statusTag == 'NOPE') {
					$icon = '<img border="0" src="'.$icon_url.'/wp-content/plugins/all-in-one-webmaster/fail.jpg" /> ';
					$submission_URL1 = $search_engine.$sitemap_URL1;
					$alter_link = '<a href="'.$submission_URL1.'" target="_blank"> (Try manually)</a><br /><br />';
					}
				else {
					$icon = '';
					$alter_link = '';
					}
				$finalMessage = substr($finalMessage,4);
				$insert_sitemap = "\n".$icon."<b>".$webmaster_engine.":  </b><i>".$finalMessage."</i><br />".$alter_link ;
				$show_sitemap .= $insert_sitemap;
				}
				$show_sitemap .= '</p></div>';
			}
	}
	
	if (isset($_POST['info_update1']))
	{
		update_option('all_in_one_google_webmaster', (string)$_POST["all_in_one_google_webmaster"]);
		update_option('all_in_one_alexa_webmaster', (string)$_POST["all_in_one_alexa_webmaster"]);
		update_option('all_in_one_bcatalog_webmaster', (string)$_POST["all_in_one_bcatalog_webmaster"]);
		update_option('all_in_one_bing_webmaster', (string)$_POST["all_in_one_bing_webmaster"]);
		update_option('all_in_one_google_analytics', (string)$_POST['all_in_one_google_analytics']);
		update_option('all_in_one_clicky_analytics', (string)$_POST['all_in_one_clicky_analytics']);
		update_option('all_in_one_compete_analytics', (string)$_POST['all_in_one_compete_analytics']);
		update_option('all_in_one_quantcast_analytics', (string)$_POST['all_in_one_quantcast_analytics']);
		update_option('all_in_one_fbinsights_webmaster', (string)$_POST["all_in_one_fbinsights_webmaster"]);
		update_option('all_in_one_sitemeter_analytics', stripslashes_deep((string)$_POST['all_in_one_sitemeter_analytics']));
		update_option('all_in_one_placed_analytics', stripslashes_deep((string)$_POST['all_in_one_placed_analytics']));
		update_option('all_in_one_head_section', stripslashes_deep((string)$_POST['all_in_one_head_section']));
		update_option('all_in_one_footer_section', stripslashes_deep((string)$_POST['all_in_one_footer_section']));
		update_option('all_in_one_banner', ($_POST['all_in_one_banner']=='1') ? '1':'-1' );

	update_option('all_in_one_placed_mobile_only', ($_POST['all_in_one_placed_mobile_only']=='1') ? '1':'-1' );
   	update_option('all_in_one_placed_tag_type', ($_POST['all_in_one_placed_tag_type']=='1') ? '1':'-1' );
		
		echo '<div id="message" class="updated fade"><p><strong>Settings updated.</strong></p></div>';
		echo '</strong>';

	}else{
	$all_in_one_placed_mobile_only = $_POST['all_in_one_placed_mobile_only'];
	$all_in_one_placed_tag_type = $_POST['all_in_one_placed_tag_type'];
	
	}
	
	
	$icon_url = get_bloginfo( 'wpurl' );
	$help_icon = '<img border="0" src="'.$icon_url.'/wp-content/plugins/all-in-one-webmaster/help.gif" /> ';
	$new_icon = '<img border="0" src="'.$icon_url.'/wp-content/plugins/all-in-one-webmaster/new.gif" /> ';

	?>
   <div class=wrap>

    <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
    <input type="hidden" name="info_update1" id="info_update1" value="true" />

    <u><h2>All in One Webmaster Options</h2></u>

	<div align="left">
	<br>
	<h3>Follow us on Twitter & Facebook to get latest update:</h3>
	
	<a href="https://twitter.com/iCrunched" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @iCrunched</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FiCrunchedco%2F117867008360385&amp;width=292&amp;height=62&amp;colorscheme=light&amp;show_faces=false&amp;border_color&amp;stream=false&amp;header=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:62px;" allowTransparency="true"></iframe>

	</div>

	<div id="poststuff" class="metabox-holder has-right-sidebar">

	<div style="float:left;width:63%;">

<br>
		<div class="postbox">
		<h3>Webmaster Options</h3>
			<div>
			<table class="form-table">

			<tr valign="top" class="alternate">
					<th scope="row" style="width:32%;"><label>1) <b>Google</b> WebMaster Central</label></th>
				<td>
				 <input name="all_in_one_google_webmaster" type="text" size="55" value="<?php echo get_option('all_in_one_google_webmaster'); ?>" /> <a href="http://www.google.com/webmasters/" target="_blank" title="Click to visit Google Webmaster Central"><?=$help_icon?></a>
				 <br />(meta name="google-site-verification" content="<font color="red"><code>Volxdfasfasd3i3e_wATasfdsSDb0uFqvNVhLk7ZVY</code></font>")<br />

				</td>
			</tr>
			<tr valign="top">
					<th scope="row" style="width:32%;"><label>2) <b>Bing</b> WebMaster Center</label></th>
				<td>
				 <input name="all_in_one_bing_webmaster" type="text" size="55" value="<?php echo get_option('all_in_one_bing_webmaster'); ?>" /> <a href="http://www.bing.com/webmaster/" target="_blank" title="Click to visit Bing Webmaster Center"><?=$help_icon?></a>
				 <br />(meta name="msvalidate.01" content="<font color="red"><code>ASBKDW71D43Z67AB2D39636C89B88A</code></font>")<br />

				</td>
			</tr>
			<tr valign="top">
					<th scope="row" style="width:32%;"><label>3) <b>Alexa</b> Rank</label></th>
				<td>
				 <input name="all_in_one_alexa_webmaster" type="text" size="55" value="<?php echo get_option('all_in_one_alexa_webmaster'); ?>" /> <a href="http://www.alexa.com/" target="_blank" title="Click to visit Alexa.com Rank Site"><?=$help_icon?></a>
				 <br />(meta name="alexaVerifyID" content="<font color="red"><code>OKJ3RsasdfKHGST1uqa8zcBfrjtY</code></font>")<br />
				</td>
			</tr>
			<tr valign="top" class="alternate">
					<th scope="row" style="width:32%;"><label>4) <b>BlogCatalog</b></label><?=$new_icon?></th>
				<td>
				 <input name="all_in_one_bcatalog_webmaster" type="text" size="55" value="<?php echo get_option('all_in_one_bcatalog_webmaster'); ?>" /> <a href="http://www.blogcatalog.com/" target="_blank" title="Click to visit BlogCatalog.com"><?=$help_icon?></a>
				 <br />(meta name="blogcatalog" content="<font color="red"><code>7DS9234212</code></font>")<br />
				</td>
			</tr>

			<tr valign="top">
					<th scope="row" style="width:32%;"><label>5) <b>Facebook Insights</b></label><?=$new_icon?></th>
				<td>
				 <input name="all_in_one_fbinsights_webmaster" type="text" size="55" value="<?php echo get_option('all_in_one_fbinsights_webmaster'); ?>" /> <a href="http://www.facebook.com/insights/" target="_blank" title="Click to visit Facebook Insight"><?=$help_icon?></a>
				 <br />(meta property="fb:admins" content="<font color="red"><code>573435354</code></font>")<br />
				</td>
			</tr>
			</table>
			</div>
		</div>

		<div class="submit">
				<input type="submit" name="info_update1" class="button-primary" value="<?php _e('Update options'); ?> &raquo;" />

		</div>

		<div class="postbox">
		<h3>Analytics Options</h3>
			<div>
			<table class="form-table">

			<tr valign="top" class="alternate">
					<th scope="row" style="width:32%;"><label>1) <b>Google</b> Analytics</label></th>
				<td>
					<input name="all_in_one_google_analytics" type="text" size="55" value="<?php echo get_option('all_in_one_google_analytics'); ?>" /> <a href="http://www.google.com/analytics/" target="_blank" title="Click to visit Google Analytics"><?=$help_icon?></a>
					<br />(Web Property ID: <font color="red"><code>UA-8123456-1</code></font>)<br />
				</td>
			</tr>

			<tr valign="top">
					<th scope="row" style="width:32%;"><label>2) <b>Quantcast</b> Analytics</label></th>
				<td>
					<input name="all_in_one_quantcast_analytics" type="text" size="55" value="<?php echo get_option('all_in_one_quantcast_analytics'); ?>" /> <a href="http://www.quantcast.com/" target="_blank" title="Click to visit Quantcast Analytics"><?=$help_icon?></a>
					<br />(qacct value. i.e. <font color="red"><code>p-a8SWEoiOWPo5Q</code></font>)<br />
				</td>
			</tr>

			<tr valign="top" class="alternate">
					<th scope="row" style="width:32%;"><label>3) <b>Clicky</b> Analytics</label></th>
				<td>
					<input name="all_in_one_clicky_analytics" type="text" size="55" value="<?php echo get_option('all_in_one_clicky_analytics'); ?>" /> <a href="http://getclicky.com/user/" target="_blank" title="Please go to this link and click Preferences under the name of the domain, you will find the Site ID. "><?=$help_icon?></a>
					<br />(Site ID: <font color="red"><code>324543</code></font>)<br />
				</td>
			</tr>

			<tr valign="top">
					<th scope="row" style="width:32%;"><label>4) <b>Compete</b> Analytics</label></th>
				<td>
					<input name="all_in_one_compete_analytics" type="text" size="55" value="<?php echo get_option('all_in_one_compete_analytics'); ?>" /> <a href="http://compete.com/" target="_blank" title="Please go to this Site and Register to get Code. "><?=$help_icon?></a>
					<br />(__compete_code = '<font color="red"><code>07a543238f9kdwjga0d280bd70534990a</code></font>')<br />
				</td>
			</tr>

			<tr valign="top" class="alternate">
					<th scope="row" style="width:32%;"><label>5) <b>SiteMeter</b> Analytics/Tracking</label></th>
				<td>
					<input name="all_in_one_sitemeter_analytics" type="text" size="55" value="<?php echo get_option('all_in_one_sitemeter_analytics'); ?>" /> <a href="http://www.sitemeter.com/" target="_blank" title="Please go to this Site and Register to get Code. "><?=$help_icon?></a>
					<br />(src="<font color="red"><code>http://s44.sitemeter.com/js/counter.js?site=s44AShah</code></font>")<br />
				</td>
			</tr>

			</table>
			</div>
		</div>

		<div class="submit">
				<input type="submit" name="info_update1" class="button-primary" value="<?php _e('Update options'); ?> &raquo;" />

		</div>
		
		<div class="postbox">
		<h3>Placed Analytics<?=$new_icon?></h3>
			<div>
			<table class="form-table">

			<tr valign="top">
					<th scope="row" style="width:32%;"><label><b>Placed</b> Application Key</label></th>
				<td>
					<input name="all_in_one_placed_analytics" type="text" size="55" value="<?php echo get_option('all_in_one_placed_analytics'); ?>" /> <a href="http://www.placed.com/" target="_blank" title="Please go to this Site and Register to get Code. "><?=$help_icon?></a>
					<br />Application Key <font color="red"><code>a6e1321039ab</code></font><br />
				</td>
			</tr>
			
					<tr valign="top" class="alternate">
							<th scope="row"><label>Custom Options<?=$new_icon?></label>
							<br>
							<br>
							<a href="http://icrunched.co/placed-analytics-added-to-all-in-one-webmaster-wordpress-plugin/" target="_blank"><code>Setup Help</code></a>
							</th>
							
						<td>
							 <input name="all_in_one_placed_mobile_only" type="checkbox"<?php if(get_option('all_in_one_placed_mobile_only')!='-1') echo 'checked="checked"'; ?> value="1" /> &nbsp;&nbsp;<code>Check</code> if you have selected ONLY Non-Mobile version. (Default: unchecked)<br>
							 unchecked = Web + Mobile <br>
							 checked = Non-Mobile Version
							 <br>
							 <br>
							 <input name="all_in_one_placed_tag_type" type="checkbox"<?php if(get_option('all_in_one_placed_tag_type')!='-1') echo 'checked="checked"'; ?> value="1" /> &nbsp;&nbsp;<code>Check</code> if you have selected Site Domain. (Default: unchecked)<br>
							unchecked = tag type (placed.com) <br>
							checked = tag type (site domain) 
						</td>
					</tr>			
			
			</table>
			</div>
		</div>
		<div class="submit">
				<input type="submit" name="info_update1" class="button-primary" value="<?php _e('Update options'); ?> &raquo;" />

		</div>

		<div class="postbox">
		<h3>Extra HTML code to be inserted in to Header or Footer Section</h3>
			<div>
			<table class="form-table">

			<tr valign="top" class="alternate">

				<th scope="row" style="width:32%;"><label>1) <b>Header</b> Section</label><?=$new_icon?><br><br>Add <b>ONLY HTML</b> code to the <code>head</code> of your blog</th>

				<td><textarea name="all_in_one_head_section" cols="60" rows="5"><?php echo get_option('all_in_one_head_section'); ?></textarea></td>
			</tr>
			<tr valign="top">
				<th scope="row" style="width:32%;"><label>2) <b>Footer</b> Section</label><?=$new_icon?><br><br>Add <b>ONLY HTML</b> code to the <code>footer</code> of your blog</th>

				<td><textarea name="all_in_one_footer_section" cols="60" rows="5"><?php echo get_option('all_in_one_footer_section'); ?></textarea></td>
			</tr>

			</table>
			</div>

		</div>
	
		<a href="http://icrunched.co/all-in-one-webmaster/" target="_blank">Feedback</a> | <a href="http://twitter.com/iCrunched" target="_blank">Twitter</a> | <a href="http://www.facebook.com/iCrunched" target="_blank">Facebook</a>

		<div class="submit">
				<input type="submit" name="info_update1" class="button-primary" value="<?php _e('Update options'); ?> &raquo;" />

		</div>
		</form>

		<form method="post" mame="info_update2" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
			<input type="hidden" name="info_update2" id="info_update2" value="true" />

			<div class="postbox">
				<h3>Automatic sitemap submission to Google and Bing</h3>
					<div>
					<table class="form-table">

					<tr valign="top" class="alternate">
							<th scope="row" style="width:29%;"><label>Please provide existing Sitemap URL</label></th>
							<td>
								<input name="sitemap_URL" type="text" size="75" value="<?php echo get_option('sitemap_URL'); ?>" />
								<br />
								(example: http://example.com/sitemap.xml)
							</td>
					</tr>

					</table>

					</div>
			</div>

					<div class="submit">
						<input type="submit" name="info_update2" class="button-primary" value="<?php _e('Submit to Google and Bing'); ?> &raquo;" />

					</div>


<?=$show_sitemap?>
   			</form>

	</div>

				 <div id="side-info-column" class="inner-sidebar">
				<div class="postbox">
				  <h3 class="hndle"><span>All in One Webmaster</span></h3>
				  <div class="inside">
	                <ul>
	                <li><a href="http://icrunched.co/all-in-one-webmaster/" title="All in One Webmaster" target="_blank">Plugin Homepage</a></li>
	                </ul>          
					</div>
				</div>
     </div>
          <br>
			<div id="side-info-column" class="inner-sidebar">
				<div class="postbox">
				  <h3 class="hndle"><span>My Other Plugins</span></h3>
				  <div class="inside">
					<ul>
					<li>1) <a href="http://icrunched.co/twitter-goodies/" title="Twitter Goodies" target="_blank">Twitter Goodies</a></li>
					<li>2) <a href="http://icrunched.co/wp-google-buzz/" title="All in One Webmaster" target="_blank">WP Google Buzz</a></li>
					<li>3) <a href="http://icrunched.co/wp-archive-sitemap-generator/" title="WP Archive-Sitemap Generator" target="_blank">WP Archive-Sitemap Generator</a></li>
					<li>4) <a href="http://icrunched.co/foursquare-integration/" title="FourSquare Integration" target="_blank">FourSquare Integration</a></li>
					<li>5) <a href="http://icrunched.co/facebook-members/" title="Facebook Members" target="_blank">Facebook Members</a></li>
					</ul>
				  </div>
				</div>
		     </div>
	
	
</div>
</div>
	<?php
}

function all_in_one_webmaster_admin() {
	add_options_page('All in One Webmaster', 'All in One Webmaster', 8, __FILE__, 'all_in_one_webmaster_options_page');
}

// admin stuff
add_action('admin_menu', 'all_in_one_webmaster_admin');

// do the work of this plugin!
add_action('wp_head', 'all_in_one_webmaster_head');
add_action('wp_footer', 'all_in_one_webmaster_footer');

?>