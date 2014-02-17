<?php if(!defined("APPLICATION")) exit();

$PluginInfo['Wysihtml5'] = array(
	'Name' => 'Wysihtml5',
	'Description'	=> 'Turns the default text area into an HTML5 editor that generates valid and semantic markup. This version of the plugin is compatible with both Vanilla 2.0 and Vanilla 2.1b.',
	'Version'	=> '13.05.28',
	'Author' => 'D.Zanella',
	'AuthorEmail'	=> 'diego@pathtoenlightenment.net',
	'AuthorUrl' => 'http://dev.pathtoenlightenment.net',
	'RequiredApplications' => array('Vanilla' => '2.0.10')
);

/**
 * Wysihtml5 plugin for Vanilla
 * Based on original work from Kasper Kronborg Isager <kasperisager@gmail.com>.
 * Original repository can be found at https://github.com/kasperisager/Wysihtml5.
 *
 * @author Diego Zanella <diego@pathtoenlightenment.net>
 * @license http://opensource.org/licenses/MIT MIT
 */
class Wysihtml5 extends Gdn_Plugin {
	/**
	 * Adds the formatting bar to the form used by the Controller.
	 *
	 * @param Gdn_Controller $Sender Sending Controller instance.
	 */
	private function AttachFormattingBar(Gdn_Controller $Sender) {
		$this->_AddWysihtml5($Sender);

		$Form = $Sender->Form;
		$Format = $Form->GetValue('Format');

		if($Format) {
			$Formatter = Gdn::Factory($Format . 'Formatter');
			if($Formatter && method_exists($Formatter, 'FormatForWysiwyg')) {
				$Body = $Formatter->FormatForWysiwyg($Form->GetValue('Body'));
				$Form->SetValue('Body', $Body);
			}
			elseif(!in_array($Format, array('Html', 'Wysiwyg'))) {
				$Form->SetValue('Body', Gdn_Format::To($Form->GetValue('Body'), $Format));
			}
		}

		$Form->SetValue('Format', 'Wysiwyg');
		echo $Sender->FetchView($this->GetView('toolbar_view.php'));
	}

	/**
	 * Vanilla 2.1 only.
	 * Add the WYSIWYG editor to all text boxes
	 *
	 * @param Gdn_Controller $Sender Sending Controller instance.
	 */
	public function Gdn_Form_BeforeBodyBox_Handler($Sender) {
		$this->AttachFormattingBar(Gdn::Controller());
	}

	/**
	 * Vanilla 2.0 only.
	 * Hook DiscussionController::BeforeBodyInput Event Handler.
	 * This event fires just before the comment textbox is drawn.
	 *
	 * @param Gdn_Controller $Sender Sending Controller instance.
	 */
	public function DiscussionController_BeforeBodyInput_Handler($Sender) {
		$this->AttachFormattingBar($Sender);
	}

	/**
	 * Vanilla 2.0 only.
	 * Hook PostController::BeforeBodyInput Event Handler. Vanilla 2.0 only.
	 * This event fires just before the comment textbox is drawn.
	 *
	 * @param Gdn_Controller $Sender Sending Controller instance.
	 */
	public function PostController_BeforeBodyInput_Handler($Sender) {
		$this->AttachFormattingBar($Sender);
	}

	/**
	 * Vanilla 2.0 only.
	 * Hook PostController::BeforeBodyField Event Handler. Vanilla 2.0 only.
	 * This event fires just before the comment textbox is drawn.
	 *
	 * @param Gdn_Controller $Sender Sending Controller instance.
	 */
	public function DiscussionController_BeforeBodyField_Handler($Sender) {
		$this->AttachFormattingBar($Sender);
	}

	/**
	 * Add Wysihtml5 resources
	 *
	 * @param Gdn_Controller $Sender
	 */
	private function _AddWysihtml5($Sender) {
		$Sender->AddCssFile('wysihtml5.css', 'plugins/Wysihtml5');
		$Sender->AddCssFile('sprites12.css', 'plugins/Wysihtml5');
		$Sender->AddJsFile('advanced.js', 'plugins/Wysihtml5');
		$Sender->AddJsFile('wysihtml5.js', 'plugins/Wysihtml5');
		$Sender->AddJsFile('initialize.js', 'plugins/Wysihtml5');
		$Sender->AddJsFile('underscore.js', 'plugins/Wysihtml5');
	}
}
