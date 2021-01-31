<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Администратор
 * Date: 07.10.13
 * Time: 15:14
 * To change this template use File | Settings | File Templates.
 */


class DFCms_Mail extends Zend_Mail
{
    protected $_charset = 'utf-8';

	static public function factory($charset = null)
	{
		return new self($charset);
	}

    /*
    public function __construct($options = null)
    {
        parent::__construct($options);

        $this->setView(new Zend_View());

        $view = $this->getView();
        $view->addHelperPath('DFCms/View/Helper', 'DFCms_View_Helper');

        $this->addPrefixPath('DFCms_Form', 'DFCms/Form');

        $this->addElementPrefixPaths(array(
            Zend_Form_Element::VALIDATE => array(
                'prefix' => 'DFCms_Validate',
                'path' => 'DFCms/Validate',
            ),
            Zend_Form_Element::FILTER => array(
                'prefix' => 'DFCms_Filter',
                'path' => 'DFCms/Filter',
            ),
        ));

    }
    */
}

?>