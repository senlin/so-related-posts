# SO Related Posts

###### Last updated on 2014.02.09
###### requires at least WordPress 3.6
###### tested up to WordPress 3.9-alpha
###### Author: [Piet Bos](https://github.com/senlin)
###### [Stable Version](http://wordpress.org/plugins/so-related-posts) (via WordPress Plugins Repository)
###### [Plugin homepage](http://so-wp.com/?p=63)

The SO Related Posts plugin puts you in control on what really is related content.

## Description

The SO Related Posts plugin is an Extension for the fantastic [Meta Box plugin](https://github.com/rilwis/meta-box) by [Rilwis](https://github.com/rilwis/) and puts you in control on what really is related content. 

With the plugin installed you will find a Related Posts box underneath the Post Editor. On the frontend the Related Posts are shown in their own class with an unordered list, right after `the_content()`. The class will use the styling of your theme and you can style it further to your own liking. 

Since 2014.01.20 I added a method to install the Meta Box plugin (where this extension depends on), instantly from within your website.

Since 2014.02.12 I have added a Settings Page where you can change the default title "Related Posts" into something of your liking.

### Background

For a while already I have been breeding on how to make a Related Posts plugin that doesn't query the database n times looking for related posts by tags, categories or what not. Most of the existing Related Posts plugin have an incredible (negative) impact on your site speed, so the benefits don't outweigh the costs.

Instead I was thinking that it would be much more flexible too if the user can choose his/her own Related Posts from a simple Posts drop down menu.

Among heaps of other very useful fields, the [Meta Box plugin](http://wordpress.org/plugins/meta-box/) by [Rilwis](http://profiles.wordpress.org/rilwis/) comes  with both a Post field and a Repeater field. I have combined these two and made it so that you can now show as many Related Posts as you want underneath the current Post. 

The SO Related Posts metabox uses the [Select2](http://ivaynberg.github.io/select2/) script which results in really beautiful and functional drop down menus. Credits for this functionality must all go to Rilwis as this is already baked in the Meta Box plugin.

On the Settings Page you can change the title that shows on the front end above the list of Related Posts.

## Frequently Asked Questions

### Can I change the default title?

Yes, since 2014.02.12 I have added a Settings Page where you can change the title that shows on the front end above the list of Related Posts. Soon I will be adding more options.

### Why is the plugin showing an error message after activation?

This plugin is an Extension for the [Meta Box plugin](http://www.deluxeblogtips.com/meta-box/). If you don't have that installed, this Extension is useless. If you click on the link that shows with the error message you will go to a new page "Required Plugin" to install the Meta Box plugin.

### I don't like the output on my Single Post, can I change anything?

Yes, you can. The output comes in its own class (`so-related-posts`) and in it you will find an `h4` for the title and an unordered list which has a class of `related-posts`. In your theme's `style.css` you can add any styling as you please.

### I have an issue with this plugin, where can I get support?

Please open an issue here on [Github](https://github.com/senlin/so-related-posts/issues)

## Contributions

This repo is open to _any_ kind of contributions.

## License

* License: GNU Version 2 or Any Later Version
* License URI: http://www.gnu.org/licenses/gpl-2.0.html

## Donations

* Donate link: http://so-wp.com/donations

## Connect with me through

[Github](https://github.com/senlin) 

[Google+](http://plus.google.com/+PietBos) 

[WordPress](http://profiles.wordpress.org/senlin/) 

[Website](http://senlinonline.com)

## Changelog

### 2014.02.12

* add settings page to enable changing the title output on the front end
* update language files
* update SO WP icon

### 2014.02.09

* improve so_related_posts_output content filter:
* by changing priority from 1 to 5
* add conditional is_main_query()
* unset foreach call
* escape text/url/title-strings

### 2014.01.24

* add Dutch language files (.po/.mo)
* add .pot file

### 2014.01.20

* added Development branch
* integrated TGM Plugin Activation class by Thomas Griffin - https://github.com/thomasgriffin/TGM-Plugin-Activation

### 2014.01.07

* added "Please select..." placeholder text

### 2014.01.06

* 	first release

## Screenshots

Preview of the meta box in the backend and the output on the front end.

![SO Related Posts meta box: Search for the related post you want to add.](assets/screenshot-1.png "SO Related Posts meta box")
---
![SO Related Posts meta box: Add any number of related posts.](assets/screenshot-2.png "SO Related Posts meta box")
---
![SO Related Posts output: You can style it to your liking.](assets/screenshot-3.png "SO Related Posts output")
