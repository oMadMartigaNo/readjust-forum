<?php if (!defined('APPLICATION')) exit(); ?>

<div id="wysihtml5-toolbar" style="display: none;">
   <a data-wysihtml5-command="bold" class="Button" title="Bold"><i class="fa fa-bold"></i></a>
   <a data-wysihtml5-command="italic" class="Button" title="Italic"><i class="fa fa-italic"></i></a>
   <a data-wysihtml5-command="insertUnorderedList" class="Button" title="Unordered list"><i class="fa fa-list-ul"></i></a>
   <a data-wysihtml5-command="insertOrderedList" class="Button" title="Ordered list"><i class="fa fa-list-ul"></i></a>
   <a data-wysihtml5-command="createLink" class="Button" title="Insert link"><i class="fa fa-link"></i></a>
   <a data-wysihtml5-command="insertImage" class="Button" title="Insert image"><i class="fa fa-picture-o"></i></a>
   <a data-wysihtml5-action="change_view" class="Button" title="Switch to code view"><i class="fa fa-code"></i></a>

   <div data-wysihtml5-dialog="createLink" class="createLink well" style="display: none;">
      <label>
         <?php echo T('Link') ?>:
         <input data-wysihtml5-dialog-field="href" value="http://" type="text" class="InputBox">
      </label>
      <a data-wysihtml5-dialog-action="save" class="Button"><?php echo T('OK') ?></a>
      <a data-wysihtml5-dialog-action="cancel" class="Button"><?php echo T('Cancel') ?></a>
   </div>

   <div data-wysihtml5-dialog="insertImage" class="insertImage well" style="display: none;">
      <label>
         <?php echo ('Image') ?>:
         <input data-wysihtml5-dialog-field="src" value="http://" type="text" class="InputBox">
      </label>
      <label>
         <?php echo ('Align') ?>:
         <select data-wysihtml5-dialog-field="className">
            <option value=""><?php echo ('default') ?></option>
            <option value="wysiwyg-float-left"><?php echo ('left') ?></option>
            <option value="wysiwyg-float-right"><?php echo ('right') ?></option>
         </select>
      </label>
      <a data-wysihtml5-dialog-action="save" class="Button"><?php echo ('OK') ?></a>
      <a data-wysihtml5-dialog-action="cancel" class="Button"><?php echo ('Cancel') ?></a>
   </div>

</div>