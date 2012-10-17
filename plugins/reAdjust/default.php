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
    
    public function Base_Render_Before(&$Sender) {
        $Sender->Head->AddString("<link rel=\"stylesheet\" href=\"/plugins/reAdjust/design/readjust.css\" type=\"text/css\" />");
    }
    
    public function Setup() {
        // Nothing to do here!
    }
    
}
