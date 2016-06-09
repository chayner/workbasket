<?php /* Smarty version 2.6.9, created on 2005-09-08 23:46:08
         compiled from form.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'form.tpl.html', 6, false),array('modifier', 'lower', 'form.tpl.html', 82, false),array('insert', 'image_select', 'form.tpl.html', 84, false),array('insert', 'category_select', 'form.tpl.html', 95, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 

<form name=admin_item method=post action="submit.php">
  <table width=100% border=0 cellspacing=0 cellpadding=10>
    <tr valign=top> 
      <td><?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
 Title:</td>
      <td> 
        <input type=text name=title size=35 value="<?php echo $this->_tpl_vars['locations'][0]['title']; ?>
"> 
      </td>
    </tr>
    <tr valign=top> 
      <td>Address (line 1):</td>
      <td> 
        <input name=address1 type=text id="address1" value="<?php echo $this->_tpl_vars['locations'][0]['address1']; ?>
" size=35> 
      </td>
    </tr>
    <tr valign=top> 
      <td>Address (line 2):</td>
      <td> 
        <input name=address2 type=text id="address2" value="<?php echo $this->_tpl_vars['locations'][0]['address2']; ?>
" size=35> 
      </td>
    </tr>
    <tr valign=top> 
      <td>City:</td>
      <td> 
        <input name=city type=text id="city" value="<?php echo $this->_tpl_vars['locations'][0]['city']; ?>
" size=35></td>
    </tr>
    <tr valign=top> 
      <td>State:</td>
      <td> 
        <input name=state type=text id="state" value="<?php echo $this->_tpl_vars['locations'][0]['state']; ?>
" size=35></td>
    </tr>
    <tr valign=top> 
      <td>Zip:</td>
      <td> 
        <input name=zip type=text id="zip" value="<?php echo $this->_tpl_vars['locations'][0]['zip']; ?>
" size=35></td>
    </tr>
    <tr valign=top> 
      <td colspan="2"> 
        <hr></td>
    </tr>
    <tr valign=top> 
      <td>Phone:</td>
      <td> 
        <input name=phone type=text id="phone" value="<?php echo $this->_tpl_vars['locations'][0]['phone']; ?>
" size=35></td>
    </tr>
    <tr valign=top> 
      <td>Fax:</td>
      <td> 
        <input name=fax type=text id="fax" value="<?php echo $this->_tpl_vars['locations'][0]['fax']; ?>
" size=35></td>
    </tr>
    <tr valign=top> 
      <td colspan="2"> 
        <hr></td>
    </tr>
    <tr valign=top> 
      <td>E-mail:</td>
      <td> 
        <input name=email type=text id="email" value="<?php echo $this->_tpl_vars['locations'][0]['email']; ?>
" size=35></td>
    </tr>
    <tr valign=top> 
      <td>URL of the <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
: <br> <i><font size="-1">URL needs 
        to include 'http://'</font></i></td>
      <td> 
        <input type=text name=url size=35 value="<?php echo $this->_tpl_vars['locations'][0]['url']; ?>
"> </td>
    </tr>
    <tr valign="top"> 
      <td colspan="2"> 
        <hr></td>
    </tr>
    <tr valign="top"> 
      <td>Notes:</td>
      <td> 
        <textarea name="notes" cols="40" rows="4" id="notes"><?php echo $this->_tpl_vars['locations'][0]['notes']; ?>
</textarea></td>
    </tr>

	<?php if ($this->_tpl_vars['cur_mod']['imgs_p']): ?>
	<tr valign="top">
	  <td colspan="2"><hr></td>
	</tr>
	<tr valign="top"> 
		<td width="175">Assign image to <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
:
		<p><img name=picture src="<?php if ($this->_tpl_vars['locations'][0]['image_id']): ?>/photos/image_<?php echo $this->_tpl_vars['locations'][0]['image_id']; ?>
_thumb.jpg<?php else: ?>/images/spacer.gif<?php endif; ?>"></p></td>
		<td><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'image_select', 'module' => $this->_tpl_vars['module'], 'cur_img' => $this->_tpl_vars['locations'][0]['image_id'])), $this); ?>
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
echo smarty_core_run_insert_handler(array('args' => array('name' => 'category_select', 'module' => $this->_tpl_vars['module'], 'cur_cat' => $this->_tpl_vars['locations'][0]['category'])), $this); ?>
</td>
	</tr>
	<?php endif; ?>


    <tr align="center" valign=top> 
      <td colspan="2"> <input type=hidden name=action value="<?php echo $this->_tpl_vars['action']; ?>
"> <input type=hidden name=id value="<?php echo $this->_tpl_vars['locations'][0]['id']; ?>
"> 
        <input type=submit name=Submit value='<?php echo $this->_tpl_vars['action']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
'> 
      </td>
    </tr>
  </table>
</form>

</table>