<?php

/*
'value' => array(
				'type' => 'value',  	// type
				'title' => '',      	// title of field in adminpanel
				'value' => '',      	// value
				'position' => 'vertical', //if position is not horisontal
				'defaultValue' => '',   // value
				'useInAddForm' => 'y',  // Used in add form
				'noUseInEdit' => 'y',   // NOT Used in edit func
				'required' => '[\d\w]+',    // required field => pattern
				'addVariable' => '',	// variable with data on this field in add
				'editVariable' => '',	// variable with data on this field in edit !!!if the same as addVariable - not require
				'addVarType' => '',     // var type [var|sqlfunc|...] default:var
				'editVarType' => '',    // var type [var|sqlfunc|...] default:var
				'useInList' => 'sort',	// Used in list of items  [show|sort]
				'inListEdit' => '',		// If edit is allowed - field type
				'useInListEdit' => 'y',	// Use in list in edit function
				'orderby' => '',        // seted, if this value differ from fieldname
				'tabord' => '',	        // seted, if table of the first sort field differ from current
				'allowEmpty' => '',		// 'y' - if allowed in edit funk be empty
				'textAfterField' => '',	// Some text after field in list or add/edit form
				'textUnderField' => '',	// Some text under field in add/edit form
				'noUseInCopy' => 'y',	// 'y' - if field not used in copy operation
				'inCopyValue' => '',	// some value to use in copy operation
				'SmartyMods' => array('escape:"html"'), // Smarty Modifier (ONLY FOR LIST)
);
'input' => array(
				'type' => 'input',  	// type
				'title' => '',      	// title of field in adminpanel
				'id' => '',         	// id of input field
				'size' => '',       	// size of input field
				'name' => '',       	// name of input field
				'value' => '',      	// value of input field
				'required' => '[\d\w]+',    // required field => pattern
				'position' => 'vertical', //if position is not horisontal
				'defaultValue' => '',   // value
				'makeSameValue' => 'linkname',	//name of field where same value needed
				'makeSameValueFrom' => 'title_en',	//field name if lang field
				'className' => '',  	// CSS class name
				'useInAddForm' => 'y',  // Used in add form
				'noUseInEdit' => 'y',  	// NOT Used in edit func
				'addVariable' => '',	// variable with data on this field in add
				'editVariable' => '',	// variable with data on this field in edit !!!if the same as addVariable - not require
				'addVarType' => '',     // var type [var|sqlfunc|...] default:var
				'editVarType' => '',    // var type [var|sqlfunc|...] default:var
				'useInList' => 'sort',	// Used in list of items  [show|sort]
				'inListEdit' => '',		// If edit is allowed - field type
				'useInListEdit' => 'y',	// Use in list in edit function
				'orderby' => '',        // seted, if this value differ from fieldname
				'tabord' => '',	        // seted, if table of the first sort field differ from current
				'editFormOther' => '',	// some editional params of input in edit form
				'other' => '',          // some editional params of input in form
				'allowEmpty' => '',		// 'y' - if allowed in edit funk be empty
				'textAfterField' => '',	// Some text after field in list or add/edit form
				'textUnderField' => '',	// Some text under field in add/edit form
				'noUseInCopy' => 'y',	// 'y' - if field not used in copy operation
				'inCopyValue' => '',	// some value to use in copy operation
				'SmartyMods' => array('escape:"html"'), // Smarty Modifier (ONLY FOR LIST)
);
'date' => array(
				'type' => 'date',  	// type
				'title' => '',      	// title of field in adminpanel
				'id' => '',         	// id of input field
				'name' => '',       	// name of input field
				'value' => '',      	// value of input field
				'required' => '[\d\w]+',    // required field => pattern
				'position' => 'vertical', //if position is not horisontal
				'defaultValue' => '',   // value
				'className' => '',  	// CSS class name
				'useInAddForm' => 'y',  // Used in add form
				'noUseInEdit' => 'y',  	// NOT Used in edit func
				'addVariable' => '',	// variable with data on this field in add
				'editVariable' => '',	// variable with data on this field in edit !!!if the same as addVariable - not require
				'useInList' => 'sort',	// Used in list of items  [show|sort]
				'orderby' => '',        // seted, if this value differ from fieldname
				'tabord' => '',	        // seted, if table of the first sort field differ from current
				'textAfterField' => '',	// Some text after field in list or add/edit form
				'textUnderField' => '',	// Some text under field in add/edit form
				'noUseInCopy' => 'y',	// 'y' - if field not used in copy operation
				'inCopyValue' => '',	// some value to use in copy operation
				'startYear' => '',		// Smarty param for func html_select_date
				'endYear' => '',		// Smarty param for func html_select_date
				'reverseYears' => true,	// Smarty param for func html_select_date
				'endYear' => '',		// Smarty param for func html_select_date
);
'textarea' => array(
				'type' => 'textarea',  	// type
				'title' => '',      	// title of field in adminpanel
				'id' => '',         	// id of textarea field
				'cols' => '',       	// cols of textarea field
				'rows' => '',       	// rows of textarea field
				'name' => '',       	// name of textarea field
				'value' => '',      	// value of textaea field
				'required' => '[\d\w]+',    // required field => pattern
				'position' => 'vertical', //if position is not horisontal
				'defaultValue' => '',   // value
				'className' => '',  	// CSS class name
				'useInAddForm' => 'y',  // Used in add form
				'noUseInEdit' => 'y',  	// NOT Used in edit func
				'addVariable' => '',	// variable with data on this field in add
				'editVariable' => '',	// variable with data on this field in edit !!!if the same as addVariable - not require
				'addVarType' => '',     // var type [var|sqlfunc|...] default:var
				'editVarType' => '',    // var type [var|sqlfunc|...] default:var
				'useInList' => 'sort',	// Used in list of items  [show|sort]
				'inListEdit' => '',		// If edit is allowed - field type
				'useInListEdit' => 'y',	// Use in list in edit function
				'orderby' => '',        // seted, if this value differ from fieldname
				'tabord' => '',	        // seted, if table of the first sort field differ from current
				'editFormOther' => '',	// some editional params of input in edit form
				'other' => '',          // some editional params of input in form
				'allowEmpty' => '',		// 'y' - if allowed in edit funk be empty
				'textAfterField' => '',	// Some text after field in list or add/edit form
				'textUnderField' => '',	// Some text under field in add/edit form
				'noUseInCopy' => 'y',	// 'y' - if field not used in copy operation
				'inCopyValue' => '',	// some value to use in copy operation
				'SmartyMods' => array('escape:"html"'), // Smarty Modifier (ONLY FOR LIST)
);
'fckeditor' => array(
				'type' => 'fckeditor',  // type
				'title' => '',          // title of field in adminpanel
				'id' => '',         	// id of textarea field
				'cols' => '',       	// cols of textarea field
				'rows' => '',       	// rows of textarea field
				'name' => '',       	// name of fckeditor/textarea field
				'value' => '',      	// value of fckeditor/textarea field
				'required' => '[\d\w]+',    // required field => pattern
				'position' => 'vertical', //if position is not horisontal
				'defaultValue' => '',   // value
				'height' => '',       	// height of fckeditor field
				'width' => '',       	// width of fckeditor field
				'toolbar' => '',      	// toolbar of fckeditor field
				'className' => '',  	// CSS class name
				'useInAddForm' => 'y',  // Used in add form
				'noUseInEdit' => 'y',  	// NOT Used in edit func
				'addVariable' => '',	// variable with data on this field in add
				'editVariable' => '',	// variable with data on this field in edit !!!if the same as addVariable - not require
				'addVarType' => '',     // var type [var|sqlfunc|...] default:var
				'editVarType' => '',    // var type [var|sqlfunc|...] default:var
				'useInList' => 'sort',	// Used in list of items  [show|sort]
				'inListEdit' => '',		// If edit is allowed - field type
				'useInListEdit' => 'y',	// Use in list in edit function
				'orderby' => '',        // seted, if this value differ from fieldname
				'tabord' => '',	        // seted, if table of the first sort field differ from current
				'allowEmpty' => '',		// 'y' - if allowed in edit funk be empty
				'textAfterField' => '',	// Some text after field in list or add/edit form
				'textUnderField' => '',	// Some text under field in add/edit form
				'noUseInCopy' => 'y',	// 'y' - if field not used in copy operation
				'inCopyValue' => '',	// some value to use in copy operation
				'SmartyMods' => array('escape:"html"'), // Smarty Modifier (ONLY FOR LIST)
);
'select_link' => array(
				'type' => 'select_link',  	// type
				'title' => '',          	// title of field in adminpanel
				'name' => '',       		// name of field
				'formid' => '',				// id of form
				'value' => '',      		// value of field
				'required' => '[\d\w]+',    // required field => pattern
				'position' => 'vertical', 	//if position is not horisontal
				'defaultValue' => '',   	// value
				'useInAddForm' => 'n',      // Used in add form
				'noUseInEdit' => 'y',  		// NOT Used in edit func
				'addVariable' => '',		// variable with data on this field in add
				'editVariable' => '',		// variable with data on this field in edit !!!if the same as addVariable - not require
				'addVarType' => '',      	// var type [var|sqlfunc|...] default:var
				'editVarType' => '',     	// var type [var|sqlfunc|...] default:var
				'useInList' => 'sort',		// Used in list of items  [show|sort]
				'inListEdit' => '',			// If edit is allowed - field type
				'useInListEdit' => 'y',		// Use in list in edit function
				'orderby' => '',        	// seted, if this value differ from fieldname
				'tabord' => '',	        	// seted, if table of the first sort field differ from current
				'textAfterField' => '',		// Some text after field in list or add/edit form
				'textUnderField' => '',		// Some text under field in add/edit form
				'noUseInCopy' => 'y',		// 'y' - if field not used in copy operation
				'inCopyValue' => '',		// some value to use in copy operation
				'SmartyMods' => array('escape:"html"'), // Smarty Modifier (ONLY FOR LIST)
				'values' => array(			// list of extrapolated values value => title
							'value1' => array(
										'title'	=> '',			// title of link
										'className' => '',  	// class name of link
										'formFields' => array( 	// list of extrapolated values name => value
														'name1' => 'value1'
														...................
										),
							),
							...................
				),
);
'select' => array(
				'type' => 'select',  		// type
				'title' => '',          	// title of field in adminpanel
				'name' => '',       		// name of field
				'value' => '',      		// value of field
				'defaultValue' => '',   	// value
				'required' => '[\d\w]+',    // required field => pattern
				'position' => 'vertical', 	//if position is not horisontal
				'useInAddForm' => 'n',      // Used in add form
				'noUseInEdit' => 'y',  		// NOT Used in edit func
				'addVariable' => '',		// variable with data on this field in add
				'editVariable' => '',		// variable with data on this field in edit !!!if the same as addVariable - not require
				'addVarType' => '',      	// var type [var|sqlfunc|...] default:var
				'editVarType' => '',     	// var type [var|sqlfunc|...] default:var
				'useInList' => 'sort',		// Used in list of items  [show|sort]
				'inListEdit' => '',			// If edit is allowed - field type
				'useInListEdit' => 'y',		// Use in list in edit function
				'orderby' => '',        	// seted, if this value differ from fieldname
				'tabord' => '',	        	// seted, if table of the first sort field differ from current
				'allowEmpty' => '',			// 'y' - if allowed in edit funk be empty
				'editFormOther' => '',		// some editional params of input in edit form
				'other' => '',          	// some editional params of input in form
				'textAfterField' => '',		// Some text after field in list or add/edit form
				'textUnderField' => '',		// Some text under field in add/edit form
				'noUseInCopy' => 'y',	// 'y' - if field not used in copy operation
				'inCopyValue' => '',	// some value to use in copy operation
				'SmartyMods' => array('escape:"html"'), // Smarty Modifier (ONLY FOR LIST)
				'values' => array(			// list of values key => val
							'key' => 'val',
							...............
				),
);

'checkbox' => array(
				'type' => 'checkbox',  		// type
				'title' => '',          	// title of field in adminpanel
				'id' => '',         		// id of input field
				'name' => '',       		// name of field
				'required' => '[\d\w]+',    // required field => pattern
				'position' => 'vertical', 	//if position is not horisontal
				'isRelation' => 'y',   		// is relation
				'useInAddForm' => 'n',      // Used in add form
				'noUseInEdit' => 'y',  		// NOT Used in edit func
				'addVariable' => '',		// variable with data on this field in add
				'editVariable' => '',		// variable with data on this field in edit !!!if the same as addVariable - not require
				'addVarType' => '',      	// var type [var|sqlfunc|...] default:var
				'editVarType' => '',     	// var type [var|sqlfunc|...] default:var
				'editFormOther' => '',		// some editional params of input in edit form
				'other' => '',          	// some editional params of input in form
				'textAfterField' => '',		// Some text after field in list or add/edit form
				'textUnderField' => '',		// Some text under field in add/edit form
				'noUseInCopy' => 'y',	// 'y' - if field not used in copy operation
				'inCopyValue' => '',	// some value to use in copy operation
				'defaultValue' => 'y',      // value
				'SmartyMods' => array('escape:"html"'), // Smarty Modifier (ONLY FOR LIST)
				'tableInfo' => array(       // table params for func makeListOfRelations()
  											'name' => $_SQL_TABLE['brand_cut_type'],
  											'keyField' => 'brand',
  											'keyFieldCol' => 'code',
  											'keyFieldValue' => $_REQUEST[id],
  								),

);

'checkboxes' => array(
				'type' => 'checkboxes',  	// type
				'title' => '',          	// title of field in adminpanel
				'name' => '',       		// name of field
				'position' => 'vertical', 	//if position is not horisontal
				'listOfRelations' => 'y',   // list of relations
				'addVariable' => '',		// variable with data on this field in add
				'editVariable' => '',		// variable with data on this field in edit !!!if the same as addVariable - not require
				'addVarType' => '',      	// var type [var|sqlfunc|...] default:var
				'editVarType' => '',     	// var type [var|sqlfunc|...] default:var
				'separator' => '',     		// string to separate checkboxes
				'editFormOther' => '',		// some editional params of input in edit form
				'other' => '',          	// some editional params of input in form
				'values' => array(			// list of values key => val
							'key' => 'val',
							...............
				),
				'selected' => [array(1,2,3...)|string], // array with values | string
				'SmartyMods' => array('escape:"html"'), // Smarty Modifier (ONLY FOR LIST)
				'tableInfo' => array(       // table params for func makeListOfRelations()
  											'name' => $_SQL_TABLE['brand_cut_type'],
  											'keyField' => 'brand',
  											'keyFieldCol' => 'code',
  											'relatedField' => 'cut_type',
  											'keyFieldValue' => $_REQUEST[id],
  								),

);

image_[varname]' => array(
				'type' => 'file',  			// type
				'title' => '',          	// title of field in adminpanel
				'name' => '',       		// name of field
				'value' => '',      		// value of field
				'required' => '[\d\w]+',    // required field => pattern
				'position' => 'vertical', 	//if position is not horisontal
				'defaultValue' => '',   	// value
				'useInAddForm' => 'y',      // Used in add form
				'noUseInEdit' => 'y',  		// NOT Used in edit func
				'editFormOther' => '',		// some editional params of input in edit form
				'textAfterField' => '',		// Some text after field in list or add/edit form
				'textUnderField' => '',		// Some text under field in add/edit form
				'size' => '123x30',			// Size of image
				'noResize' => 'y/n',		// resize image to params in size or sizes
				'old_filename' => '',       // old file name [string|array]
				'filetype' => '',			// .jpg or other
				'filename' => '',			// Name of image file for saving
				'filenamePrefix' => '',		// Prefix in the Name of image file for saving
				'multiimage' => 'y',        // y - if count of imegae more then 1
				'dirname' => '',			// Dir for saving of image file
				'docroot_dirname' => '',	// Dir of image file from document root
				'SmartyMods' => array('escape:"html"'), // Smarty Modifier (ONLY FOR LIST)
				'sizes' => array(			// [if needed some sizes and size is empty] list of sizes key => val as 123x64
							'1' => '120x30',
							...............
				),
);

// !!! var "name" & "value" are seted in smarty function

*/

?>