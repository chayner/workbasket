<?php /* Smarty version 2.6.9, created on 2005-08-24 12:13:25
         compiled from ./index.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', './index.tpl.html', 3, false),array('insert', 'category_dropdown', './index.tpl.html', 13, false),array('insert', 'category_name', './index.tpl.html', 50, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 

<p align=center><a href="new.php<?php if ($this->_tpl_vars['cur_cat']['id'] > 0): ?>?cat=<?php echo $this->_tpl_vars['cur_cat']['id'];  endif; ?>"><strong>add a new <?php if ($this->_tpl_vars['cur_cat']['id'] > 0):  echo ((is_array($_tmp=$this->_tpl_vars['cur_cat']['name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp));  endif; ?> <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
</strong></a></p>
<p align=center><font size="1"><a href="import.php"><strong>import multiple photos</strong></a><strong> | <a href="redo_thumbs.php?c=<?php if ($this->_tpl_vars['c']):  echo $this->_tpl_vars['c'];  else: ?>0<?php endif; ?>">rebuild thumbnails</a></strong></font></p>
<table width=100% class="content" cellspacing=0 cellpadding=3>
			<tr>
			  <td bgcolor=#000000 colspan=3>
			  <strong><?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
 <?php if ($this->_tpl_vars['cur_cat']['id'] != -1): ?> - <?php echo $this->_tpl_vars['cur_cat']['name'];  endif; ?></strong> 
			  <?php if ($this->_tpl_vars['cur_cat']['id'] != -1): ?><a href="delcat.php?cat=<?php echo $this->_tpl_vars['cur_cat']['id']; ?>
"><font color="#FFFFFF" size="1">(delete all photos in this category)</font></a><?php endif; ?>
			  </td>
			  <?php if ($this->_tpl_vars['cur_mod']['cat_p']): ?>
				<td align=right bgcolor="#000000">
					<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'category_dropdown', 'cur_cat' => $this->_tpl_vars['cur_cat']['id'], 'module' => $this->_tpl_vars['module'])), $this); ?>

				</td>
			<?php endif; ?>
			</tr>


                 
		<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['photos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<tr>
			   <td width=5% align=center valign=top>
			  <p><a href="edit.php?id=<?php echo $this->_tpl_vars['photos'][$this->_sections['i']['index']]['id']; ?>
"><font size="1">edit</font></a><font size="1"><br>
		      <a href="delete.php?id=<?php echo $this->_tpl_vars['photos'][$this->_sections['i']['index']]['id']; ?>
">delete</a></font></p>			  </td>

			   
               <td width=20% align=center valign=top> <a href=edit.php?id=<?php echo $this->_tpl_vars['photos'][$this->_sections['i']['index']]['id']; ?>
> 
      <img src=/thumbs/<?php echo $this->_tpl_vars['photos'][$this->_sections['i']['index']]['id']; ?>
.jpg border="0"> </a> </td>
               <td width=50% valign=top>
			   		<p><i>Photo ID: <?php echo $this->_tpl_vars['photos'][$this->_sections['i']['index']]['id']; ?>
</i>
					<br><i>(<?php echo $this->_tpl_vars['photos'][$this->_sections['i']['index']]['width']; ?>
 x <?php echo $this->_tpl_vars['photos'][$this->_sections['i']['index']]['height']; ?>
)</i>
					<p><?php echo $this->_tpl_vars['photos'][$this->_sections['i']['index']]['caption']; ?>
				 <p>
						 	
  				    <?php if ($this->_tpl_vars['photos'][$this->_sections['i']['index']]['author']): ?>
                       <i><?php echo $this->_tpl_vars['photos'][$this->_sections['i']['index']]['author']; ?>
</i><br>
                    <?php endif; ?>

  				    <?php if ($this->_tpl_vars['photos'][$this->_sections['i']['index']]['copyright']): ?>
                       <i>&copy; <?php echo $this->_tpl_vars['photos'][$this->_sections['i']['index']]['copyright']; ?>
</i>
					<p>
                     <?php endif; ?>

			  </td>
				
			<?php if ($this->_tpl_vars['cur_mod']['cat_p']): ?>
			<td width=25% valign="top">
				<strong class="title">Category:</strong>
				<br><font size="1">
				<?php if ($this->_tpl_vars['photos'][$this->_sections['i']['index']]['category'] > 0): ?>
					<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'category_name', 'modid' => $this->_tpl_vars['module'], 'id' => $this->_tpl_vars['photos'][$this->_sections['i']['index']]['category'])), $this); ?>

				<?php else: ?>
					<i>No Category Assigned</i>
				<?php endif; ?>
				</font>
			</td>
			<?php endif; ?>
			</tr>
	<?php endfor; else: ?>
        <tr><td colspan="4"><p>There are no items to display.</p></td></tr>
	<?php endif; ?>
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>