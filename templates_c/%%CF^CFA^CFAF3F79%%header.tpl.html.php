<?php /* Smarty version 2.6.9, created on 2008-05-10 18:00:20
         compiled from header.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'header.tpl.html', 7, false),)), $this); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<?php if ($this->_tpl_vars['page'] == 'ours' || $this->_tpl_vars['page'] == 'yours' || $this->_tpl_vars['page'] == 'new' || $this->_tpl_vars['page'] == 'punchneedle' || $this->_tpl_vars['page'] == 'needlepoint'): ?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php else: ?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php endif; ?>
<title>The Workbasket - <?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</title>
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

function changeImage(newID) {
	document.images.mainimage.src = newID;
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

function MM_openBrWindow(theURL,winName,features) { //v2.0
          window.open(theURL,winName,features);
}

var popUpWin=0;
function popUpWindow(URLStr,left,top,width,height,scrollbar,resize) {
	  if (!scrollbar)
		{
			scrollbar = \'yes\';
		}
	  if (!resize)
	  	{
			resize = \'yes\';
		}
	  if(popUpWin)
	  {
		if(!popUpWin.closed) popUpWin.close();
	  }
	  popUpWin = open(URLStr, \'popUpWin\', \'toolbar=no,location=no,directories=no,status=no,menubar=no,titlebar=no,scrollbars=\'+scrollbar+\',resizable=\'+resize+\',copyhistory=yes,width=\'+width+\',height=\'+height+\',left=\'+left+\', top=\'+top+\',screenX=\'+left+\',screenY=\'+top+\'\');	
}

function popUpMerch(id, width, height) {
	  if(popUpWin)
	  {
		if(!popUpWin.closed) popUpWin.close();
	  }
	  popUpWin = open(\'item.php?id=\'+id, \'popUpWin\', \'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,width=\'+width+\',height=\'+height+\',left=150, top=150,screenX=150,screenY=150\');	
}

function ChangeCaption (newcaption, newcopyright, newauthor) {
   var caption = document.getElementById("caption");
   caption.firstChild.nodeValue=newcaption;
   var copyright = document.getElementById("copyright");
   copyright.firstChild.nodeValue=newcopyright;
   var author = document.getElementById("author");
   author.firstChild.nodeValue=newauthor;   
}

//-->
</script>

'; ?>

<script type="text/javascript" src="/includes/flashobject.js"></script>
<link href="/main.css" rel="stylesheet" type="text/css">
</head>

<body background="/images/background.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('/images/home_top_f2.jpg','/images/us_top_f2.jpg','/images/new_top_f2.jpg','/images/ours_top_f2.jpg','/images/yours_top_f2.jpg','/images/free_top_f2.jpg','/images/links_top_f2.jpg','/images/contact_top_f2.jpg','/images/npoint_top_f2.jpg','/images/pneedle_top_f2.jpg')">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="126">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td rowspan="3"><img src="/images/corner_left.jpg" width="14" height="126"></td>
        <td><img src="/images/corner_top.jpg" width="100" height="14"></td>
        <td rowspan="3"><img src="/images/corner_right.jpg" width="9" height="126"></td>
      </tr>
      <tr>
        <td width="100" height="100" background="/images/corner_blank.jpg"><img src="/thumbs/<?php echo $this->_tpl_vars['rand_thumb']; ?>
.jpg"></td>
        </tr>
      <tr>
        <td><img src="/images/corner_bottom.jpg" width="100" height="12"></td>
      </tr>
    </table>
	</td>
    <td rowspan="2" align="left" valign="top">      <table width="80%" height="100%"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
          <td align="center" valign="top"><img src="/images/title.jpg" width="438" height="126"></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="32" style="background: url(/images/body_tl.jpg) right bottom no-repeat;"></td>
          <td style="background: url(/images/body_top.jpg) bottom repeat-x;"></td>
          <td width="32" style="height: 40px; background: url(/images/body_tr.jpg) left bottom no-repeat;"></td>
        </tr>
        <tr>
          <td background="/images/body_left.jpg">&nbsp;</td>
          <td height="50" align="center" valign="top" background="/images/body.jpg"><img src="/images/header_<?php echo $this->_tpl_vars['page']; ?>
.jpg" width="300" height="40"></td>
          <td background="/images/body_right.jpg">&nbsp;</td>
        </tr>
        <tr>
          <td width="32" background="/images/body_left.jpg">&nbsp;</td>
          <td background="/images/body.jpg">