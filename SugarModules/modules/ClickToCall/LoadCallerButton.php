<?php

if (!defined('sugarEntry') || ! sugarEntry) {
    die('Not A Valid Entry Point');
}

class LoadCallerButton
{

    function loadCallerButton()
    {

        if ($this->isValidLoadButtom())
        {

            $extension = $GLOBALS['current_user']->phone_extension_c;
            $siteUrl = $GLOBALS['sugar_config']['site_url'];

            echo '<script type="text/javascript">window.extension = ' . '"' . $extension . '"' . ';</script>';
            echo '<script type="text/javascript">window.siteUrl = ' . '"' . $siteUrl . '"' . ';</script>';
            echo '<script type="text/javascript" src="modules/ClickToCall/scripts/replaceAndCall.js"></script>';

        }
    }

    public function isValidLoadButtom()
    {

        $noActions = array(
            'modulelistmenu',
            'favorites',
            'Popup',
            'Login'
        );

        if (in_array($_REQUEST['action'], $noActions)) {
            return false;
        }

        if (!empty($_REQUEST['to_pdf']) || !empty($_REQUEST['to_csv'])) {
            return false;
        }

        $noModule = array(
            'ModuleBuilder',
            'Timesheets',
            'Emails'
        );

        if (in_array($_REQUEST['module'], $noModule)) {
            return false;
        }

        return true;

    }

}

