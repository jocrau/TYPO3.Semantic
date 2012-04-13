<?php
namespace TYPO3\Semantic\ViewHelpers\Form;

/*                                                                        *
 * This script belongs to the FLOW3 package "TYPO3.Semantic".             *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * A Code Editor ViewHelper
 */
class CodeEditorViewHelper extends \TYPO3\Fluid\ViewHelpers\Form\TextareaViewHelper {


	/**
	 * @var \TYPO3\FLOW3\Resource\Publishing\ResourcePublisher
	 * @FLOW3\Inject
	 */
	protected $resourcePublisher;

	/**
	 * Initialize the arguments.
	 *
	 * @return void
	 */
	public function initializeArguments() {
		parent::initializeArguments();
		$this->registerArgument('language', 'string', 'The programming language the code editor is for.', FALSE, 'ts');
	}

	/**
	 * Renders the codeeditor.
	 *
	 * @return string
	 */
	public function render() {
		$name = $this->getName();
		$this->registerFieldNameForFormTokenGeneration($name);

		$this->tag->forceClosingTag(TRUE);
		$this->tag->addAttribute('name', $name);
		$this->tag->addAttribute('id', 'code-editor');
		$this->tag->setContent(htmlspecialchars($this->getValue()));

		$this->setErrorClassAttribute();

		$pathToRessources = $this->resourcePublisher->getStaticResourcesWebBaseUri() . 'Packages/TYPO3.Semantic/';
		$javaScript = '<script src="' . $pathToRessources . 'Vendor/CodeMirror/js/codemirror.js" type="text/javascript"></script>
			<script>
			var editor = CodeMirror.fromTextArea("code-editor", {
				path: "' . $pathToRessources . 'Vendor/CodeMirror/js/",
				parserfile: "parsesparql.js",
				stylesheet: "' . $pathToRessources . 'Css/sparqlcolors.css",
				height: "350px",
				width: "650px",
				tabMode: "shift",
				textWrapping: false,
				disableSpellcheck: true
			});
			</script>';

		return $this->tag->render() . $javaScript;
	}

}
?>