=== SO Related Posts ===
Contributors: senlin
Donate link: http://so-wp.com/donations
Tags: related posts
Requires at least: 3.7
Tested up to: 3.9
Stable tag: 2014.04.17
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The SO Related Posts plugin puts you in control on what really is related content.

== Description ==

The SO Related Posts plugin is an Extension for the fantastic [Meta Box plugin](http://wordpress.org/plugins/meta-box/) by [Rilwis](http://profiles.wordpress.org/rilwis/) and puts you in control on what really is related content. 

With the plugin installed you will find a Related Posts box underneath the Post Editor. Here you will see a checkbox which you can use to turn showing the Related Posts on or off as well as a neat dropdown menu that shows up to 999 of your published Posts.

On the frontend the Related Posts are shown in their own class with an unordered list, right after `the_content()`. The class will use the styling of your theme and you can style it further to your own liking.

Since 2014.01.20 I added a method to install the Meta Box plugin (where this extension depends on), instantly from within your website.

Since 2014.02.12 I have added a Settings Page where you can change the default title "Related Posts" into something of your liking.

Since 2014.03.23 I have added a checkbox with which you can turn the Related Posts on or off per Post

Since 2014.04.04 there is a premium version available with more built in options, such as custom styling from within the plugin and the possibility to add thumbnails. More information via [SO PLUS](https://senlinonline.com/plus/plugin/so-related-posts-plus/).

= Background =

For a while already I have been breeding on how to make a Related Posts plugin that doesn't query the database n times looking for related posts by tags, categories or what not. Most of the existing Related Posts plugin have an incredible (negative) impact on your site speed, so the benefits don't outweigh the costs.

Instead I was thinking that it would be much more flexible too if the user can choose his/her own Related Posts from a simple Posts drop down menu.

Among heaps of other very useful fields, the [Meta Box plugin](http://wordpress.org/plugins/meta-box/) by [Rilwis](http://profiles.wordpress.org/rilwis/) comes  with both a Post field and a Repeater field. I have combined these two and made it so that you can now show as many Related Posts as you want underneath the current Post. 

The SO Related Posts metabox uses the [Select2](http://ivaynberg.github.io/select2/) script which results in really beautiful and functional drop down menus. Credits for this functionality must all go to Rilwis as this is already baked in the Meta Box plugin.

On the Settings Page you can change the title that shows on the front end above the list of Related Posts.

I have decided to only support this plugin through [Github](https://github.com/senlin/so-related-posts/issues). Therefore, if you have any questions, need help and/or want to make a feature request, please open an issue over at Github. You can also browse through open and closed issues to find what you are looking for and perhaps even help others.

**PLEASE DO NOT POST YOUR ISSUES VIA THE WORDPRESS FORUMS**

Thanks for your understanding and cooperation.

== Installation ==

Go to **Plugins > Add New** in your WordPress Dashboard, do a search for "so related posts" and install it.

 &hellip; OR &hellip;


 1. Download zip file.

 2. Upload the zip file via the Plugins > Add New > Upload page &hellip; OR &hellip; unpack and upload with your favourite FTP client to the /plugins/ folder.

 3. Activate the plugin on the Plugins page.
 
 4. If you have not yet installed the Meta Box plugin (where this plugin depends on to function) you will see an error message with a link to a new install page called "Required Plugin". Go there and follow the instructions.
 
 5. Optional; go to the Settings page to change the title into something of your liking.

Done!


== Frequently Asked Questions ==

= Can I change the default title? =

Yes, since 2014.02.12 I have added a Settings Page where you can change the title that shows on the front end above the list of Related Posts. Soon I will be adding more options.

= I have not added any Related Posts, but the plugin shows the current post as Related Posts =

First update to the latest version (2014.03.23). If after updating it still shows, then you need to uncheck the checkbox that shows under your Post.

= Why is the plugin showing an error message after activation? =

This plugin is an Extension for the [Meta Box plugin](http://www.deluxeblogtips.com/meta-box/). If you don't have that installed, this Extension is useless. If you click on the link that shows with the error message you will go to a new page "Required Plugin" to install the Meta Box plugin.

= I don't like the output on my Single Post, can I change anything? =

Yes, you can. The output comes in its own class (`so-related-posts`) and in it you will find an `h4` for the title and an unordered list which has a class of `related-posts`. In your theme's `style.css` you can add any styling as you please.

= I have an issue with this plugin, where can I get support? =

Please open an issue on [Github](https://github.com/senlin/so-related-posts/issues)

== Screenshots ==
1. SO Related Posts Settings Page: change the title output on the settings page.
2. SO Related Posts meta box: search for the related post you want to add.
3. SO Related Posts meta box: add any number of related posts.
4. SO Related Posts output: you can style it to your liking.

== Changelog ==

= 2014.04.17 =

* added filter to prevent Jetpack related posts module from auto-activating
* move minimum WP version up to 3.7
* modify default settings function

= 2014.04.09 =

* updated TGM Plugin Activation class to 2.4
* update language files

= 2014.04.04 =

* added SO PLUS reference and discount coupon
* update language files

= 2014.04.03 =

* fix title bug

= 2014.03.23 =

* add checkbox to turn Related Posts on/off per post without losing the Posts you already have set. (default = off)

= 2014.02.20 =

* bugfix, set default output title if no title has been filled in

= 2014.02.12 =

* add settings page to enable changing the title output on the front end
* update language files
* update SO WP icon

= 2014.02.09 =

* improve so_related_posts_output content filter:
* by changing priority from 1 to 5
* add conditional is_main_query()
* unset foreach call
* escape text/url/title-strings

= 2014.01.24 =

* add Dutch language files (.po/.mo)
* add .pot file

= 2014.01.20 =

* integrated TGM Plugin Activation class by Thomas Griffin - https://github.com/thomasgriffin/TGM-Plugin-Activation

= 2014.01.07 =

* added "Please select..." placeholder text

= 2014.01.06 =

* first release

== Upgrade Notice ==

= 2014.03.23 =

* added a checkbox to turn Related Posts on/off per post without losing the Posts you already have set. As the default setting is off, you might need to go back into your Posts to tick it on.

= 2014.02.12 =

* the plugin now comes with a Settings Page
