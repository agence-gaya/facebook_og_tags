<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 Benoit Chenu <contact@gaya.fr>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 * Hint: use extdeveval to insert/update function index above.
 */

require_once(PATH_tslib.'class.tslib_pibase.php');


/**
 * Plugin '' for the 'facebook_og_tags' extension.
 *
 * @author	Benoit Chenu <contact@gaya.fr>
 * @package	TYPO3
 * @subpackage	tx_facebookogtags
 */
class tx_facebookogtags_pi1 extends tslib_pibase {
	public $prefixId      = 'tx_facebookogtags_pi1';		// Same as class name
	public $scriptRelPath = 'pi1/class.tx_facebookogtags_pi1.php';	// Path to this script relative to the extension dir.
	public $extKey        = 'facebook_og_tags';	// The extension key.
	public $pi_checkCHash = true;

	protected $tab_img = array();

	/**
	 * The main method of the PlugIn
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 * @return	The content that is displayed on the website
	 */
	public function main($content, $conf)	{
		if (!$this->is_active())
			return $content;

		if ($conf['data_page_field']) {
			foreach (explode(',', $this->cObj->data[$conf['data_page_field']]) as $img) {
				$lconf = array();
				$lconf['file'] = $conf['data_page_field.']['dir'].$img;
				$lconf['file.'] = $conf['data_page_field.']['file.'];

				$this->add_image($this->cObj->IMG_RESOURCE($lconf));
			}
		}

		foreach ($conf['images.'] as $key => $image) {
			if (substr($key, -1) != '.') {
				$this->add_image($this->cObj->IMG_RESOURCE($conf['images.'][$key.'.']));
			}
		}

		foreach ($this->tab_img as $img) {
			$content .= '<meta property="og:image" content="'.t3lib_div::getIndpEnv('TYPO3_SITE_URL').$img.'"/>'."\n";
		}

		return $content;
	}

	/**
	 * Parsing HTML content and set og tags with img found
	 */
	public function contentPostProc(&$params, &$reference)	{

		if (!$this->is_active())
			return;

		$head_pos = strpos($params['pObj']->content, '</head>');
		// No head, no chocolate
		if ($head_pos === false)
			return;
		$head = substr($params['pObj']->content, 0, $head_pos);

		// If no <base> tag is defined, this hook is useless, facebook will do his job
		if (!preg_match('#<base\s+[^>]*href=[\'"]([^"\']+)[\'"]#is', $head, $match))
			return;
		$base = $match[1];

		// Searching img
		if (preg_match_all('#<img\s+[^>]*src=[\'"]([^"\']+)[\'"]#is', $params['pObj']->content, $match)) {
			foreach ($match[1] as $img) {
				// Check if url is absolute
				if (substr($img, 0, 1) == '/' || preg_match('#^\w+://#is', $img))
					continue;

				$this->add_image($img);
			}
		}

		// No img found...
		if (!count($this->tab_img))
			return;

		// Adding img in head
		$chocolate = '';
		foreach ($this->tab_img as $img) {
			$chocolate .= '<meta property="og:image" content="'.$base.$img.'"/>'."\n";
		}
		$params['pObj']->content = $head.$chocolate.substr($params['pObj']->content, $head_pos);
	}

	/**
	 * Check if the plugin has to do something
	 *
	 * We currently do a simple check if USER_AGENT is a known bot which use OG TAGS
	 */
	protected function is_active() {
		return	(strpos(t3lib_div::getIndpEnv('HTTP_USER_AGENT'), 'facebookexternalhit') !== false) ||
			(strpos(t3lib_div::getIndpEnv('HTTP_USER_AGENT'), 'LinkedInBot') !== false);
	}

	/**
	 * Add an image to $tab_img
	 *
	 * @param string $img Image URL
	 */
	protected function add_image($img) {
		if ($img && !in_array($img, $this->tab_img)) {
			$this->tab_img[] = $img;
		}
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/facebook_og_tags/pi1/class.tx_facebookogtags_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/facebook_og_tags/pi1/class.tx_facebookogtags_pi1.php']);
}

?>