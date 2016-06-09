<?php /* Smarty version 2.6.9, created on 2014-12-30 00:54:40
         compiled from cart.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'store_trail', 'cart.tpl.html', 3, false),)), $this); ?>
<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr valign="middle"><td class="leftbarcategory"><a href="/store/"><?php echo $this->_tpl_vars['sitename']; ?>
 store</a>  <?php if ($this->_tpl_vars['parent_cat']): ?>> <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'store_trail', 'id' => $this->_tpl_vars['parent_cat'][0]['id'])), $this);  endif; ?></td>
    <td align="right" class="leftbarcategory"><input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="business" value="<?php echo $this->_tpl_vars['paypal_email']; ?>
">
<input type="image" src="/store/cart.gif" border="0" name="submit" alt="PayPal Cart" height="20">
<input type="hidden" name="display" value="1"></td>
  </tr><tr><td colspan="2"><hr noshade color="#000000"></td></tr></table>
</form>