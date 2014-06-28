<?php if (!defined('APPLICATION')) die();

/**
 * Plugin info
 */
$PluginInfo['reAdjust'] = array(
  'Name'            => 'reAdjust',
  'Description'     => 'Insert custom stuff where ever it pleases us',
  'Version'         => '1.1.0',
  'Author'          => 'Fredrik Frodlund',
  'AuthorUrl'       => 'http://frippz.se'
);


/**
 * Begin plugin
 */
class readjustPlugin extends Gdn_Plugin {
  
  public function Base_Render_Before(&$Sender){
    
    // Only render outside the dashboard
    if ($Sender->MasterView != 'admin') {
      
      $Sender->AddCssFile('/plugins/reAdjust/design/readjust.css');
      
    }
    
  }
  
  public function Setup() {
    // No setup required
  }
  
}
