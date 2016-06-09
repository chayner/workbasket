<?php /* Smarty version 2.6.9, created on 2007-10-11 21:52:45
         compiled from free.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'rtrim', 'free.tpl.html', 25, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array('page' => 'free')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 


<table width="100%" cellpadding="5" class="links_main_table" >
  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['downloads']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		
		<td rowspan="2" align="center" valign="top">
		<?php if ($this->_tpl_vars['downloads'][$this->_sections['i']['index']]['image_id']): ?>
		<img src="/photos/image_<?php echo $this->_tpl_vars['downloads'][$this->_sections['i']['index']]['image_id']; ?>
.jpg" width="150">
		<?php endif; ?>
		</td>
		<td height="20" valign="top">
			<?php if ($this->_tpl_vars['downloads'][$this->_sections['i']['index']]['title']): ?>
				<strong class="links_main_title"><?php echo $this->_tpl_vars['downloads'][$this->_sections['i']['index']]['title']; ?>
</strong>
			<?php endif; ?>
		</td>
		<td align="right" rowspan="2" valign="top">
		<p><strong><a href="/getfile?<?php echo $this->_tpl_vars['downloads'][$this->_sections['i']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['user_browser'] == 'ie'): ?>target="_blank"<?php endif; ?>>download <?php echo $this->_tpl_vars['downloads'][$this->_sections['i']['index']]['extension']; ?>
</a></strong>
		<br><em><?php echo $this->_tpl_vars['downloads'][$this->_sections['i']['index']]['sizestring']; ?>
</em></p>
		</td>
	</tr>
	<tr>
		<td valign="top">
		<?php if (((is_array($_tmp=$this->_tpl_vars['downloads'][$this->_sections['i']['index']]['description'])) ? $this->_run_mod_handler('rtrim', true, $_tmp) : rtrim($_tmp))): ?>
			<?php echo ((is_array($_tmp=$this->_tpl_vars['downloads'][$this->_sections['i']['index']]['description'])) ? $this->_run_mod_handler('rtrim', true, $_tmp) : rtrim($_tmp)); ?>
<br>
		<?php endif; ?>
		</td>
	</tr> 
	<?php endfor; endif; ?>
</table>
	
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl.html", 'smarty_include_vars' => array('page' => 'downloads')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>