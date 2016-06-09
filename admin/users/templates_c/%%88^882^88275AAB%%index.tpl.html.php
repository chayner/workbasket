<?php /* Smarty version 2.6.9, created on 2005-08-10 13:15:00
         compiled from ./index.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', './index.tpl.html', 32, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
<p align=center>
        <b><a href=new.php>add a new <?php echo $this->_tpl_vars['cur_mod']['item']; ?>
</a></b></p>
        
		<p><a href="mailto:<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['user_list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 echo $this->_tpl_vars['user_list'][$this->_sections['j']['index']]['email']; ?>
;<?php endfor; endif; ?>">email all admins</a></p>
<table width=100% class="content" cellpadding=5 cellspacing=0>
  <tr> 
    <td colspan=6 bgcolor=#000000> <b><?php echo $this->_tpl_vars['cur_mod']['name']; ?>
</b> </td>
  </tr>
  <tr bgcolor=#999999> 
    <td> 
      <div align=center>&nbsp;</div></td>
    <td> 
      <div align=center><b> <a href="<?php echo $this->_tpl_vars['thispage']; ?>
?ord=id">id</a></b></div></td>
    <td><b><a href="<?php echo $this->_tpl_vars['thispage']; ?>
?ord=user_name">user name</a></b></td>
    <td><b><a href="<?php echo $this->_tpl_vars['thispage']; ?>
?ord=real_name">real name</a></b></td>
    <td><strong><a href="<?php echo $this->_tpl_vars['thispage']; ?>
?ord=email">email</a></strong></td>
    <td><b><a href="<?php echo $this->_tpl_vars['thispage']; ?>
?ord=login">last login</a></b></td>
  </tr>
  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['user_list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <td width="5%"> 
      <div align=center> 
        <p><a href=edit.php?id=<?php echo $this->_tpl_vars['user_list'][$this->_sections['i']['index']]['id']; ?>
><font size="1">edit</font></a><font size="1"><br>
            <a href=delete.php?id=<?php echo $this->_tpl_vars['user_list'][$this->_sections['i']['index']]['id']; ?>
>delete</a></font></p>
    </div></td>
    <td width="5%"> 
    <p align=center><?php echo $this->_tpl_vars['user_list'][$this->_sections['i']['index']]['id']; ?>
</p></td>
    <td width="15%"><?php echo $this->_tpl_vars['user_list'][$this->_sections['i']['index']]['user_name']; ?>
</td>
    <td width="30%"><?php echo $this->_tpl_vars['user_list'][$this->_sections['i']['index']]['real_name']; ?>
</td>
    <td width="30%"><?php echo $this->_tpl_vars['user_list'][$this->_sections['i']['index']]['email']; ?>
</td>
    <td width="15%"><?php echo ((is_array($_tmp=$this->_tpl_vars['user_list'][$this->_sections['i']['index']]['last_login'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%b %d, %Y <br> %l:%M %p') : smarty_modifier_date_format($_tmp, '%b %d, %Y <br> %l:%M %p')); ?>
</td>
  </tr>
  <?php endfor; endif; ?> 
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>