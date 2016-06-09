<?php /* Smarty version 2.6.9, created on 2005-09-13 22:36:37
         compiled from photos.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 

<div align="center">
<div id="flashcontent">
		This movie requires Flash Player 7. <a href="http://www.macromedia.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" title="Download FP7">Download Flash Player 7</a> to view SlideShowPro.
	</div>
							
							<script type="text/javascript">
							// <![CDATA[
							var myFlashObject = new FlashObject("/slideshow.swf", "slideshow", "450", "450", 7, "#f0f0f0");
							myFlashObject.addVariable("initialURL", "<?php echo $this->_tpl_vars['param']; ?>
");
							myFlashObject.addParam("wmode", "transparent");
							myFlashObject.write("flashcontent");	
							// ]]>
						</script>
						

						
<font color="#666666" size="1"><br>
The slideshow should start automatically. Hover your mouse over large images to learn more.
<br> 
Use the arrow keys on your keyboard to navigate.</font>
</div>
  
  
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>