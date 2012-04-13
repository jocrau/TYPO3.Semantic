<?php
namespace TYPO3\Semantic\Domain\Model\Rdf;

/*                                                                        *
 * This script belongs to the FLOW3 package "TYPO3.Semantic".             *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Namespace
 *
 * @FLOW3\ValueObject
 */
class RdfNamespace {

	/**
	 * The prefix
	 * @var string
	 */
	protected $prefix;

	/**
	 * The iri
	 * @var string
	 */
	protected $iri;

	function __construct($prefix, $iri) {
		$this->setPrefix($prefix);
		$this->setIri($iri);
	}

	/**
	 * Get the Namespace's prefix
	 *
	 * @return string The Namespace's prefix
	 */
	public function getPrefix() {
		return $this->prefix;
	}

	/**
	 * Get the Namespace's iri
	 *
	 * @return string The Namespace's iri
	 */
	public function getIri() {
		return $this->iri;
	}

}
?>