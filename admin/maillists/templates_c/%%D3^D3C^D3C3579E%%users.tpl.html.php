<?php /* Smarty version 2.6.9, created on 2005-08-06 12:54:24
         compiled from ./users.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'numUsers', './users.tpl.html', 24, false),array('modifier', 'date_format', './users.tpl.html', 56, false),array('modifier', 'capitalize', './users.tpl.html', 63, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 

<?php echo '
<script LANGUAGE="JavaScript">
<!--
// Nannette Thacker http://www.shiningstar.net
function confirmSubmit()
{
var agree=confirm("Are you sure you wish to delete this user?");
if (agree)
	return true ;
else
	return false ;
}
// -->
</script>
'; ?>


<table width=100% border=0 cellspacing=0 cellpadding=0>
  				<tr> 
    				<td valign=top><p><strong class=title><?php echo $this->_tpl_vars['maillist'][0]['title']; ?>
</strong><br>
        				<?php echo $this->_tpl_vars['maillist'][0]['summary']; ?>
</p>
      					<p><em>From: <?php echo $this->_tpl_vars['maillist'][0]['email']; ?>
</em></p></td>
    				<td valign=top><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'numUsers', 'id' => $this->_tpl_vars['maillist'][0]['id'])), $this); ?>
 Subscriptions</td>
			  </tr>
</table>
	  		<p></p>		
			<table width=100% class="content" cellspacing=0 cellpadding=5>
			  <tr>
				<td bgcolor=#000000><a href="<?php echo $this->_tpl_vars['thispage']; ?>
?list_id=<?php echo $this->_tpl_vars['id']; ?>
&ord=lname">Last Name</a></td>
				<td bgcolor=#000000><a href="<?php echo $this->_tpl_vars['thispage']; ?>
?list_id=<?php echo $this->_tpl_vars['id']; ?>
&ord=fname">First Name</a></td>
				<td bgcolor=#000000><a href="<?php echo $this->_tpl_vars['thispage']; ?>
?list_id=<?php echo $this->_tpl_vars['id']; ?>
&ord=email">Email Address</a></td>
				<td bgcolor=#000000><a href="<?php echo $this->_tpl_vars['thispage']; ?>
?list_id=<?php echo $this->_tpl_vars['id']; ?>
&ord=zip">Zip Code</a></td>
				<td bgcolor=#000000><a href="<?php echo $this->_tpl_vars['thispage']; ?>
?list_id=<?php echo $this->_tpl_vars['id']; ?>
&ord=created_on">Joined</a></td>
				<td bgcolor=#000000>&nbsp;</td>
			  </tr>
			  <form name=user_edit method=post action=submit.php>
			  <tr>
			  	<td><input name=lname type=text size="15"></td>
			  	<td><input name=fname type=text size="15"></td>
			  	<td><input name=email type=text size="25"></td>
				<td><input name=zip type=text size="10"></td>
				<td>&nbsp;</td>
				<td><input name=list_id type=hidden value=<?php echo $this->_tpl_vars['maillist'][0]['id']; ?>
>
					<input name=action type=hidden value="user_add">
					<input name=submit value="Add User" type=submit></td>
			  </tr>
			  </form>
		  
			<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['users']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<td><font size="1"><?php echo $this->_tpl_vars['users'][$this->_sections['i']['index']]['lname']; ?>
</font></td>
				<td><font size="1"><?php echo $this->_tpl_vars['users'][$this->_sections['i']['index']]['fname']; ?>
</font></td>
				<td><font size="1"><?php echo $this->_tpl_vars['users'][$this->_sections['i']['index']]['email']; ?>
</font></td>
				<td><font size="1"><?php echo $this->_tpl_vars['users'][$this->_sections['i']['index']]['zip']; ?>
</font></td>
				<td><font size="1"><?php echo ((is_array($_tmp=$this->_tpl_vars['users'][$this->_sections['i']['index']]['created_on'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%b %d, %Y") : smarty_modifier_date_format($_tmp, "%b %d, %Y")); ?>
</font></td>
				<td><a href=submit.php?action=user_del&user_id=<?php echo $this->_tpl_vars['users'][$this->_sections['i']['index']]['id']; ?>
&list_id=<?php echo $this->_tpl_vars['maillist'][0]['id']; ?>
 onClick="return confirmSubmit()">remove</a></td>
			  </tr>
			 <?php endfor; endif; ?>

	</table>
	<p>
	<div align=center><a href=index.php>Return to <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['name'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
 Admin Page</a></div>


</table>