<?php if (!defined('APPLICATION')) die();

/**
 * Plugin info
 */
$PluginInfo['FontAwesome'] = array(
  'Name'            => 'FontAwesome',
  'Description'     => 'Includes icon font set Font Awesome',
  'Version'         => '0.1',
  'Author'          => 'frippz',
  'AuthorEmail'     => 'fredrik@frippz.se',
  'AuthorUrl'       => 'http://frippz.se'
);


/**
 * Begin plugin
 */
class fontawesomePlugin extends Gdn_Plugin {
    
    public function Base_Render_Before(&$Sender){
        
        // Only render outside the dashboard
        if ($Sender->MasterView != 'admin') {
            
            $Sender->AddCssFile('/plugins/FontAwesome/css/font-awesome.css');
            
        }
        
    }
    
    public function Setup() {
        // No setup required
    }
    
}
