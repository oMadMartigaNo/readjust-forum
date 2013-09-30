<?php if (!defined('APPLICATION')) die();


//
// Here's the info about my meager plugin
//
$PluginInfo['Analytics'] = array
(
  'Name' => 'Analytics',
  'Description' => 'Inserts Google Analytics Javascript EVERYWHERE!',
  'Version' => '1.0',
  'Author' => 'Lykaon',
  'AuthorEmail' => 'lykaon@strahotksi.com',
  'AuthorUrl' => 'http://www.strahotski.com',
);

//
// Did I mention this was a plugin?  That would explain our desire to
// extend Gdn_Plugin. How else would we be an uber-plugin of hawtness?
//
class analyticsPlugin extends Gdn_Plugin
{
  //
  // We want to get our hot selves into the page before it renders and
  // what-not so that we can get our groove on and start tracking our
  // forum users... in a cool way; not in a creepy stalker way.
  //
  public function Base_Render_Before(&$Sender)
  {
    // ************************************************************
    // IF YOU READ NOTHING ELSE, READ THIS!
    //
    // CHANGE THIS TRACKING ID TO YOUR OWN.  THE GENERAL FORMAT IS
    // IS BELOW, BUT I ASSURE YOU THAT ALL ZEROES WILL NOT MAKE MR.
    // GOOGLE A HAPPY CAMPER!
    // ************************************************************
    $WebId = 'UA-2727256-4';

    // Now we're just going to add our javascript to the head.  It's not
    // super pretty formatted, but it works and working is half the battle.
    // Obviously, we're inserting the WebId from above (you changed that
    // to yours, right?  Right??
    $Sender->Head->AddString
    (
      "<script type=\"text/javascript\">var _gaq = _gaq || [];_gaq.push(['_setAccount', '".$WebId."']);_gaq.push(['_trackPageview']);(function() {var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);})();
</script><!--Piwik--><script type=\"text/javascript\">var _paq=_paq||[];_paq.push([\"trackPageView\"]);_paq.push([\"enableLinkTracking\"]);(function(){var u=((\"https:\"==document.location.protocol)?\"https\":\"http\")+\"://piwik.frippz.se/\";_paq.push([\"setTrackerUrl\",u+\"piwik.php\"]);_paq.push([\"setSiteId\",\"3\"]);var d=document,g=d.createElement(\"script\"),s=d.getElementsByTagName(\"script\")[0];g.type=\"text/javascript\";g.defer=true;g.async=true;g.src=u+\"piwik.js\";s.parentNode.insertBefore(g,s)})();</script><!--End Piwik Code--><!--Start Open Web Analytics Tracker--><script type=\"text/javascript\">var owa_baseUrl='http://analytics.frippz.se/';var owa_cmds=owa_cmds||[];owa_cmds.push(['setSiteId','7f6fc830da375d8ba2af99cee46e0190']);owa_cmds.push(['trackPageView']);owa_cmds.push(['trackClicks']);owa_cmds.push(['trackDomStream']);(function(){var _owa=document.createElement('script');_owa.type='text/javascript';_owa.async=true;owa_baseUrl=('https:'==document.location.protocol?window.owa_baseSecUrl||owa_baseUrl.replace(/http:/,'https:'):owa_baseUrl);_owa.src=owa_baseUrl+'modules/base/js/owa.tracker-combined-min.js';var _owa_s=document.getElementsByTagName('script')[0];_owa_s.parentNode.insertBefore(_owa,_owa_s)}());</script><!--End Open Web Analytics Code-->"
    );
  }

  //
  // Here's where we tell Garden what to do to set us up the bomb.  But
  // we're just simpletons so we have no setup.  Oh to be smart...
  //
  public function Setup()
  {
    // Nothing to do here!
  }
}
