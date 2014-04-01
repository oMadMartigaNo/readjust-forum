<?php if (!defined('APPLICATION')) die();

// Plugin info
$PluginInfo['Analytics'] = array (
    'Name'        => 'Analytics',
    'Description' => 'Inserts the analytics snippet of your choosing',
    'Version'     => '1.0.1',
    'Author'      => 'Fredrik Frodlund',
    'AuthorUrl'   => 'http://frippz.se',
);

class analyticsPlugin extends Gdn_Plugin {
  
  public function Base_Render_Before(&$Sender) {
    
    // Insert snippet inside <head>
    $Sender->Head->AddString
      ('
<!-- Begin Piwik Tracking Code -->
<script type="text/javascript">
var _paq = _paq || [];
_paq.push(["trackPageView"]);
_paq.push(["enableLinkTracking"]);

(function() {
var u=(("https:" == document.location.protocol) ? "https" : "http") + "://piwik.frippz.se/";
_paq.push(["setTrackerUrl", u+"piwik.php"]);
_paq.push(["setSiteId", "3"]);
var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
})();
</script>
<!-- End Piwik Tracking Code -->');
  }
  
  public function Setup() {
    // No setup required
  }
}
