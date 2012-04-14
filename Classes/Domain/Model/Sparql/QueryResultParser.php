<?php
namespace TYPO3\Semantic\Domain\Model\Sparql;

/*                                                                        *
 * This script belongs to the FLOW3 package "TYPO3.Semantic".             *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * A Query result parser
 *
 * @FLOW3\Transient
 */
class QueryResultParser {

	/**
	 * A resource handler reference to the PHP Extpat parser
	 *
	 * @var string
	 * FIXME This should be of type resource (FLOW3 doesn't support resource type, yet. 2012-04-14)
	 **/
	protected $parser;

	/**
	 * An array of results
	 *
	 * @var array
	 **/
	protected $results = array('variables' => array(), 'results' => array());

	/**
	 * The current result
	 *
	 * @var array
	 **/
	protected $currentResult = array();

	/**
	 * @var string
	 **/
	protected $currentName = '';

	/**
	 * @var string
	 **/
	protected $currentCharacterData = '';

	/**
	 * @var string
	 **/
	protected $currentType = '';

	/**
	 * @var string
	 **/
	protected $currentDatatype;

	/**
	 * @var string
	 **/
	protected $currentLanguage;

	/**
	 * A flag indicating, if the character data of the current node should be processed.
	 *
	 * @var bool
	 **/
	protected $processCharacterData = FALSE;

	/**
	 * Sets up the PHP parser.
	 *
	 * @return void
	 **/
	public function __construct() {
		$this->parser = xml_parser_create();
		xml_set_object($this->parser, $this);
		xml_set_element_handler($this->parser, 'handleElementStart', 'handleElementStop');
		xml_set_character_data_handler($this->parser, 'handleCharacterData');
	}

	/**
	 * Frees the memory of the PHP parser.
	 *
	 * @return void
	 **/
	public function __destruct() {
		xml_parser_free($this->parser);
	}

	/**
	 * Parses the given XML document. The resulting array has two top level keys: 'values' and 'results'.
	 *
	 * @return void
	 * @api
	 **/
	public function parse($document = '') {
		$status = xml_parse($this->parser, $document);
		if ($status === 1) {
			return $this->results;
		} else {
			throw new \TYPO3\Semantic\Domain\Model\Sparql\Exception\QueryResultParserException('Parser Error: "' . xml_error_string(xml_get_error_code($this->parser)) . '".', 1296481762);
		}
	}

	/**
	 * Handles an event fired by an opening element.
	 *
	 * @return void
	 **/
	protected function handleElementStart($parser, $elementName, $elementAttributes) {
		switch ($elementName) {
			case 'VARIABLE':
				$this->results['variables'][] = $elementAttributes['NAME'];
				$this->processCharacterData = FALSE;
				break;
			case 'BINDING':
				$this->currentName = $elementAttributes['NAME'];
				$this->processCharacterData = FALSE;
				break;
			case 'LITERAL':
				$this->currentType = 'literal';
				if (isset($elementAttributes['DATATYPE'])) {
					$this->currentDatatype = $elementAttributes['DATATYPE'];
				}
				if (isset($elementAttributes['XML:LANG'])) {
					$this->currentLanguage = $elementAttributes['XML:LANG'];
				}
				$this->processCharacterData = TRUE;
				break;
			case 'BNODE':
				$this->currentType = 'bnode';
				$this->processCharacterData = TRUE;
				break;
			case 'URI':
				$this->currentType = 'uri';
				$this->processCharacterData = TRUE;
				break;
		}
	}

	/**
	 * Handles an event fired by a closing element.
	 *
	 * @return void
	 **/
	protected function handleElementStop($parser, $elementName) {
		switch ($elementName) {
			case 'BINDING':
				$this->currentResult[$this->currentName] = array(
					'name' => $this->currentName,
					'value' => $this->currentCharacterData,
					'type' => $this->currentType
				);
				if ($this->currentDatatype !== NULL) {
					$this->currentResult[$this->currentName]['datatype'] = $this->currentDatatype;
					$this->currentDatatype = NULL;
				}
				if ($this->currentLanguage !== NULL) {
					$this->currentResult[$this->currentName]['language'] = $this->currentLanguage;
					$this->currentLanguage = NULL;
				}
				$this->currentCharacterData = '';
				break;
			case 'LITERAL':
				$this->processCharacterData = FALSE;
				break;
			case 'BNODE':
				$this->processCharacterData = FALSE;
				break;
			case 'URI':
				$this->processCharacterData = FALSE;
				break;
			case 'RESULT':
				$this->results['results'][] = $this->currentResult;
				$this->currentResult = array();
				break;
		}
	}

	/**
	 * Handles character data.
	 *
	 * @return void
	 **/
	protected function handleCharacterData($parser, $characterData) {
		if ($this->processCharacterData === TRUE) {
			$this->currentCharacterData .= $characterData;
		}
	}

}
?>