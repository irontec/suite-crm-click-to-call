<?php

$manifest = array(
    'acceptable_sugar_versions' => array(
        'exact_matches' => array(
            1 => '6.5.15'
        ),
        'regex_matches' => array(
            1 => '6\.4\.\d',
            2 => '6\.[0-9]\.\d',
            3 => '7\.[0-9]\.\d'
        )
    ),
    'acceptable_sugar_flavors' => array(
        'CE',
        'PRO',
        'ENT',
        'CORP'
    ),
    'readme' => '',
    'key' => '',
    'author' => ' ',
    'description' => 'SuiteCRM Click to Call (Asterisk)',
    'icon' => '',
    'is_uninstallable' => true,
    'name' => 'SuiteCRM Click to Call (Asterisk)',
    'published_date' => 'January 8, 2018',
    'type' => 'module',
    'version' => 'v0.0.1',
    'remove_tables' => false
);

$installdefs = array(
    'id' => 'ClickToCall',
    'copy' => array(
        0 => array(
            'from' => '<basepath>/SugarModules/Extension/modules/Administration/Ext/',
            'to' => 'custom/Extension/modules/Administration/Ext'
        ),
        1 => array(
            'from' => '<basepath>/SugarModules/Extension/modules/Users/Ext/Language',
            'to' => 'custom/Extension/modules/Users/Ext/Language'
        ),
        2 => array(
            'from' => '<basepath>/SugarModules/modules/ClickToCall',
            'to' => 'modules/ClickToCall'
        ),
        3 => array(
            'from' => '<basepath>/SugarModules/EntryPoint/clickToCall.php',
            'to' => 'custom/Extension/application/Ext/EntryPointRegistry/clickToCall.php'
        )
    ),
    'mkdir' => array(),
    'administration' => array(),
    'custom_fields' => array(
        array(
            'id' => 'extension_id',
            'name' => 'phone_extension_c',
            'label' => 'LBL_CLICKTOCALL_PHONE_EXTENSION',
            'type' => 'varchar',
            'module' => 'Users',
            'help' => 'Enter Your Extension',
            'comment' => '',
            'default_value' => '',
            'max_size' => 10,
            'required' => false,
            'reportable' => false,
            'audited' => false,
            'importable' => true,
            'duplicate_merge' => false
        )
    ),
    'logic_hooks' => array(
        array(
            'module' => '',
            'hook' => 'after_ui_footer',
            'order' => 99,
            'description' => 'SuiteCRM Click to Call',
            'file' => 'modules/ClickToCall/LoadCallerButton.php',
            'class' => 'LoadCallerButton',
            'function' => 'loadCallerButton'
        )
    )
);

$upgrade_manifest = array();
