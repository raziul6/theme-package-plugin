<?php
if(!defined('ABSPATH')){
    die('-1');
}
//Class Started
class dustVCExtendAddonClass{
    function __construct(){
        //We safely integrate with VC with this hook
        add_action('init', array($this, 'dustIntegrateWithVC'));
    }
    public function dustIntegrateWithVC(){

        //Check if visual composer is not installed 
        if(! defined('WPB_VC_VERSION')){
            add_action('admin_notices', array($this, 'dustShowVcVersionNotice'));
            return;
        }  
        // vc Addons 
        include DUST_ACC_PATH . '/vc-addons/vc-test.php';
        
        
        
    }
	
    // Show VC Version
    public function dustShowVcVersionNotice(){
        $theme_data = wp_get_theme();
        echo '
        <div class="notice notice-warning">
            <p>' .sprintf(__('<strong>%s</strong> recommends <strong>
                <a href="'.site_url().' /wp-admin/themes.php?page=tgmpa-install-plugins" target="_blank">Visual Composer</a></strong> Plugin to be installed & activate on your site.', 'dust-toolkit'), $theme_data->get('Name')).'</p>
       </div>';
    }
}
new dustVCExtendAddonClass();