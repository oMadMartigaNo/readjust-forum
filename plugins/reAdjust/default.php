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
    
    public function Base_Render_Before($Sender){
        $Sender->AddCssFile($this->GetResource('design/readjust.css', FALSE, FALSE));
        $Sender->AddCssFile($this->GetResource('../../themes/VanillaBootstrap/design/less/main.css', FALSE, FALSE));
        $Sender->AddCssFile($this->GetResource('../../themes/VanillaBootstrap/design/prettify/prettify.css', FALSE, FALSE));
        $Sender->AddJsFile($this->GetResource('../../themes/VanillaBootstrap/js/bootstrap.main.js', FALSE, FALSE));
        $Sender->AddJsFile($this->GetResource('../../themes/VanillaBootstrap/js/plugin.autosize.js', FALSE, FALSE));
        $Sender->AddJsFile($this->GetResource('../../themes/VanillaBootstrap/js/vanilla.main.js', FALSE, FALSE));
        $Sender->AddJsFile($this->GetResource('../../../../themes/VanillaBootstrap/design/prettify/prettify.js', FALSE, FALSE));
    }
    
    public function Setup() {
        // Nothing to do here!
    }
    
}
