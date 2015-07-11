<?php 

class WonderPlugin_Lightbox_View {

	private $controller;
	
	function __construct($controller) {
		
		$this->controller = $controller;
	}
	
	function add_metaboxes() {
		add_meta_box('overview_features', __('WonderPlugin Lightbox Features', 'wonderplugin_lightbox'), array($this, 'show_features'), 'wonderplugin_lightbox_overview', 'features', '');
		add_meta_box('overview_upgrade', __('Upgrade to Commercial Version', 'wonderplugin_lightbox'), array($this, 'show_upgrade_to_commercial'), 'wonderplugin_lightbox_overview', 'upgrade', '');
		add_meta_box('overview_news', __('WonderPlugin News', 'wonderplugin_lightbox'), array($this, 'show_news'), 'wonderplugin_lightbox_overview', 'news', '');
		add_meta_box('overview_contact', __('Contact Us', 'wonderplugin_lightbox'), array($this, 'show_contact'), 'wonderplugin_lightbox_overview', 'contact', '');
		add_meta_box('overview_license', __('Credits', 'wonderplugin_lightbox'), array($this, 'show_license'), 'wonderplugin_lightbox_overview', 'license', '');
	}
	
	function show_upgrade_to_commercial() {
		?>
		<ul class="wonderplugin-feature-list">
			<li>Use on commercial websites</li>
			<li>Remove the wonderplugin.com watermark</li>
			<li>Priority techincal support</li>
			<li><a href="http://www.wonderplugin.com/order/?product=lightbox" target="_blank">Upgrade to Commercial Version</a></li>
		</ul>
		<?php
	}
	
	function show_news() {
		
		include_once( ABSPATH . WPINC . '/feed.php' );
		
		$rss = fetch_feed( 'http://www.wonderplugin.com/feed/' );
		
		$maxitems = 0;
		if ( ! is_wp_error( $rss ) )
		{
			$maxitems = $rss->get_item_quantity( 5 );
			$rss_items = $rss->get_items( 0, $maxitems );
		}
		?>
		
		<ul class="wonderplugin-feature-list">
		    <?php if ( $maxitems > 0 ) {
		        foreach ( $rss_items as $item )
		        {
		        	?>
		        	<li>
		                <a href="<?php echo esc_url( $item->get_permalink() ); ?>" target="_blank" 
		                    title="<?php printf( __( 'Posted %s', 'wonderplugin_lightbox' ), $item->get_date('j F Y | g:i a') ); ?>">
		                    <?php echo esc_html( $item->get_title() ); ?>
		                </a>
		                <p><?php echo $item->get_description(); ?></p>
		            </li>
		        	<?php 
		        }
		    } ?>
		</ul>
		<?php
	}
	
	function show_features() {
		?>
		<ul class="wonderplugin-feature-list">
			<li>Works on mobile, tablets and all major web browsers, including iPhone, iPad, Android, Firefox, Safari, Chrome, Opera and Internet Explorer 7/8/9/10/11</li>
			<li>Support images, Flash SWF files, webpage, YouTube, Vimeo, mp4, webm and flv videos</li>
			<li>Support Lightbox gallery with thumbnail navigation</li>
			<li>Fully responsive</li>
			<li>Easy to use</li>
		</ul>
		<?php
	}
	
	function show_contact() {
		?>
		<p>Technical support is available for Commercial Version users at support@wonderplugin.com. Please include your license information, WordPress version, link to your webpage, all related error messages in your email.</p> 
		<?php
	}

	function show_license() {
		?>
		<p><a target="_blank" href="http://www.bigbuckbunny.org">Big Buck Bunny</a>, Copyright Blender Foundation, <a target="_blank" href="http://creativecommons.org/licenses/by/3.0/">Creative Commons Attribution 3.0</a></p> 
		<p><a target="_blank" href="http://www.publicdomainpictures.net/view-image.php?image=6480&#038;picture=tulip-background">Tulip Background</a> by Petr Kratochvil, <a target="_blank" href="http://creativecommons.org/publicdomain/zero/1.0/">Public Domain License</a></p>
		<p><a target="_blank" href="http://www.publicdomainpictures.net/view-image.php?image=7277&#038;picture=swan-on-lake">Swan On Lake</a> by Vera Kratochvil, <a target="_blank" href="http://creativecommons.org/publicdomain/zero/1.0/">Public Domain License</a></p>
		<p><a target="_blank" href="http://www.publicdomainpictures.net/view-image.php?image=7982&picture=colorful-tulips-and-blue-sky">Colorful Tulips And Blue Sky</a> by Vera Kratochvil, <a target="_blank" href="http://creativecommons.org/publicdomain/zero/1.0/">Public Domain License</a></p>
		<?php
	}
		
	function print_overview() {
		
		?>
		<div class="wrap">
		<div id="icon-wonderplugin-lightbox" class="icon32"><br /></div>
		
		<?php $this->controller->print_lightbox_options(); ?>
		<h2><?php echo __( 'WonderPlugin Lightbox', 'wonderplugin_lightbox' ) . ( (WONDERPLUGIN_LIGHTBOX_VERSION_TYPE == "C") ? " Commercial Version" : " Free Version") . " " . WONDERPLUGIN_LIGHTBOX_VERSION; ?> </h2>
		 
		<div id="welcome-panel" class="welcome-panel">
			<div class="welcome-panel-content">
				<h3>WordPress Image and Video Lightbox Plugin</h3>
				<div class="welcome-panel-column-container">
					<div class="welcome-panel-column">
						<h4>Get Started</h4>
						<a class="button button-primary button-hero" href="<?php echo admin_url('admin.php?page=wonderplugin_lightbox_show_quick_start'); ?>">Quick Start</a>
					</div>
					<div class="welcome-panel-column welcome-panel-last">
						<h4>More Actions</h4>
						<ul>
							<li><a href="<?php echo admin_url('admin.php?page=wonderplugin_lightbox_show_options'); ?>" class="welcome-icon welcome-widgets-menus">Lightbox Options</a></li>
							<?php  if (WONDERPLUGIN_LIGHTBOX_VERSION_TYPE !== "C") { ?>
							<li><a href="http://www.wonderplugin.com/order/?product=lightbox" target="_blank" class="welcome-icon welcome-view-site">Upgrade to Commercial Version</a></li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		<div id="dashboard-widgets-wrap">
			<div id="dashboard-widgets" class="metabox-holder columns-2">
	 
	                 <div id="postbox-container-1" class="postbox-container">
	                    <?php 
	                    do_meta_boxes( 'wonderplugin_lightbox_overview', 'features', '' ); 
	                    do_meta_boxes( 'wonderplugin_lightbox_overview', 'contact', '' ); 
	                    do_meta_boxes( 'wonderplugin_lightbox_overview', 'license', '' );
	                    ?>
	                </div>
	 
	                <div id="postbox-container-2" class="postbox-container">
	                    <?php 
	                    if (WONDERPLUGIN_LIGHTBOX_VERSION_TYPE != "C")
	                    	do_meta_boxes( 'wonderplugin_lightbox_overview', 'upgrade', ''); 
	                    do_meta_boxes( 'wonderplugin_lightbox_overview', 'news', ''); 
	                    ?>
	                </div>
	 
	        </div>
        </div>
            
		<?php
	}
	
	function print_options() {
		
		?>
		<div class="wrap">
		<div id="icon-wonderplugin-lightbox" class="icon32"><br /></div>
			
		<?php $this->controller->print_lightbox_options(); ?>
		<h2><?php _e( 'Lightbox Options', 'wonderplugin_lightbox' ); ?> <a href="<?php echo admin_url('admin.php?page=wonderplugin_lightbox_show_quick_start'); ?>" class="add-new-h2"> <?php _e( 'Quick Start', 'wonderplugin_lightbox' ); ?>  </a></h2>
		
		<?php
		if (isset($_POST['save-lightbox-options']))
		{
			unset($_POST['save-lightbox-options']);
			$this->controller->save_options($_POST);
			echo '<div class="updated"><p>Lightbox options saved.</p></div>';
		}
		
		$lightbox_options = $this->controller->read_options();
		
		?>
        <form method="post">
        
        <table class="form-table">
        
        <tr valign="top">
			<th scope="row">Responsive</th>
			<td><label for="responsive"><input name="responsive" type="checkbox" id="responsive" value="1" <?php echo $lightbox_options['responsive'] ? "checked": ""; ?> /> Support responsive</label></td>
		</tr>
		
		<tr valign="top">
			<th scope="row">Video</th>
			<td><label for="autoplay"><input name="autoplay" type="checkbox" id="autoplay" value="1" <?php echo $lightbox_options['autoplay'] ? "checked": ""; ?>  /> Automatically play video (Only works on desktop, does not work on mobile and tablets)</label>
			<br /><label for="html5player"><input name="html5player" type="checkbox" id="html5player" value="1" <?php echo $lightbox_options['html5player'] ? "checked": ""; ?>  /> Use HTML5 player by default</label></td>
		</tr>
		
		<tr valign="top">
			<th scope="row">Default volume of MP4/WebM videos</th>
			<td><label><input name="defaultvideovolume" type="number" step="any" id="defaultvideovolume" value="<?php echo $lightbox_options['defaultvideovolume']; ?>" class="small-text" /> (0 - 1)</label></td>
		</tr>
		
		<tr valign="top">
			<th scope="row">Overlay color</th>
			<td><input name="overlaybgcolor" type="text" id="overlaybgcolor" value="<?php echo $lightbox_options['overlaybgcolor']; ?>" class="regular-text" /></td>
		</tr>
		
		<tr valign="top">
			<th scope="row">Overlay opacity</th>
			<td><input name="overlayopacity" type="text" id="overlayopacity" value="<?php echo $lightbox_options['overlayopacity']; ?>" class="small-text" /></td>
		</tr>
		
		<tr valign="top">
			<th scope="row">Background color</th>
			<td><input name="bgcolor" type="text" id="bgcolor" value="<?php echo $lightbox_options['bgcolor']; ?>" class="regular-text" /></td>
		</tr>
		
		<tr valign="top">
			<th scope="row">Border radius</th>
			<td><input name="borderradius" type="text" id="borderradius" value="<?php echo $lightbox_options['borderradius']; ?>" class="small-text" /></td>
		</tr>
		
		<tr valign="top">
			<th scope="row">Maximum text bar height</th>
			<td><input name="barheight" type="text" id="barheight" value="<?php echo $lightbox_options['barheight']; ?>" class="small-text" /></td>
		</tr>
		
		<tr valign="top">
			<th scope="row">Title</th>
			<td><label for="showtitle"><input name="showtitle" type="checkbox" id="showtitle" value="1" <?php echo $lightbox_options['showtitle'] ? "checked": ""; ?> /> Show title</label></td>
		</tr>
		
		<tr valign="top">
			<th scope="row">Title CSS</th>
			<td><textarea name="titlebottomcss" id="titlebottomcss" rows="2" class="large-text code"><?php echo $lightbox_options['titlebottomcss']; ?></textarea></td>
		</tr>
		
		<tr valign="top">
			<th scope="row">Description</th>
			<td><label for="showdescription"><input name="showdescription" type="checkbox" id="showdescription" value="1" <?php echo $lightbox_options['showdescription'] ? "checked": ""; ?> /> Show description</label></td>
		</tr>
		
		<tr valign="top">
			<th scope="row">Description CSS</th>
			<td><textarea name="descriptionbottomcss" id="descriptionbottomcss" rows="2" class="large-text code"><?php echo $lightbox_options['descriptionbottomcss']; ?></textarea></td>
		</tr>
		
		<tr valign="top">
			<th scope="row">Thumbnail size</th>
			<td><input name="thumbwidth" type="text" id="thumbwidth" value="<?php echo $lightbox_options['thumbwidth']; ?>" class="small-text" /> by <input name="thumbheight" type="text" id="thumbheight" value="<?php echo $lightbox_options['thumbheight']; ?>" class="small-text" /></td>
		</tr>

		<tr valign="top">
			<th scope="row">Thumbnail top margin</th>
			<td><input name="thumbtopmargin" type="text" id="thumbtopmargin" value="<?php echo $lightbox_options['thumbtopmargin']; ?>" class="small-text" /></td>
		</tr>
		
		<tr valign="top">
			<th scope="row">Thumbnail bottom margin</th>
			<td><input name="thumbbottommargin" type="text" id="thumbbottommargin" value="<?php echo $lightbox_options['thumbbottommargin']; ?>" class="small-text" /></td>
		</tr>	
		
		<tr valign="top">
			<th>Advanced Options</th>
			<td><textarea name='advancedoptions' id='advancedoptions' value='' class='large-text' rows="5"><?php echo $lightbox_options['advancedoptions']; ?></textarea></td>
		</tr>	
        </table>
        
        <p class="submit"><input type="submit" name="save-lightbox-options" id="save-lightbox-options" class="button button-primary" value="Save Changes"  /></p>
        
        </form>
        
		</div>
		<?php
	}

	function print_quick_start() {

		?>
		<div class="wrap">
		<div id="icon-wonderplugin-lightbox" class="icon32"><br /></div>
		
		<?php $this->controller->print_lightbox_options(); ?>
		<h2><?php _e( 'Quick Start', 'wonderplugin_lightbox' ); ?> <a href="<?php echo admin_url('admin.php?page=wonderplugin_lightbox_show_options'); ?>" class="add-new-h2"> <?php _e( 'Lightbox Options', 'wonderplugin_lightbox' ); ?>  </a> </h2>
		<p>Add a <code>class="wplightbox"</code> attribute to any link to activate the Lightbox effect. </p>
		<p>To show a caption, use attribute <code>title</code>. To define the size of the Lightbox popup, use attribute <code>data-width</code> and <code>data-height</code>.</p>
		
		<h2>Image Lightbox</h2>
		<p>Live demo: <a href="<?php echo WONDERPLUGIN_LIGHTBOX_URL; ?>images/demo-image0.jpg" class="wplightbox" title="WonderPlugin Image Lightbox">Image Lightbox</a></p>
		<p>Demo code:</p>
		<div class="code">&lt;a href=&quot;<?php echo WONDERPLUGIN_LIGHTBOX_URL; ?>images/demo-image0.jpg&quot; <span>class=&quot;wplightbox&quot;</span> title=&quot;WonderPlugin Image Lightbox&quot;&gt;Image Lightbox&lt;/a&gt;</div>
		
		<h2>YouTube Lightbox</h2>
		<p>Live demo: <a href="http://www.youtube.com/embed/YE7VzlLtp-4" class="wplightbox" title="Big Buck Bunny Copyright Blender Foundation" data-width="640" data-height="360">YouTube Lightbox</a></p>
		<p>Demo code:</p>
		<div class="code">&lt;a href=&quot;http://www.youtube.com/embed/YE7VzlLtp-4&quot; <span>class=&quot;wplightbox&quot;</span> title=&quot;Big Buck Bunny Copyright Blender Foundation&quot; <span>data-width=&quot;640&quot;</span> <span>data-height=&quot;360&quot;</span>&gt;YouTube Lightbox&lt;/a&gt;</div>
		
		<h2>Vimeo Lightbox</h2>
		<p>Live demo: <a href="http://player.vimeo.com/video/1084537" class="wplightbox" title="Big Buck Bunny Copyright Blender Foundation">Vimeo Lightbox</a></p>
		<p>Demo code:</p>
		<div class="code">&lt;a href=&quot;http://player.vimeo.com/video/1084537&quot; <span>class=&quot;wplightbox&quot;</span> title=&quot;Big Buck Bunny Copyright Blender Foundation&quot;&gt;Vimeo Lightbox&lt;/a&gt;</div>
		
		<h2>MP4/WebM video Lightbox</h2>
		<p>To play your video in Lightbox, you only need to provide one MP4 format.</p>
		<p>On iPhone, iPad, Android, Chrome, Safari, Internet Explorer 10 and above, the plugin will use HTML5 to play the MP4 video. On legacy web browsers Internet Explorer 7/8/9, the plugin will use Flash to play the MP4 video.</p>
		<p>You can also use <code>data-webm</code> to add a video for Firefox and Opera HTML5 player. Providing a WebM format is optional. If the WebM video is not provided, the plugin will use Flash to play MP4 on Firefox and Opera.</p>
		<p>The provided MP4 and WebM videos must be HTML5 compatible. Please visit the link for <a href="http://www.wonderplugin.com/wordpress-tutorials/how-to-convert-video-to-html5-compatible/" target="_blank">how to convert vidoe to HTML5 compabitle</a>.</p>
		<p>Live demo: <a href="<?php echo WONDERPLUGIN_LIGHTBOX_URL; ?>images/demo-video0.mp4" data-webm="<?php echo WONDERPLUGIN_LIGHTBOX_URL; ?>images/demo-video0.webm" class="wplightbox" title="Big Buck Bunny Copyright Blender Foundation">Video Lightbox</a></p>
		<p>Demo code:</p>
		<div class="code">&lt;a href=&quot;<?php echo WONDERPLUGIN_LIGHTBOX_URL; ?>images/demo-video0.mp4&quot; data-webm=&quot;<?php echo WONDERPLUGIN_LIGHTBOX_URL; ?>images/demo-video0.webm&quot; <span>class=&quot;wplightbox&quot;</span> title=&quot;Big Buck Bunny Copyright Blender Foundation&quot;&gt;Video Lightbox&lt;/a&gt;</div>
		
		<h2>Image & video Lightbox gallery with thumbnail navigation</h2>
		<p>To create a gallery of images and videos, you can add a attribute <code>data-group</code> to the related links. You can use any string as the group name, as long as all of the links in one gallery has same value.</p>
		<p>You can use <code>data-thumbnail</code> to add thumbnail navigation to the gallery.</p>
		<p>Live demo</p>
		<p>
		<a href="<?php echo WONDERPLUGIN_LIGHTBOX_URL; ?>images/demo-image1.jpg" class="wplightbox" data-group="gallery0" data-thumbnail="<?php echo WONDERPLUGIN_LIGHTBOX_URL; ?>images/demo-image1-tn.jpg" title="Image"><img src="<?php echo WONDERPLUGIN_LIGHTBOX_URL; ?>images/demo-image1-tn.jpg" /></a>
		<a href="http://www.youtube.com/embed/YE7VzlLtp-4?rel=0&vq=hd1080" class="wplightbox" data-group="gallery0" data-thumbnail="<?php echo WONDERPLUGIN_LIGHTBOX_URL; ?>images/demo-youtube-tn.jpg" title="YouTube"><img src="<?php echo WONDERPLUGIN_LIGHTBOX_URL; ?>images/demo-youtube-tn.jpg" /></a>
		<a href="http://player.vimeo.com/video/1084537?title=0&byline=0&portrait=0" class="wplightbox" data-group="gallery0" data-thumbnail="<?php echo WONDERPLUGIN_LIGHTBOX_URL; ?>images/demo-vimeo-tn.jpg" title="Vimeo"><img src="<?php echo WONDERPLUGIN_LIGHTBOX_URL; ?>images/demo-vimeo-tn.jpg" /></a>
		<a href="<?php echo WONDERPLUGIN_LIGHTBOX_URL; ?>images/demo-video1.mp4" data-webm="<?php echo WONDERPLUGIN_LIGHTBOX_URL; ?>images/demo-video1.webm" class="wplightbox" data-group="gallery0" data-thumbnail="<?php echo WONDERPLUGIN_LIGHTBOX_URL; ?>images/demo-video-tn.jpg" title="Video"><img src="<?php echo WONDERPLUGIN_LIGHTBOX_URL; ?>images/demo-video-tn.jpg" /></a>
		</p>
		<p>Demo code:</p>
		<div class="code">
		&lt;a href=&quot;<?php echo WONDERPLUGIN_LIGHTBOX_URL; ?>images/demo-image1.jpg&quot; <span>class=&quot;wplightbox&quot;</span> <span>data-group=&quot;gallery0&quot;</span> <span>data-thumbnail=&quot;<?php echo WONDERPLUGIN_LIGHTBOX_URL; ?>images/demo-image1-tn.jpg&quot;</span> title=&quot;Image&quot;&gt;Image&lt;/a&gt;
		<br /><br />&lt;a href=&quot;http://www.youtube.com/embed/YE7VzlLtp-4?rel=0&amp;vq=hd1080&quot; <span>class=&quot;wplightbox&quot;</span> <span>data-group=&quot;gallery0&quot;</span> <span>data-thumbnail=&quot;<?php echo WONDERPLUGIN_LIGHTBOX_URL; ?>images/demo-youtube-tn.jpg&quot;</span> title=&quot;YouTube&quot;&gt;YouTube&lt;/a&gt;
		<br /><br />&lt;a href=&quot;http://player.vimeo.com/video/1084537?title=0&amp;byline=0&amp;portrait=0&quot; <span>class=&quot;wplightbox&quot;</span> <span>data-group=&quot;gallery0&quot;</span> <span>data-thumbnail=&quot;<?php echo WONDERPLUGIN_LIGHTBOX_URL; ?>images/demo-vimeo-tn.jpg&quot;</span> title=&quot;Vimeo&quot;&gt;Vimeo&lt;/a&gt;
		<br /><br />&lt;a href=&quot;<?php echo WONDERPLUGIN_LIGHTBOX_URL; ?>images/demo-video1.mp4&quot; data-webm=&quot;<?php echo WONDERPLUGIN_LIGHTBOX_URL; ?>images/demo-video1.webm&quot; <span>class=&quot;wplightbox&quot;</span> <span>data-group=&quot;gallery0&quot;</span> <span>data-thumbnail=&quot;<?php echo WONDERPLUGIN_LIGHTBOX_URL; ?>images/demo-video-tn.jpg&quot;</span> title=&quot;Video&quot;&gt;Video&lt;/a&gt;
		</div>
		
		<h2>Show title and description in Lightbox</h2>
		<p>To show a title, use attribute <code>title</code>.</p>
		<p>To show a description, you need to enable the option <code>Show description</code> in the Lightbox Options page, then add data tag <code>data-description</code> to your link.</p>
		<p>Live demo: <a href="<?php echo WONDERPLUGIN_LIGHTBOX_URL; ?>images/demo-image2.jpg" class="wplightbox" title="You can display a title." data-description="You can also display a description." >Lightbox with title and description</a></p>
		<p>Demo code:</p>
		<div class="code">&lt;a href=&quot;<?php echo WONDERPLUGIN_LIGHTBOX_URL; ?>images/demo-image2.jpg&quot; <span>class=&quot;wplightbox&quot;</span> title=&quot;You can display a title.&quot; data-description=&quot;You can also display a description.&quot; &gt;Image Lightbox&lt;/a&gt;</div>
		
		<h2>Open a div in Lightbox</h2>
		
		<p>To open a div in the lightbox, firstly, define a div with an ID in your webpage. You can add CSS style <code>display:none;</code> to make it invisible on the page.</p>
		<p>Demo code:</p>
		<div class="code">
		&lt;div id=&quot;mydiv&quot; style=&quot;display:none;&quot;&gt;<br />
		&nbsp;&nbsp;&lt;div style=&quot;width:100%;height:100%;text-align:left;&quot;&gt;<br /><br />
		&nbsp;&nbsp;&nbsp;&nbsp;&lt;div style=&quot;float:left;width:40%;height:100%;&quot;&gt;<br />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;div style=&quot;margin:12px;&quot;&gt;<br />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;h2&gt;WonderPlugin Gallery&lt;/h2&gt;<br />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;p&gt;WonderPlugin Gallery is a WordPress photo and video gallery plugin, and a great way to showcase your images and videos online. The plugin supports images, YouTube, Vimeo, Dailymotion, mp4 and webm videos. It's fully responsive, works on iPhone, iPad, Android, Firefox, Chrome, Safari, Opera and Internet Explorer 7/8/9/10/11.&lt;/p&gt;<br />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/div&gt;<br />
		&nbsp;&nbsp;&nbsp;&nbsp;&lt;/div&gt;<br /><br />
		&nbsp;&nbsp;&nbsp;&nbsp;&lt;div style=&quot;float:left;width:60%;height:100%;&quot;&gt;<br />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;iframe width=&quot;100%&quot; height=&quot;100%&quot; src=&quot;https://www.youtube.com/embed/wswxQ3mhwqQ&quot; frameborder=&quot;0&quot; allowfullscreen&gt;&lt;/iframe&gt;<br />
		&nbsp;&nbsp;&nbsp;&nbsp;&lt;/div&gt;<br /><br />
		&nbsp;&nbsp;&nbsp;&nbsp;&lt;div style=&quot;clear:both;&quot;&gt;&lt;/div&gt;<br />
		&nbsp;&nbsp;&lt;/div&gt;<br />
		&lt;/div&gt;
		</div>
		<p>You can then use <code>#DIVID</code> as the href value of the lightbox link.</p>
		<p>Demo code:</p>
		<div class="code">
		&lt;a href=&quot;#mydiv&quot; class=&quot;wplightbox&quot; data-width=800 data-height=388 title=&quot;Inline Div&quot;&gt;Open a Div in Lightbox&lt;/a&gt;
		</div>
		
		<div id="mydiv" style="display:none;">
		  <div style="width:100%;height:100%;text-align:left;">
		
		    <div style="float:left;width:40%;height:100%;">
		      <div style="margin:36px;">
		        <p style="font-size:16px;font-weight:bold;margin:12px 0px;">WonderPlugin Gallery</p>
				<p style="font-size:14px;line-height:20px;">WonderPlugin Gallery is a WordPress photo and video gallery plugin, and a great way to showcase your images and videos online. The plugin supports images, YouTube, Vimeo, Dailymotion, mp4 and webm videos. It's fully responsive, works on iPhone, iPad, Android, Firefox, Chrome, Safari, Opera and Internet Explorer 7/8/9/10/11.</p>
		      </div>
		    </div>
		
		    <div style="float:left;width:60%;height:100%;">
		      <iframe width="100%" height="100%" src="https://www.youtube.com/embed/wswxQ3mhwqQ" frameborder="0" allowfullscreen></iframe>
		    </div>
		
		    <div style="clear:both;"></div>
		  </div>
		</div>

		<p>Live demo: <a href="#mydiv" class="wplightbox" data-width=800 data-height=300 >Open a Div in Lightbox</a></p>
		<?php 
	}
	
	function print_edit_settings() {
		?>
		<div class="wrap">
		<div id="icon-wonderplugin-lightbox" class="icon32"><br /></div>
			
		<h2><?php _e( 'Settings', 'wonderplugin_lightbox' ); ?> </h2>
		<?php

		if ( isset($_POST['save-lightbox-options']))
		{		
			unset($_POST['save-lightbox-options']);
			
			$this->controller->save_settings($_POST);
			
			echo '<div class="updated"><p>Settings saved.</p></div>';
		}
								
		$settings = $this->controller->get_settings();
		$disableupdate = $settings['disableupdate'];
		$addjstofooter = $settings['addjstofooter'];
		
		?>
				
        <form method="post">
        
        <table class="form-table">
		
		<tr>
			<th>Update option</th>
			<td><label><input name='disableupdate' type='checkbox' id='disableupdate' <?php echo ($disableupdate == 1) ? 'checked' : ''; ?> /> Disable plugin version check and update</label>
			</td>
		</tr>
		
		<tr>
			<th>Scripts position</th>
			<td><label><input name='addjstofooter' type='checkbox' id='addjstofooter' <?php echo ($addjstofooter == 1) ? 'checked' : ''; ?> /> Add lightbox js scripts to the footer</label>
			</td>
		</tr>
		
        </table>
        
        <p class="submit"><input type="submit" name="save-lightbox-options" id="save-lightbox-options" class="button button-primary" value="Save Changes"  /></p>
        
        </form>
        
		</div>
		<?php
	}
		
	function print_register() {
		?>
		<div class="wrap">
		<div id="icon-wonderplugin-lightbox" class="icon32"><br /></div>
			
		<h2><?php _e( 'Register', 'wonderplugin_lightbox' ); ?></h2>
		<?php
				
		if (isset($_POST['save-lightbox-license']))
		{		
			unset($_POST['save-lightbox-license']);

			$ret = $this->controller->check_license($_POST);
			
			if ($ret['status'] == 'valid')
				echo '<div class="updated"><p>The key has been saved.</p></div>';
			else if ($ret['status'] == 'expired')
				echo '<div class="error"><p>Your free upgrade period has expired, please renew your license.</p></div>';
			else if ($ret['status'] == 'invalid')
				echo '<div class="error"><p>The key is invalid.</p></div>';
			else if ($ret['status'] == 'abnormal')
				echo '<div class="error"><p>There is abnormal usage with your license key, please contact support@wonderplugin.com for more information.</p></div>';
			else if ($ret['status'] == 'timeout')
				echo '<div class="error"><p>The license server can not be reached, please try again later.</p></div>';
			else if ($ret['status'] == 'empty')
				echo '<div class="error"><p>Please enter your license key.</p></div>';
		}
		else if (isset($_POST['deregister-lightbox-license']))
		{	
			$ret = $this->controller->deregister_license($_POST);
			
			if ($ret['status'] == 'success')
				echo '<div class="updated"><p>The key has been deregistered.</p></div>';
			else if ($ret['status'] == 'timeout')
				echo '<div class="error"><p>The license server can not be reached, please try again later.</p></div>';
			else if ($ret['status'] == 'empty')
				echo '<div class="error"><p>The license key is empty.</p></div>';
		}
		
		$settings = $this->controller->get_settings();
		$disableupdate = $settings['disableupdate'];
		
		$key = '';
		$info = $this->controller->get_plugin_info();
		if (!empty($info->key) && ($info->key_status == 'valid' || $info->key_status == 'expired'))
			$key = $info->key;
		
		?>
		
		<?php 
		if ($disableupdate == 1)
		{
			echo "<h3 style='padding-left:10px;'>The plugin version check and update is currently disabled. You can enable it in the Settings menu.</h3>";
		}
		else
		{
			if (empty($key)) { ?>
				<form method="post">
				<table class="form-table">
				<tr>
					<th>Enter Your License Key:</th>
					<td><input name="wonderplugin-lightbox-key" type="text" id="wonderplugin-lightbox-key" value="" class="regular-text" /> <input type="submit" name="save-lightbox-license" id="save-lightbox-license" class="button button-primary" value="Register License Key"  />
					</td>
				</tr>
				</table>
				</form>
			<?php } else { ?>
				<form method="post">
				<table class="form-table">
				<tr>
					<th>Your License Key is:</th>
					<td><?php echo $key; ?> &nbsp;&nbsp;&nbsp;&nbsp;<input name="wonderplugin-lightbox-key" type="hidden" id="wonderplugin-lightbox-key" value="<?php echo $key; ?>" class="regular-text" /><input type="submit" name="deregister-lightbox-license" id="deregister-lightbox-license" class="button button-primary" value="Deregister the License Key"  /></label></td>
				</tr>
				</table>
				</form>
				
				<form method="post">
				<table class="form-table">
				<?php if ($info->key_status == 'valid') { ?>
				<tr>
					<th></th>
					<td>
					<p><strong>Your license key is valid.</strong> The key has been successfully registered with this domain.</p></td>
				</tr>
				<?php } else if ($info->key_status == 'expired') { ?>
				<tr>
					<th></th>
					<td>
					<p><strong>Your free upgrade period has expired.</strong> To get upgrades, please <a href="https://www.wonderplugin.com/renew/" target="_blank">renew your license</a>.</p>
				</tr>
				<?php } ?>
				</table>
				</form>
			<?php } ?>

		<?php } ?>
		
		<div style="padding-left:10px;padding-top:30px;">
		<a href="<?php echo admin_url('update-core.php?force-check=1'); ?>"><button class="button-primary">Force WordPress To Check For Plugin Updates</button></a>
		</div>
					
		<div style="padding-left:10px;padding-top:20px;">
        <h3><a href="https://www.wonderplugin.com/register-faq/" target="_blank">Frequently Asked Questions</a></h3>
        </div>
        
		</div>
		
		<?php
	}
}