<?php /* Smarty version 2.6.9, created on 2005-08-06 12:51:59
         compiled from maillist.tpl.html */ ?>
<html><title><?php echo $this->_tpl_vars['configs'][0]['sitename']; ?>
</title>
<link href="/main.css" rel="stylesheet" type="text/css">

<body bgcolor="#000000" background="/images/background.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<form name="form1" method="post" action="<?php echo $this->_tpl_vars['thispage']; ?>
">
    <table width="350"  border="0" align="center" cellpadding="15" cellspacing="0">
        <tr>
          <td valign="middle" background="/images/maillist.gif">	
		  
	        <div align="center"><font color="#FF0000"><?php if ($this->_tpl_vars['feedback']): ?> 
		        <strong><?php echo $this->_tpl_vars['feedback']; ?>
</strong> 
	<?php else: ?> 
		<strong>Join the mailing list!</strong>	<?php endif; ?> 
	
            </font></div>
	        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" class="maillist">
    <tr> 
      <td><strong><font size="-1">First 
        Name: </font></strong></td>
      <td><font color="#FFFFFF" size="-1"> 
        <input type="text" name="fname">
        </font></td>
    </tr>
    <tr> 
      <td><strong><font size="-1">Last 
        Name:</font></strong></td>
      <td><font color="#FFFFFF" size="-1"> 
        <input type="text" name="lname">
        </font></td>
    </tr>
    <tr> 
      <td><strong><font size="-1">Email:        </font></strong></td>
      <td><font color="#FFFFFF" size="-1"> 
        <input type="text" name="email">
        </font></td>
    </tr>
	
    <tr>
      <td><p><strong><font size="-1">Zip C</font></strong><strong><font size="-1">ode:</font></strong></p>
        </td>
      <td><font color="#FFFFFF" size="-1">
      <input name="zip" type="text" id="zip">
</font></td>
    </tr>
    <tr>
      <td colspan="2"><hr></td>
      </tr>
    <tr> 
      <td><strong><font size="-1">Mailing List:</font></strong></td>
      <td><font size="-1">
	  <?php if ($this->_tpl_vars['dropdown'][1]['title']): ?>
	      <select name=maillist_id>
	        
              
		  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['dropdown']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			 
          
              
	        <option value="<?php echo $this->_tpl_vars['dropdown'][$this->_sections['i']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['dropdown'][$this->_sections['i']['index']]['title']; ?>
</option>
	        
              
		  <?php endfor; endif; ?>
	   
        
	        </select>
		<?php else: ?>
		<input type="hidden" name="maillist_id" value="<?php echo $this->_tpl_vars['dropdown'][0]['id']; ?>
">
		<?php echo $this->_tpl_vars['dropdown'][0]['title']; ?>

		<?php endif; ?>
		</font></td>
    </tr>
    <tr align="center"> 
      <td colspan="2">        <font size="-1">
        <input name="action" type="radio" value="subscribe" checked>
        subscribe 
        <input type="radio" name="action" value="unsubscribe">
        unsubscribe</font></td>
    </tr>
    <tr align="center"> 
      <td colspan="2">        <input type="submit" name="Submit" value="Submit">      </td>
    </tr>
  </table></td>
        </tr>
  </table>

</form>
</body>
</html>