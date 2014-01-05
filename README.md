# SO Related Posts

###### Last updated on 2014.01.06
###### requires at least WordPress 3.6
###### tested up to WordPress 3.9-alpha
###### Author: [Piet Bos](https://github.com/senlin)
###### [Stable Version](http://wordpress.org/plugins/so-related-posts) (via WordPress Plugins Repository)
###### [Plugin homepage](http://so-wp.com/?p=63)

This Addon for the [Meta Box plugin](https://github.com/rilwis/meta-box) lets the user choose one or more Related Posts from all published Posts and shows them underneath the Post.

## Description

For a while already I have been breeding on how to make a Related Posts plugin that doesn't query the database n times looking for related posts by tags, categories or what not. Most of the existing Related Posts plugin have an incredible (negative) impact on your site speed, so the benefits don't outweigh the costs.

Instead I was thinking that it would be much more flexible too if the user can choose his/her own Related Posts from a simple Posts drop down.

As the Meta Box plugin comes with both a Post field and a Repeater field, I have combined these two and made it so that you can now show as many Related Posts as you want underneath the current Post. 

The Addon doesn't come with any settings; you can just choose which Posts to add. The meta box is only visible in the Edit Post screen.

## Frequently Asked Questions

### Where are the Settings?

You can stop looking, there are no settings. When you go into your Post Edit screen, you will see the Related Posts Metabox where you can choose Related Posts for your current Post.

### Why is the plugin showing an error message after activation?

This plugin is an Addon for the [Meta Box plugin](http://www.deluxeblogtips.com/meta-box/). If you don't have that installed, this Addon is useless, so better not install it.

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

### 2014.01.06

* 	first release