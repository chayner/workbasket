<?php /* Smarty version 2.6.9, created on 2006-01-28 14:10:05
         compiled from photos_new.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'utf8', 'photos_new.tpl.html', 19, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 

<table cellspacing="10" cellpadding="0" width="100%">
<tr>
<td align="center" width="250" valign="top">
	<div id="flashcontent">
		This movie requires Flash Player 7. <a href="http://www.macromedia.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" title="Download FP7">Download Flash Player 7</a> to view SlideShowPro.
	</div>
							
		<script type="text/javascript">
		var myFlashObject = new FlashObject("/slideshow.swf", "slideshow", "450", "450", 7, "#f0f0f0");
		myFlashObject.addVariable("initialURL", "<?php echo $this->_tpl_vars['param']; ?>
");
		myFlashObject.addParam("wmode", "transparent");
		myFlashObject.write("flashcontent");	
		</script>
						
</td>
<td valign="top">
<?php echo ((is_array($_tmp=$this->_tpl_vars['news'][0]['body'])) ? $this->_run_mod_handler('utf8', true, $_tmp) : smarty_modifier_utf8($_tmp)); ?>

</td>
</tr>
</table>
  
  
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>