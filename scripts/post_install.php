<?php

if (!defined('sugarEntry')) {
    define('sugarEntry', true);
}

function post_install()
{
    require ('config.php');

    $url = $sugar_config['site_url'];

    require_once ('modules/Configurator/Configurator.php');
    require_once ('modules/ModuleBuilder/parsers/ParserFactory.php');

    $views = array(
        'editview',
        'detailview'
    );

    foreach ($views as $view) {
        $parser = ParserFactory::getParser($view, 'Users');
        if (!isset($parser->_viewdefs['panels']['LBL_CLICKTOCALL_PANEL'])) {
            $parser->_viewdefs['panels']['LBL_CLICKTOCALL_PANEL'] = array(
                array(
                    array(
                        'name' => 'phone_extension_c'
                    )
                )
            );
            $parser->handleSave(false);
        }
    }

    require_once ('modules/Administration/QuickRepairAndRebuild.php');

    $repairClear = new RepairAndClear();
    $repairClear->repairAndClearAll(
        array('clearAll'),
        array(translate('LBL_ALL_MODULES')),
        $autoexecute,
        true
    );

    echo '<br />';
    echo '<p><strong>SuiteCRM Click to Call (Asterisk)</strong> Installed Successfully .........</p>';
    echo '<br />';

}

