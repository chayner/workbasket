<?php /* Smarty version 2.6.9, created on 2005-08-06 12:24:04
         compiled from form.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'form.tpl.html', 6, false),array('modifier', 'lower', 'form.tpl.html', 19, false),array('insert', 'image_select', 'form.tpl.html', 33, false),array('insert', 'category_select', 'form.tpl.html', 44, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 

<form name=admin_item enctype="multipart/form-data" method=post action="submit.php">
  <table width=100% border=0 cellspacing=0 cellpadding=10>
  <tr valign=top>
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
 Title:</td>
    <td>
      <input type=text name=title size=35 value="<?php echo $this->_tpl_vars['features'][0]['title']; ?>
">
    </td>
  </tr>
  <tr valign=top>
      <td><?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
 Priority (1 is High):</td>
    <td>
      <input type=text name=priority size=10 value="<?php echo $this->_tpl_vars['features'][0]['priority']; ?>
">
    </td>
  </tr>
  <tr valign=top>
    <td>
      <p>Body of the <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
:</p>
    </td>
    <td>
      <textarea name="body" cols=40 rows=10><?php echo $this->_tpl_vars['features'][0]['body']; ?>
</textarea>
    </td>
  </tr>

	<?php if ($this->_tpl_vars['cur_mod']['imgs_p']): ?>
	<tr valign="top">
	  <td colspan="2"><hr></td>
	</tr>
	<tr valign="top"> 
		<td width="175">Assign image to <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
:
		<p><img name=picture src="<?php if ($this->_tpl_vars['features'][0]['image_id']): ?>/photos/image_<?php echo $this->_tpl_vars['features'][0]['image_id']; ?>
_thumb.jpg<?php else: ?>/images/spacer.gif<?php endif; ?>"></p></td>
		<td><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'image_select', 'module' => $this->_tpl_vars['module'], 'cur_img' => $this->_tpl_vars['features'][0]['image_id'])), $this); ?>
</td>
	</tr>
	<?php endif; ?>

	
	<?php if ($this->_tpl_vars['cur_mod']['cat_p']): ?>
	<tr valign="top">
	  <td colspan="2"><hr></td>
	</tr>
	<tr valign="top"> 
		<td width="175"> Item <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['cat_name'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
:</td>
		<td><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'category_select', 'module' => $this->_tpl_vars['module'], 'cur_cat' => $this->_tpl_vars['features'][0]['category'])), $this); ?>
</td>
	</tr>
	<?php endif; ?>
  
    <tr align="center" valign=top> 
      <td colspan=2> 
        <input type=hidden name=action value="<?php echo $this->_tpl_vars['action']; ?>
">
        <input type=hidden name=id value="<?php echo $this->_tpl_vars['id']; ?>
">		
	  <input type=submit name=Submit value="<?php echo $this->_tpl_vars['action']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
">
      </td>
  </tr>
</table>
</form>

</table>