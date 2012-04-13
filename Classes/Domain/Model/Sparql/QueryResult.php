<?php
namespace TYPO3\Semantic\Domain\Model\Sparql;

/*                                                                        *
 * This script belongs to the FLOW3 package "TYPO3.Semantic".             *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Query result
 *
 * @FLOW3\Entity
 */
class QueryResult {

	/**
	 * The variables
	 * @var \Doctrine\Common\Collections\Collection
	 */
	protected $variables;

	/**
	 * The results
	 * @var \Doctrine\Common\Collections\Collection
	 */
	protected $results;

	/**
	 * The query
	 * @ORM\OneToOne
	 * @var \TYPO3\Semantic\Domain\Model\Sparql\Query
	 */
	protected $query;

	/**
	 * The query result parser
	 * @ORM\OneToOne
	 * @var \TYPO3\Semantic\Domain\Model\Sparql\QueryResultParser
	 */
	protected $queryResultParser;

	/**
	 * The is initialized
	 * @var boolean
	 */
	protected $isInitialized;


	/**
	 * Get the Query result's variables
	 *
	 * @return \Doctrine\Common\Collections\Collection The Query result's variables
	 */
	public function getVariables() {
		return $this->variables;
	}

	/**
	 * Sets this Query result's variables
	 *
	 * @param \Doctrine\Common\Collections\Collection $variables The Query result's variables
	 * @return void
	 */
	public function setVariables(\Doctrine\Common\Collections\Collection $variables) {
		$this->variables = $variables;
	}

	/**
	 * Get the Query result's results
	 *
	 * @return \Doctrine\Common\Collections\Collection The Query result's results
	 */
	public function getResults() {
		return $this->results;
	}

	/**
	 * Sets this Query result's results
	 *
	 * @param \Doctrine\Common\Collections\Collection $results The Query result's results
	 * @return void
	 */
	public function setResults(\Doctrine\Common\Collections\Collection $results) {
		$this->results = $results;
	}

	/**
	 * Get the Query result's query
	 *
	 * @return \TYPO3\Semantic\Domain\Model\Sparql\Query The Query result's query
	 */
	public function getQuery() {
		return $this->query;
	}

	/**
	 * Sets this Query result's query
	 *
	 * @param \TYPO3\Semantic\Domain\Model\Sparql\Query $query The Query result's query
	 * @return void
	 */
	public function setQuery(\TYPO3\Semantic\Domain\Model\Sparql\Query $query) {
		$this->query = $query;
	}

	/**
	 * Get the Query result's query result parser
	 *
	 * @return \TYPO3\Semantic\Domain\Model\Sparql\QueryResultParser The Query result's query result parser
	 */
	public function getQueryResultParser() {
		return $this->queryResultParser;
	}

	/**
	 * Sets this Query result's query result parser
	 *
	 * @param \TYPO3\Semantic\Domain\Model\Sparql\QueryResultParser $queryResultParser The Query result's query result parser
	 * @return void
	 */
	public function setQueryResultParser(\TYPO3\Semantic\Domain\Model\Sparql\QueryResultParser $queryResultParser) {
		$this->queryResultParser = $queryResultParser;
	}

	/**
	 * Get the Query result's is initialized
	 *
	 * @return boolean The Query result's is initialized
	 */
	public function getIsInitialized() {
		return $this->isInitialized;
	}

	/**
	 * Sets this Query result's is initialized
	 *
	 * @param boolean $isInitialized The Query result's is initialized
	 * @return void
	 */
	public function setIsInitialized($isInitialized) {
		$this->isInitialized = $isInitialized;
	}

}
?>