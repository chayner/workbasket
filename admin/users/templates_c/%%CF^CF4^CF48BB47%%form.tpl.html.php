<?php /* Smarty version 2.6.9, created on 2005-08-10 13:15:02
         compiled from form.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/header.tpl.html", 'smarty_include_vars' => array('title' => 'users','page' => 'users')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 

<form name=users_iitem method=post action="submit.php">
  <table border=0 cellspacing=0 cellpadding=10>
    <tr valign=top> 
      <td>Real Name:</td>
      <td> <input name=real_name type=text id="real_name" value="<?php echo $this->_tpl_vars['users'][0]['real_name']; ?>
" size=35> 
      </td>
    </tr>
    <tr valign=top> 
      <td>User Name:</td>
      <td> <input name=user_name type=text id="user_name" value="<?php echo $this->_tpl_vars['users'][0]['user_name']; ?>
" size=35> 
      </td>
    </tr>
    <tr valign=top> 
      <td>Email:</td>
      <td><input name=email type=text id="email" value="<?php echo $this->_tpl_vars['users'][0]['email']; ?>
" size=35></td>
    </tr>
	<tr valign="top">
		<td>Password:</td>
		<td><input name="password" type=text id="password" value="<?php echo $this->_tpl_vars['user'][0]['password']; ?>
" size="35"></td>
	</tr>
    <tr align="center" valign=top> 
      <td colspan=2> <input type=hidden name=action value="<?php echo $this->_tpl_vars['action']; ?>
"> <input type=hidden name=id value="<?php echo $this->_tpl_vars['id']; ?>
">	
        <input type=submit name=Submit value="<?php echo $this->_tpl_vars['action']; ?>
 user"> </td>
    </tr>
  </table>
</form>

</table>