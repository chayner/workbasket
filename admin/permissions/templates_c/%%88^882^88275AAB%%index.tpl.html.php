<?php /* Smarty version 2.6.9, created on 2005-08-10 13:15:25
         compiled from ./index.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'get_user_dropdown', './index.tpl.html', 7, false),array('insert', 'get_section_dropdown', './index.tpl.html', 10, false),array('insert', 'get_module_dropdown', './index.tpl.html', 13, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
        
<form method="post" action="submit.php" name="addpermission">
  <table width=600 border=0 cellspacing=0 cellpadding=5>
  <tr>
   <td width=150>
   		<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'get_user_dropdown')), $this); ?>

	</td>
    <td width=150>
      	<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'get_section_dropdown')), $this); ?>

	</td>
    <td width=150>
     	<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'get_module_dropdown')), $this); ?>

	</td>
    <td width=150>
      <input type=hidden name=action value=add>
      <input type=submit name=Submit value='Add Permission'>
    </td>
  </tr>
</table>
</form>

<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['permissions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
 if ($this->_tpl_vars['permissions'][$this->_sections['j']['index']]['user_id'] != $this->_tpl_vars['curuser']): ?>
	<?php if (! $this->_sections['j']['first']): ?></table><?php endif; ?>
	<?php $this->assign('curuser', $this->_tpl_vars['permissions'][$this->_sections['j']['index']]['user_id']); ?>
	<?php $this->assign('cursect', 0); ?>
	<?php $this->assign('modtype', 0); ?>
	 <table width=80% class="content" cellspacing=0 cellpadding=5>
	  <tr bgcolor="#000000">
    <td><font size="1"><?php echo $this->_tpl_vars['permissions'][$this->_sections['j']['index']]['user_name']; ?>
</font></td>
    <td width="175"><a href=submit.php?user_id=<?php echo $this->_tpl_vars['permissions'][$this->_sections['j']['index']]['user_id']; ?>
&action=userdelete><font size="1">delete all user permissions</font></a></td></tr>
<?php endif; ?>

<?php if ($this->_tpl_vars['permissions'][$this->_sections['j']['index']]['section_id'] != $this->_tpl_vars['cursect']): ?>
	<?php $this->assign('cursect', $this->_tpl_vars['permissions'][$this->_sections['j']['index']]['section_id']); ?>	
	<tr bgcolor="#333333">
	<td><font size="1">&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['permissions'][$this->_sections['j']['index']]['section_name']; ?>
</font></td>
	<td><a href=submit.php?user_id=<?php echo $this->_tpl_vars['permissions'][$this->_sections['j']['index']]['user_id']; ?>
&section_id=<?php echo $this->_tpl_vars['permissions'][$this->_sections['j']['index']]['section_id']; ?>
&action=sectdelete><font size="1">delete
	section permissions</font></a></td>
	</tr>
	<?php $this->assign('modtype', 0); ?> 
<?php endif; ?>
	
<?php if ($this->_tpl_vars['modtype'] == 0 && $this->_tpl_vars['permissions'][$this->_sections['j']['index']]['module_id'] < 50): ?>
	<tr bgcolor="#999999"> 
  <td><font size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['section_name']; ?>
 modules</font></td>
		<td><a href=submit.php?user_id=<?php echo $this->_tpl_vars['permissions'][$this->_sections['j']['index']]['user_id']; ?>
&module_id=<?php echo $this->_tpl_vars['permissions'][$this->_sections['j']['index']]['module_id']; ?>
&section_id=<?php echo $this->_tpl_vars['permissions'][$this->_sections['j']['index']]['section_id']; ?>
&action=sectmoddelete><font size="1">delete <?php echo $this->_tpl_vars['section_name']; ?>
 permissions</font></a></td>
		</tr>
	<?php $this->assign('modtype', 1); ?> 
<?php endif; ?>
	
	
<?php if ($this->_tpl_vars['permissions'][$this->_sections['j']['index']]['module_id'] > 49 && $this->_tpl_vars['modtype'] != 2): ?>
		<tr bgcolor="#999999">
  <td><font size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;config modules</font></td>
		<td><a href=submit.php?user_id=<?php echo $this->_tpl_vars['permissions'][$this->_sections['j']['index']]['user_id']; ?>
&section_id=<?php echo $this->_tpl_vars['permissions'][$this->_sections['j']['index']]['section_id']; ?>
&action=configmoddelete><font size="1">delete config permissions</font></a></td>
		</tr>
	<?php $this->assign('modtype', 2);  endif; ?>
	
<tr>
  <td><font size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['permissions'][$this->_sections['j']['index']]['module_name']; ?>
</font></td>
		<td><a href=submit.php?user_id=<?php echo $this->_tpl_vars['permissions'][$this->_sections['j']['index']]['user_id']; ?>
&module_id=<?php echo $this->_tpl_vars['permissions'][$this->_sections['j']['index']]['module_id']; ?>
&section_id=<?php echo $this->_tpl_vars['permissions'][$this->_sections['j']['index']]['section_id']; ?>
&action=delete><font size="1">delete module permissions</font></a></td>
		</tr>

<?php if ($this->_sections['j']['last']): ?></table><?php endif;  endfor; endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>