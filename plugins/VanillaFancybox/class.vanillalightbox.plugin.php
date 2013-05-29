<?php if (!defined('APPLICATION')) exit();

/**
 * Plugin info
 */
$PluginInfo['VanillaFancybox'] = array(
    'Name'                  => 'jQuery Fancybox 2.0',
    'Description'           => 'Display images in a beautiful modal window. A cleaner version of Oliver Raduner\'s version that uses FancyBox 2.',
    'Version'               => '2.0',
    'Author'                => 'Fredrik Frodlund',
    'AuthorEmail'           => 'fredrik@frippz.se',
    'AuthorUrl'             => 'http://frippz.se/',
    'License'               => 'Apache',
    'RequiredApplications'  => array('Vanilla' => '>=2.0.18'),
    'RequiredTheme'         => FALSE,
    'RequiredPlugins'       => FALSE,
    'HasLocale'             => FALSE,
    'RegisterPermissions'   => FALSE,
    'SettingsUrl'           => FALSE,
    'SettingsPermission'    => FALSE,
    'MobileFriendly'        => FALSE
);


/**
 * Vanilla Fancybox-Plugin
 *
 * Creates an on-site "popup" for displying images, using the jQuery Fancybox library
 *
 * @version 2.0
 * @author Fredrik Frodlund
 * 
 * @link http://fancyapps.com/fancybox/ jQuery Fancybox Plugin
 *
 */
class VanillaFancyboxPlugin extends Gdn_Plugin {
    
    public function Base_Render_Before(&$Sender) {
        
        // Show the Plugin only on specific pages...
        $DisplayOn =  array('activitycontroller', 'discussioncontroller', 'profilecontroller', 'messagecontroller');
        if (!InArrayI($Sender->ControllerName, $DisplayOn)) return;
        
        // Attach the Plugin's JavaScript & CSS to the site
        $Sender->AddJsFile($this->GetResource('js/jquery.fancybox.pack.js', FALSE, FALSE));
        $Sender->AddJsFile($this->GetResource('js/jquery.easing.pack.js', FALSE, FALSE));
        $Sender->AddJsFile($this->GetResource('js/fancyBoxConfig.js', FALSE, FALSE));
        $Sender->AddCSSFile($this->GetResource('css/jquery.fancybox.css', FALSE, FALSE));
        
    }
    
    /**
     * Initialize required data
     *
     * @since 1.0
     * @version 1.0
     */
    public function Setup() {
        // No setup required
    }
        
}
