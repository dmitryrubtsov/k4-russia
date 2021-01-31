<?PHP

	define('__CFG_CORE_PATH', dirname(realpath(__FILE__))."/");


    define('__CFG_CLIENT_SCRIPT', false);

    define('__CFG_SUBSYSTEM_ID','1');

    define('__CFG_SESSION_HANDLE', 'S3dfSNT');
    define('__CFG_SESSION_NAME', 'HQIWUGD');

    define('__CFG_ZONE_ADMIN_ACCESSOR', '/admin/');

    define('__CFG_AREA_ADMIN', FALSE);
	define('__CFG_AREA_MANAGE', FALSE);

	define('__CFG_ADMIN_USER_ID', 'lmr');

    define('__CFG_FILE_MANAGER_FOLDER', 'images/myfls/');

    define('__TRUE', 1);
    define('__FALSE', '');
    define('__ERROR', -1);

    define('__CFG_PGR_ADDSLASHES', __FALSE);
    define('__CFG_PGR_STRIPSLASHES', __TRUE);
    define('__CFG_FLTR_ADDSLASHES', __TRUE);

	require_once('config.path.php');
	require_once('config.sql.php');
	require_once('config.local.php');

	define('__HEADER_PAGE_NOT_FOUND', "HTTP/1.0 404 Not Found");

	$MakeLinkNameSearchArr = array(
  						'\\',
  						' ',
  						'&',
  						'/',
  						')',
  						'(',
  						';',
  						':',
  						',',
  						'%',
  						'!',
  						'?',
  						'=',
  						'+',
  						'$',
  						'#',
  						'"',
  						'>',
  						'<',
  						'\'',
  						'_',
  						'[',
  						']',
                        '№',
  					   );

  	$MakeLinkNameSearchArrJVSC = array(
  						'\\\\',
  						' ',
  						'\&',
  						'\/',
  						'\)',
  						'\(',
  						'\;',
  						'\:',
  						'\,',
  						'\%',
  						'\!',
  						'\?',
  						'=',
  						'\+',
  						'\$',
  						'\#',
  						'"',
  						'\>',
  						'\<',
  						'\\\'',
  						'\_',
  						'\[',
  						'\]',
                        '№',
  					   );

  	$MakeLinkNameReplaceArr = array(
  						' ',
  						' ',
  						'and',
  						' ',
  						' ',
  						' ',
  						' ',
  						' ',
  						' ',
  						' ',
  						' ',
  						' ',
  						' ',
  						' ',
  						' ',
  						' ',
  						'',
  						' ',
  						' ',
  						'',
  						' ',
  						' ',
  						' ',
                        '',
  						);

?>