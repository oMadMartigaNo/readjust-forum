<?php if (!defined('APPLICATION')) die();

// Plugin info
$PluginInfo['Analytics'] = array (
    'Name'        => 'Analytics',
    'Description' => 'Inserts the analytics snippet of your choosing',
    'Version'     => '1.0.2',
    'Author'      => 'Fredrik Frodlund',
    'AuthorUrl'   => 'http://frippz.se',
);

class analyticsPlugin extends Gdn_Plugin {

  public function Base_Render_Before($Sender) {

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
<!-- End Piwik Tracking Code -->
<!-- Begin Google Analytics Tracking Code -->
<script>
  (function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,"script","//www.google-analytics.com/analytics.js","ga");

  ga("create", "UA-57274505-2", "auto");
  ga("send", "pageview");

</script>
<!-- End Google Analytics Tracking Code -->');
  }

  public function Setup() {
    // No setup required
  }
}
