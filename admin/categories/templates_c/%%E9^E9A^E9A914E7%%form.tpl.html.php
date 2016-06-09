<?php /* Smarty version 2.6.9, created on 2005-08-10 12:10:32
         compiled from ./form.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', './form.tpl.html', 12, false),array('insert', 'avail_parent_cats', './form.tpl.html', 32, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/header.tpl.html", 'smarty_include_vars' => array('title' => 'categories','page' => 'categories')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 

 <form method=post action=submit.php name=editcategory>
  <table width=600 border=0 cellspacing=0 cellpadding=5>
  <tr>
   <td width=150 valign="top">
		
	</td>
    <td width=350>
			   <table width="500" border="0" cellspacing="0" cellpadding="10">
			     <tr>
			       <td colspan="2"><b><font size="+1">Modify <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</font></b><font size="+1">: </font></td>
		         </tr>
			     <tr valign="top">
			       <td><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
 Name: </strong> </td>
			       <td><input name=cat_name value="<?php echo $this->_tpl_vars['cat'][0]['name']; ?>
">
</td>
		         </tr>
			     <tr valign="top">
                   <td><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
 Description: </strong> </td>
                   <td><textarea name="cat_desc" cols="45" rows="5"><?php echo $this->_tpl_vars['cat'][0]['description']; ?>
</textarea>
                   </td>
		         </tr>
				 <tr valign="top">
			       <td><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
 Order: </strong> </td>
			       <td><input name=cat_order value="<?php echo $this->_tpl_vars['cat'][0]['ordervar']; ?>
">
</td>
		         </tr>
			     <tr valign="top">
			       <td><strong>Parent <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
:</strong></td>
			       
				   <td><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'avail_parent_cats', 'module' => $this->_tpl_vars['cur_cat_mod'], 'p_id' => $this->_tpl_vars['cat'][0]['parent'], 'id' => $this->_tpl_vars['cat'][0]['id'], 'owner' => $this->_tpl_vars['section_s'])), $this); ?>
 </td>
		         </tr>
			     <tr>
			       <td colspan="2"><input type=submit name=Submit value='Modify <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
'></td>
		         </tr>
      </table>				  
			   <p>
					<input type=hidden name=category_id value=<?php echo $this->_tpl_vars['id']; ?>
>
					<br>
	    </p>
	  <input type=hidden name=cat_id value="<?php echo $this->_tpl_vars['cat'][0]['id']; ?>
">
	  <input type=hidden name="cur_cat_mod" value="<?php echo $this->_tpl_vars['cur_cat_mod']; ?>
">
      <input type=hidden name=action value="edit_cat">
    </td>
  </tr>
</table></form>

</table>