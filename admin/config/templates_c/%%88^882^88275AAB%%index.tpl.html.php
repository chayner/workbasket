<?php /* Smarty version 2.6.9, created on 2005-08-06 12:21:40
         compiled from ./index.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', './index.tpl.html', 34, false),array('function', 'math', './index.tpl.html', 41, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
        
<form method="post" action="submit.php" name="configs">
<table width="80%" align="center" cellpadding="5">
  <tr>
    <td colspan="3"><strong>General Site Configuration:</strong> </td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Site Name: </td>
    <td><input name="site_name" type="text" id="sitename" value="<?php echo $this->_tpl_vars['config_query'][0]['sitename']; ?>
" size="35"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>From Address: </td>
    <td><input name="from_address" type="text" id="fromaddress" value="<?php echo $this->_tpl_vars['config_query'][0]['fromaddress']; ?>
" size="35"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">Is this a multi-section site? </td>
    <td><input name="multisection_p" type="radio" value="1" <?php if ($this->_tpl_vars['config_query'][0]['multisection'] == 1): ?>checked<?php endif; ?>>
    Yes
    <input name="multisection_p" type="radio" value="0" <?php if ($this->_tpl_vars['config_query'][0]['multisection'] == 0): ?>checked<?php endif; ?>>
    No</td>
  </tr>
  <tr>
    <td colspan="3"><hr></td>
  </tr>
  <tr>
    <td colspan="3"><strong>Permissions Configuration:</strong> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td valign="top"><?php echo ((is_array($_tmp=$this->_tpl_vars['section_name'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
 Norms: </td>
    <td>
	<select name="s_norms[]" size="6" multiple>
		<?php $this->assign('snorm_next', 0); ?>
		
		<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['allmodules']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			
			<option value="<?php echo $this->_tpl_vars['allmodules'][$this->_sections['i']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['allmodules'][$this->_sections['i']['index']]['id'] == $this->_tpl_vars['s_norms_a'][$this->_tpl_vars['snorm_next']]): ?>selected<?php echo smarty_function_math(array('equation' => "x + 1",'x' => $this->_tpl_vars['snorm_next'],'assign' => 'snorm_next'), $this); endif; ?>><?php echo $this->_tpl_vars['allmodules'][$this->_sections['i']['index']]['name']; ?>
</option>
    	<?php endfor; endif; ?>
	</select>
	</td>
  </tr>
  <tr>
    <td colspan="3"><hr></td>
  </tr>
  <tr>
    <td colspan="3"><strong>Events Configuration:</strong> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td valign="top">Permit event series?</td>
    <td><input name="eventseries_p" type="radio" value="1" <?php if ($this->_tpl_vars['config_query'][0]['eventseries'] == 1): ?>checked<?php endif; ?>>
Yes
<input name="eventseries_p" type="radio" value="0" <?php if ($this->_tpl_vars['config_query'][0]['eventseries'] == 0): ?>checked<?php endif; ?>>
No</td>
  </tr>
  <tr>
    <td colspan="3"><hr></td>
  </tr>
  <tr>
    <td colspan="3"><strong>Photo Configuration:</strong> </td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td> Photo Resize Width:</td>
    <td><input name="photo_width" type="text" id="photo_width " value="<?php echo $this->_tpl_vars['config_query'][0]['photo_resize_width']; ?>
"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td> Photo Resize Height: </td>
    <td><input name="photo_height" type="text" id="photo_height" value="<?php echo $this->_tpl_vars['config_query'][0]['photo_resize_height']; ?>
"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><strong></strong></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td> <p>Photo Thumbnail Size:<br>
      <strong><font size="1">(Thumbnail is a square): </font></strong></p>
      </td>
    <td><input name="photo_thumb" type="text" id="photo_thumb" value="<?php echo $this->_tpl_vars['config_query'][0]['photo_thumb_resize']; ?>
"></td>
  </tr>
  <tr>
    <td colspan="3"><hr></td>
  </tr>
  <tr>
    <td colspan="3"><strong>Image Configuration:</strong> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td> Image Resize Width:</td>
    <td><input name="img_width" type="text" id="img_width " value="<?php echo $this->_tpl_vars['config_query'][0]['img_resize_width']; ?>
"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td> Image Resize Height: </td>
    <td><input name="img_height" type="text" id="img_height" value="<?php echo $this->_tpl_vars['config_query'][0]['img_resize_height']; ?>
"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><strong><font size="1">* Only fill in one of the following (set the other to 0): </font></strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td> Image Thumbnail Resize Width:</td>
    <td><input name="img_thumb_width" type="text" id="img_thumb_width" value="<?php echo $this->_tpl_vars['config_query'][0]['img_thumb_resize_width']; ?>
"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td> Image Thumbnail Resize Height: </td>
    <td><input name="img_thumb_height" type="text" id="img_thumb_height" value="<?php echo $this->_tpl_vars['config_query'][0]['img_thumb_resize_height']; ?>
"></td>
  </tr>
  <tr>
    <td colspan="3"><hr></td>
  </tr>
  <tr>
    <td colspan="3"><strong>Features Configuration:</strong> </td>
  </tr>
  <tr>
    <td colspan="3"><hr></td>
  </tr>
  <tr>
    <td colspan="3"><strong>Members Configuration:</strong> </td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">Associate Members with Locations? </td>
    <td><input name="memberloc_p" type="radio" value="1" <?php if ($this->_tpl_vars['config_query'][0]['memberloc'] == 1): ?>checked<?php endif; ?>>
Yes
  <input name="memberloc_p" type="radio" value="0" <?php if ($this->_tpl_vars['config_query'][0]['memberloc'] == 0): ?>checked<?php endif; ?>>
No</td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">Add username and password for members? </td>
    <td><input name="memberpass_p" type="radio" value="1" <?php if ($this->_tpl_vars['config_query'][0]['memberpass'] == 1): ?>checked<?php endif; ?>>
Yes
  <input name="memberpass_p" type="radio" value="0" <?php if ($this->_tpl_vars['config_query'][0]['memberpass'] == 0): ?>checked<?php endif; ?>>
No</td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">Custom Field 1: </td>
    <td><input name="member_cust1" type="text" id="member_cust1" value="<?php echo $this->_tpl_vars['config_query'][0]['member_cust1']; ?>
" size="35"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">Custom Field 2: </td>
    <td><input name="member_cust2" type="text" id="member_cust2" value="<?php echo $this->_tpl_vars['config_query'][0]['member_cust2']; ?>
" size="35"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">Custom Field 3: </td>
    <td><input name="member_cust3" type="text" id="member_cust3" value="<?php echo $this->_tpl_vars['config_query'][0]['member_cust3']; ?>
" size="35"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">Custom Field 4: </td>
    <td><input name="member_cust4" type="text" id="member_cust4" value="<?php echo $this->_tpl_vars['config_query'][0]['member_cust4']; ?>
" size="35"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">Custom Field 5: </td>
    <td><input name="member_cust5" type="text" id="member_cust5" value="<?php echo $this->_tpl_vars['config_query'][0]['member_cust5']; ?>
" size="35"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">Custom Field 6: </td>
    <td><input name="member_cust6" type="text" id="member_cust6" value="<?php echo $this->_tpl_vars['config_query'][0]['member_cust6']; ?>
" size="35"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">Custom Field 7: </td>
    <td><input name="member_cust7" type="text" id="member_cust7" value="<?php echo $this->_tpl_vars['config_query'][0]['member_cust7']; ?>
" size="35"></td>
  </tr>
  <tr>
    <td colspan="3"><hr></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><strong>Store Configuration: </strong></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">PayPal Address: </td>
    <td><input name="paypalemail" type="text" id="payl" value="<?php echo $this->_tpl_vars['config_query'][0]['paypal_email']; ?>
" size="35"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">Store Address: </td>
    <td><textarea name="storeaddress" cols="30" rows="5" id="storeaddress"><?php echo $this->_tpl_vars['config_query'][0]['store_address']; ?>
</textarea>
	<?php echo '
	<script language="JavaScript1.2" defer>
	var config = new Object(); // create new config object
		config.toolbar = [
		  [\'bold\',\'italic\',\'underline\',\'separator\'],[\'htmlmode\']
		]; 

		editor_generate(\'storeaddress\',config);
	   </script>
	   '; ?>
</td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">Price to ship first item: </td>
    <td><input name="shipfirst" type="text" id="shipfirst" value="<?php echo $this->_tpl_vars['config_query'][0]['ship_first']; ?>
"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">Additional Item (within USA) </td>
    <td><input name="shipusa" type="text" id="shipusa" value="<?php echo $this->_tpl_vars['config_query'][0]['ship_usa']; ?>
"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">Additional Item (Internationally) </td>
    <td><input name="shipint" type="text" id="paypal_address5" value="<?php echo $this->_tpl_vars['config_query'][0]['ship_int']; ?>
"></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><div align="center">
      <p>
        <input name="action" type="hidden" id="action" value="submit">
</p>
      <p>
        <input type="submit" name="Submit" value="modify configs">
          </p>
    </div></td>
    </tr>
</table>


</form>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/footer.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>