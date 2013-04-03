<?php if (!defined('APPLICATION')) die();


/*
 * Plugin info
 */
$PluginInfo['reAdjust'] = array
(
  'Name' => 'reAdjust',
  'Description' => 'Inserts custom stylesheets and JavaScripts where it pleases us',
  'Version' => '1.0',
  'Author' => 'frippz',
  'AuthorEmail' => 'frippz@me.com',
  'AuthorUrl' => 'http://blog.frippz.se',
);

/*
 * Let the plugin makin' begin!
 */
class readjustPlugin extends Gdn_Plugin {
    
    public function Base_Render_Before(&$Sender){
        
        // Only render outside the dashboard
        if ($Sender->MasterView != 'admin') {
            
            $Sender->AddCssFile('/plugins/reAdjust/design/readjust.css');
            $Sender->AddCssFile('/themes/VanillaBootstrap/design/less/main.css');
            $Sender->AddCssFile('/themes/VanillaBootstrap/design/prettify/prettify.css');
            $Sender->AddJsFile('/themes/VanillaBootstrap/js/bootstrap.main.js');
            $Sender->AddJsFile('/themes/VanillaBootstrap/js/plugin.autosize.js');
            $Sender->AddJsFile('/themes/VanillaBootstrap/js/vanilla.main.js');
            $Sender->AddJsFile('/themes/VanillaBootstrap/design/prettify/prettify.js');
            
        }
        
    }
    
    public function Setup() {
        // No setup required
    }
    
}
