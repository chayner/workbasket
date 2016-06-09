<?php /* Smarty version 2.6.9, created on 2005-09-08 23:46:06
         compiled from ../../templates/header.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', '../../templates/header.tpl.html', 142, false),array('modifier', 'stripslashes', '../../templates/header.tpl.html', 170, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?php echo $this->_tpl_vars['sitename']; ?>
 administration : <?php echo $this->_tpl_vars['cur_mod']['name']; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php echo '
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
          eval(targ+".location=\'"+selObj.options[selObj.selectedIndex].value+"\'");
          if (restore) selObj.selectedIndex=0;
}

/*Combo Box Image Selector:
By JavaScript Kit (www.javascriptkit.com)
Over 200+ free JavaScript here!
*/

function showimage(){
	var newimage, newimageid;
	newimageid = document.admin_item.image.options[document.admin_item.image.selectedIndex].value;
	if (newimageid > "0") {
		newimage = "/photos/image_"+newimageid+"_thumb.jpg";
		document.images.picture.src = newimage;
	} else {
		document.images.picture.src = "/images/spacer.gif";
	}
}
//-->
</script>

<script type="text/javascript">
   _editor_url = "/includes/htmlarea/";
   _editor_lang = "en";
</script>

<script type="text/javascript" src="/includes/htmlarea/htmlarea.js"></script>

<script type="text/javascript">

      function initDocument() {
		// var editor = new HTMLArea("body");
		 //editor.generate();
		 //HTMLArea.replaceAll();
	}
	HTMLArea.init();
setTimeout(function() { HTMLArea.replaceAll() }, 500);

//	HTMLArea.onload = initDocument;
</script>

<!-- <script type="text/javascript" src="/includes/fckeditor/fckeditor.js"></script>-->
'; ?>


<link href="/admin/includes/admin.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#CCCCCC">
<table width="80%" align="center" cellpadding="5" bgcolor="#666666">
    <tr>
	  <td colspan="2" bgcolor="#000000" height="5"><font size="+1"><strong><?php echo $this->_tpl_vars['sitename']; ?>
 administration</strong></font></tr>
  <?php if ($this->_tpl_vars['fullname']): ?>
	<tr>
      <td colspan="2">
		  <table width="100%">
			  <tr>
				  <td>
	<font color=#FFCC00><b>Welcome <font color=#FFFFFF><?php echo $this->_tpl_vars['fullname']; ?>
</font>!</b></font>
					  <!-- <br>
          <font size="-3"><font color="#FFCC00">Current <?php echo $this->_tpl_vars['section_item']; ?>
:</font> 
          <?php echo $this->_tpl_vars['cur_section_name']; ?>
 <font color="#666666">(<?php echo $this->_tpl_vars['section_s']; ?>
)</font></font>	 -->
        </td>
			     <td align=right>
				     <a href=<?php echo $this->_tpl_vars['siteroot'];  echo $this->_tpl_vars['admindir']; ?>
/changepass.php>change password</a> | 
				     <a href=<?php echo $this->_tpl_vars['siteroot'];  echo $this->_tpl_vars['admindir']; ?>
/logout.php>logout</a>
			     </td>
			  </tr>
	  </table></td>
	</tr>
	<?php endif; ?>  
	<tr>
	  <td colspan="2" align="right" bgcolor="#FFCC00" height="3"><img src="/admin/includes/spacer.gif"></td></tr>
	  <tr>
		<?php if ($this->_tpl_vars['fullname']): ?>
		  <td rowspan="2" valign="top" bgcolor="#999999" width="20%">
		  <?php if ($this->_tpl_vars['global_mods']): ?>
		  <table width="100%">
		  	  <tr>
				  <td><font size="1" color="#000000"><strong>global modules:</strong></font>
				  </td>
			  </tr>
			  <?php unset($this->_sections['m']);
$this->_sections['m']['name'] = 'm';
$this->_sections['m']['loop'] = is_array($_loop=$this->_tpl_vars['global_mods']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['m']['show'] = true;
$this->_sections['m']['max'] = $this->_sections['m']['loop'];
$this->_sections['m']['step'] = 1;
$this->_sections['m']['start'] = $this->_sections['m']['step'] > 0 ? 0 : $this->_sections['m']['loop']-1;
if ($this->_sections['m']['show']) {
    $this->_sections['m']['total'] = $this->_sections['m']['loop'];
    if ($this->_sections['m']['total'] == 0)
        $this->_sections['m']['show'] = false;
} else
    $this->_sections['m']['total'] = 0;
if ($this->_sections['m']['show']):

            for ($this->_sections['m']['index'] = $this->_sections['m']['start'], $this->_sections['m']['iteration'] = 1;
                 $this->_sections['m']['iteration'] <= $this->_sections['m']['total'];
                 $this->_sections['m']['index'] += $this->_sections['m']['step'], $this->_sections['m']['iteration']++):
$this->_sections['m']['rownum'] = $this->_sections['m']['iteration'];
$this->_sections['m']['index_prev'] = $this->_sections['m']['index'] - $this->_sections['m']['step'];
$this->_sections['m']['index_next'] = $this->_sections['m']['index'] + $this->_sections['m']['step'];
$this->_sections['m']['first']      = ($this->_sections['m']['iteration'] == 1);
$this->_sections['m']['last']       = ($this->_sections['m']['iteration'] == $this->_sections['m']['total']);
?>
			  <tr><td><a href="<?php echo $this->_tpl_vars['admindir'];  echo $this->_tpl_vars['global_mods'][$this->_sections['m']['index']]['path']; ?>
"><font size=1 <?php if ($this->_tpl_vars['cur_mod']['name'] == $this->_tpl_vars['global_mods'][$this->_sections['m']['index']]['name']): ?>class="sidebarhighlight"<?php endif; ?>><?php echo $this->_tpl_vars['global_mods'][$this->_sections['m']['index']]['name']; ?>
</font></a></td>
			  </tr>
			  <?php endfor; endif; ?>
		</table><hr>
		<?php endif; ?>


		
  		<table cellpadding="3" width="100%"> 
		<?php if ($this->_tpl_vars['multisection']): ?>
			  <tr>
				  <td><font size="1" color="#000000"><strong><?php echo $this->_tpl_vars['section_name']; ?>
:</strong></font>
				  </td>
			  </tr>
		<?php endif; ?>
			  </table>
			  <?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['section_list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			  
					<?php if ($this->_tpl_vars['section_list'][$this->_sections['j']['index']]['id'] == $this->_tpl_vars['section_s']): ?>
						<table width="100%"><tr><td colspan="2"><a href=<?php echo $this->_tpl_vars['siteroot'];  echo $this->_tpl_vars['admindir']; ?>
/index.php?section=<?php echo $this->_tpl_vars['section_list'][$this->_sections['j']['index']]['id']; ?>
>
						<font class="sidebarhighlight"><?php if ($this->_tpl_vars['multisection']):  echo ((is_array($_tmp=$this->_tpl_vars['section_list'][$this->_sections['j']['index']]['name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp));  else:  echo ((is_array($_tmp=$this->_tpl_vars['sitename'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp));  endif; ?></font></a>
						</td></tr>
						<?php unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['modules']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['l']['show'] = true;
$this->_sections['l']['max'] = $this->_sections['l']['loop'];
$this->_sections['l']['step'] = 1;
$this->_sections['l']['start'] = $this->_sections['l']['step'] > 0 ? 0 : $this->_sections['l']['loop']-1;
if ($this->_sections['l']['show']) {
    $this->_sections['l']['total'] = $this->_sections['l']['loop'];
    if ($this->_sections['l']['total'] == 0)
        $this->_sections['l']['show'] = false;
} else
    $this->_sections['l']['total'] = 0;
if ($this->_sections['l']['show']):

            for ($this->_sections['l']['index'] = $this->_sections['l']['start'], $this->_sections['l']['iteration'] = 1;
                 $this->_sections['l']['iteration'] <= $this->_sections['l']['total'];
                 $this->_sections['l']['index'] += $this->_sections['l']['step'], $this->_sections['l']['iteration']++):
$this->_sections['l']['rownum'] = $this->_sections['l']['iteration'];
$this->_sections['l']['index_prev'] = $this->_sections['l']['index'] - $this->_sections['l']['step'];
$this->_sections['l']['index_next'] = $this->_sections['l']['index'] + $this->_sections['l']['step'];
$this->_sections['l']['first']      = ($this->_sections['l']['iteration'] == 1);
$this->_sections['l']['last']       = ($this->_sections['l']['iteration'] == $this->_sections['l']['total']);
?>
						<tr><td width="15%">&nbsp;</td><td width="85%"><a href="<?php echo $this->_tpl_vars['admindir'];  echo $this->_tpl_vars['modules'][$this->_sections['l']['index']]['path']; ?>
"><font size=1 <?php if ($this->_tpl_vars['cur_mod']['name'] == $this->_tpl_vars['modules'][$this->_sections['l']['index']]['name']): ?>class="sidebarhighlight"<?php endif; ?>><?php echo $this->_tpl_vars['modules'][$this->_sections['l']['index']]['name']; ?>
</font></a></td></tr>
						<?php endfor; endif; ?>
						</table>
					<?php else: ?>
					<table><tr><td><a href=<?php echo $this->_tpl_vars['siteroot'];  echo $this->_tpl_vars['admindir']; ?>
?section=<?php echo $this->_tpl_vars['section_list'][$this->_sections['j']['index']]['id']; ?>
>
					<font size="1" color="#333333"><?php echo ((is_array($_tmp=$this->_tpl_vars['section_list'][$this->_sections['j']['index']]['name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
</font></a></td></tr></table><?php endif; ?>
					
			  <?php endfor; endif; ?>
			  
			  
			  <?php if ($this->_tpl_vars['config_list']): ?>
			  <hr><table width="100%">
			  <tr>
			  <td><font size="1" color="#000000"><strong>config modules:</strong></font>
			  </td>
			  </tr>
			  <?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['config_list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k']['show'] = true;
$this->_sections['k']['max'] = $this->_sections['k']['loop'];
$this->_sections['k']['step'] = 1;
$this->_sections['k']['start'] = $this->_sections['k']['step'] > 0 ? 0 : $this->_sections['k']['loop']-1;
if ($this->_sections['k']['show']) {
    $this->_sections['k']['total'] = $this->_sections['k']['loop'];
    if ($this->_sections['k']['total'] == 0)
        $this->_sections['k']['show'] = false;
} else
    $this->_sections['k']['total'] = 0;
if ($this->_sections['k']['show']):

            for ($this->_sections['k']['index'] = $this->_sections['k']['start'], $this->_sections['k']['iteration'] = 1;
                 $this->_sections['k']['iteration'] <= $this->_sections['k']['total'];
                 $this->_sections['k']['index'] += $this->_sections['k']['step'], $this->_sections['k']['iteration']++):
$this->_sections['k']['rownum'] = $this->_sections['k']['iteration'];
$this->_sections['k']['index_prev'] = $this->_sections['k']['index'] - $this->_sections['k']['step'];
$this->_sections['k']['index_next'] = $this->_sections['k']['index'] + $this->_sections['k']['step'];
$this->_sections['k']['first']      = ($this->_sections['k']['iteration'] == 1);
$this->_sections['k']['last']       = ($this->_sections['k']['iteration'] == $this->_sections['k']['total']);
?>
					<tr><td><a href="<?php echo $this->_tpl_vars['admindir'];  echo $this->_tpl_vars['config_list'][$this->_sections['k']['index']]['path']; ?>
">
					<font size=1 color="#333333" <?php if ($this->_tpl_vars['cur_mod']['name'] == $this->_tpl_vars['config_list'][$this->_sections['k']['index']]['name']): ?>class="sidebarhighlight"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['config_list'][$this->_sections['k']['index']]['name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
</font>
					</a></td></tr>
			  <?php endfor; endif; ?>
			  </table>		  
			  <?php endif; ?>
			  </td>
	<?php endif; ?>
	  <td width="80%" height="5" valign="middle" align="center"><font class="feedback"><?php echo ((is_array($_tmp=$this->_tpl_vars['feedback'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</font></td>
	</tr>
    <tr>
      <td align="center" valign="top">