<?php /* Smarty version 2.6.9, created on 2005-08-10 12:54:20
         compiled from ./index.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', './index.tpl.html', 4, false),array('modifier', 'capitalize', './index.tpl.html', 110, false),array('insert', 'category_dropdown', './index.tpl.html', 12, false),array('insert', 'category_name', './index.tpl.html', 89, false),array('insert', 'location_list', './index.tpl.html', 103, false),array('insert', 'section_list', './index.tpl.html', 110, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 

<p align=center>
        <b><a href=new.php>add new <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
</a></b></p>
        
<table width=100% class="content" cellspacing=0 cellpadding=5>
  <tr> 
    <td colspan=3 bgcolor=#000000> <b><?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
</b> </td>
	<?php if ($this->_tpl_vars['member_loc'] || $this->_tpl_vars['cur_mod']['cat_p']): ?>
		<td align=right bgcolor="#000000">
		<?php if ($this->_tpl_vars['cur_mod']['cat_p']): ?>
			<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'category_dropdown', 'cur_cat' => $this->_tpl_vars['cur_cat']['id'], 'module' => $this->_tpl_vars['module'])), $this); ?>

		<?php else: ?>
			&nbsp;
		<?php endif; ?>
		</td>
	<?php endif; ?>
	
  </tr>
  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['members']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <td width=5% align=center rowspan="<?php echo $this->_tpl_vars['spanfill']['1']; ?>
"> <p><font size=-1><a href=edit.php?id=<?php echo $this->_tpl_vars['members'][$this->_sections['i']['index']]['id']; ?>
><font size="1">edit</font></a><font size="1"><br>
    </font></font><font size=1><a href=delete.php?id=<?php echo $this->_tpl_vars['members'][$this->_sections['i']['index']]['id']; ?>
>delete</a></font></p>    </td>
    <td width="20%" rowspan="<?php echo $this->_tpl_vars['spanfill']['1']; ?>
" align="center" valign="top"><p><font size="1"><b><font class="title"><?php echo $this->_tpl_vars['members'][$this->_sections['i']['index']]['fname']; ?>
 <?php echo $this->_tpl_vars['members'][$this->_sections['i']['index']]['lname']; ?>
</font></b></font></p>
	  <font size="1"><img src="/photos/member_<?php echo $this->_tpl_vars['members'][$this->_sections['i']['index']]['id']; ?>
_thumb.jpg"></font>
	  </td>
    <td rowspan="<?php echo $this->_tpl_vars['spanfill']['0']; ?>
">
      <font size="1"><strong class="title">Contact:</strong>
	  		<?php if ($this->_tpl_vars['members'][$this->_sections['i']['index']]['address1']): ?> 
        		<br><?php echo $this->_tpl_vars['members'][$this->_sections['i']['index']]['address1']; ?>
 
			<?php endif; ?> 
			<?php if ($this->_tpl_vars['members'][$this->_sections['i']['index']]['address2']): ?>
				<br><?php echo $this->_tpl_vars['members'][$this->_sections['i']['index']]['address2']; ?>

			<?php endif; ?> 
        <?php if ($this->_tpl_vars['members'][$this->_sections['i']['index']]['city']): ?> 
	        <br><?php echo $this->_tpl_vars['members'][$this->_sections['i']['index']]['city'];  if ($this->_tpl_vars['members'][$this->_sections['i']['index']]['state']): ?>, <?php endif; ?>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['members'][$this->_sections['i']['index']]['state']): ?>
		<?php echo $this->_tpl_vars['members'][$this->_sections['i']['index']]['state']; ?>

	<?php endif; ?>
	<?php if ($this->_tpl_vars['members'][$this->_sections['i']['index']]['zip']): ?> 
       	<?php echo $this->_tpl_vars['members'][$this->_sections['i']['index']]['zip']; ?>

<?php endif; ?><br>
		<?php if ($this->_tpl_vars['members'][$this->_sections['i']['index']]['phone']): ?><br><strong class="title">Phone:</strong> <?php echo $this->_tpl_vars['members'][$this->_sections['i']['index']]['phone'];  endif; ?>
		<?php if ($this->_tpl_vars['members'][$this->_sections['i']['index']]['fax']): ?><br><strong class="title">Fax:</strong> <?php echo $this->_tpl_vars['members'][$this->_sections['i']['index']]['fax'];  endif; ?>
		<?php if ($this->_tpl_vars['members'][$this->_sections['i']['index']]['email']): ?><br><strong class="title">Email:</strong> <?php echo $this->_tpl_vars['members'][$this->_sections['i']['index']]['email'];  endif; ?>
		<?php if ($this->_tpl_vars['members'][$this->_sections['i']['index']]['url'] != "http://" && $this->_tpl_vars['member'][$this->_sections['i']['index']]['url']): ?><br><strong class="title">URL:</strong><i><a href="<?php echo $this->_tpl_vars['members'][$this->_sections['i']['index']]['url']; ?>
" target='_blank'><?php echo $this->_tpl_vars['members'][$this->_sections['i']['index']]['url']; ?>
</a></i><?php endif; ?>
&nbsp;

 <br>
 	  <?php if ($this->_tpl_vars['members'][$this->_sections['i']['index']]['custom1']): ?>
	  <br>
	  <strong class="title"><?php echo $this->_tpl_vars['configs'][0]['member_cust1']; ?>
: </strong><?php echo $this->_tpl_vars['members'][$this->_sections['i']['index']]['custom1']; ?>

	  <?php endif; ?>
	  <?php if ($this->_tpl_vars['members'][$this->_sections['i']['index']]['custom2']): ?>
	  <br>
	  <strong class="title"><?php echo $this->_tpl_vars['configs'][0]['member_cust2']; ?>
: </strong><?php echo $this->_tpl_vars['members'][$this->_sections['i']['index']]['custom2']; ?>

	  <?php endif; ?>
	  <?php if ($this->_tpl_vars['members'][$this->_sections['i']['index']]['custom3']): ?>
	  <br>
	  <strong class="title"><?php echo $this->_tpl_vars['configs'][0]['member_cust3']; ?>
: </strong><?php echo $this->_tpl_vars['members'][$this->_sections['i']['index']]['custom3']; ?>

	  <?php endif; ?>
	  <?php if ($this->_tpl_vars['members'][$this->_sections['i']['index']]['custom4']): ?>
	  <br>
	  <strong class="title"><?php echo $this->_tpl_vars['configs'][0]['member_cust4']; ?>
: </strong><?php echo $this->_tpl_vars['members'][$this->_sections['i']['index']]['custom4']; ?>

	  <?php endif; ?>
	  <?php if ($this->_tpl_vars['members'][$this->_sections['i']['index']]['custom5']): ?>
	  <br>
	  <strong class="title"><?php echo $this->_tpl_vars['configs'][0]['member_cust5']; ?>
: </strong><?php echo $this->_tpl_vars['members'][$this->_sections['i']['index']]['custom5']; ?>

	  <?php endif; ?>
	  <?php if ($this->_tpl_vars['members'][$this->_sections['i']['index']]['custom6']): ?>
	  <br>
	  <strong class="title"><?php echo $this->_tpl_vars['configs'][0]['member_cust6']; ?>
: </strong><?php echo $this->_tpl_vars['members'][$this->_sections['i']['index']]['custom6']; ?>

	  <?php endif; ?>
	  <?php if ($this->_tpl_vars['members'][$this->_sections['i']['index']]['custom7']): ?>
	  <br>
	  <strong class="title"><?php echo $this->_tpl_vars['configs'][0]['member_cust7']; ?>
: </strong><?php echo $this->_tpl_vars['members'][$this->_sections['i']['index']]['custom7']; ?>

	  <?php endif; ?>
	  </p>    
	  </font>
    </td>
    
	
	<?php if ($this->_tpl_vars['cur_mod']['cat_p']): ?>
	<td width=25% valign="top">
		<font size="1"><strong class="title">Category:</strong>
		<br>
		<?php if ($this->_tpl_vars['members'][$this->_sections['i']['index']]['category'] > 0): ?>
			<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'category_name', 'modid' => $this->_tpl_vars['module'], 'id' => $this->_tpl_vars['members'][$this->_sections['i']['index']]['category'])), $this); ?>

		<?php else: ?> 
			<i>No Category Assigned</i>
    	<?php endif; ?>
		</font>
	</td>
	<?php endif; ?>
	
  	<?php if ($this->_tpl_vars['cur_mod']['cat_p'] && $this->_tpl_vars['member_loc']): ?>
  </tr>
  	<tr valign=top>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['member_loc']): ?>
	<td valign="top"><font size="1"><strong class="title">Locations:</strong><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'location_list', 'modid' => $this->_tpl_vars['module'], 'member_id' => $this->_tpl_vars['members'][$this->_sections['i']['index']]['id'])), $this); ?>

        <p><a href="locations.php?member_id=<?php echo $this->_tpl_vars['members'][$this->_sections['i']['index']]['id']; ?>
"><em>modify <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
 locations</em></a></p>
	</font></td>
	<?php endif; ?>
    
  </tr>
  <tr valign=top>
    <td colspan="2"><font size="1"><strong class="title">Postions<?php if ($this->_tpl_vars['multisection']): ?> / <?php echo ((is_array($_tmp=$this->_tpl_vars['section_name'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp));  endif; ?>:</strong><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'section_list', 'modid' => $this->_tpl_vars['module'], 'member_id' => $this->_tpl_vars['members'][$this->_sections['i']['index']]['id'])), $this); ?>

      <p><a href="sections.php?member_id=<?php echo $this->_tpl_vars['members'][$this->_sections['i']['index']]['id']; ?>
"><em>modify <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
 positions<?php if ($this->_tpl_vars['multisection']): ?> / <?php echo $this->_tpl_vars['section_name'];  endif; ?></em></a></p>
    </font></td>
  </tr>
	
	

  <?php endfor; else: ?> 
  <tr> 
    <td colspan=4><p>There are no items to display.</p></td>
  </tr>
  <?php endif; ?> 
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>