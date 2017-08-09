=== Exit Notifier ===
Contributors: cvs@cvstech.com
Donate link: http://www.cvstech.com/donate
Tags: exit link, speed bump, external link, compliance, Credit Union
Requires at least: 4.0
Tested up to: 4.8
Stable tag: 1.4.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Provides a way to notify site users they have clicked an external link and are leaving your site.

== Description ==

Some industries' compliance recommendations suggest that a notice be presented anytime someone leaves your site. I searched for a plugin to do this, and came up empty, so here you go! 

Features:
* Works with little or no configuration.
* The title and the body of the exit box, and the text on the buttons are all editable, and honor shortcodes.
* There are also options for providing a visual indication on your selected links, and for opening selected links in a new window/tab.
* You can completely customize the display of the dialog by modifying the CSS. 
* You can set a timeout that will continue or cancel when the time expires.

Credit where credit is due

I have made liberal use of the excellent Wordpress Plugin Template by Hugh Lashbrooke found at https://github.com/hlashbrooke/WordPress-Plugin-Template. Thanks, Hugh!
Also, to <a href="http://flwebsites.biz/jAlert/">Versatility Werks</a>, the makers of jAlert. Great "werk", guys! Thanks!


== Installation ==

Installing "Exit Notifier" can be done either by searching for "Exit Notifier" via the "Plugins > Add New" screen in your WordPress dashboard, or by using the following steps:

1. Download the plugin via WordPress.org
2. Upload the ZIP file through the 'Plugins > Add New > Upload' screen in your WordPress dashboard
3. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= What is the plugin for? =

This plugin is designed to provide a mechanism for notifying users of your site that they are leaving for another server. It can also be used to pop an alert for pretty much any <a> tag target with some jQuery selector magic. Some industries recommend notifying users if they are leaving your site.

= Can I edit the text in the box? =

Yes. The plugin provides generic defaults, but the settings page allows you to edit the title and body of the exit box. You can now also edit the text of the buttons, and determine the box behavior and look and feel.

== Screenshots ==

1. A sample notice in action.
2. Default exit box closeup.
3. Content settings.
4. Behavior settings.
5. Display settings.

== Changelog ==

= 1.4.2 =
* 2017-06-15
* Fixed minor error involving the Exit Box Theme sometimes not being selected leading to it failing to fire.

= 1.4.1 =
* 2017-06-09
* Minor metadata update

= 1.4.0 =
* 2017-06-09
* Added the timeout feature and settings tab.

= 1.3.4 =
* 2017-04-03
* Added exitNotifierLink class to all selected links so that you can style them to suit. Added the option to use no animation.

= 1.3.3 =
* 2017-03-16
* Added option to turn off URL in button text, and process shortcodes in the body text and popup title.

= 1.3.2 =
* 2017-03-01
* Added in an advanced CSS field that allows editing CSS that will affect the whole site and should take precedence over other CSS. WARNING: Do not use if you are not confident in your understanding of CSS!

= 1.3.1 =
* 2017-02-23
* Narrowed the scope of the Custom CSS setting to prevent sitewide CSS issues.

= 1.3.0 =
* 2017-02-15
* Added the ability to completely customize the look of the dialog by modifying the CSS.

= 1.2.3 =
* 2017-02-11
* Fixed CSS defining width for text fields affecting more than intended

= 1.2.2 =
* 2015-12-17
* Verified compatibility with WordPress 4.4. Updated Behavior tab in settings to clear up how the jQuery selector gets used.

= 1.2.1 =
* 2015-09-25
* Rearranged settings into tabs for readability and to reduce the need to scroll. Added backgroundColor option.

= 1.2 =
* 2015-09-24
* Visual controls added to the admin page

= 1.1.2 =
* 2015-09-14
* Minor terminology updates.

= 1.1.1 =
* 2015-09-14
* Added option to change the jQuery selector, allowing you to affect what links are notified.

= 1.0.2 =
* 2015-09-13
* Updated default body text to better match compliance suggestions.

= 1.0.1 =
* 2015-08-16
* Added options for visual indication of an external link and whether or not to open external links in a new window/tab.

= 1.0 =
* 2015-08-15
* Initial release

== Upgrade Notice ==
= 1.4.2 =
Fixed minor error involving the Exit Box Theme sometimes not being selected leading to it failing to fire.

= 1.4.1 =
Minor metadata update.

= 1.4.0 =
Added the timeout feature and settings tab.

= 1.3.4 =
Added exitNotifierLink class to all selected links so that you can style them to suit. Added the option to use no animation.

= 1.3.3 =
Added option to turn off URL in button text, and process shortcodes in the body text and popup title.

= 1.3.2 =
Added in an advanced CSS field that allows editing CSS that will affect the whole site and should take precedence over other CSS. WARNING: Do not use if you are not confident in your understanding of CSS!

= 1.3.1 =
Narrowed the scope of the Custom CSS setting to prevent sitewide CSS issues.

= 1.3.0 =
Added the ability to completely customize the look of the dialog by modifying the CSS.

= 1.2.3 =
Fixed CSS defining width for text fields affecting more than intended

= 1.2.2 =
Verified compatibility with WordPress 4.4. Updated Behavior tab in settings to clear up how the jQuery selector gets used.

= 1.2.1 =
Rearranged settings into tabs for readability and to reduce the need to scroll. Added backgroundColor option.

= 1.2 =
Added visual control to the admin panel

= 1.1.1 =
Added option to change the jQuery selector, allowing you to affect what links are notified.

= 1.0.2 =
Updated default body text to better match compliance suggestions.

= 1.0.1 =
Added options for visual indication of an external link and whether or not to open external links in a new window/tab.

= 1.0 =
Initial release
