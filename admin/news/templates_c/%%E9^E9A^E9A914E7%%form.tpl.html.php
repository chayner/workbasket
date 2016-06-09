<?php /* Smarty version 2.6.9, created on 2005-09-14 10:22:31
         compiled from ./form.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', './form.tpl.html', 6, false),array('modifier', 'lower', './form.tpl.html', 19, false),array('insert', 'image_select', './form.tpl.html', 39, false),array('insert', 'category_select', './form.tpl.html', 49, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 

<form name=news_item id=admin_item  enctype="multipart/form-data" method=post action="submit.php">
  <table width=100% border=0 cellspacing=0 cellpadding=10>
  <tr valign=top>
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
 Title:</td>
    <td>
      <input type=text name=title size=35 value="<?php echo $this->_tpl_vars['news'][0]['title']; ?>
">
    </td>
  </tr>
  <tr valign=top>
      <td><?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
 Date:</td>
    <td>
      <input type=text name=date size=35 value="<?php if ($this->_tpl_vars['news'][0]['date']):  echo $this->_tpl_vars['news'][0]['date'];  else: ?>today<?php endif; ?>">
    </td>
  </tr>
  <tr valign=top>
    <td>
      <p>Body of the <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
:</p>
    </td>
    <td>
      <textarea id="body" name="body"><?php echo $this->_tpl_vars['news'][0]['body']; ?>
</textarea>
    </td>
  </tr>
  <tr valign=top>
    <td>External URL of the <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
: <br>
        <i><font size="-1">URL needs to include 'http://'</font></i></td>
    <td><input type=text name=url size=35 value="<?php echo $this->_tpl_vars['news'][0]['url']; ?>
">
    </td>
  </tr>

	<?php if ($this->_tpl_vars['cur_mod']['imgs_p']): ?>
	<tr valign="top">
	  <td colspan="2"><hr></td>
	</tr>
	<tr valign="top"> 
		<td width="175">Assign image to <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
:
		<p><img name=picture id=picture src="<?php if ($this->_tpl_vars['news'][0]['image_id']): ?>/photos/image_<?php echo $this->_tpl_vars['news'][0]['image_id']; ?>
_thumb.jpg<?php else: ?>/images/spacer.gif<?php endif; ?>"></p></td>
		<td><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'image_select', 'module' => $this->_tpl_vars['module'], 'cur_img' => $this->_tpl_vars['news'][0]['image_id'])), $this); ?>
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
echo smarty_core_run_insert_handler(array('args' => array('name' => 'category_select', 'module' => $this->_tpl_vars['module'], 'cur_cat' => $this->_tpl_vars['news'][0]['category'])), $this); ?>
</td>
	</tr>
	<?php endif; ?>
  
    <tr align="center" valign=top> 
      <td colspan=2> 
        <input type=hidden name=action id=action_js value="<?php echo $this->_tpl_vars['action']; ?>
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