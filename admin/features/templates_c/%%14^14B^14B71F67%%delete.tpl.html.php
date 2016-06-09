<?php /* Smarty version 2.6.9, created on 2006-01-28 14:12:30
         compiled from ./delete.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', './delete.tpl.html', 6, false),array('modifier', 'capitalize', './delete.tpl.html', 8, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 

<div align=left><hr><b><?php echo $this->_tpl_vars['features'][0]['title']; ?>
</b>
 	  <p><?php echo $this->_tpl_vars['features'][0]['body']; ?>
<hr></div>

<p>Are you sure that you want to delete this <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
?

<p><a href="submit.php?id=<?php echo $this->_tpl_vars['id']; ?>
&action=delete">Yes, Delete this <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</a>
<p><a href="index.php?feedback=Delete Canceled.">No, Cancel my Delete</a>

</table>