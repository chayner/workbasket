<?php /* Smarty version 2.6.9, created on 2005-08-06 12:20:29
         compiled from ./index.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/header.tpl.html", 'smarty_include_vars' => array('title' => 'modules','page' => 'modules')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 

<p align=center>
        <b><a href=new.php>add a new <?php echo $this->_tpl_vars['cur_mod']['item']; ?>
</a></b></p>
        
<table width=100% class="content" cellspacing=0 cellpadding=5>
  <tr> 
    <td colspan=9 bgcolor=#000000> <b>modules</b> </td>
  </tr>
  <tr bgcolor=#999999> 
    <td width=40> <div align=center><strong><font size="1">&nbsp;</font></strong></div></td>
    <td> <div align=center><strong><font size="1"> <a href="<?php echo $this->_tpl_vars['thispage']; ?>
?ord=id">id</a></font></strong></div></td>
    <td><strong><font size="1"><a href="<?php echo $this->_tpl_vars['thispage']; ?>
?ord=name">name</a></font></strong></td>
    <td><strong><font size="1">description</font></strong></td>
    <td><strong><font size="1">item name</font></strong></td>
    <td><strong><font size="1">category</font></strong></td>
    <td align="center"><font size="1"><strong>imgs</strong></font></td>
    <td align="center"><strong><font size="1">a/d</font></strong></td>
    <td align="center"><strong><font size="1">pub</font></strong></td>
  </tr>
  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['module_list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <tr valign="top"> 
    <td width=5%> <div align=center> 
       <a href=edit.php?id=<?php echo $this->_tpl_vars['module_list'][$this->_sections['i']['index']]['id']; ?>
><font size="1">edit</font></a><font size="1"><br>
            <a href=delete.php?id=<?php echo $this->_tpl_vars['module_list'][$this->_sections['i']['index']]['id']; ?>
>delete</a></font>
        </div></td>
    <td width=5% align=center><font size="1"><?php echo $this->_tpl_vars['module_list'][$this->_sections['i']['index']]['id']; ?>
</font></td>
    <td width=10%><a href=edit.php?id=<?php echo $this->_tpl_vars['module_list'][$this->_sections['i']['index']]['id']; ?>
><font size="1"><strong><?php echo $this->_tpl_vars['module_list'][$this->_sections['i']['index']]['name']; ?>
</strong></font></a></td>
    <td><font size="1"><strong class="title"><font size="1">Description:</font></strong> <?php echo $this->_tpl_vars['module_list'][$this->_sections['i']['index']]['description']; ?>
<br>
    <strong class="title"><font size="1">Item: </font></strong><?php echo $this->_tpl_vars['module_list'][$this->_sections['i']['index']]['item']; ?>
</font><br></td>
    <td><font size="1"><strong class="title"><font size="1">Path: </font></strong><?php echo $this->_tpl_vars['module_list'][$this->_sections['i']['index']]['path']; ?>
<br>
        <strong class="title"><font size="1">Table: </font></strong><?php echo $this->_tpl_vars['module_list'][$this->_sections['i']['index']]['dbtable']; ?>

		<?php if ($this->_tpl_vars['configs'][0]['multisection']): ?><br><strong class="title"><font size="1">Scope: </font></strong><?php if ($this->_tpl_vars['module_list'][$this->_sections['i']['index']]['global_mod']): ?>global<?php else: ?>specific<?php endif; ?></font><?php endif; ?></td>
    <td><font size="1"><?php if ($this->_tpl_vars['module_list'][$this->_sections['i']['index']]['cat_p'] == 1): ?><a href="<?php echo $this->_tpl_vars['thispage']; ?>
?action=catno&id=<?php echo $this->_tpl_vars['module_list'][$this->_sections['i']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['module_list'][$this->_sections['i']['index']]['cat_name']; ?>
</a><?php else: ?><a href="<?php echo $this->_tpl_vars['thispage']; ?>
?action=catyes&id=<?php echo $this->_tpl_vars['module_list'][$this->_sections['i']['index']]['id']; ?>
">n/a</a><?php endif; ?></font></td>
    <td align="center"><font size="1"><?php if ($this->_tpl_vars['module_list'][$this->_sections['i']['index']]['imgs_p'] == 0): ?><strong><a href="<?php echo $this->_tpl_vars['thispage']; ?>
?action=imgsyes&id=<?php echo $this->_tpl_vars['module_list'][$this->_sections['i']['index']]['id']; ?>
">No</a></strong><?php else: ?><strong><a href="<?php echo $this->_tpl_vars['thispage']; ?>
?action=imgsno&id=<?php echo $this->_tpl_vars['module_list'][$this->_sections['i']['index']]['id']; ?>
">Yes</a></strong><?php endif; ?></font></td>
    <td align="center"><font size="1"><?php if ($this->_tpl_vars['module_list'][$this->_sections['i']['index']]['add_del'] == 0): ?><strong><a href="<?php echo $this->_tpl_vars['thispage']; ?>
?action=adyes&id=<?php echo $this->_tpl_vars['module_list'][$this->_sections['i']['index']]['id']; ?>
">No</a></strong><?php else: ?><strong><a href="<?php echo $this->_tpl_vars['thispage']; ?>
?action=adno&id=<?php echo $this->_tpl_vars['module_list'][$this->_sections['i']['index']]['id']; ?>
">Yes</a></strong><?php endif; ?></font></td>
    <td align="center"><font size="1"><?php if ($this->_tpl_vars['module_list'][$this->_sections['i']['index']]['public'] == 0): ?><a href="<?php echo $this->_tpl_vars['thispage']; ?>
?action=show&id=<?php echo $this->_tpl_vars['module_list'][$this->_sections['i']['index']]['id']; ?>
">No</a><?php else: ?><a href="<?php echo $this->_tpl_vars['thispage']; ?>
?action=hide&id=<?php echo $this->_tpl_vars['module_list'][$this->_sections['i']['index']]['id']; ?>
">Yes</a><?php endif; ?></font></td>
  </tr>
  <?php endfor; endif; ?> 
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/footer.tpl.html", 'smarty_include_vars' => array('page' => 'modules')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>