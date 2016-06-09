<?php /* Smarty version 2.6.9, created on 2005-08-06 14:29:55
         compiled from ./index.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', './index.tpl.html', 39, false),array('insert', 'listChildren', './index.tpl.html', 59, false),)), $this); ?>
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
var agree=confirm("Deleting a category will cause all items within that category to become unassigned.  Are you sure you wish to delete this category?");
if (agree)
	return true ;
else
	return false ;
}
// -->
</script>
'; ?>


<form>
<select name="category" onChange="MM_jumpMenu('parent',this,0)">
 	<?php if (! $this->_tpl_vars['module']): ?>
	<option value="">Please choose a module.</option>
	<?php else: ?>
	<option value="<?php echo $this->_tpl_vars['thispage']; ?>
?cur_cat_mod=<?php echo $this->_tpl_vars['cur_cat_mod']; ?>
"><?php echo $this->_tpl_vars['cur_cat_mod_name']; ?>
</option>
	<?php endif; ?>
	<option value="">----------</option>
	<?php unset($this->_sections['i']);
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
		<option value="<?php echo $this->_tpl_vars['thispage']; ?>
?cur_cat_mod=<?php echo $this->_tpl_vars['modules'][$this->_sections['i']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['modules'][$this->_sections['i']['index']]['name']; ?>
</option>
	<?php endfor; endif; ?>		

</select>

</form>


<form method=post action="submit.php">
  <table width=600 border=0 cellspacing=0 cellpadding=5>
  <tr>
   <td width=150><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
 Name: </strong><br><input name=cat_name size="45">
   </td>
   <td width=150>
      <input type=hidden name=action value="add_cat">
  	  <input type=hidden name="cur_cat_mod" value="<?php echo $this->_tpl_vars['cur_cat_mod']; ?>
">
      <input type=submit name=Submit value='Add <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
'>
    </td>
  </tr>
</table></form>
<p><a href="<?php echo $this->_tpl_vars['admindir'];  echo $this->_tpl_vars['cur_cat_mod_path']; ?>
">back to <?php echo $this->_tpl_vars['cur_cat_mod_name']; ?>
 admin</a></p>

<!-- Existing Categories -->
<p>
<table width=100% class="content" cellspacing=0 cellpadding=5>
<tr><td><font size="1">&nbsp;</font></td>
<td><font size="1">&nbsp;</font></td>
<td><font size="1"><strong>Name</strong></font></td>
<td><p><font size="1"><strong>Order (if applicable)</strong></font></p>
  </td>
</tr>
<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'listChildren', 'parent_id' => 0, 'cur_cat_mod' => $this->_tpl_vars['cur_cat_mod'], 'depth' => 0, 'owner' => $this->_tpl_vars['section_s'])), $this); ?>


</table>