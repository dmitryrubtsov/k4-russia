<?php /* Smarty version 2.6.16, created on 2014-03-21 19:38:06
         compiled from admin.field_image.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.field_image.tpl', 1, false),array('modifier', 'unescape', 'admin.field_image.tpl', 1, false),array('modifier', 'count', 'admin.field_image.tpl', 7, false),array('modifier', 'cat', 'admin.field_image.tpl', 23, false),)), $this); ?>
<input class="<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['className'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ''): ?>inp_inpt<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['Field']['className'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  endif; ?> styled" type="file" name="<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" <?php if (((is_array($_tmp=$this->_tpl_vars['Field']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''): ?> id="<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"<?php endif;  if (((is_array($_tmp=$this->_tpl_vars['Field']['other'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''): ?> <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Field']['other'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp));  endif; ?> />

<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['textAfterField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>&nbsp;<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Field']['textAfterField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp));  endif;  if (((is_array($_tmp=$this->_tpl_vars['Field']['textUnderField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?><br /><sup><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Field']['textUnderField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)); ?>
</sup><?php endif; ?>

<?php if (((is_array($_tmp=$this->_tpl_vars['Item'][$this->_tpl_vars['Field']['name']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
	<?php $this->assign('imarray', ((is_array($_tmp=$this->_tpl_vars['Item'][$this->_tpl_vars['Field']['name']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))); ?>
	<?php if (((is_array($_tmp=$this->_tpl_vars['imarray']['images'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) && count(((is_array($_tmp=$this->_tpl_vars['imarray']['images'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))) > 0): ?>

     	<div class="image-field-area">
	     	<?php $_from = ((is_array($_tmp=$this->_tpl_vars['imarray']['images'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['curr']):
?>
	     				    	<?php $_from = ((is_array($_tmp=$this->_tpl_vars['Field']['sizes'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sizekey'] => $this->_tpl_vars['size']):
?>
		    		<?php if (((is_array($_tmp=$this->_tpl_vars['curr'][$this->_tpl_vars['size']['tableFieldPath']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
			    		<div class="image-each-block">
			    			<img src="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('cat', true, $_tmp, ((is_array($_tmp=$this->_tpl_vars['curr'][$this->_tpl_vars['size']['tableFieldPath']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))) : smarty_modifier_cat($_tmp, ((is_array($_tmp=$this->_tpl_vars['curr'][$this->_tpl_vars['size']['tableFieldPath']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))); ?>
" border="0" class="im" />
			    			<div class="icon-area">
			    				<div class="icon-block">
			    					<a href="#" onClick="if(confirm('<?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['askToDelImage'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
')){document.forms['<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['ImageFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
'].imageId.value='<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
';document.forms['<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['ImageFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
'].fieldName.value='<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
';document.forms['<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['ImageFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
'].tableName.value='<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['storeTable']['tableName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
';document.forms['<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['ImageFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
'].tableInfoName.value='<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['storeTable']['tableInfoName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
';document.forms['<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['ImageFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
'].tableKeyField.value='<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['storeTable']['keyField'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
';document.forms['<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['ImageFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
'].act.value='deleteimage';document.forms['<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['ImageFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
'].submit();return false;}else{return false}">
			    						<img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['MainImageFolder'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['adminImageFolder'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['generalImageFolder'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
close_ico.png" width="20" height="20" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['deleteImage'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
			   						</a>
			   					</div>
			    				<div class="icon-block hide-def">
			    					<a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['BaseURL'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
index.php?mode=image&key_image_id=<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
&pmode=image_list&cntonly=y&iframe=true&width=600&height=550" rel="prettyPhoto" >
			    						<img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['MainImageFolder'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['adminImageFolder'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['Config']['generalImageFolder'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
edit_ico.png" width="20" height="20" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['editImage'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
			    					</a>
			   					</div>
	                            			    			</div>
			 			</div>
		 			<?php endif; ?>
		    	<?php endforeach; endif; unset($_from); ?>
		    <?php endforeach; endif; unset($_from); ?>
		</div>
	<?php endif; ?>
<?php endif; ?>