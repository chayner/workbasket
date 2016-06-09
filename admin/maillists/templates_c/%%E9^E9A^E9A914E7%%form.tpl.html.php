<?php /* Smarty version 2.6.9, created on 2005-09-08 10:38:35
         compiled from ./form.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', './form.tpl.html', 6, false),array('modifier', 'lower', './form.tpl.html', 12, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 

<form name=maillist_edit method=post action="submit.php">
  <table width=100% border=0 cellspacing=0 cellpadding=10>
  <tr valign=top>
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
 Title:</td>
    <td>
      <input type=text name=title size=35 value="<?php echo $this->_tpl_vars['maillists'][0]['title']; ?>
">
    </td>
  </tr>
  <tr valign=top>
    <td>Brief summary of the <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
 (try to keep this pretty short):</td>
    <td>
      <textarea name=summary cols=40 rows=5><?php echo $this->_tpl_vars['maillists'][0]['summary']; ?>
</textarea>
    </td>
  </tr>
  <tr valign=top>
    <td>Email of the <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
:
		<br><i>This will appear as the "From" address.</i></td>
    <td>
      <input type=text name=email size=35 value="<?php echo $this->_tpl_vars['maillists'][0]['email']; ?>
">
    </td>
  </tr>
    <tr align="center" valign=top> 
      <td colspan=2> 
        <input type=hidden name=action value="<?php echo $this->_tpl_vars['action']; ?>
">
	  <input type=hidden name=id value="<?php echo $this->_tpl_vars['maillists'][0]['id']; ?>
">
	  <input type=submit name=Submit value="<?php echo $this->_tpl_vars['action']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
">
      </td>
  </tr>
</table>
</form>

</table>