<?php
namespace TYPO3\Semantic\Domain\Model\Sparql;

/*                                                                        *
 * This script belongs to the FLOW3 package "TYPO3.Semantic".             *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Endpoint
 *
 * @FLOW3\Entity
 */
class Endpoint {

	/**
	 * The name
	 * @var string
	 */
	protected $name;

	/**
	 * The iri
	 * @var string
	 */
	protected $iri;

	/**
	 * The username
	 * @var string
	 */
	protected $username;

	/**
	 * The password
	 * @var string
	 */
	protected $password;


	/**
	 * Get the Endpoint's name
	 *
	 * @return text The Endpoint's name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets this Endpoint's name
	 *
	 * @param text $name The Endpoint's name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Get the Endpoint's iri
	 *
	 * @return string The Endpoint's iri
	 */
	public function getIri() {
		return $this->iri;
	}

	/**
	 * Sets this Endpoint's iri
	 *
	 * @param string $iri The Endpoint's iri
	 * @return void
	 */
	public function setIri($iri) {
		$this->iri = $iri;
	}

	/**
	 * Get the Endpoint's username
	 *
	 * @return string The Endpoint's username
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * Sets this Endpoint's username
	 *
	 * @param string $username The Endpoint's username
	 * @return void
	 */
	public function setUsername($username) {
		$this->username = $username;
	}

	/**
	 * Get the Endpoint's password
	 *
	 * @return string The Endpoint's password
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * Sets this Endpoint's password
	 *
	 * @param string $password The Endpoint's password
	 * @return void
	 */
	public function setPassword($password) {
		$this->password = $password;
	}

}
?>