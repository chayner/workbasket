<?php /* Smarty version 2.6.9, created on 2005-08-24 12:23:06
         compiled from upload.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form method="post" enctype="multipart/form-data" action="submit.php" onSubmit="this.elements['submit'].disabled='disabled';">
<p>You can either upload the file yourself to the &quot;/files&quot; directory, or else
  upload it through the admin section using the form below.</p>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr align="center">
    <td>
      <input name="upload_the_file" type="radio" value="no" checked onClick="uploadfile.disabled=true;">
Upload file myself</td>
    <td width="250">
      <input type="radio" name="upload_the_file" value="yes" onClick="uploadfile.disabled=false;">
Use form below to upload file </td>
  </tr>
</table>
<hr>
<table width="500" border="0" cellpadding="10" cellspacing="0">
  <tr>
    <td align="center"><p><b>Please browse for the file you wish to upload:</b></p>
      <p>
        <input type="file" name="uploadfile" disabled="true";>
      </p>
      <p><font size=2 color=#FFCC33><b>Please be patient when uploading files,<br>
as it may take a few minutes to process.</b></font> </p></td>
  </tr>
</table>
<p>
  <input type="submit" name="submit" value="submit form" onClick="document.getElementById('progress').style.visibility='visible';">
  <br>
  <br>
  </p>
  <p>
  <INPUT TYPE=hidden name=MAX_FILE_SIZE value=20000000>
  <input type=hidden name=action value="upload">
</form>