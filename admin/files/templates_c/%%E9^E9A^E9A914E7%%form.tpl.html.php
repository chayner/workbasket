<?php /* Smarty version 2.6.9, created on 2005-09-05 10:10:22
         compiled from ./form.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'get_files', './form.tpl.html', 17, false),array('insert', 'image_select', './form.tpl.html', 115, false),array('insert', 'category_select', './form.tpl.html', 125, false),array('modifier', 'lower', './form.tpl.html', 113, false),array('modifier', 'capitalize', './form.tpl.html', 124, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../templates/header.tpl.html", 'smarty_include_vars' => array('title' => 'files','page' => 'files')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
<p><strong class="title"><?php echo $this->_tpl_vars['files'][0]['filename']; ?>
</strong><br>

<br>Add Item Details:
<form name="admin_item" enctype="multipart/form-data" method="post" action="submit.php">
    	 
  <table cellpadding="5">
	<tr valign="top">
      <td width="175">Filename:
	  </td>
      <td>
	  <?php if ($this->_tpl_vars['files'][0]['fileuploaded'] == '1'): ?>
	  	<?php echo $this->_tpl_vars['files'][0]['filename']; ?>

		<input type="hidden" name="filename" value="<?php echo $this->_tpl_vars['files'][0]['filename']; ?>
"> 
	  <?php else: ?>
  	  	  <p>Select a file from the "/files" directory:
			<br><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'get_files', 'cur_file' => $this->_tpl_vars['files'][0]['filename'])), $this); ?>

          
		
		    <input type="hidden" name="old_filename" value="<?php echo $this->_tpl_vars['files'][0]['filename']; ?>
"> 
			<input type="hidden" name="fileuploaded" value="<?php echo $this->_tpl_vars['files'][0]['fileuploaded']; ?>
"> 
          </p>
	   <?php endif; ?>
	  </td>
    </tr>
        <tr valign="top">
          <td>Filetype:</td>
          <td>
	  	  <?php if ($this->_tpl_vars['files'][0]['fileuploaded'] == '0'): ?>
				<select name="filetype">
					<option value="<?php echo $this->_tpl_vars['files'][0]['filetype']; ?>
">
						  <?php if ($this->_tpl_vars['files'][0]['filetype'] == "video/mpeg"): ?>
							MPEG Video
						  <?php elseif ($this->_tpl_vars['files'][0]['filetype'] == "audio/mpeg"): ?>
							MP3
						  <?php elseif ($this->_tpl_vars['files'][0]['filetype'] == "application/vnd.rn-realfiles"): ?>
							Real files
						  <?php elseif ($this->_tpl_vars['files'][0]['filetype'] == "video/quicktime"): ?>
							Quicktime
						  <?php elseif ($this->_tpl_vars['files'][0]['filetype'] == "video/avi"): ?>
							AVI Video
						  <?php elseif ($this->_tpl_vars['files'][0]['filetype'] == "video/x-ms-wmv"): ?>
							Windows files Video
						  <?php elseif ($this->_tpl_vars['files'][0]['filetype'] == "application/x-shockwave-flash"): ?>
							Macrofiles Flash
						  <?php elseif ($this->_tpl_vars['files'][0]['filetype'] == "application/pdf"): ?>
					  		Adobe Acrobat
			  			  <?php else: ?>
							<?php echo $this->_tpl_vars['files'][0]['filetype']; ?>

						  <?php endif; ?>
					</option>
					<option value="">------------</option>
					<option value="">None</option>
					<option value="audio/mpeg">MP3</option>
					<option value="application/pdf">Acrobat PDF</option>
					<option value="application/vnd.rn-realfiles">Real files</option>
					<option value="video/mpeg">MPEG Video</option>							
					<option value="video/quicktime">Quicktime Video</option>
				</select>
			<?php else: ?>
			  <?php if ($this->_tpl_vars['files'][0]['filetype'] == "video/mpeg"): ?>
				MPEG Video
			  <?php elseif ($this->_tpl_vars['files'][0]['filetype'] == "audio/mpeg"): ?>
				MP3
			  <?php elseif ($this->_tpl_vars['files'][0]['filetype'] == "application/vnd.rn-realfiles"): ?>
				Real files
			  <?php elseif ($this->_tpl_vars['files'][0]['filetype'] == "video/quicktime"): ?>
				Quicktime
			  <?php elseif ($this->_tpl_vars['files'][0]['filetype'] == "video/avi"): ?>
				AVI Video
			  <?php elseif ($this->_tpl_vars['files'][0]['filetype'] == "video/x-ms-wmv"): ?>
				Windows files Video
			  <?php elseif ($this->_tpl_vars['files'][0]['filetype'] == "application/x-shockwave-flash"): ?>
				Macrofiles Flash
			  <?php elseif ($this->_tpl_vars['files'][0]['filetype'] == "application/pdf"): ?>
				Adobe Acrobat
			  <?php else: ?>
				<?php echo $this->_tpl_vars['files'][0]['filetype']; ?>

			  <?php endif; ?>
			  <input type="hidden" name="filetype" value="<?php echo $this->_tpl_vars['files'][0]['filetype']; ?>
"> 
			<?php endif; ?>
		  </td>
        </tr>
        <tr valign="top">
          <td colspan="2"><hr></td>
        </tr>
    <tr valign="top"> 
      <td width=175> 
        <p> Title: </td>
      <td> 
        <input type="text" name="title" size=50 value="<?php echo $this->_tpl_vars['files'][0]['title']; ?>
">
      </td>
    </tr>
    <tr valign="top"> 
      <td width=175> 
        <p> Description: </td>
      <td> 
        <textarea name="description" cols=40 rows=4><?php echo $this->_tpl_vars['files'][0]['description']; ?>
</textarea>
      </td>
    </tr>
    <tr valign="top"> 
      <td width="175"> Copyright Information: </td>
      <td> &copy; 
        <input type=text name="copyright" size=50 value="<?php echo $this->_tpl_vars['files'][0]['copyright']; ?>
">
      </td>
    </tr>
	
	<?php if ($this->_tpl_vars['cur_mod']['imgs_p']): ?>
	<tr valign="top">
	  <td colspan="2"><hr></td>
	</tr>
	<tr valign="top"> 
		<td width="175">Assign image to <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
:
		<p><img name=picture src="<?php if ($this->_tpl_vars['files'][0]['image_id']): ?>/photos/image_<?php echo $this->_tpl_vars['files'][0]['image_id']; ?>
_thumb.jpg<?php else: ?>/images/spacer.gif<?php endif; ?>"></p></td>
		<td><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'image_select', 'module' => $this->_tpl_vars['module'], 'cur_img' => $this->_tpl_vars['files'][0]['image_id'])), $this); ?>
</td>
	</tr>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['cur_mod']['cat_p']): ?>
	<tr valign="top">
	  <td colspan="2"><hr></td>
	</tr>
	<tr valign="top"> 
		<td width="175"> Item <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['cat_name'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
:</td>
		<td><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'category_select', 'module' => $this->_tpl_vars['module'], 'cur_cat' => $this->_tpl_vars['files'][0]['category'])), $this); ?>
</td>
	</tr>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['files'][0]['fileuploaded'] == '1'): ?>

    <tr valign="top">
      <td colspan="2"><hr></td>
    </tr>
	
    <tr valign="top"> 
      <td width="175"> 
        <p>Update current item <br>
          with a new file:</p>
        <?php if ($this->_tpl_vars['message'] == 1): ?> <font size=2 color=red><b>The file you selected is 
        not a valid <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
.</b></font> <hr>
        <?php endif; ?> </td>
      <td> 
        <input type=file name=uploadfile>
        <br> <input type="hidden" name="old_filename" value="<?php echo $this->_tpl_vars['files'][0]['filename']; ?>
"> 
			<input type="hidden" name="fileuploaded" value="<?php echo $this->_tpl_vars['files'][0]['fileuploaded']; ?>
"> 
        
			  <p>Or select a file from the "/files" directory:
			<br><?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'get_files', 'cur_file' => $this->_tpl_vars['files'][0]['filename'])), $this); ?>

          </p>

	  </td>
    </tr>
		<?php endif; ?>
    <tr valign="top">
      <td colspan="2"><hr></td>
    </tr>
  </table>
     <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
">
	 <input type="hidden" name="action" value="edit">
     <input type="submit" value="Submit <?php echo ((is_array($_tmp=$this->_tpl_vars['cur_mod']['item'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
">
</form>

</table>