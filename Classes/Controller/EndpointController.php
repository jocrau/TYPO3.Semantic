<?php
namespace TYPO3\Semantic\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "TYPO3.Semantic".             *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * Query controller for the TYPO3.Semantic package
 *
 * @FLOW3\Scope("singleton")
 */
class EndpointController extends \TYPO3\FLOW3\Mvc\Controller\ActionController {

	/**
	 * @FLOW3\Inject
	 * @var \TYPO3\Semantic\Domain\Repository\Sparql\EndpointRepository
	 */
	protected $endpointRepository;

	/**
	 * Displays a form for creating a new Endpoint
	 */
	public function newAction() {
	}

	/**
	 * Creates a new Query and forwards to the index action.
	 *
	 * @param \TYPO3\Semantic\Domain\Model\Sparql\Endpoint $newEndpoint a fresh Endpoint object which has not yet been added to the repository
	 */
	public function createAction(\TYPO3\Semantic\Domain\Model\Sparql\Endpoint $newEndpoint) {
		$this->endpointRepository->add($newEndpoint);
		$this->redirect('index', 'Query');
	}

	/**
	 * Displays a form to edit an existing Endpoint
	 *
	 * @param \TYPO3\Semantic\Domain\Model\Sparql\Endpoint $endpoint the Endpoint to display
	 * @FLOW3\IgnoreValidation("$query")
	 */
	public function editAction(\TYPO3\Semantic\Domain\Model\Sparql\Endpoint $endpoint) {
		$this->view->assign('endpoint', $endpoint);
	}

	/**
	 * Updates an existing Endpoint and forwards to the index action afterwards.
	 *
	 * @param \TYPO3\Semantic\Domain\Model\Sparql\Endpoint $endpoint the Query to display
	 */
	public function updateAction(\TYPO3\Semantic\Domain\Model\Sparql\Endpoint $endpoint) {
		$this->endpointRepository->update($endpoint);
		$this->redirect('index', 'Query');
	}

	/**
	 * Deletes an existing Endpoint
	 *
	 * @param \TYPO3\Semantic\Domain\Model\Sparql\Endpoint $query the Query to be deleted
	 */
	public function deleteAction(\TYPO3\Semantic\Domain\Model\Sparql\Endpoint $endpoint) {
		$this->endpointRepository->remove($endpoint);
		$this->redirect('index', 'Query');
	}

}

?>