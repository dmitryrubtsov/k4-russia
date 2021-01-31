<?php /* Smarty version 2.6.16, created on 2014-03-21 20:00:18
         compiled from admin.field_checkboxes.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.field_checkboxes.tpl', 3, false),array('modifier', 'unescape', 'admin.field_checkboxes.tpl', 63, false),array('function', 'html_checkboxes', 'admin.field_checkboxes.tpl', 63, false),)), $this); ?>
<div class="checkboxes">
	<script language="javascript">
	function checkElement<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
(form,value)
	{
	  var length = document.forms[form].length;
	  var str = new String();
	  for(i=0;i<length;i++)
	  {
	    str = document.forms[form].elements[i].name;
	    if(str.match(/^<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
/))
	    {	      document.forms[form].elements[i].checked=value;
	    }
	  }
	}
	<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['joinFunc'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == 'y'): ?>
	var chList<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
 = new Array();
	<?php $_from = ((is_array($_tmp=$this->_tpl_vars['Field']['values'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['curr']):
?>
	chList<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
['<?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
']="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
";
	<?php endforeach; endif; unset($_from); ?>
	function joinElements<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
(form)
	{
	  var length = document.forms[form].length;
	  var str = new String();
	  var arr = new Array();
	  var k=0;
	  for(i=0;i<length;i++)
	  {
	    str = document.forms[form].elements[i].name;
	    if(str.match(/^<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
/))
	    {
	      if(document.forms[form].elements[i].checked!='')
	      {
	        arr[k] = document.forms[form].elements[i].value;
	        k++;
	      }
	    }
	  }
	  var elem = new String();
	  var elemText = new String();
	  for(i=0;i<arr.length;i++)
	  {
	    if(i!= 0)
	    {
	     elem=elem+'<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['joinDelim'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''):  echo ((is_array($_tmp=$this->_tpl_vars['Field']['joinDelim'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  else:  echo ((is_array($_tmp=$this->_tpl_vars['Config']['AdminListInRowDelim'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  endif; ?>';
	     elemText=elemText+'<br />';
	    }
	    elem=elem+arr[i];
	    elemText=elemText+chList<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
[arr[i]];
	  }
	  opener.document.getElementById('<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['parentElemID'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''):  echo ((is_array($_tmp=$this->_tpl_vars['Field']['parentElemID'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  else:  echo ((is_array($_tmp=$_GET['elemid'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  endif; ?>').value=elem;
	  opener.document.getElementById('<?php if (((is_array($_tmp=$this->_tpl_vars['Field']['parentElemID'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) != ''):  echo ((is_array($_tmp=$this->_tpl_vars['Field']['parentElemID'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  else:  echo ((is_array($_tmp=$_GET['elemid'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  endif; ?>-list').innerHTML=elemText;
	}
	<?php endif; ?>
	</script>

	<a href="#" onclick="checkElement<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
('<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['AddFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
','checked');return false;"><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['checkAll'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
	&nbsp;|&nbsp;
	<a href="#" onclick="checkElement<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
('<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['AddFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
','');return false;"><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['uncheckAll'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
	<br />

	<ul>
		<li>
	<?php echo smarty_function_html_checkboxes(array('name' => ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')),'options' => ((is_array($_tmp=$this->_tpl_vars['Field']['values'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')),'selected' => ((is_array($_tmp=$this->_tpl_vars['Field']['selected'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')),'separator' => ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Field']['separator'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)),'other' => ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Field']['other'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp))), $this);?>

		</li>
	</ul>

	<a href="#" onclick="checkElement<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
('<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['AddFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
','checked');return false;"><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['checkAll'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
	&nbsp;|&nbsp;
	<a href="#" onclick="checkElement<?php echo ((is_array($_tmp=$this->_tpl_vars['Field']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
('<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['AddFormName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
','');return false;"><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['admin']['uncheckAll'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>

</div>