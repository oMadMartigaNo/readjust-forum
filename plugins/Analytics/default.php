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
<script>
  (function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,"script","//www.google-analytics.com/analytics.js","ga");
  ga("create", "UA-57274505-2", "auto");
  ga("send", "pageview");
</script>');
  }

  public function Setup() {
    // No setup required
  }
}
