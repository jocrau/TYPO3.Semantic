<?php
namespace TYPO3\Semantic\ViewHelpers;

/*                                                                        *
 * This script belongs to the FLOW3 package "TYPO3.Semantic".             *
 *                                                                        *
 *                                                                        */

class HumanizeViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * Make a word human readable
	 *
	 * @param string $string The string to make human readable
	 * @return string The human readable string
	 */
	public function render($string = NULL) {
		if ($string === NULL) {
			$string = $this->renderChildren();
		}
		$string = strtolower(preg_replace('/(?<=\w)([A-Z])/', '_\\1', $string));
		$string = str_replace('_', ' ', $string);
		$string = ucwords($string);
		return $string;
	}
}

?>