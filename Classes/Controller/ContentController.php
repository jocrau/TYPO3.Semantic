<?php
namespace TYPO3\Semantic\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "TYPO3.Semantic".             *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * Content controller for the TYPO3.Semantic package
 *
 * @FLOW3\Scope("singleton")
 */
class ContentController extends \TYPO3\FLOW3\Mvc\Controller\ActionController {

	/**
	 * These constants designate how a custom template code is loaded by the controller.
	 * custromroot => The controller expects a root path to the templates.
	 * customfile => The controller loads a single template file.
	 * customcode => The controller takes the bodytext of the content element as template code.
	 */
	const LAYOUT_CUSTOMROOT = 'customroot';
	const LAYOUT_CUSTOMFILE = 'customfile';
	const LAYOUT_CUSTOMCODE = 'customcode';

	/**
	 * @FLOW3\Inject
	 * @var \TYPO3\Semantic\Domain\Repository\Sparql\QueryRepository
	 */
	protected $queryRepository;

	/**
	 * Renders the content of a Sparql Query Result
	 *
	 * @param \TYPO3\Semantic\Domain\Model\Sparql\Query $query the Sparql Query to be executed and rendered
	 */
	public function renderAction(\TYPO3\Semantic\Domain\Model\Sparql\Query $query) {
		try {
			$this->view->assign('results', $query->execute());
			$content = $this->view->render(); // The query gets executed lazily during render time. Thus, we include the render() method.
		} catch (\TYPO3\Semantic\Domain\Model\Sparql\Exception\SparqlEndpointException $exception){
			$content = '';
		}
		return $content;
	}

}