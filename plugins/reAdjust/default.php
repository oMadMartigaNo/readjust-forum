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

  public function Base_Render_Before($Sender) {
    // Only render outside the dashboard
    if ($Sender->MasterView != 'admin') {
      $Sender->AddJsFile('/plugins/reAdjust/fancybox/fancybox.js');
      $Sender->AddCssFile('/plugins/reAdjust/fancybox/fancybox.css');
      $Sender->AddCssFile('/plugins/reAdjust/design/readjust.css');
    }
  }

  public function Base_AfterBody_Handler($Sender) {
    // Only render outside the dashboard
    if ($Sender->MasterView != 'admin') {
      echo '<script src="/plugins/reAdjust/fancybox/init.js" async></script>';
    }
  }

  public function PageController_Render_Before($Sender) {
    // Hide unwanted modules
    unset($Sender->Assets['Panel']['DiscussionsModule']);
    unset($Sender->Assets['Panel']['RecentActivityModule']);
  }

  public function Setup() {
    // No setup required
  }

}
