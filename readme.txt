=== My Custom Theme Values===
Contributors: Junaid Iqbal   
Author link: http://www.junaidiqbal.net
Donate Link: http://www.junaidiqbal.net
Tags: theme, values, theme values, custom theme values, custom theme options, short code, short code option
Requires at least: 3
Version: 1.1
Tested up to: 3.9
Stable tag: 1.0
License: GPLv2 or later 

This plugin will provide user to use the custom dynamic values anywhere on the site.

== Description ==

This plugin will provide user to use the custom dynamic values anywhere on the site by editing code OR by simply using short code that you can see the details on the plug-in setting page.


== Frequently Asked Questions ==

If you have any query just drop me a message on junaid19_0688@yahoo.com. 

== Upgrade Notice ==

Not available. 

== Installation ==

1. Upload `custom-theme-values.zip` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Now need to go on Theme Setting page and add your content.
After saving all your values in plug-in setting page, use echo get_option( 'my_value' )[0]; in code to render value in frontend OR Use short code [get-my-values key="my_value(0)"] in posts and pages to render values.
You can also use short code button that appears on post and page editor.

== Screenshots ==

1. Plugin settings page.
2. Post Shortcode and TinyMCE Button for Shortcode.

== Changelog ==

= 1.1 =
* New feature: Adds the button of short code on editor of posts and pages.
* Fix Code: Fix the code to work on php 4 and 5 both.
* Add file: Add new javascript file named as 'editor_sc.js' and updated the icon image.