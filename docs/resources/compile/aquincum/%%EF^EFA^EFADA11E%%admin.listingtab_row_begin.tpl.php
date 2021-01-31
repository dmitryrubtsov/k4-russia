<?php /* Smarty version 2.6.16, created on 2014-03-21 19:37:53
         compiled from admin.listingtab_row_begin.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.listingtab_row_begin.tpl', 1, false),array('modifier', 'unescape', 'admin.listingtab_row_begin.tpl', 45, false),array('function', 'eval', 'admin.listingtab_row_begin.tpl', 45, false),)), $this); ?>
<?php if (((is_array($_tmp=$this->_tpl_vars['NoUse']['Nomer'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ''): ?>
	<td><?php echo ((is_array($_tmp=$this->_tpl_vars['nomer'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td>
<?php endif; ?>
<?php if (((is_array($_tmp=$this->_tpl_vars['NoUse']['Checkbox'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ''): ?>
	<td class="check">
		<input type="checkbox" id="item<?php echo ((is_array($_tmp=$this->_tpl_vars['curr'][$this->_tpl_vars['WorkTableKeyFieldName']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" name="item[<?php echo ((is_array($_tmp=$this->_tpl_vars['curr'][$this->_tpl_vars['WorkTableKeyFieldName']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr'][$this->_tpl_vars['WorkTableKeyFieldName']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
	</td>
<?php endif; ?>
<?php if (((is_array($_tmp=$this->_tpl_vars['NoUse']['EditBlock'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ''): ?>
	<td>
		<nobr>
			<?php if (((is_array($_tmp=$this->_tpl_vars['NoUse']['Edit'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ''): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin.linktoitem.tpl", 'smarty_include_vars' => array('Mode' => ((is_array($_tmp=$this->_tpl_vars['Mode'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')),'linkTitle' => ((is_array($_tmp=$this->_tpl_vars['linkTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
			<?php if (((is_array($_tmp=$this->_tpl_vars['NoUse']['SaveButton'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ''): ?>
								<a href="#" onClick="checkItems('');itemCheck('item<?php echo ((is_array($_tmp=$this->_tpl_vars['curr'][$this->_tpl_vars['WorkTableKeyFieldName']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
');document.forms['<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['mainFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
'].act.value='edit';document.forms['<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['mainFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
'].submit();return false;" class="tablectrl_small bDefault tipS" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['saveButton'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
					<span class="buttonTemp icos-inbox"></span>
				</a>
							<?php endif; ?>
			<?php if (((is_array($_tmp=$this->_tpl_vars['NoUse']['DeleteButton'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ''): ?>
								<a href="#" onClick="if(confirm('<?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['askToDelThisRow'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
')){checkItems('');itemCheck('item<?php echo ((is_array($_tmp=$this->_tpl_vars['curr'][$this->_tpl_vars['WorkTableKeyFieldName']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
');document.forms['<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['mainFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
'].act.value='delete';document.forms['<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['mainFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
'].submit();}else{return false;}" class="tablectrl_small bDefault tipS" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['delete'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
					<span class="buttonTemp icos-cross"></span>
				</a>
			<?php endif; ?>
            <?php if (((is_array($_tmp=$this->_tpl_vars['NoUse']['CopyButton'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == ''): ?>
                            <a href="#" onclick="checkItems('');itemCheck('item<?php echo ((is_array($_tmp=$this->_tpl_vars['curr'][$this->_tpl_vars['WorkTableKeyFieldName']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
');document.forms['<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['mainFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
'].act.value='copy';document.forms['<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['mainFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
'].subtask.value='1';document.forms['<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['mainFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
'].submit();" class="tablectrl_small bDefault tipS" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['copy'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                    <span class="buttonTemp icos-copy"></span>
                </a>
            <?php endif; ?>
			<?php $_from = ((is_array($_tmp=$this->_tpl_vars['ListItemIconButtons'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['button']):
?>
				&nbsp;
				<a href="<?php if (((is_array($_tmp=$this->_tpl_vars['button']['href'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''):  echo smarty_function_eval(array('var' => ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['button']['href'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp))), $this); else: ?>#<?php endif; ?>"<?php if (((is_array($_tmp=$this->_tpl_vars['button']['onclick'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''): ?> onClick="<?php echo smarty_function_eval(array('var' => ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['button']['onclick'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp))), $this);?>
"<?php endif;  if (((is_array($_tmp=$this->_tpl_vars['button']['target'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''): ?> target="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['button']['target'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)); ?>
"<?php endif; ?>>
					<img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
/images/admin/<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['button']['src'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)); ?>
" border="0" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['button']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['button']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
				</a>
			<?php endforeach; endif; unset($_from); ?>
		</nobr>
	</td>
<?php endif; ?>