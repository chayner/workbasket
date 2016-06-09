<?php /* Smarty version 2.6.9, created on 2005-09-05 11:21:47
         compiled from ./form.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', './form.tpl.html', 6, false),array('modifier', 'lower', './form.tpl.html', 48, false),array('insert', 'category_select', './form.tpl.html', 40, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 

<p><img src="/photos/<?php echo $this->_tpl_vars['id']; ?>
.jpg"><br>

<br>
<?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
 Information:<br>
  <form method="post" enctype="multipart/form-data"  action="submit.php">
    	 <table>		
			<tr>
               <td width=60 valign=top>
                   <p>
                   Caption:
               </td>
               <td>
                   <textarea name=caption cols=40 rows=4><?php echo $this->_tpl_vars['photos'][0]['caption']; ?>
</textarea>
			   </td>
           </tr>
           <tr>
               <td>
                   Photographer:
               </td>
               <td>
                   <input type=text name=author size=50 value="<?php echo $this->_tpl_vars['photos'][0]['author']; ?>
"><br>
               </td>
           </tr>
           <tr>
               <td>
                   Copyright Information:
               </td>
               <td>
                   &copy; <input type=text name=copyright size=50 value="<?php echo $this->_tpl_vars['photos'][0]['copyright']; ?>
"><br>
               </td>
           </tr>

			<?php if ($this->_tpl_vars['cur_mod']['cat_p']): ?>
			<tr>
		     <td colspan="2" valign="top"><hr></td>
	       </tr><tr valign="top"> 
				<td width="175"> Item <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['cat_name'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
:</td>
				<td><?php if ($this->_tpl_vars['cat']):  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'category_select', 'module' => $this->_tpl_vars['module'], 'cur_cat' => $this->_tpl_vars['cat'])), $this);  else:  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'category_select', 'module' => $this->_tpl_vars['module'], 'cur_cat' => $this->_tpl_vars['photos'][0]['category'])), $this);  endif; ?></td>
			</tr>
			<?php endif; ?>
	       <tr>
	         <td colspan="2"><hr></td>
           </tr>
	       <tr>
		<td>
			<p>Replace <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>

			<br>with a new image:</p>
			<?php if ($this->_tpl_vars['message'] == 1): ?>
				<font size=2 color=red><b>The file you selected is not a valid <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
.</b></font><hr>
			<?php endif; ?>
		</td>
		<td>
                    <input type="file" name="source_file">
					<INPUT TYPE=hidden name=MAX_FILE_SIZE value=20000000><br><br>
                    <input type=hidden name=photo_filename value="<?php echo $this->_tpl_vars['photos'][0]['filename']; ?>
">
					
             </td>
           </tr>
	 </table>
	 
     <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
">
	 <input type="hidden" name="action" value="edit">
     <input type="submit" value="Submit <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
">
  </form>

</table>