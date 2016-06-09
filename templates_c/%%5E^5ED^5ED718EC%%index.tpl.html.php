<?php /* Smarty version 2.6.9, created on 2005-08-06 12:46:45
         compiled from index.tpl.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl.html", 'smarty_include_vars' => array('page' => 'home')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 

<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td rowspan="2" align="center" valign="top" background="/images/body.jpg">            <p align="center"><img src="/images/mission.jpg" width="300" height="346"></p>            </td>
          <td width="50%" rowspan="2" align="center" valign="top" background="/images/body.jpg">
		  <?php echo $this->_tpl_vars['blurb'][0]['body']; ?>

		  </td>
          </tr>
        <tr>
          </tr>
      </table>
	  
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl.html", 'smarty_include_vars' => array('page' => 'home')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>