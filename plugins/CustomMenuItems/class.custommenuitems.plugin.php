<?php if (!defined('APPLICATION')) exit();
/**
 * Custom Menu Items plugin for Vanilla Forums.
 *
 * v0.1
 *
 * @package CustomMenuItems
 */
 
$PluginInfo['CustomMenuItems'] = array(
   'Name' => 'Custom Menu Items',
   'Description' => 'Allow the admin to cleanly add custom menu items',
   'Version' => '0.1',
   'Author' => "Fredrik Frodlund",
   'AuthorEmail' => 'frippz@me.com',
   'AuthorUrl' => 'http://frippz.se',
   'License' => 'GNU GPLv2',
   'MobileFriendly' => TRUE
);

/**
 * Allow the admin to cleanly add custom menu items
 *
 * @package CustomMenuItemsPlugin
 */
class CustomMenuItemsPlugin extends Gdn_Plugin {
   /**
    * Add custom menu items to main menu.
    *
    * @since 0.1
    * @access public
    */
    public function Base_Render_Before($Sender) {
        $Session = Gdn::Session();
        if ($Sender->Menu && $Session->IsValid()) {
            // FAQ
            $Sender->Menu->AddLink('FAQ', T('<i class="icon-question-sign"></i>FAQ'), '/faq');
            // Servrar
            $Sender->Menu->AddLink('Servrar', T('<i class="icon-list-alt"></i>Servrar'), '/servrar');
        }
    }
}
