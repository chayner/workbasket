<?php /* Smarty version 2.6.9, created on 2005-08-06 12:20:19
         compiled from login.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 

	<P>
	Enter your user name and password and we'll set a cookie so we know you're logged in.
	<P>
	<FORM ACTION="<?php echo $this->_tpl_vars['thispage']; ?>
" METHOD="POST">
	<B>User Name:</B><BR>
	<INPUT TYPE="TEXT" NAME="user_name" VALUE="" SIZE="10" MAXLENGTH="15">
	<P>
	<B>Password:</B><BR>
	<INPUT TYPE="password" NAME="password" VALUE="" SIZE="10" MAXLENGTH="15">
	<P>
	<INPUT TYPE="SUBMIT" NAME="submit" VALUE="Login">
	</FORM>
	<P>

<span class="title">If you've forgotten your password, please fill out <a href=lostpass.php>this form</a> to get your password reset.</span>