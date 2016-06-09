<?php /* Smarty version 2.6.9, created on 2010-03-01 08:04:41
         compiled from ./table.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', './table.tpl.html', 23, false),array('modifier', 'truncate', './table.tpl.html', 23, false),)), $this); ?>
<table width=100% class="content" style='margin: 4px;' cellpadding=5 cellspacing=0>
  <tr bgcolor=#999999> 
    <td colspan=4><font color="#000000"><strong><?php echo $this->_tpl_vars['expand_fill']; ?>
 <?php echo $this->_tpl_vars['sections'][0]['name']; ?>
</strong></font></td>
	</tr>
  <tr valign=top> 
    <td width="5%" align="center"> <font size="1"><a href=edit.php?id=<?php echo $this->_tpl_vars['sections'][0]['id']; ?>
>edit</a><br>
        <a href=delete.php?id=<?php echo $this->_tpl_vars['sections'][0]['id']; ?>
>delete</a></font></td>
    <td width="10%"><img src=/photos/section_<?php echo $this->_tpl_vars['sections'][0]['id']; ?>
_thumb.jpg></td>
    <td>
	<?php if ($this->_tpl_vars['sections'][0]['director']): ?>	  <span class=title>Director:</span><br>
	  <font size="1"><?php echo $this->_tpl_vars['sections'][0]['director']; ?>
</font><br>
	<?php endif; ?>
    <?php if ($this->_tpl_vars['sections'][0]['director_phone']): ?>
		<span class="title">Contact Number:</span><br>
   	  <font size="1"><?php echo $this->_tpl_vars['sections'][0]['director_phone']; ?>
</font><br>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['sections'][0]['director_email']): ?>
		<span class="title">Contact Email:</span><br>
	  <font size="1"><?php echo $this->_tpl_vars['sections'][0]['director_email']; ?>
</font><br>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['sections'][0]['description']): ?>
		<hr><span class="title">Description: </span><br>
	  <font size="1"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['sections'][0]['description'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 250) : smarty_modifier_truncate($_tmp, 250)); ?>
</font>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['sections'][0]['link']): ?>
      <hr><span class="title">External Link:</span><br>
        <?php echo $this->_tpl_vars['sections'][0]['link']; ?>
<p>
      <?php endif; ?>&nbsp;
	</td>
  </tr>
            </table>