<?php
namespace TYPO3\Semantic\Tests\Unit\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "TYPO3.Semantic".             *
 *                                                                        *
 *                                                                        */

/**
 * Testcase for Query result parser
 */
class QueryResultParserTest extends \TYPO3\FLOW3\Tests\UnitTestCase {

	/**
	 * @test
	 */
	public function parserParsesASimpleXmlDocument() {
		$document = '<?xml version="1.0"?>
			<sparql xmlns="http://www.w3.org/2005/sparql-results#">
			  <head>
				<variable name="x"/>
				<variable name="hpage"/>
				<variable name="name"/>
				<variable name="age"/>
				<variable name="mbox"/>
				<variable name="friend"/>
			  </head>
			  <results>
				<result>
				  <binding name="x">
					<bnode>r2</bnode>
				  </binding>
				  <binding name="hpage">
					<uri>http://work.example.org/bob/</uri>
				  </binding>
				  <binding name="name">
					<literal xml:lang="en">Bob</literal>
				  </binding>
				  <binding name="age">
					<literal datatype="http://www.w3.org/2001/XMLSchema#integer">30</literal>
				  </binding>
				  <binding name="mbox">
					<uri>mailto:bob@work.example.org</uri>
				  </binding>
				</result>
			  </results>
			</sparql>';
		$expected = array(
			'variables' => array('x', 'hpage', 'name', 'age', 'mbox', 'friend'),
			'results' => array(array(
				'x' => array('name' => 'x', 'value' => 'r2', 'type' => 'bnode'),
				'hpage'	=> array('name' => 'hpage', 'value' => 'http://work.example.org/bob/', 'type' => 'uri'),
				'name' => array('name' => 'name', 'value' => 'Bob', 'type' => 'literal', 'language' => 'en'),
				'age' => array('name' => 'age', 'value' => '30', 'type' => 'literal', 'datatype' => 'http://www.w3.org/2001/XMLSchema#integer'),
				'mbox' => array('name' => 'mbox', 'value' => 'mailto:bob@work.example.org', 'type' => 'uri')
			))
		);
		$parser = new \TYPO3\Semantic\Domain\Model\Sparql\QueryResultParser();
		$result = $parser->parse($document);
		$this->assertEquals($result, $expected);
	}

	/**
	 * @test
	 * @expectedException \TYPO3\Semantic\Domain\Model\Sparql\Exception\QueryResultParserException
	 */
	public function parserThrowsExceptionIfAParsingErrorOccured() {
		$document = '<foo></bar>';
		$parser = new \TYPO3\Semantic\Domain\Model\Sparql\QueryResultParser();
		$parser->parse($document);
	}

}
?>