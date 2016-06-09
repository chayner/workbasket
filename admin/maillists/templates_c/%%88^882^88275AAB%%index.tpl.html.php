<?php /* Smarty version 2.6.9, created on 2005-08-06 12:53:47
         compiled from ./index.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', './index.tpl.html', 4, false),array('insert', 'numUsers', './index.tpl.html', 25, false),array('insert', 'cur_email_p', './index.tpl.html', 32, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 

<?php if ($this->_tpl_vars['cur_mod']['add_del']): ?><p align=center>
        <b><a href=new.php>add new <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
</a></b></p><?php endif; ?>
        <table width=100% class="content" cellspacing=0 cellpadding=5>
        <tr>
           <td bgcolor=#000000 colspan=6>
              <b><?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
</b>
           </td>
        </tr>

<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['maillists']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                <td width=5% align=center>
                    <p><a href=edit.php?id=<?php echo $this->_tpl_vars['maillists'][$this->_sections['i']['index']]['id']; ?>
><font size="1">edit</font></a>
					<?php if ($this->_tpl_vars['cur_mod']['add_del']): ?><br><font size=1><a href=delete.php?id=<?php echo $this->_tpl_vars['maillists'][$this->_sections['i']['index']]['id']; ?>
>delete</a></font></p><?php endif; ?></td>
                <td>
                    <p><b><font size=-1 class="title"><?php echo $this->_tpl_vars['maillists'][$this->_sections['i']['index']]['title']; ?>
</font></b>
					<br><font size=1><?php echo $this->_tpl_vars['maillists'][$this->_sections['i']['index']]['summary']; ?>
</font>
					
      <p><i><?php echo $this->_tpl_vars['maillists'][$this->_sections['i']['index']]['email']; ?>
</i></p>
                </td>
				<td width=25% align=center valign=middle>
					<font size="1"><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'numUsers', 'id' => $this->_tpl_vars['maillists'][$this->_sections['i']['index']]['id'])), $this); ?>
 Subscriptions </font>				  <p>
               		  <font size="1"><a href=users.php?list_id=<?php echo $this->_tpl_vars['maillists'][$this->_sections['i']['index']]['id']; ?>
>Edit Users</a>
					  <br>
					  <a href=csv.php?list_id=<?php echo $this->_tpl_vars['maillists'][$this->_sections['i']['index']]['id']; ?>
>Export list to CSV file</a>
					  </font>
					<p>		
				<font size="1">
					<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'cur_email_p', 'id' => $this->_tpl_vars['maillists'][$this->_sections['i']['index']]['id'])), $this); ?>

					<?php if ($this->_tpl_vars['maillists'][$this->_sections['i']['index']]['id'] == $this->_tpl_vars['current_email']['list_id']): ?>
					<p><strong>There is a message written but not yet sent!</strong></p>
					<a href=send.php?list_id=<?php echo $this->_tpl_vars['maillists'][$this->_sections['i']['index']]['id']; ?>
>Edit Message</a> | <a href=submit.php?action=cancel&list_id=<?php echo $this->_tpl_vars['maillists'][$this->_sections['i']['index']]['id']; ?>
>Cancel Message</a> 
					 <?php else: ?>
						<a href=send.php?list_id=<?php echo $this->_tpl_vars['maillists'][$this->_sections['i']['index']]['id']; ?>
>Send New Email to List</a>
                      <?php endif; ?> </font>
      	  </td>
		  </tr>

	<?php endfor; else: ?>
        <tr><td colspan="3"><p>There are no items to display.</p></td></tr>
	<?php endif; ?>

</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>