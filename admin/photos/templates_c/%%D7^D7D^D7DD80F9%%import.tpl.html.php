<?php /* Smarty version 2.6.9, created on 2005-08-06 13:55:47
         compiled from import.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'category_select', 'import.tpl.html', 23, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 

<font color=#FFCC00><strong>Due to constraints of our database, you can only upload JPEG images.</strong></font> 
<br>
All images will be resized to fit within an <?php echo $this->_tpl_vars['photo_resize_width']; ?>
 x <?php echo $this->_tpl_vars['photo_resize_height']; ?>
 pixel area.
      <hr><p><b>All files must be uploaded to the "/toimport" directory of the web server.</b></p>
	<?php if ($this->_tpl_vars['filelist']): ?>
		<p><font color=#FFCC00><strong>The following files will be imported:</strong></font></p>
		<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['filelist']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
			<?php echo $this->_tpl_vars['filelist'][$this->_sections['i']['index']]['filename']; ?>
<br>
		<?php endfor; endif; ?>
	<?php else: ?>
		<p><font color=#FFCC00><strong>There are currently no files in the "/toimport" directory.  Nothing will be imported.</strong></font></p>
	<?php endif; ?>
	  
<form method="post" enctype="multipart/form-data" action="import_action.php" onSubmit="this.elements['submit'].disabled='disabled';">
<p><input name="caption_p" type="checkbox" value="1"> Set caption to filename (without file extension)</p>
<?php if ($this->_tpl_vars['cur_mod']['cat_p']): ?>
	<table>
		<tr>
			<td>
			<strong>Select a category that all imported photos should be assigned to.</strong>
			<br><?php if ($this->_tpl_vars['cat']):  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'category_select', 'module' => $this->_tpl_vars['module'], 'cur_cat' => $this->_tpl_vars['cat'])), $this);  else:  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'category_select', 'module' => $this->_tpl_vars['module'], 'cur_cat' => $this->_tpl_vars['photos'][0]['category'])), $this);  endif; ?>
			</td>
		</tr>
	 </table>
<?php endif; ?>
  <p>
<p> 
    <input type="hidden" name="action" value="import">
    <input type="submit" name="submit" value="import images in /toimport directory">
</form>

</table>