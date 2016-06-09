<?php /* Smarty version 2.6.9, created on 2014-12-30 00:54:40
         compiled from index.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'find_item', 'index.tpl.html', 28, false),array('modifier', 'aslash', 'index.tpl.html', 36, false),array('modifier', 'lower', 'index.tpl.html', 36, false),)), $this); ?>
<?php echo '
<script language="JavaScript" type="text/JavaScript">
<!--

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location=\'"+selObj.options[selObj.selectedIndex].value+"\'");
  if (restore) selObj.selectedIndex=0;
}

oldImage=\'spacer.gif\'
function chng(newImage) { 
	if (document.mainimage.src.indexOf(oldImage)!= -1) 
		document.mainimage.src = newImage;
	else 
		document.mainimage.src = newImage;
} 


//-->
</script>
'; ?>

<table border="0" cellpadding="10" cellspacing="0" width="100%">
<tr><td colspan="2">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cart.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</td></tr>
  <tr> 
    <td align="center" colspan="2"><?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['children']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?> 
	<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'find_item', 'cat' => $this->_tpl_vars['children'][$this->_sections['j']['index']]['id'], 'catname' => $this->_tpl_vars['children'][$this->_sections['j']['index']]['name'])), $this); ?>

	<?php endfor; endif; ?> 
	  
<?php if ($this->_tpl_vars['children'] && $this->_tpl_vars['merchandise']): ?>
  <tr><td colspan="2"><hr noshade color="#000000"></td></tr>
<?php endif; ?> 

<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['merchandise']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<tr valign="top"><td align="center"><a href="item_info.php?id=<?php echo $this->_tpl_vars['merchandise'][$this->_sections['i']['index']]['id']; ?>
"><img src="/photos/merch_<?php echo $this->_tpl_vars['merchandise'][$this->_sections['i']['index']]['id']; ?>
.jpg" alt="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['merchandise'][$this->_sections['i']['index']]['caption'])) ? $this->_run_mod_handler('aslash', true, $_tmp) : addslashes($_tmp)))) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
" width="125" border=0></a><br>
</td><td>
  <p><i><font size="1">Item ID: <?php echo $this->_tpl_vars['merchandise'][$this->_sections['i']['index']]['id']; ?>
<br>
    </font></i><strong><font size="3"><?php echo $this->_tpl_vars['merchandise'][$this->_sections['i']['index']]['name']; ?>
</font></strong> <br>
    <em><font size="2"><?php echo $this->_tpl_vars['merchandise'][$this->_sections['i']['index']]['subname']; ?>
</font></em>
                      <?php if ($this->_tpl_vars['merchandise'][$this->_sections['i']['index']]['lprice'] != 0 || $this->_tpl_vars['merchandise'][$this->_sections['i']['index']]['sprice'] != 0): ?>
	  <p><strong>List:</strong> <s>$<?php echo $this->_tpl_vars['merchandise'][$this->_sections['i']['index']]['lprice']; ?>
</s><br>
                          <strong>Sale:</strong> $<?php echo $this->_tpl_vars['merchandise'][$this->_sections['i']['index']]['sprice']; ?>
      
						<?php endif; ?>              
      <?php if ($this->_tpl_vars['merchandise'][$this->_sections['i']['index']]['copyright']): ?><p><i>&copy; <?php echo $this->_tpl_vars['merchandise'][$this->_sections['i']['index']]['copyright']; ?>
</i></p><?php endif; ?>
	  <p><a href="item_info.php?id=<?php echo $this->_tpl_vars['merchandise'][$this->_sections['i']['index']]['id']; ?>
">more info</a></p>
      </td>
  </tr>
  <tr>
  <td colspan="2"><hr noshade color="#000000">
  </td>
  </tr>
  
  <?php endfor; endif; ?>
</table>