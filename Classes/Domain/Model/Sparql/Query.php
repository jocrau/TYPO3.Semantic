<?php
namespace TYPO3\Semantic\Domain\Model\Sparql;

/*                                                                        *
 * This script belongs to the FLOW3 package "TYPO3.Semantic".             *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Sparql query
 *
 * @FLOW3\Entity
 */
class Query {

	/**
	 * The name
	 * @var string
	 */
	protected $name;

	/**
	 * The body
	 * @var string
	 * @ORM\Column(type="text")
	 */
	protected $body;

	/**
	 * The limit
	 * @var integer
	 * @ORM\Column(name="quoted_limit")
	 */
	protected $limit = 0;

	/**
	 * The offset
	 * @var integer
	 * @ORM\Column(name="quoted_offset")
	 */
	protected $offset = 0;

	/**
	 * The endpoint
	 * @ORM\ManyToOne(cascade={"persist"})
	 * @var \TYPO3\Semantic\Domain\Model\Sparql\Endpoint
	 */
	protected $endpoint;

	/**
	 * The namespaces
	 * @var \Doctrine\Common\Collections\Collection<\TYPO3\Semantic\Domain\Model\Rdf\RdfNamespace>
	 * @ORM\ManyToMany
	 */
	protected $namespaces;


	/**
	 * Get the Sparql query's name
	 *
	 * @return string The Sparql query's name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets this Sparql query's name
	 *
	 * @param string $name The Sparql query's name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Get the Sparql query's body
	 *
	 * @return string The Sparql query's body
	 */
	public function getBody() {
		return $this->body;
	}

	/**
	 * Sets this Sparql query's body
	 *
	 * @param string $body The Sparql query's body
	 * @return void
	 */
	public function setBody($body) {
		$this->body = $body;
	}

	/**
	 * Get the Sparql query's limit
	 *
	 * @return integer The Sparql query's limit
	 */
	public function getLimit() {
		return $this->limit;
	}

	/**
	 * Sets this Sparql query's limit
	 *
	 * @param integer $limit The Sparql query's limit
	 * @return void
	 */
	public function setLimit($limit) {
		$this->limit = $limit;
	}

	/**
	 * Get the Sparql query's offset
	 *
	 * @return integer The Sparql query's offset
	 */
	public function getOffset() {
		return $this->offset;
	}

	/**
	 * Sets this Sparql query's offset
	 *
	 * @param integer $offset The Sparql query's offset
	 * @return void
	 */
	public function setOffset($offset) {
		$this->offset = $offset;
	}

	/**
	 * Get the Sparql query's endpoint
	 *
	 * @return \TYPO3\Semantic\Domain\Model\Sparql\Endpoint The Sparql query's endpoint
	 */
	public function getEndpoint() {
		return $this->endpoint;
	}

	/**
	 * Sets this Sparql query's endpoint
	 *
	 * @param \TYPO3\Semantic\Domain\Model\Sparql\Endpoint $endpoint The Sparql query's endpoint
	 * @return void
	 */
	public function setEndpoint($endpoint) {
		$this->endpoint = $endpoint;
	}

	/**
	 * Get the Sparql query's namespaces
	 *
	 * @return \Doctrine\Common\Collections\Collection<TYPO3\Semantic\Domain\Model\Rdf\RdfNamespace> The Sparql query's namespaces
	 */
	public function getNamespaces() {
		return $this->namespaces;
	}

	/**
	 * Sets this Sparql query's namespaces
	 *
	 * @param \Doctrine\Common\Collections\Collection<TYPO3\Semantic\Domain\Model\Rdf\RdfNamespace> $namespaces The Sparql query's namespaces
	 * @return void
	 */
	public function setNamespaces($namespaces) {
		$this->namespaces = $namespaces;
	}

	/**
	 * Executes the query against the SPARQL Endpoint and returns the result
	 *
	 * @return \TYPO3\Semantic\Domain\Model\Sparql\QueryResult The query result object
	 * @api
	 */
	public function execute() {
		return new QueryResult($this);
	}

}
?>