<?php /* Smarty version 2.6.9, created on 2005-09-14 23:33:30
         compiled from ./index.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', './index.tpl.html', 3, false),array('insert', 'category_dropdown', './index.tpl.html', 12, false),array('insert', 'category_name', './index.tpl.html', 74, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 

<p align=center><a href=new.php><strong>add new <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
</strong></a></p>

		<table width=100% class="content" cellspacing=0 cellpadding=5>
			<tr>
			  <td colspan=<?php if ($this->_tpl_vars['cur_mod']['imgs_p']): ?>"4"<?php else: ?>"3"<?php endif; ?> bgcolor="#000000">
			  <strong><?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
</strong>
			  </td>
				<?php if ($this->_tpl_vars['cur_mod']['cat_p']): ?>
					<td align=right bgcolor="#000000">
						<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'category_dropdown', 'cur_cat' => $this->_tpl_vars['cur_cat']['id'], 'module' => $this->_tpl_vars['module'])), $this); ?>

					</td>
				<?php endif; ?>
			</tr>


                 
		<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['files']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			   
    <td width=5% align=center valign=top> <a href="edit.php?id=<?php echo $this->_tpl_vars['files'][$this->_sections['i']['index']]['id']; ?>
"><font size="1">edit</font></a><font size="1"><br>      
        <a href="delete.php?id=<?php echo $this->_tpl_vars['files'][$this->_sections['i']['index']]['id']; ?>
">delete</a> </font></td>
    <?php if ($this->_tpl_vars['cur_mod']['imgs_p']): ?><td><?php if ($this->_tpl_vars['files'][$this->_sections['i']['index']]['image_id']): ?><img src=/photos/image_<?php echo $this->_tpl_vars['files'][$this->_sections['i']['index']]['image_id']; ?>
_thumb.jpg><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
                
    <td width=30% align=center valign=top>
	<?php if ($this->_tpl_vars['files'][$this->_sections['i']['index']]['filename']): ?><em><?php echo $this->_tpl_vars['files'][$this->_sections['i']['index']]['filename']; ?>
</em><?php endif; ?>
	<?php if ($this->_tpl_vars['files'][$this->_sections['i']['index']]['title']): ?>
		<p><div class="title"><?php echo $this->_tpl_vars['files'][$this->_sections['i']['index']]['title']; ?>
</div></p>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['files'][$this->_sections['i']['index']]['artist']): ?>
	<p><em><i><?php echo $this->_tpl_vars['files'][$this->_sections['i']['index']]['artist']; ?>
</i></em></p>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['files'][$this->_sections['i']['index']]['album']): ?>
	<p><em><?php echo $this->_tpl_vars['files'][$this->_sections['i']['index']]['album']; ?>
 
		  <?php if ($this->_tpl_vars['files'][$this->_sections['i']['index']]['track']): ?>
			  (Track <?php echo $this->_tpl_vars['files'][$this->_sections['i']['index']]['track']; ?>
)
		  <?php endif; ?>
	  </em></p>
	<?php endif; ?></td>
    <td width="40%" valign=top> 
      <p><i><strong><?php if ($this->_tpl_vars['files'][$this->_sections['i']['index']]['filetype'] == "video/mpeg"): ?>
			  	MPEG Video
			  <?php elseif ($this->_tpl_vars['files'][$this->_sections['i']['index']]['filetype'] == "audio/mpeg"): ?>
			  	MP3
			  <?php elseif ($this->_tpl_vars['files'][$this->_sections['i']['index']]['filetype'] == "application/vnd.rn-realfiles"): ?>
			  	Real files
			  <?php elseif ($this->_tpl_vars['files'][$this->_sections['i']['index']]['filetype'] == "video/quicktime"): ?>
			  	Quicktime
			  <?php elseif ($this->_tpl_vars['files'][$this->_sections['i']['index']]['filetype'] == "video/avi"): ?>
			  	AVI Video
			  <?php elseif ($this->_tpl_vars['files'][$this->_sections['i']['index']]['filetype'] == "video/x-ms-wmv"): ?>
			  	Windows files Video
			  <?php elseif ($this->_tpl_vars['files'][$this->_sections['i']['index']]['filetype'] == "application/x-shockwave-flash"): ?>
			  	Macrofiles Flash
			  <?php elseif ($this->_tpl_vars['files'][$this->_sections['i']['index']]['filetype'] == "application/pdf"): ?>
			  	Adobe Acrobat
			  <?php else: ?>
			  	<?php echo $this->_tpl_vars['files'][$this->_sections['i']['index']]['filetype']; ?>

			  <?php endif; ?></strong></i>
	  <p><?php echo $this->_tpl_vars['files'][$this->_sections['i']['index']]['caption']; ?>

	  <p><?php if ($this->_tpl_vars['files'][$this->_sections['i']['index']]['copyright']): ?>
      
	  <p><i>&copy; <?php echo $this->_tpl_vars['files'][$this->_sections['i']['index']]['copyright']; ?>
</i></p>
                     <?php endif; ?>
              <p><a href="/files/<?php echo $this->_tpl_vars['files'][$this->_sections['i']['index']]['filename']; ?>
">Link to File</a></p>			  </td>
				<?php if ($this->_tpl_vars['cur_mod']['cat_p']): ?>
				<td width=25% valign="top">
					<strong class="title">Category:</strong>
					<br><font size="1">
					<?php if ($this->_tpl_vars['files'][$this->_sections['i']['index']]['category'] > 0): ?>
						<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'category_name', 'modid' => $this->_tpl_vars['module'], 'id' => $this->_tpl_vars['files'][$this->_sections['i']['index']]['category'])), $this); ?>

					<?php else: ?>
						<i>No Category Assigned</i>
					<?php endif; ?>
					</font>
				</td>
				<?php endif; ?>
			</tr>
	<?php endfor; else: ?>
        <tr><td colspan="4"><p>There are no items to display.</p></td></tr>
	<?php endif; ?>
       
	   </table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>