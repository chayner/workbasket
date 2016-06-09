<?php /* Smarty version 2.6.9, created on 2005-08-06 12:20:25
         compiled from index.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', 'index.tpl.html', 15, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 

<table cellspacing=5>
<?php $this->assign('lineshown', 'false');  unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['modules']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	
	<?php if ($this->_tpl_vars['modules'][$this->_sections['i']['index']]['id'] >= 50 && $this->_tpl_vars['lineshown'] == 'false'): ?>
	<tr><td colspan=2><hr></td>
	</tr>
	<?php $this->assign('lineshown', 'true'); ?>
	<?php endif; ?>
	<tr><td align="right">
	<strong>[<a href="<?php echo $this->_tpl_vars['admindir'];  echo $this->_tpl_vars['modules'][$this->_sections['i']['index']]['path']; ?>
" class="title"><?php echo $this->_tpl_vars['modules'][$this->_sections['i']['index']]['name']; ?>
</a>]</strong> 
	</td>
	<td><?php echo ((is_array($_tmp=$this->_tpl_vars['modules'][$this->_sections['i']['index']]['description'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>

	</td>
	</tr>

<?php endfor; endif; ?>
</table>