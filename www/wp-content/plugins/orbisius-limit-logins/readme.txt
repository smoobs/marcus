=== Orbisius Limit Logins ===
Contributors: lordspace,orbisius
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7APYDVPBCSY9A
Tags: authentication, login, security,limit login attempts,limit logins,brute force,securi,secury,auth,best security, botnet, brute force, brute force attack, bruteforce, harden wp, login lockdown, multisite, security, wordfence
Requires at least: 2.6
Tested up to: 4.1
Stable tag: 1.0.0
License: GPLv2 or later

Protect your site from automated logins efficiently!

== Description ==

This plugin logs and blocks IP address of users who try to login with known bad usernames such as admin, adm etc.
The plugin intentionally hooks very early (plugins_loaded hook) in order to determine if the user should be blocked or not because that way WordPress doesn't have to waste resources if the user is supposed to be blocked.
It stores the IP address in the uploads folder (.htaccess protected) so it doesn't hit the database for the ip checks. This may not work on some setups.

The user will get blocked in these cases:
- Tries to login using one of the bad usernames (admin, adm, root, administrator)
- Tries 7 or more ties to guess any password of any user

Note: If you still have an account whose username matches the logins mentioned above please create a new admin account and use that one instead
..  or *you will get banned* when you attempt to login regardless if your password was valid or not.

When the user should be blocked the plugin outputs Internal Server Error message and stop. That way the attacked doesn't know what's happening.
Also the user is has to wait between 3 and 15 seconds before seeing this error message to slow him/her down.

= Features / Benefits =
* Hooks very early and checks if the user is blocked -> blocks to saves resources
* Doesn't block server's ip or localhost / 127.0.0.1
* The plugin should be capable of detecting multiple IP address of a visitor (some proxies pass the original IP address via different request variable)
* If an IP is blocked that user is not allowed to access the whole site not just the login page.
* Extensible via hooks (filters, actions).

== Demo ==
TODO

Bugs? Suggestions? If you want a faster response contact us through our website's contact form [ orbisius.com ] and not through the support tab of this plugin or WordPress forums.
We don't get notified when such requests get posted in the forums.

> Support is handled on our site: <a href="http://club.orbisius.com/forums/" target="_blank" title="[new window]">http://club.orbisius.com/forums/</a>
> Please do NOT use the WordPress forums or other places to seek support.

= Author =

Svetoslav Marinov (Slavi) | <a href="http://orbisius.com" title="Custom Web Programming, Web Design, e-commerce, e-store, Wordpress Plugin Development, Facebook and Mobile App Development in Niagara Falls, St. Catharines, Ontario, Canada" target="_blank">Custom Web and Mobile Programming by Orbisius.com</a>

== Upgrade Notice ==
n/a

== Screenshots ==
1. Settings Page

== Installation ==

1. Unzip the package, and upload `orbisius-limit-logins` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= How to use this plugin? =
Just install the plugin and activate it. It will start protecting right away.

= How do I unblock myself ? =
Login with FTP and navigate to wp-content/uploads/.ht_orbisius_simple_block/ and then look for blk-YOUR-ip.txt and blk-YOUR-ip.txt.cnt.txt


== Changelog ==

= 1.0.0 =
* Initial release
