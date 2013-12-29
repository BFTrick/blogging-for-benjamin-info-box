# Blogging For Benjamin Info Box

## Installation

1. Download the zip file of this plugin
1. Unzip the file
1. Upload the entire folder to your `wp-content/plugins/` directory
1. Activate the plugin via the WordPress Dashboard

## Configuration

There aren't any settings screens and it should work out of the box. But if you want there are a few filters that you can use.

### Filters

* `wtbfb_add_info_box` - the variable which controls if you should display the info box.
* `wtbfb_info_box_permalink` - the which URL the Blogging For Benjamin link to point to
* `wtbfb_open_wrapper` - the opening wrapper for the info box
* `wtbfb_close_wrapper` - the closing wrapper for the info box
* `wtbfb_info_box` - the entire info box including content & wrappers

### Strings

If you want to change the content in the info box it is fully translatable. I suggest using the [gettext filter](http://speakinginbytes.com/2013/10/gettext-filter-wordpress/).

## Styling

Since it is a good practice to separate functionality away from design I didn't include any styling in this plugin. But if you want to add some styling I suggest adding a few styles from this fantastic article about [CSS Message Boxes](http://css.dzone.com/news/css-message-boxes-different-me). Those are the same styles I use in the screenshot below.

## Screenshots

Checkout the information box on my [programming blog](http://speakinginbytes.com/2013/12/adding-functionality/).

![Info Box on SpeakingInBytes.com](/screenshots/info-box-on-my-blog.png "Info Box on SpeakingInBytes.com")