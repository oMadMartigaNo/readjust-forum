<?php if (!defined('APPLICATION')) exit();

/**
 * Define the plugin:
 */
$PluginInfo['Emoticons'] = array(
	'Name' 		=>	 'Retina Emoticons',
	'Description' => 'Replace text emoticons with high resolution images',
	'Version' 	=>	 '0.1',
	'Author' 	=>	 'Fredrik Frodlund',
	'AuthorEmail' => 'frippz@me.com',
	'AuthorUrl' =>	 'http://frippz.se/',
	'License' =>	 'Free',
	'RequiredPlugins' => FALSE,
	'HasLocale' => FALSE,
	'RegisterPermissions' => FALSE,
	'SettingsUrl' => FALSE,
	'SettingsPermission' => FALSE,
	'MobileFriendly' => TRUE,
	'RequiredApplications' => array('Vanilla' => '>=2.0.16')
);


/**
 * Emoticons Plugin
 *
 * Replaces text emoticons like <code>:-)</code> and <code>:-P</code> with graphics.
 *
 * @version 0.1
 * @date 17-03-2013
 * @author Fredrik Frodlund <frippz@me.com>
 *
 */
class EmoticonsPlugin extends Gdn_Plugin {
	
	/**
	 * Add the Plugin Stylesheet to the Header
	 *
	 * @since 1.0
	 * @version 1.1
	 * @author Fredrik Frodlund <frippz@me.com>
	 *
	 * @uses EMOTICONS_PLUGIN_ROOT
	 */
	public function DiscussionController_Render_Before(&$Sender) {
		$Sender->AddCssFile($this->GetResource('emoticon.css', FALSE, FALSE));
	}
	
	
	/**
	 * Initialize everything we need to replace Emoticons with Graphics
	 *
	 * @since 1.0
	 * @version 1.0
	 * @author Fredrik Frodlund <frippz@me.com>
	 * 
	 * @todo The Emoticon<-->Filename-Match could probably be exculed to a JSON-formatted file?
	 *
	 * @global array $EmoticonMatch
	 * @global array $EmoticonsSearch
	 */
	public function Initialize() {
		global $EmoticonMatch, $EmoticonsSearch;
		
		// Build an Array containing the Emoticon<-->Graphic matches
		if (!isset($EmoticonMatch)) {
			$EmoticonMatch = array(
                ':D'      => 'big-smile.png',
                ':O'      => 'gasp.png',
                '^^'      => 'laugh.png',
                '>D'      => 'mad.png',
                ':|'      => 'neutral.png',
                ':('      => 'sad.png',
                'o:)'     => 'saint.png',
                ';D'      => 'smile-wink.png',
                ':)'      => 'smile.png',
                ':-)'	  => 'smile.png',
                ':P'      => 'tounge.png',
                ':/'      => 'unsure.png',
                ';)'      => 'wink.png',
                ':9'      => 'yum.png'
			);
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
	 * @author Fredrik Frodlund <frippz@me.com>
	 *
	 * @uses Initialize()
	 * @uses FindEmoticon()
	 */
	public function DiscussionController_BeforeCommentBody_Handler(&$Sender) {
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
	 * @author Fredrik Frodlund <frippz@me.com>
	 *
	 * @uses Initialize()
	 * @uses FindEmoticon()
	 */
	public function PostController_BeforeCommentBody_Handler(&$Sender) {
		// Initialize the emoticons stuff
		$this->Initialize();
		
		// Replace emoticons in a submitted discussion & comment
		$this->DiscussionController_BeforeCommentBody_Handler($Sender);
	}
	
	
	/**
	 * Hack the Post-Controller to replace Text with Emoticons in the Discussion Preview
	 * 
	 * @since 1.2
	 * @version 1.0
	 * @author Fredrik Frodlund <frippz@me.com>
	 *
	 * @uses Initialize()
	 * @uses FindEmoticon()
	 */
	public function PostController_BeforeDiscussionRender_Handler(&$Sender) {
		if ($Sender->View == 'preview')
		{
			// Initialize the Emoticons stuff
			$this->Initialize();
			
			// Replace Emoticons in a preview of a new Discussion
			$Sender->Comment->Body = $this->FindEmoticon($Sender->Comment->Body);
		}
	}
	
	
	/**
	 * Hack the Post-Controller to replace Text with Emoticons in Comment Previews
	 * 
	 * @since 1.2
	 * @version 1.0
	 * @author Fredrik Frodlund <frippz@me.com>
	 *
	 * @uses Initialize()
	 * @uses FindEmoticon()
	 */
	public function PostController_BeforeCommentRender_Handler(&$Sender) {
		if ($Sender->View == 'preview')
		{
			// Initialize the Emoticons stuff
			$this->Initialize();
			
			// Replace Emoticons in a preview to a new Comment
			$Sender->Comment->Body = $this->FindEmoticon($Sender->Comment->Body);
		}
	}
	
	
	/**
	 * Hack the Post-Controller to replace Text with Emoticons in Edit-Previews
	 * 
	 * @since 0.1
	 * @version 0.1
	 * @author Fredrik Frodlund <frippz@me.com>
	 *
	 * @uses Initialize()
	 * @uses FindEmoticon()
	 */
	public function PostController_BeforeDiscussionPreview_Handler(&$Sender) {
		// Initialize the Emoticons stuff
		$this->Initialize();
		
		// Replace Emoticons in a preview of a currently edited Discussion or Comment
		$Sender->Comment->Body = $this->FindEmoticon($Sender->Comment->Body);
	}
	
	
	/**
	 * Search through a Text and find any occurence of an Emoticon
	 *
	 * @since 0.1
	 * @version 0.1
	 * @author Fredrik Frodlund <frippz@me.com>
	 *
	 * @uses $EmoticonImgTag()
	 * @global array $EmoticonsSearch()
	 * @param string $Text Content to convert Emoticons from.
	 * @return string Converted string with text emoticons replaced by <img>-tag.
	 */
	public function FindEmoticon($Text) {
		global $EmoticonsSearch;
		
		$Output = '';
		$Content = '';
		
		// Check if the Emoticons-Searchstring has been set properly
		if (!empty($EmoticonsSearch) ) {
			$TextArr = preg_split("/(<.*>)/U", $Text, -1, PREG_SPLIT_DELIM_CAPTURE); // Capture the Tags as well as in between
			$Stop = count($TextArr);
			
			for ($i = 0; $i < $Stop; $i++) {
				$Content = $TextArr[$i];
				
				// Check if it's not a HTML-Tag
				if ((strlen($Content) > 0) && ('<' != $Content{0})) {
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
	
	
	/**
	 * Translate an Emoticon Code into <img> HTML-tag
	 * 
	 * @since 0.1
	 * @version 0.1
	 * @author Fredrik Frodlund <frippz@me.com>
	 * 
	 * @uses EMOTICONS_PLUGIN_ROOT
	 * @global array $EmoticonMatch
	 * @param string $Emoticon The Emoticon Code to convert to image.
	 * @return string HTML-Image-Tag string for the emoticon.
	 */
	public function EmoticonImgTag($Emoticon) {
		global $EmoticonMatch;
		
		if (count($Emoticon) == 0) {
			return '';
		}
		
		$Emoticon = trim(reset($Emoticon));
		$Img = $EmoticonMatch[$Emoticon];
		$EmoticonMasked = $Emoticon;
		
		return ' <img class="emoticon" src="/'.$this->GetResource("images/$Img", FALSE, FALSE).'" height="16" width="16" alt="" /> ';
	}
	
	
	/**
	 * Initialize required data
	 *
	 * @since 0.1
	 * @version 0.1
	 */
	public function Setup() { }
	
}

?>
