<?php

if (!defined('sugarEntry')) {
    define('sugarEntry', true);
}

function pre_uninstall()
{

    require_once('modules/ModuleBuilder/parsers/ParserFactory.php');

    $views = array(
        'editview',
        'detailview'
    );

    foreach ($views as $view) {

        $parser = ParserFactory::getParser($view, 'Users');

        if (isset($parser->_viewdefs['panels']['LBL_CLICKTOCALL_PANEL'])) {
            unset($parser->_viewdefs['panels']['LBL_CLICKTOCALL_PANEL']);
            $parser->handleSave(false);
        }

    }

}

