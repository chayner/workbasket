<?php /* Smarty version 2.6.9, created on 2005-09-08 23:46:06
         compiled from ./index.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', './index.tpl.html', 4, false),array('insert', 'category_dropdown', './index.tpl.html', 11, false),array('insert', 'category_name', './index.tpl.html', 54, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 

<p align=center>
        <b><a href=new.php>add new <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
</a></b></p>
        
<table width=100% class="content" cellspacing=0 cellpadding=5>
  <tr> 
    <td colspan=3 bgcolor=#000000> <b><?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
</b> </td>
<?php if ($this->_tpl_vars['cur_mod']['cat_p']): ?>
	<td align=right bgcolor="#000000">
		<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'category_dropdown', 'cur_cat' => $this->_tpl_vars['cur_cat']['id'], 'module' => $this->_tpl_vars['module'])), $this); ?>

	</td>
<?php endif; ?>
  </tr>
  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['locations']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <tr valign=top> 
    <td width=5% align=center> <p><font size=1><a href=edit.php?id=<?php echo $this->_tpl_vars['locations'][$this->_sections['i']['index']]['id']; ?>
>edit</a><br>
    <a href=delete.php?id=<?php echo $this->_tpl_vars['locations'][$this->_sections['i']['index']]['id']; ?>
>delete</a></font></p>    </td>
    <td width="30%"> <p><b><font size=-1 class="title"><?php echo $this->_tpl_vars['locations'][$this->_sections['i']['index']]['title']; ?>
</font></b></p>
      <p> 	<?php if ($this->_tpl_vars['locations'][$this->_sections['i']['index']]['address1']): ?> 
        		<?php echo $this->_tpl_vars['locations'][$this->_sections['i']['index']]['address1']; ?>
 
			<?php endif; ?> 
			<?php if ($this->_tpl_vars['locations'][$this->_sections['i']['index']]['address2']): ?>
				<br><?php echo $this->_tpl_vars['locations'][$this->_sections['i']['index']]['address2']; ?>

			<?php endif; ?> 
        <?php if ($this->_tpl_vars['locations'][$this->_sections['i']['index']]['city']): ?> 
			<br><?php echo $this->_tpl_vars['locations'][$this->_sections['i']['index']]['city'];  if ($this->_tpl_vars['locations'][$this->_sections['i']['index']]['state']): ?>, <?php endif; ?>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['locations'][$this->_sections['i']['index']]['state']): ?>
			<?php echo $this->_tpl_vars['locations'][$this->_sections['i']['index']]['state']; ?>

		<?php endif; ?>
		<?php if ($this->_tpl_vars['locations'][$this->_sections['i']['index']]['zip']): ?> 
        	<?php echo $this->_tpl_vars['locations'][$this->_sections['i']['index']]['zip']; ?>

		<?php endif; ?> </font></i></p>    </td>
    <td width="40%">
		<p> 
		<?php if ($this->_tpl_vars['locations'][$this->_sections['i']['index']]['phone']): ?> <strong class="title">Phone:</strong> <br>
		<font size="1"><?php echo $this->_tpl_vars['locations'][$this->_sections['i']['index']]['phone']; ?>
</font><br><?php endif; ?>
	    <?php if ($this->_tpl_vars['locations'][$this->_sections['i']['index']]['fax']): ?> <strong class="title">Fax:</strong><br>
	    <font size="1"><?php echo $this->_tpl_vars['locations'][$this->_sections['i']['index']]['fax']; ?>
</font><br><?php endif; ?>
	    <?php if ($this->_tpl_vars['locations'][$this->_sections['i']['index']]['email']): ?> <strong class="title">Email:</strong><br>
	    <font size="1"><?php echo $this->_tpl_vars['locations'][$this->_sections['i']['index']]['email']; ?>
</font><br><?php endif; ?>
		<?php if ($this->_tpl_vars['locations'][$this->_sections['i']['index']]['url'] && ( $this->_tpl_vars['locations'][$this->_sections['i']['index']]['url'] != "http://" )): ?> <strong class="title">URL:</strong> <i><a href="<?php echo $this->_tpl_vars['locations'][$this->_sections['i']['index']]['url']; ?>
" target='_blank'><font size="1"><?php echo $this->_tpl_vars['locations'][$this->_sections['i']['index']]['url']; ?>
</font></a></i><?php endif; ?>
		</p>
    <?php if ($this->_tpl_vars['locations'][$this->_sections['i']['index']]['notes']): ?>
		
      <p><strong class="title">Notes:</strong> <?php echo $this->_tpl_vars['locations'][$this->_sections['i']['index']]['notes']; ?>
</p>
	<?php endif; ?>	</td>
    <?php if ($this->_tpl_vars['cur_mod']['cat_p']): ?>
<td width=25% valign="top">
	<strong class="title">Category:</strong>
	<br><font size="1">
	<?php if ($this->_tpl_vars['locations'][$this->_sections['i']['index']]['category'] > 0): ?>
		<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'category_name', 'modid' => $this->_tpl_vars['module'], 'id' => $this->_tpl_vars['locations'][$this->_sections['i']['index']]['category'])), $this); ?>

	<?php else: ?>
		<i>No Category Assigned</i>
	<?php endif; ?>
	</font>
</td>
<?php endif; ?>
  </tr>
  <?php endfor; else: ?> 
  <tr> 
    <td colspan=4><p>There are no items to display.</p></td>
  </tr>
  <?php endif; ?> 
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>