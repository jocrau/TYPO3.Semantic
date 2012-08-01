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
class QueryController extends \TYPO3\FLOW3\Mvc\Controller\ActionController {

	/**
	 * @FLOW3\Inject
	 * @var \TYPO3\Semantic\Domain\Repository\Sparql\QueryRepository
	 */
	protected $queryRepository;

	/**
	 * @FLOW3\Inject
	 * @var \TYPO3\Semantic\Domain\Repository\Sparql\EndpointRepository
	 */
	protected $endpointRepository;

	/**
	 * @FLOW3\Inject
	 * @var \TYPO3\Semantic\Domain\Repository\Rdf\RdfNamespaceRepository
	 */
	protected $namespaceRepository;

	protected function setPropertyMappingConfiguration () {
		$propertyMappingConfiguration = $this->arguments['query']->getPropertyMappingConfiguration();
		$propertyMappingConfiguration->forProperty('endpoint')->allowAllProperties();
		$propertyMappingConfiguration->allowCreationForSubProperty('endpoint');
	}

	/**
	 * Displays all Queries
	 */
	public function indexAction() {
		$queries = $this->queryRepository->findAll();
		$this->view->assign('queries', $queries);
	}

	/**
	 * Displays a single Query
	 *
	 * @param \TYPO3\Semantic\Domain\Model\Sparql\Query $query the Query to display
	 */
	public function showAction(\TYPO3\Semantic\Domain\Model\Sparql\Query $query) {
		$this->view->assign('query', $query);
	}

	/**
	 * Displays a form for creating a new Query
	 */
	public function newAction() {
		$this->view->assign('endpoints', array_merge(array(NULL => "Add New"), $this->endpointRepository->findAll()->toArray()));
		$this->view->assign('namespaces', $this->namespaceRepository->findAll());
	}

	public function initializeCreateAction() {
		$this->setPropertyMappingConfiguration();
	}

	/**
	 * Creates a new Query and forwards to the index action.
	 *
	 * @param \TYPO3\Semantic\Domain\Model\Sparql\Query $newQuery a fresh Query object which has not yet been added to the repository
	 */
	public function createAction(\TYPO3\Semantic\Domain\Model\Sparql\Query $newQuery) {
		$this->queryRepository->add($newQuery);
		$this->redirect('index');
	}

	/**
	 * Displays a form to edit an existing Query
	 *
	 * @param \TYPO3\Semantic\Domain\Model\Sparql\Query $query the Query to display
	 * @FLOW3\IgnoreValidation("$query")
	 */
	public function editAction(\TYPO3\Semantic\Domain\Model\Sparql\Query $query) {
		$this->view->assign('query', $query);
		$this->view->assign('endpoints', array_merge(array(NULL => "Add New"), $this->endpointRepository->findAll()->toArray()));
		$this->view->assign('namespaces', $this->namespaceRepository->findAll());
	}

	public function initializeUpdateAction() {
		$this->setPropertyMappingConfiguration();
	}

	/**
	 * Updates an existing Query and forwards to the index action afterwards.
	 *
	 * @param \TYPO3\Semantic\Domain\Model\Sparql\Query $query the Query to display
	 */
	public function updateAction(\TYPO3\Semantic\Domain\Model\Sparql\Query $query) {
		$this->queryRepository->update($query);
		$this->redirect('index');
	}

	/**
	 * Deletes an existing Query
	 *
	 * @param \TYPO3\Semantic\Domain\Model\Sparql\Query $query the Query to be deleted
	 */
	public function deleteAction(\TYPO3\Semantic\Domain\Model\Sparql\Query $query) {
		$this->queryRepository->remove($query);
		$this->redirect('index');
	}

}

?>