<div class="editor-toolbar js-editor-toolbar" style="display: none;">

  <a data-wysihtml5-command="bold" class="Button" title="CTRL+B">
    <span>{t c="Bold"}</span> <i class="icon icon-bold"></i>
  </a>
  <a data-wysihtml5-command="italic" class="Button" title="CTRL+I">
    <span>{t c="Italic"}</span> <i class="icon icon-italic"></i>
  </a>
  <a data-wysihtml5-command="insertUnorderedList" class="Button">
    <span>{t c="Bulleted List"}</span> <i class="icon icon-list-ul"></i>
  </a>
  <a data-wysihtml5-command="insertOrderedList" class="Button">
    <span>{t c="Numbered List"}</span> <i class="icon icon-list-ol"></i>
  </a>
  <a data-wysihtml5-command="createLink" class="Button">
    <span>{t c="Link"}</span> <i class="icon icon-link"></i>
  </a>
  <a data-wysihtml5-command="insertImage" class="Button">
    <span>{t c="Image"}</span> <i class="icon icon-picture"></i>
  </a>
  <a data-wysihtml5-action="change_view" class="Button">
    {t c="Source"} <i class="icon icon-source"></i>
  </a>

  <div data-wysihtml5-dialog="createLink" class="createLink" style="display: none;">
    <label>
      {t c="Link"}
      <input data-wysihtml5-dialog-field="href" value="http://" type="text" class="InputBox">
    </label>
    <a data-wysihtml5-dialog-action="save" class="Button">{t c="OK"}</a>
    <a data-wysihtml5-dialog-action="cancel" class="Button">{t c="Cancel"}</a>
  </div>

  <div data-wysihtml5-dialog="insertImage" class="insertImage" style="display: none;">
    <label>
      {t c="Image"}:
      <input data-wysihtml5-dialog-field="src" value="http://" type="text" class="InputBox">
    </label>
    <a data-wysihtml5-dialog-action="save" class="Button">{t c="OK"}</a>
    <a data-wysihtml5-dialog-action="cancel" class="Button">{t c="Cancel"}</a>
  </div>

</div>
