<?php
if (!defined ('TYPO3_MODE')) {
 	die ('Access denied.');
}

t3lib_extMgm::addPItoST43($_EXTKEY, 'pi1/class.tx_facebookogtags_pi1.php', '_pi1', 'header_layout', 0);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-output']['facebook_og_tags'] = 'EXT:'.$_EXTKEY.'/pi1/class.tx_facebookogtags_pi1.php:tx_facebookogtags_pi1->contentPostProc';
?>