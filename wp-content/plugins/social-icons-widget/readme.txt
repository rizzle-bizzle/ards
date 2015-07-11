=== Social Icons Widget ===
Contributors: cgrymala
Tags: social media, twitter, facebook, widget
Requires at least: 3.1
Tested up to: 3.2.1
Stable tag: 0.1

A developer-friendly plugin that allows you to add a widget with links to various social media profiles.

== Description ==

Adds an available widget to list various social media profiles. The following social media sites are included by default:

* Facebook
* Twitter
* YouTube
* LinkedIn
* Google+
* FriendFeed
* Flickr

This plugin also includes a filter hook allowing you to extend the available services. 

By default, this plugin outputs an unordered list (ul) with a class of `social-icons-list`. Each service is output as a list item (li) with the service name used as the HTML class attribute. Filters are available to allow you to change those HTML elements.

== Installation ==

= Automatic Installation =

The easiest way to install this plugin automatically from within your administration area.

1. Go to Plugins -&gt; Add New in your administration area, then search for the plugin "Social Icons Widget".
1. Click the "Install" button.
1. Go to the Plugins dashboard and "Activate" the plugin (for MultiSite users, you can safely "Network Activate" this plugin).

= Manual Installation =

If that doesn't work, or if you prefer to install it manually, you have two options.

**Upload the ZIP**

1. Download the ZIP file from the WordPress plugin repository.
1. Go to Plugins -&gt; Add New -&gt; Upload in your administration area.
1. Click the "Browse" (or "Choose File") button and find the ZIP file you downloaded.
1. Click the "Upload" button.
1. Go to the Plugins dashboard and "Activate" the plugin (for MultiSite users, you can safely "Network Activate" this plugin).

**FTP Installation**

1. Download the ZIP file from the WordPress plugin repository.
1. Unzip the file somewhere on your harddrive.
1. FTP into your Web server and navigate to the /wp-content/plugins directory.
1. Upload the social-icons-widget folder and all of its contents into your plugins directory.
1. Go to the Plugins dashboard and "Activate" the plugin (for MultiSite users, you can safely "Network Activate" this plugin).

= Must-Use Installation =

If you would like to **force** this plugin to be active (generally only useful for Multi Site installations) without an option to deactivate it, you can upload the social-icons-widget.php file to your /wp-content/mu-plugins folder. If that folder does not exist, you can safely create it. Make sure **not** to upload the social-icons-widget *folder* into your mu-plugins directory, as "Must Use" plugins must reside in the root mu-plugins directory in order to work.

== Frequently Asked Questions ==

= How do I add/remove services from the list? =

This plugin runs the array of services through a filter called `social-icons-services` before using that array. The list of services is an associative array using a string that's usable as a CSS class for the key and the proper name of the service as the value. You can remove services by unsetting them from the passed array or add services by simply appending them to the array.

The entire array is sorted in alphabetical order according to the name of the service.

The default array used by the plugin is:
`
array( 
	'twitter' 	=> __( 'Twitter' ), 
	'facebook' 	=> __( 'Facebook' ), 
	'youtube'	=> __( 'YouTube' ), 
	'linkedin'	=> __( 'LinkedIn' ), 
	'google'	=> __( 'Google+' ), 
	'friendfeed'	=> __( 'FriendFeed' ), 
	'flickr'	=> __( 'Flickr' ), 
);
`

The widget control inputs require the values entered to be URLs, so you should not try to add list items that are supposed to accept input other than valid URLs.

= How do I change the HTML output of the widget? =

There are four separate hooks used to filter the HTML output of the widget. They are as follows:

* `social-icons-before-list` - The HTML code that should be output to open the list (`<ul class="social-icons-list">` by default)
* `social-icons-after-list` - The HTML code used to close the list (`</ul>` by default)
* `social-icons-before-item` - The HTML code used to open each list item. This code is printed using the `printf()` method to inject the appropriate service key as the class. Therefore, you should use `%s` in the code to indicate where the service key should be printed. The default code is `<li class="%s">`
* `social-icons-after-item` - The HTML code used to close the list item (`</li>` by default)

= How do I style the links? =

The widget should be assigned a class of 'social-icons'. By default, the list itself will have a CSS class of 'social-icons-list', so you can apply any CSS styles you desire to that class. In addition, as mentioned above, each list item is assigned its own CSS class, consistent with the array key assigned to that item. The default CSS classes that will be used by the plugin are (the proper names of the services are shown in parentheses):

* twitter (Twitter)
* facebook (Facebook)
* youtube (YouTube)
* linkedin (LinkedIn)
* google (Google+)
* friendfeed (FriendFeed)
* flickr (Flickr)

With those classes, you could do something like the following to hide the text of the links and replace that text with the appropriate icons (not included):
`
.social-icons {
	position: absolute;
	bottom: 12px;
	left: 58px;
	width: 124px;
	height: 32px;
	margin: 0 auto;
}

.social-icons li {
	display: inline;
}

.social-icons li a {
	display: block;
	float: left;
	width: 0;
	height: 0;
	padding: 32px 32px 0 0;
	margin: 0 0 0 14px;
	font-size: 0;
	line-height: 0;
	overflow: hidden;
	background: url(images/social-icons.png);
}

.social-icons li.linkedin a {
	background-position: -46px 0;
}

.social-icons li.twitter a {
	background-position: -91px 0;
}

.social-icons li:first-child a {
	margin-left: 0;
}
`

= Where can I find icons to use with this widget? =
I found [an older blog post](http://webdesignledger.com/freebies/the-best-social-media-icons-all-in-one-place) with some links to a bunch of resources for free sets of social media icons. You can check it out and see if any of the examples shown there strike your fancy. _I am not affiliated in any way with that blog or the author of the post._

== Changelog ==

= 0.1 =
* This is the first version of this plugin, so there haven't been any changes yet.
