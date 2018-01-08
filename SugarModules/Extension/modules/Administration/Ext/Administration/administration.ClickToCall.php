<?php

$admin_options_defs = array();
$admin_options_defs['Administration']['AsteriskConfiguration'] = array(
    'ASTERISKPANELSETTINGS',
    'LBL_CLICKTOCALL_CONFIGURATION_TITLE',
    'LBL_CLICKTOCALL_CONFIGURATION_DESC',
    './index.php?module=ClickToCall'
);
$admin_group_header[] = array(
    'LBL_CLICKTOCALL_TITLE',
    'LBL_CLICKTOCALL_DESC',
    false,
    $admin_options_defs
);

