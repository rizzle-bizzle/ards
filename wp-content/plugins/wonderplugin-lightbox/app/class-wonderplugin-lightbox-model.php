<?php 

require_once 'wonderplugin-lightbox-functions.php';

class WonderPlugin_Lightbox_Model {

	private $controller;
	
	function __construct($controller) {
		
		$this->controller = $controller;
	}
	
	function get_upload_path() {
		
		$uploads = wp_upload_dir();
		return $uploads['basedir'] . '/wonderplugin-lightbox/';
	}
	
	function get_upload_url() {
	
		$uploads = wp_upload_dir();
		return $uploads['baseurl'] . '/wonderplugin-lightbox/';
	}
		
	function save_options($options) {
	
		$options['responsive'] = isset($options['responsive']) ? true : false;
		$options['autoplay'] = isset($options['autoplay']) ? true : false;
		$options['html5player'] = isset($options['html5player']) ? true : false;
		$options['showtitle'] = isset($options['showtitle']) ? true : false;
		$options['defaultvideovolume'] = floatval(trim($options['defaultvideovolume']));
		
		$options['overlaybgcolor'] = trim($options['overlaybgcolor']);
		$options['overlayopacity'] = floatval(trim($options['overlayopacity']));
		$options['bgcolor'] = trim($options['bgcolor']);
		$options['borderradius'] = intval(trim($options['borderradius']));
		
		$options['thumbwidth'] = intval(trim($options['thumbwidth']));
		$options['thumbheight'] = intval(trim($options['thumbheight']));
		$options['thumbtopmargin'] = intval(trim($options['thumbtopmargin']));
		$options['thumbbottommargin'] = intval(trim($options['thumbbottommargin']));
		
		$options['barheight'] = intval(trim($options['barheight']));
		$options['titlebottomcss'] = trim($options['titlebottomcss']);
		
		$options['showdescription'] = isset($options['showdescription']) ? true : false;
		$options['descriptionbottomcss'] = trim($options['descriptionbottomcss']);
		
		$options['advancedoptions'] = trim($options['advancedoptions']);
		
		update_option( "wonderplugin-lightbox-options", json_encode($options) );
	}
	
	function read_options() {

		$default = array(
				'responsive' => true,
				'autoplay' => true,
				'html5player' => true,
				'overlaybgcolor' => '#000',
				'overlayopacity' => 0.8,
				'defaultvideovolume' => 1,
				'bgcolor' => '#FFF',
				'borderradius' => 0,
				'thumbwidth' => 96,
				'thumbheight' => 72,
				'thumbtopmargin' => 12,
				'thumbbottommargin' => 12,
				'barheight' => 48,
				'showtitle' => true,
				'titlebottomcss' => '{color:#333; font-size:14px; font-family:Armata,sans-serif,Arial; overflow:hidden; text-align:left;}',
				'showdescription' => true,
				'descriptionbottomcss' => '{color:#333; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:left; margin:4px 0px 0px; padding: 0px;}',
				'advancedoptions' => ''
			);
		
		$options = json_decode(get_option("wonderplugin-lightbox-options"), true);
		
		if (isset($options['advancedoptions']) && strlen($options['advancedoptions']) > 0)
		{
			$options['advancedoptions'] = stripslashes($options['advancedoptions']);
		}
		
		if( is_array($options) )
			return array_merge($default, $options);
		else
			return $default;
		
	}
	
	function print_lightbox_options() {
		
		$options = $this->read_options();
		
		$optionsdiv = '<div id="wonderpluginlightbox_options" data-skinsfoldername="skins/default/"  data-jsfolder="' . WONDERPLUGIN_LIGHTBOX_URL . 'engine/"';
		
		if (isset($options['advancedoptions']) && strlen($options['advancedoptions']) > 0)
		{
			$advancedoptions = str_replace("\r", " ", $options['advancedoptions']);
			$advancedoptions = str_replace("\n", " ", $advancedoptions);
			$optionsdiv .= ' ' . $advancedoptions;
		}
		
		foreach ($options as $key => $value)
		{
			if ($key != 'advancedoptions')
			{
				if (is_bool($value))
					$value = $value ? 'true' : 'false';
				$optionsdiv .= ' data-' . $key . '="' . $value . '"';
			}
		}
		
		$optionsdiv .= ' style="display:none;"></div>';
		if ('F' == 'F')
			$optionsdiv .= '<div class="wonderplugin-engine"><a href="http://www.wonderplugin.com/wordpress-lightbox/" title="'. get_option('wonderplugin-lightbox-engine')  .'">' . get_option('wonderplugin-lightbox-engine') . '</a></div>';
		
		echo $optionsdiv;
	}
	
	function get_settings() {
	
		$disableupdate = get_option( 'wonderplugin_lightbox_disableupdate', 0 );
		
		$addjstofooter = get_option( 'wonderplugin_lightbox_addjstofooter', 0 );
		
		$settings = array(
				"disableupdate" => $disableupdate,
				"addjstofooter" => $addjstofooter
		);
	
		return $settings;
	}
	
	function save_settings($options) {
	
		if (!isset($options) || !isset($options['disableupdate']))
			$disableupdate = 0;
		else
			$disableupdate = 1;
		update_option( 'wonderplugin_lightbox_disableupdate', $disableupdate );
		
		if (!isset($options) || !isset($options['addjstofooter']))
			$addjstofooter = 0;
		else
			$addjstofooter = 1;
		update_option( 'wonderplugin_lightbox_addjstofooter', $addjstofooter );
	}
	
	function get_plugin_info() {
	
		$info = get_option('wonderplugin_lightbox_information');
		if ($info === false)
			return false;
	
		return unserialize($info);
	}
	
	function save_plugin_info($info) {
	
		update_option( 'wonderplugin_lightbox_information', serialize($info) );
	}
	
	function check_license($options) {
	
		$ret = array(
				"status" => "empty"
		);
	
		if ( !isset($options) || empty($options['wonderplugin-lightbox-key']) )
		{
			return $ret;
		}
	
		$key = trim( $options['wonderplugin-lightbox-key'] );
		if ( empty($key) )
			return $ret;
	
		$update_data = $this->controller->get_update_data('register', $key);
		if( $update_data === false )
		{
			$ret['status'] = 'timeout';
			return $ret;
		}
	
		if ( isset($update_data->key_status) )
			$ret['status'] = $update_data->key_status;
	
		return $ret;
	}
	
	function deregister_license($options) {
	
		$ret = array(
				"status" => "empty"
		);
	
		if ( !isset($options) || empty($options['wonderplugin-lightbox-key']) )
			return $ret;
	
		$key = trim( $options['wonderplugin-lightbox-key'] );
		if ( empty($key) )
			return $ret;
	
		$info = $this->get_plugin_info();
		$info->key = '';
		$info->key_status = 'empty';
		$info->key_expire = 0;
		$this->save_plugin_info($info);
	
		$update_data = $this->controller->get_update_data('deregister', $key);
		if ($update_data === false)
		{
			$ret['status'] = 'timeout';
			return $ret;
		}
	
		$ret['status'] = 'success';
	
		return $ret;
	}
}
