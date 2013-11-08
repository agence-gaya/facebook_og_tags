<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "facebook_og_tags".
 *
 * Auto generated 08-11-2013 12:15
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Facebook OG Tags',
	'description' => 'Adds Open Graph Tags with absolute URL. This plugins takes all img ressources in page and media configured on page.
This plugin helps to resolv <base> tag bug of OG services (Facebook and LinkedIn) which don\'t take care.',
	'category' => 'fe',
	'shy' => 0,
	'version' => '1.2.5',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'beta',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Benoit Chenu',
	'author_email' => 'contact@gaya.fr',
	'author_company' => 'GAYA',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'php' => '5.0.0-5.4.99',
			'typo3' => '4.5.0-6.0.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'suggests' => array(
	),
	'_md5_values_when_last_written' => 'a:8:{s:9:"ChangeLog";s:4:"f951";s:12:"ext_icon.gif";s:4:"bc0c";s:17:"ext_localconf.php";s:4:"b566";s:14:"ext_tables.php";s:4:"d41d";s:24:"ext_typoscript_setup.txt";s:4:"e692";s:10:"README.txt";s:4:"ac17";s:14:"doc/manual.sxw";s:4:"1e34";s:35:"pi1/class.tx_facebookogtags_pi1.php";s:4:"772c";}',
);

?>