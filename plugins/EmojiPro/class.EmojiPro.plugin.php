<?php if (!defined('APPLICATION')) exit();

$PluginInfo['EmojiPro'] = array(
	'Name' => 'Emoji Pro',
	'Description' => 'Enables Emoji in discussions and comments. Emojifies emoticons.',
	'Version' => '1.0',
	'RequiredApplications' => array('Vanilla' => '2.0.18.4'),
	'RequiredTheme' => FALSE,
	'RequiredPlugins' => FALSE,
	'MobileFriendly' => TRUE,
	// 'SettingsUrl' => '/dashboard/settings/EmojiPro',
	'SettingsPermission' => 'Garden.Settings.Manage',
	// 'HasLocale' => TRUE,
	'RegisterPermissions' => FALSE,
	'Author' => "Anonymoose",
	'AuthorEmail' => '',
	'AuthorUrl' => ''
);


/**
**
** Emoji Pro 1.0
**
** * Enables Emoji
** * Works in discussions and comments, including previews.
** * Converts all legacy emoji formats to the standard unified format.
** * Supports all emoji in Unicode 6.2 (current as of 2012.09).
** * Converts to actual characters, not image files.
** * This allows for high resolution display on all devices.
** * Characters stored in database as html entities for compatibility.
** * Forwards compatible: if plugin is removed, emoji already in
** * discussions will still display.
** * 
** * 	Windows 7 & 8 must have optional update KB2729094 
** *	 (through Windows Update) installed to view emoji.
** * 
** *	Mac 10.7 (Lion) and above support emoji.
** * 
** * 	Requires iOS 6.0 or higher for display of all emoji.
** * 
** * 	Others should install the free Symbola font from
** * 	http://users.teilar.gr/~g1951d/ 
** * 
** * Converts Emoticons to Emoji
** * Converts :-) style emoticons to emoji.
** *
** * Converts legacy css div based image emoji made by Emoji 0.1a plugin
** * to standard html entities.
** *
** * To do: Make emoji show in editor box.
** * 
**
 * Based on:
 Emoticons 1.2 plugin by Oliver Raduner;
 Emoji 0.1a plugin by chuck911, 
 Cal Henderson's [Emoji for PHP] library
 http://code.iamcal.com/php/emoji/ and 
 @matt's [great idea](http://vanillaforums.org/discussion/21033)
**
 */

class EmojiProPlugin extends Gdn_Plugin {
	public function __construct() {
		require_once(dirname(__FILE__).'/emoji.php');
	}


	public function DiscussionController_Render_Before(&$Sender) {
		$Sender->AddCssFile('emoji.css', 'plugins/EmojiPro');
		// css file only necessary to render old style Emoji via css made by original Emoji plugin
	}


  public function Base_Render_Before(&$Sender)
	{
		//html entities of emoji to pure utf-8
		$Sender->Discussion->Head = $this->Emoji_html_to_utf8($Sender->Discussion->Head);
		$Sender->Discussion->Body = $this->Emoji_html_to_utf8($Sender->Discussion->Body);
	}


//////////







//Gdn_Form_BeforeBodyBox_Handler requires 2.1, for direct editing of the text:
//Not ready, do not uncomment.
//
//	public function Gdn_Form_BeforeBodyBox_Handler($Sender) {
//
//		$Sender->Form_Body = $this->Emoji_html_to_utf8($Sender->Form_Body);
//		$Sender->SetValue('Body', Gdn_Format::To($Sender->GetValue('Body'), $Format));
//}
//

	
	public function CommentModel_BeforeSaveComment_Handler($Sender,$arg) {
		$arg['FormPostValues']['Body'] = $this->Emojify($arg['FormPostValues']['Body']);
	}

	public function DiscussionModel_BeforeSaveDiscussion_Handler($Sender,$arg) {
		$arg['FormPostValues']['Name'] = $this->Emojify($arg['FormPostValues']['Name']);
		$arg['FormPostValues']['Body'] = $this->Emojify($arg['FormPostValues']['Body']);
	}



	public function PostController_BeforeCommentRender_Handler(&$Sender)
	{
		if ($Sender->View == 'preview')
		{		
			// Replace Emoji in a preview to a new Comment
			$Sender->Comment->Body = $this->Emojify($Sender->Comment->Body);


// Initialize the Emoticons stuff
			$this->Initialize();
			
			// Replace Emoticons in a preview to a new Comment
			$Sender->Comment->Body = $this->FindEmoticon($Sender->Comment->Body);

		}
	}
	
	
	public function PostController_BeforeDiscussionRender_Handler(&$Sender)
	{
		if ($Sender->View == 'preview')
		{		
			// Replace Emoji in a preview of a new Discussion
			$Sender->Comment->Body = $this->Emojify($Sender->Comment->Body);

				// Initialize the Emoticons stuff
			$this->Initialize();
			
			// Replace Emoticons in a preview of a new Discussion
			$Sender->Comment->Body = $this->FindEmoticon($Sender->Comment->Body);
	
	}
	}
	

	public function PostController_BeforeDiscussionPreview_Handler(&$Sender)
	{	
		// Replace Emoji in a preview of a currently edited Discussion or Comment
		$Sender->Comment->Body = $this->Emojify($Sender->Comment->Body);
		
		
			$this->Initialize();
		
		// Replace Emoticons in a preview of a currently edited Discussion or Comment
		$Sender->Comment->Body = $this->FindEmoticon($Sender->Comment->Body);
		
		
	}	



	private function Emojify($data) {
	$data = emoji_docomo_to_unified($data);   # DoCoMo devices
    $data = emoji_kddi_to_unified($data);     # KDDI & Au devices
    $data = emoji_softbank_to_unified($data); # Softbank & (iPhone) Apple devices
    $data = emoji_google_to_unified($data);   # Google Android devices
    return emoji_unified_to_html($data);	
	}
	
	private function Emoji_html_to_utf8($data) {
    return emoji_html_to_unified($data);
	}
	/**
	
	*/
	
		
	/**
	 * Initialize everything we need to replace Emoticons with Emoji
	 *
	 * @since 1.0
	 * @version 1.0
	 * @author Oliver Raduner <vanilla@raduner.ch>
	 * 
	 * @todo The Emoticon<-->Filename-Match could probably be exculed to a JSON-formatted file?
	 *
	 * @global array $EmoticonMatch
	 * @global array $EmoticonsSearch
	 * Emoji Pro 1.0 ==> Not with images now.
	 */
	public function Initialize()
	{
		global $EmoticonMatch, $EmoticonsSearch;
		
		// Build an Array containing the Emoticon<-->Emoji matches
		if (!isset($EmoticonMatch))
		{
			$EmoticonMatch = array(
				'8-)'	=> '&#128526;',
				':-E'	=> '&#128513;',
				'8-|'	=> '&#128521;',
				'<3'	=> '&#128150;',
				'8-?'	=> '&#128533;',
				':-D'	=> '&#128515;',
				':D'	=> '&#128515;',
				'>:-('	=> '&#128545;',
				'(8)'	=> '&#128114;',
				'8-x'	=> '&#128559;',
				'8-P'	=> '&#128548;',
				':?:'	=> '&#8265;',
				':-P'	=> '&#128539;',
				':P'	=> '&#128539;',
				'->'	=> '&rarr;',
				':-('	=> '&#128542;',
				':('	=> '&#128542;',
				':-O'	=> '&#128558;',
				':-)'	=> '☺',
				'=)'	=> '☺',
				'^^'	=> '&#128570;',
				':)'	=> '☺',
				';-|'	=> '&#128530;',
				':!:'	=> '&#9888;',
				';-)'	=> '&#128521;',
				';)'	=> '&#128521;',
				
#Original Smileys from in
#http://www.AcronymsList.com/cat/sms-text-smileys-and-emoticons.html

'#-)'	=>	'&#128131;',
'#:-)'	=>	'&#128135;',
'#:-O'	=>	'&#128561;	',
'%-)'	=>	'&#128513;',
'%-)'	=>	'&#128513;',
'&:-)'	=>	'&#128113;',
'(-:'	=>	'&#128072;&#128515;',
'(:-)'	=>	'&#128116;',
'(:-...'	=>	'&#128148;',
'(:-|K-'	=>	'&#128084;',
'*:*'	=>	'&#128121;',
'*<:O)'	=>	'&#128122;',
'8-)'	=>	'&#128083;',
'B-)'	=>	'&#128083;',
'8^'	=>	'&#128020;',
':\'-('	=>	'&#128546;',
':*)'	=>	'&#128523;',
':*)?'	=>	'&#128523;?',
':+('	=>	'&#128531;',
':-#'	=>	'&#128567;',
':-$'	=>	'&#128176;',
':-&'	=>	'&#128543;',
':-('	=>	'&#128542;',
':-(*)'	=>	'&#128548;',
':-)'	=>	'&#128515;',
':-))'	=>	'&#128513;',
':-*'	=>	'&#128536;',
':-7'	=>	'&#128527;',
':-9'	=>	'&#128068;',
':->'	=>	'&#128070;',
':-@'	=>	'&#128558;',
':-C'	=>	'&#128559;',
':-D'	=>	'&#128512;',
':-E'	=>	'&#128556;',
':-O'	=>	'&#128550;',
':-O'	=>	'&#128562;',
':-P'	=>	'&#128523;',
':-S'	=>	'&#128533;',
':-X'	=>	'&#128536;',
':-{)'	=>	'&#128110;',
':-{)}'	=>	'&#128116;',
':-|'	=>	'&#128528;',
':-||'	=>	'&#128544;',
'://'	=>	'&#128545;',
':3-<'	=>	'&#128054;',
'::=))'	=>	'&#128565;',
':=8)'	=>	'&#128053;',
':>'	=>	'&#128570;',
':@'	=>	'&#128534;',
':@)'	=>	'&#128061;',
':^D"'	=>	'&#128077;',
';-)'	=>	'&#128521;',
'<3'	=>	'&#128525;',
'<:-)'	=>	'&#128527;',
'<:-0'	=>	'&#128561;',
'>;-(\''	=>	'&#128545;',
'D:-)'	=>	'&#128161;',
'O:-)'	=>	'&#128118;',
'O/'	=>	'&#128548;',
'{}'	=>	'&#128528;',
'|-)'	=>	'&#128518;',
'|-|'	=>	'&#128564;',
'|:-0'	=>	'&#128532;',
'~#:-('	=>	'&#128135;',
'~O~'	=>	'&#128037;',

#Original but without nose

'#)'	=>	'&#128131;',
'#:)'	=>	'&#128135;',
'#:O'	=>	'&#128561;	',
'%\)'	=>	'&#128513;',
'%)'	=>	'&#128513;',
'&:)'	=>	'&#128113;',
'(:'	=>	'&#128072;&#128515;',
'(:)'	=>	'&#128116;',
'(:...'	=>	'&#128148;',
'(:|K'	=>	'&#128084;',
'8)'	=>	'&#128083;',
'B)'	=>	'&#128083;',
':\'('	=>	'&#128546;',
':#'	=>	'&#128567;',
':$'	=>	'&#128176;',
':&'	=>	'&#128543;',
':('	=>	'&#128542;',
':(*)'	=>	'&#128548;',
':)'	=>	'&#128515;',
':))'	=>	'&#128513;',
':*'	=>	'&#128536;',
':7'	=>	'&#128527;',
':9'	=>	'&#128068;',
':>'	=>	'&#128070;',
':@'	=>	'&#128558;',
':C'	=>	'&#128559;',
':D'	=>	'&#128512;',
':E'	=>	'&#128556;',
':O'	=>	'&#128550;',
':O'	=>	'&#128562;',
':P'	=>	'&#128523;',
':S'	=>	'&#128533;',
':X'	=>	'&#128536;',
':{)'	=>	'&#128110;',
':{)}'	=>	'&#128116;',
':|'	=>	'&#128528;',
':||'	=>	'&#128544;',
':3<'	=>	'&#128054;',
';)'	=>	'&#128521;',
'<:)'	=>	'&#128527;',
'<:0'	=>	'&#128561;',
'>;(\''	=>	'&#128545;',
'D:)'	=>	'&#128161;',
'O:)'	=>	'&#128118;',
'|)'	=>	'&#128518;',
'||'	=>	'&#128564;',
'|:0'	=>	'&#128532;',
'~#:('	=>	'&#128135;',

#more
'=;'	=>	'&#128568;',
'=P~'	=>	'&#128569;',
'>:D'	=>	'&#128568;',
':-B'	=>	'&#128568;',
';;)'	=>	'&#128518;',
':C'	=>	'&#128542;',
':c'	=>	'&#128542;',
':-c'	=>	'&#128542;',
':-C'	=>	'&#128542;',
':-\"'	=>	'&#128546;',
':-/'	=>	'&#128533;',
':\">'	=>	'&#128541;',
'=D>'	=>	'&#128541;',
'#:-S'	=>	'&#128534;',
'>:)'	=>	'&#128570;',
'=(('	=>	'&#128551;',
'X_X'	=>	'&#128565;',
'X('	=>	'&#128565;',
':x'	=>	'&#128565;',
'o->'	=>	'&#128522;',
'o=>'	=>	'&#128524;',
'o-+'	=>	'&#128537;',
'I-)'	=>	'&#128529;',

# Skype style flags
'(flag:JP)'	=>	'&#127471;&#127477;',
'(flag:KR)'	=>	'&#127472;&#127479;',
'(flag:DE)'	=>	'&#127465;&#127466;',
'(flag:CN)'	=>	'&#127464;&#127475;',
'(flag:US)'	=>	'&#127482;&#127480;',
'(flag:FR)'	=>	'&#127467;&#127479;',
'(flag:ES)'	=>	'&#127466;&#127480;',
'(flag:IT)'	=>	'&#127470;&#127481;',
'(flag:RU)'	=>	'&#127479;&#127482;',
'(flag:GB)'	=>	'&#127468;&#127463;',

# Yahoo style
':@)'	=>	'&#128055;',
'3:-O'	=>	'&#128004;',
':o3'	=>	'&#128054;',
'~O)'	=>	'&#127861;',
'=:)'	=>	'&#128126;',
'^:)^'	=>	'&#128583;',
':-??'	=>	'&#128584;',
':-@'	=>	'&#128581;',
'%-('	=>	'&#128585;',
':-j'	=>	'&#128514;',

# msn style
'(\'.\')'	=>	'&#128048;',

			); // Add more matches, if you need them... 
		}
		
		// In case there's something wrong with the Array, exit the Function
		if (count($EmoticonMatch) == 0)
			return;
		
		// Define the basic Regex pattern to find Emoticons
		$EmoticonsSearch = '/(?:\s|^)';
		
		// Automatically extend the Regex pattern based on the Emoticon-Codes in the $EmoticonMatch-Array
		$subchar = '';
		foreach ( (array) $EmoticonMatch as $Smiley => $Img ) {
			$firstchar = substr($Smiley, 0, 1);
			$rest = substr($Smiley, 1);
	
			// new subpattern?
			if ($firstchar != $subchar) {
				if ($subchar != '') {
					$EmoticonsSearch .= ')|(?:\s|^)';
				}
				$subchar = $firstchar;
				$EmoticonsSearch .= preg_quote($firstchar, '/') . '(?:';
			} else {
				$EmoticonsSearch .= '|';
			}
			$EmoticonsSearch .= preg_quote($rest, '/');
		}
		
		// Add final Regex pattern to the Search-Variable
		$EmoticonsSearch .= ')(?:\s|$)/m';
		
	}
	
	/**
	 * Hack the Discussion-Controller to replace Text with Emoticons in Discussions & Comments
	 * 
	 * @since 1.0
	 * @version 1.2
	 * @author Oliver Raduner <vanilla@raduner.ch>
	 *
	 * @uses Initialize()
	 * @uses FindEmoticon()
	 */
	public function DiscussionController_BeforeCommentBody_Handler(&$Sender)
	{
		// Get the current Discussion and Comments
		$Comment = $Sender->Discussion;
		
		// Initialize the Emoticons stuff
		$this->Initialize();
		
		// Replace Emoticons in the Discussion and all Comments to it
		$Comment->Body = $this->FindEmoticon($Comment->Body);
		
		foreach($Sender->CommentData as $cdata) {
			$cdata->Body = $this->FindEmoticon($cdata->Body);;

		}
	}
	


	/**
	 * Hack the Post-Controller to replace Text with Emoticons in just submitted Comments
	 * 
	 * @since 1.2
	 * @version 1.0
	 * @author Oliver Raduner <vanilla@raduner.ch>
	 *
	 * @uses Initialize()
	 * @uses FindEmoticon()
	 */
	public function PostController_BeforeCommentBody_Handler(&$Sender)
	{
		// Initialize the Emoticons stuff
		$this->Initialize();
		
		// Replace Emoticons in a Discussion & Comment just submitted
		$this->DiscussionController_BeforeCommentBody_Handler($Sender);
	}

	

	/**
	 * Search through a Text and find any occurence of an Emoticon
	 *
	 * @since 1.0
	 * @version 1.0
	 * @author Oliver Raduner <vanilla@raduner.ch>
	 *
	 * @uses $EmoticonImgTag()
	 * @global array $EmoticonsSearch()
	 * @param string $Text Content to convert Emoticons from.
	 * @return string Converted string with text emoticons replaced.
	 * Emoji Pro 1.0 ==> Not with images now.
	 */
	public function FindEmoticon($Text)
	{
		global $EmoticonsSearch;
		
		$Output = '';
		$Content = '';
		
		// Check if the Emoticons-Searchstring has been set properly
		if (!empty($EmoticonsSearch) )
		{
			$TextArr = preg_split("/(<.*>)/U", $Text, -1, PREG_SPLIT_DELIM_CAPTURE); // Capture the Tags as well as in between
			$Stop = count($TextArr);
			
			for ($i = 0; $i < $Stop; $i++)
			{
				$Content = $TextArr[$i];
				
				// Check if it's not a HTML-Tag
				if ((strlen($Content) > 0) && ('<' != $Content{0}))
				{
					// Documentation about preg_replace_callback: http://php.net/manual/en/function.preg-replace-callback.php
					$Content = preg_replace_callback($EmoticonsSearch, array(&$this, 'EmoticonImgTag'), $Content);
				}
				
				$Output .= $Content;
			}
			
		} else {
			// Return default text
			$Output = $Text;
		}
		
		return $Output;
	}
	
	
	//
	
	
	/**
	 * Translate an Emoticon Code into Emoji
	 * 
	 * @since 1.0
	 * @version 1.1
	 * @author Oliver Raduner <vanilla@raduner.ch>
	 * 
	 * @uses EMOTICONS_PLUGIN_ROOT
	 * @global array $EmoticonMatch
	 * @param string $Emoticon The Emoticon Code to convert to emoji.
	 * @return string for the emoticon.
 	 * Emoji Pro 1.0 ==> Not with images now.
	 */
	public function EmoticonImgTag($Emoticon)
	{
		global $EmoticonMatch;
		
		if (count($Emoticon) == 0) {
			return '';
		}
		
		$Emoticon = trim(reset($Emoticon));
		$Img = $EmoticonMatch[$Emoticon];
		$EmoticonMasked = $Emoticon;
		
		return $Img;
	}
	
	
	/**
	 * Initialize required data
	 *
	 * @since 1.0
	 * @version 1.1
	 */
	public function Setup() { }
	
	//
	

	
	
	
///////////////////////////////////////	
}
