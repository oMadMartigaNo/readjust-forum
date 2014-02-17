<?php
  if (!defined('APPLICATION')) exit();
  $this->Title(T('FAQ'));
?>

<h1>FAQ</h1>
<p>Välkommen till vår lilla FAQ där vi samlar allmän information om funktioner i vårt forum.</p>

<ol class="toc-list">
  <li><a href="#wysiwyg">Varför finns det ingen WYSIWYG-editor?</a></li>
  <li><a href="#markdown">Hur formaterar jag mina inlägg?</a></li>
  <li><a href="#smileys">Finns det stöd för smileys?</a></li>
  <li><a href="#features">Kan ni inte installera pluginen XYZ?</a></li>
</ol>

<h2 id="wysiwyg">Varför finns det ingen WYSIWYG-editor?</h2>
<p>Tyvärr saknas detta idag då det helt enkelt inte finns några bra plugins till den version av Vanilla Forums som vi kör. Det finns en editor som heter <a href="http://vanillaforums.org/addon/wysihtml5-plugin">Wysihtml5</a>, som vi håller ett nära öga på. Tyvärr är den endast kompatibel med 2.1-grenen av Vanilla, som fortfarande är i beta-stadiet (vårt forum använder 2.0.x-grenen).</p>
<p>Så fort det är lämpligt så kommer vi antingen uppgradera reAdjusts forummjukvara till 2.1, eller om det dyker upp någon annan bra WYSIWYG-editor under tiden, så kommer vi givetvis att installera en sådan. Under tiden får ni hålla till godo med Markdown (se nedan).</p>

<h2 id="markdown">Hur formaterar jag mina inlägg?</h2>
<p>Forumet använder Markdown för att formatera text. En komplett dokumentation över Markdown finns på <a href="http://daringfireball.net/projects/markdown/syntax">Daring Fireball</a>.</p>

<h2 id="smileys">Finns det stöd för smileys?</h2>
<p>Vi har grundläggande stöd för smileys/emoticons. Tyvärr finns ännu inga verktygsknappar för att infoga smileys, utan du måste skriva dem för hand, så omvandlas de automatiskt till bilder. Se tabellen nedan för en referens över tillgängliga smileys.</p>
<table class="borders">
  <thead>
  <tr>
    <th scope="col">Smiley</th>
    <th scope="col">Variant</th>
    <th scope="col">Emoticon</th>
  </tr>
  </thead>
  <tbody>
  <tr>
    <td>:D</td>
    <td>:-D</td>
    <td> <img class="emoticon" src="/plugins/RetinaEmoticons/images/big-smile.png" height="16" width="16" alt="" /> </td>
  </tr>
  <tr>
    <td>:O</td>
    <td>:-O</td>
    <td> <img class="emoticon" src="/plugins/RetinaEmoticons/images/gasp.png" height="16" width="16" alt="" /> </td>
  </tr>
  <tr>
    <td>^^</td>
    <td>^_^</td>
    <td> <img class="emoticon" src="/plugins/RetinaEmoticons/images/laugh.png" height="16" width="16" alt="" /> </td>
  </tr>
  <tr>
    <td>>D</td>
    <td>>-D</td>
    <td> <img class="emoticon" src="/plugins/RetinaEmoticons/images/mad.png" height="16" width="16" alt="" /> </td>
  </tr>
  <tr>
    <td>:|</td>
    <td>:-|</td>
    <td> <img class="emoticon" src="/plugins/RetinaEmoticons/images/neutral.png" height="16" width="16" alt="" /> </td>
  </tr>
  <tr>
    <td>:(</td>
    <td>:-(</td>
    <td> <img class="emoticon" src="/plugins/RetinaEmoticons/images/sad.png" height="16" width="16" alt="" /> </td>
  </tr>
  <tr>
    <td>o:)</td>
    <td>o:-)</td>
    <td> <img class="emoticon" src="/plugins/RetinaEmoticons/images/saint.png" height="16" width="16" alt="" /> </td>
  </tr>
  <tr>
    <td>;D</td>
    <td>;-D</td>
    <td> <img class="emoticon" src="/plugins/RetinaEmoticons/images/smile-wink.png" height="16" width="16" alt="" /> </td>
  </tr>
  <tr>
    <td>:)</td>
    <td>:-)</td>
    <td> <img class="emoticon" src="/plugins/RetinaEmoticons/images/smile.png" height="16" width="16" alt="" /> </td>
  </tr>
  <tr>
    <td>:P</td>
    <td>:-P</td>
    <td> <img class="emoticon" src="/plugins/RetinaEmoticons/images/tounge.png" height="16" width="16" alt="" /> </td>
  </tr>
  <tr>
    <td>:/</td>
    <td>:-/</td>
    <td> <img class="emoticon" src="/plugins/RetinaEmoticons/images/unsure.png" height="16" width="16" alt="" /> </td>
  </tr>
  <tr>
    <td>;)</td>
    <td>;-)</td>
    <td> <img class="emoticon" src="/plugins/RetinaEmoticons/images/wink.png" height="16" width="16" alt="" /> </td>
  </tr>
  <tr>
    <td>:9</td>
    <td>:-9</td>
    <td> <img class="emoticon" src="/plugins/RetinaEmoticons/images/yum.png" height="16" width="16" alt="" /> </td>
  </tr>
  </tbody>
</table>

<h2 id="features">Kan ni inte installera pluginen XYZ?</h2>
<p>Kort svar; nej. <img class="emoticon" src="/plugins/RetinaEmoticons/images/tounge.png" height="16" width="16" alt=""> Vi försöker hålla vårt forum så smidigt och lättviktigt som möjligt. Självklart överväger vi feedback om det visar sig att en plugin skulle tillföra rejäl nytta.</p>