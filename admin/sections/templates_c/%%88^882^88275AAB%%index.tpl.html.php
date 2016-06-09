<?php /* Smarty version 2.6.9, created on 2010-03-01 08:04:41
         compiled from ./index.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', './index.tpl.html', 4, false),array('insert', 'listChildren', './index.tpl.html', 11, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 

<p align=center>
        <b><a href=new.php>add new <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
</a></b></p>
   
   <table width=100% class="content" cellspacing=0 cellpadding=5>
<tr bgcolor="#000000">
<td colspan=4 bgcolor=#000000> <b><?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
</b> </td>
</tr>

  <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'listChildren', 'parent_id' => 0, 'depth' => 0, 'owner' => $this->_tpl_vars['section_s'])), $this); ?>


</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>