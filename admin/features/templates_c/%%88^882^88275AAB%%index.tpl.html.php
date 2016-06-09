<?php /* Smarty version 2.6.9, created on 2005-08-06 12:24:03
         compiled from ./index.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', './index.tpl.html', 4, false),array('modifier', 'strip_tags', './index.tpl.html', 22, false),array('modifier', 'truncate', './index.tpl.html', 22, false),array('insert', 'category_dropdown', './index.tpl.html', 10, false),array('insert', 'category_name', './index.tpl.html', 26, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 

<?php if ($this->_tpl_vars['cur_mod']['add_del']): ?><p align=center>
        <b><a href=new.php>add new <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
</a></b></p><?php endif; ?>
        <table width=100% class="content" cellspacing=0 cellpadding=5>
        <tr>
           <td colspan=2 bgcolor=#000000>
              <b><?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
</b>
           </td>
           <?php if ($this->_tpl_vars['cur_mod']['cat_p']): ?><td align=right bgcolor="#000000"> <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'category_dropdown', 'cur_cat' => $this->_tpl_vars['cur_cat']['id'], 'module' => $this->_tpl_vars['module'])), $this); ?>
 </td><?php endif; ?>
        </tr>



<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['features']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

		<tr valign=top>
                <td width="5%" align=center valign=top> <a href="edit.php?id=<?php echo $this->_tpl_vars['features'][$this->_sections['i']['index']]['id']; ?>
"><font size="1">edit</font></a>
			  <?php if ($this->_tpl_vars['cur_mod']['add_del']): ?><br><font size="1"><a href="delete.php?id=<?php echo $this->_tpl_vars['features'][$this->_sections['i']['index']]['id']; ?>
">delete</a></font><?php endif; ?></td>
                <td>                  <p><b><font size=-1 class="title"><?php echo $this->_tpl_vars['features'][$this->_sections['i']['index']]['title']; ?>
</font></b>
                    <br><font size=1><i>(Priority: <?php echo $this->_tpl_vars['features'][$this->_sections['i']['index']]['priority']; ?>
)</i></font></p>
                    <p><?php if ($this->_tpl_vars['features'][$this->_sections['i']['index']]['image_id']): ?><img src="/photos/image_<?php echo $this->_tpl_vars['features'][$this->_sections['i']['index']]['image_id']; ?>
_thumb.jpg" align="left"><?php endif; ?><font size=-1><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['features'][$this->_sections['i']['index']]['body'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 200) : smarty_modifier_truncate($_tmp, 200)); ?>
</font></p>
                </td>
			    
				<?php if ($this->_tpl_vars['cur_mod']['cat_p']): ?><td width=25% valign="top"> <strong class="title">Category:</strong><br>
                  <font size="1"><?php if ($this->_tpl_vars['features'][$this->_sections['i']['index']]['category'] > 0): ?> <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'category_name', 'modid' => $this->_tpl_vars['module'], 'id' => $this->_tpl_vars['features'][$this->_sections['i']['index']]['category'])), $this); ?>
 <?php else: ?> <i>No Category Assigned</i> <?php endif; ?> </font>
		  	</td><?php endif; ?>
		</tr>

	<?php endfor; else: ?>
        <tr><td colspan=3><p>There are no items to display.</p></td></tr>
	<?php endif; ?>

</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>