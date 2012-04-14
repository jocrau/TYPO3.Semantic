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
 * @FLOW3\Transient
 */
class QueryResult implements \TYPO3\FLOW3\Persistence\QueryResultInterface {

	/**
	 * The variables
	 * @var array
	 */
	protected $variables = array();

	/**
	 * The results
	 * @var array
	 */
	protected $results = array();

	/**
	 * The query
	 * @var \TYPO3\Semantic\Domain\Model\Sparql\Query
	 */
	protected $query;

	/**
	 * The query result parser
	 * @FLOW3\Inject
	 * @var \TYPO3\Semantic\Domain\Model\Sparql\QueryResultParser
	 */
	protected $queryResultParser;

	/**
	 * The is initialized
	 * @var boolean
	 */
	protected $isInitialized = FALSE;

	/**
	 * Constructor
	 *
	 * @param \TYPO3\Semantic\Domain\Model\Sparql\Query $query
	 */
	public function __construct(\TYPO3\Semantic\Domain\Model\Sparql\Query $query) {
		$this->query = $query;
	}

	/**
	 * Loads the QueryResult
	 *
	 * @return void
	 */
	protected function initialize() {
		if ($this->isInitialized === FALSE) {
			$this->results = array();
			$statement = '';
			foreach ($this->query->getNamespaces() as $namespace) {
				$statement .= "PREFIX " . $namespace->getPrefix() . ": <" . $namespace->getIri() . ">\r\n";
			}
			$statement .= $this->query->getBody() . "\r\n";
			if($this->query->getLimit() > 0) {
				$statement .= 'LIMIT ' . $this->query->getLimit() . "\r\n";
			}
			if($this->query->getOffset() > 0) {
				$statement .= 'OFFSET ' . $this->query->getOffset() . "\r\n";
			}

			$requestHeaders = array(
				"Accept: application/sparql-results+xml"
			);
			$username = $this->query->getEndpoint()->getUsername();
			if (is_string($username) && strlen($username) > 0) {
				$requestHeaders[] = "Authorization: Basic " . base64_encode($username . ":" . $this->query->getEndpoint()->getPassword());
			}

			$url = $this->query->getEndpoint()->getIri() . '?query=' . urlencode($statement);
			$response = $this->sendRequest($url, $requestHeaders);
			if ($response !== FALSE) {
				$parsedResponse = $this->queryResultParser->parse($response);
			} else {
				throw new \TYPO3\Semantic\Domain\Model\Sparql\Exception\SparqlEndpointException('Unable to fetch data from the SPARQL Endpoint right now.', 1295062323);
			}

			$this->setVariables($parsedResponse['variables']);
			$this->setResults($parsedResponse['results']);
			$this->isInitialized = TRUE;
		}
	}

	protected function sendRequest($url, $requestHeaders) {
		if (!function_exists('curl_init') || !($curlHandle = curl_init())) {
			return FALSE;
		}

		curl_setopt($curlHandle, CURLOPT_URL, $url);
		curl_setopt($curlHandle, CURLOPT_HEADER, 0);
		curl_setopt($curlHandle, CURLOPT_NOBODY, 0);
		curl_setopt($curlHandle, CURLOPT_HTTPGET, 'GET');
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlHandle, CURLOPT_FAILONERROR, 1);
		curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, 60);

		curl_setopt($curlHandle, CURLOPT_FOLLOWLOCATION, 1);

		if (is_array($requestHeaders)) {
			curl_setopt($curlHandle, CURLOPT_HTTPHEADER, $requestHeaders);
		}

		$response = curl_exec($curlHandle);
		curl_close($curlHandle);
		return $response;
	}

	/**
	 * Get the Query result's variables
	 *
	 * @return array The Query result's variables
	 */
	public function getVariables() {
		$this->initialize();
		return $this->variables;
	}

	/**
	 * Sets this Query result's variables
	 *
	 * @param array $variables The Query result's variables
	 * @return void
	 */
	public function setVariables(array $variables = array()) {
		$this->variables = $variables;
	}

	/**
	 * Get the Query result's results
	 *
	 * @return array The Query result's results
	 */
	public function getResults() {
		$this->initialize();
		return $this->results;
	}

	/**
	 * Sets this Query result's results
	 *
	 * @param array $results The Query result's results
	 * @return void
	 */
	public function setResults(array $results = array()) {
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


	/**
	 * Returns the first object in the result set
	 *
	 * @return object
	 * @api
	 */
	public function getFirst() {
		if (is_array($this->results) && count($this->results) > 0) {
			$results = $this->results;
			reset($results);
		} else {
			// TODO This has side effects if the query gets executed twice in the request/response cycle.
			$this->query->setLimit(1);
			$this->initialize();
			$results = $this->results;
		}
		$firstResult = current($results);
		if ($firstResult === FALSE) {
			$firstResult = NULL;
		}
		return $firstResult;
	}

	/**
	 * Returns the number of objects in the result
	 *
	 * @return integer The number of matching objects
	 * @api
	 */
	public function count() {
		if (is_array($this->results)) {
			return count($this->results);
		}
	}

	/**
	 * Returns an array with the objects in the result set
	 *
	 * @return array
	 * @api
	 */
	public function toArray() {
		$this->initialize();
		return iterator_to_array($this);
	}

	/**
	 * This method is needed to implement the ArrayAccess interface,
	 * but it isn't very useful as the offset has to be an integer
	 *
	 * @param mixed $offset
	 * @return boolean
	 * @see ArrayAccess::offsetExists()
	 */
	public function offsetExists($offset) {
		$this->initialize();
		return isset($this->results[$offset]);
	}

	/**
	 * @param mixed $offset
	 * @return mixed
	 * @see ArrayAccess::offsetGet()
	 */
	public function offsetGet($offset) {
		$this->initialize();
		return isset($this->results[$offset]) ? $this->results[$offset] : NULL;
	}

	/**
	 * This method has no effect on the persisted objects but only on the result set
	 *
	 * @param mixed $offset
	 * @param mixed $value
	 * @return void
	 * @see ArrayAccess::offsetSet()
	 */
	public function offsetSet($offset, $value) {
		$this->initialize();
		$this->results[$offset] = $value;
	}

	/**
	 * This method has no effect on the persisted objects but only on the result set
	 *
	 * @param mixed $offset
	 * @return void
	 * @see ArrayAccess::offsetUnset()
	 */
	public function offsetUnset($offset) {
		$this->initialize();
		unset($this->results[$offset]);
	}

	/**
	 * @return mixed
	 * @see Iterator::current()
	 */
	public function current() {
		$this->initialize();
		return current($this->results);
	}

	/**
	 * @return mixed
	 * @see Iterator::key()
	 */
	public function key() {
		$this->initialize();
		return key($this->results);
	}

	/**
	 * @return void
	 * @see Iterator::next()
	 */
	public function next() {
		$this->initialize();
		next($this->results);
	}

	/**
	 * @return void
	 * @see Iterator::rewind()
	 */
	public function rewind() {
		$this->initialize();
		reset($this->results);
	}

	/**
	 * @return void
	 * @see Iterator::valid()
	 */
	public function valid() {
		$this->initialize();
		return current($this->results) !== FALSE;
	}

}
?>