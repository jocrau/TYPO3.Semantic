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
	 * The current view, as resolved by resolveView()
	 *
	 * @var Tx_Semantic_View_ContentView
	 * @api
	 */
	protected $view = NULL;

	/**
	 * Pattern after which the view object name is built if no Fluid template
	 * is found.
	 * @var string
	 * @api
	 */
	protected $viewObjectNamePattern = 'Tx_Semantic_View_ContentView';

	/**
	 * @var Tx_Semantic_Domain_Repository_Sparql_QueryRepository
	 */
	protected $queryRepository;


	protected function initializeRenderAction() {
//		$contentObjectData = $this->configurationManager->getContentObject()->data;
//		$contentObjectSettings = array(
//			'query' => $contentObjectData['tx_semantic_query'],
//			'layout' => $contentObjectData['tx_semantic_layout'],
//			'templateCode' => '{namespace s=Tx_Semantic_ViewHelpers}<f:layout name="default"/><f:section name="main">'
//				. $contentObjectData['bodytext']
//				. '</f:section>',
//			'paginate' => $contentObjectData['tx_semantic_paginate']
//		);
//		$this->settings = array_merge_recursive($this->settings, $contentObjectSettings);
	}

	/**
	 * Renders the content of a Sparql Query Result
	 *
	 * @param \TYPO3\Semantic\Domain\Model\Sparql\Query $query the Sparql Query to be executed and rendered
	 */
	public function renderAction(\TYPO3\Semantic\Domain\Model\Sparql\Query $query = NULL) {
		if ($query === NULL) {
			if (isset($this->settings['query'])) {
				$query = $this->queryRepository->findByUid(intval($this->settings['query']));
			}
			if ($query === NULL) {
				return '';
			}
		}
		if ($this->settings['layout'] === self::LAYOUT_CUSTOMCODE) {
			$this->view->setTemplateSource($this->settings['templateCode']);
		}
		try {
			$this->view->assign('results', $query->execute());
			$content = $this->view->render(); // The query gets executed lazily during render time. Thus, we include the render() method.
		} catch (Tx_Semantic_Domain_Model_Sparql_Exception_SparqlEndpointException $exception){
			$content = '';
		}
		return $content;
	}

}