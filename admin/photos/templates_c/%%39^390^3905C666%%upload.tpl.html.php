<?php /* Smarty version 2.6.9, created on 2005-08-24 12:11:28
         compiled from upload.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> <font color=#FFCC00><strong>Due 
to constraints of our database, you can only upload JPEG images.</strong></font> 
<br>
All images will be resized to fit within an <?php echo $this->_tpl_vars['photo_resize_width']; ?>
 x <?php echo $this->_tpl_vars['photo_resize_height']; ?>
 pixel area.
      <hr><p><b>Please enter the filename of the image you wish to upload:</b></p>
<form method="post" enctype="multipart/form-data" action="submit.php" onSubmit="this.elements['submit'].disabled='disabled';">
  <input type="file" name="source_file"><br><br>
  <p>
  <INPUT TYPE=hidden name=MAX_FILE_SIZE value=20000000>
  <font size=2 color=#FFCC00><b>Please be patient when uploading images, as it may take a little while to process.</b></font>
  <p> 
    <input type="hidden" name="action" value="upload">
    <input type="submit" name="submit" value="upload image">
	<input type="hidden" name="cat" value="<?php echo $this->_tpl_vars['cat']; ?>
">
</form>

</table>