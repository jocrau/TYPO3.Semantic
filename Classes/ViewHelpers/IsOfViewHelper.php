<?php
namespace TYPO3\Semantic\ViewHelpers;

/*                                                                        *
 * This script belongs to the FLOW3 package "TYPO3.Semantic".             *
 *                                                                        *
 *                                                                        */

class IsOfViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * Checks if the given object is an instance of the given class name
	 *
	 * @param string $type The type
	 * @param mixed $subject The subject to be tested
	 * @return boolean TRUE if the given subject is of the given type
	 */
	public function render($type, $subject = NULL) {
		if ($subject === NULL) {
			$subject = $this->renderChildren();
		}
		if (is_object($subject)) {
			return $subject instanceof $type;
		} elseif (is_array($subject) && isset($subject['type'])) {
			return $subject['type'] === $type;
		} else {
			return FALSE;
		}
	}
}

?>