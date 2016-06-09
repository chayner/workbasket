<?php /* Smarty version 2.6.9, created on 2005-09-05 10:11:12
         compiled from ./delete.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', './delete.tpl.html', 15, false),array('modifier', 'capitalize', './delete.tpl.html', 16, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 

<div align=center><hr><font class="title"><?php echo $this->_tpl_vars['files'][0]['title']; ?>
</font>
 	  <br><?php echo $this->_tpl_vars['files'][0]['filename']; ?>

	  <p><?php echo $this->_tpl_vars['files'][0]['caption']; ?>
<hr></div>

<form action="submit.php" method="post" enctype="multipart/form-data" name="form1">
  <input type="checkbox" name="del_file" value="1" checked>
  Delete <?php echo $this->_tpl_vars['files'][0]['filename']; ?>
 from /files as well. 
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
">
<input type="hidden" name="filename" value="<?php echo $this->_tpl_vars['files'][0]['filename']; ?>
">
<input type="hidden" name="fileuploaded" value="<?php echo $this->_tpl_vars['files'][0]['fileuploaded']; ?>
">
<input type="hidden" name="action" value="delete">
<hr>
<p>Are you sure that you want to delete this <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
?</p>
<p><input name="submit" type="submit" id="submit" value="Delete this <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
">
<p><a href="index.php?feedback=Delete Canceled.">No, Cancel my Delete</a>
</form>
</table>