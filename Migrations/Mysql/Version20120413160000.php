<?php
namespace TYPO3\FLOW3\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
	Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20120413160000 extends AbstractMigration {

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function up(Schema $schema) {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

		$this->addSql("
			INSERT INTO `typo3_semantic_domain_model_rdf_rdfnamespace` (`flow3_persistence_identifier`, `prefix`, `iri`)
			VALUES
				('81c75190-858a-11e1-b0c4-0800200c9a66','xml','http://www.w3.org/XML/1998/namespace'),
				('81c75191-858a-11e1-b0c4-0800200c9a66','xmlns','http://www.w3.org/2000/xmlns/'),
				('81c75192-858a-11e1-b0c4-0800200c9a66','xsd','http://www.w3.org/2001/XMLSchema#'),
				('81c778a0-858a-11e1-b0c4-0800200c9a66','xhv','http://www.w3.org/1999/xhtml/vocab#'),
				('81c778a1-858a-11e1-b0c4-0800200c9a66','rdfa','http://www.w3.org/ns/rdfa#'),
				('81c778a2-858a-11e1-b0c4-0800200c9a66','rdf','http://www.w3.org/1999/02/22-rdf-syntax-ns#'),
				('81c778a3-858a-11e1-b0c4-0800200c9a66','rdfs','http://www.w3.org/2000/01/rdf-schema#'),
				('81c778a4-858a-11e1-b0c4-0800200c9a66','owl','http://www.w3.org/2002/07/owl#'),
				('81c778a5-858a-11e1-b0c4-0800200c9a66','rif','http://www.w3.org/2007/rif#'),
				('81c778a6-858a-11e1-b0c4-0800200c9a66','skos','http://www.w3.org/2004/02/skos/core#'),
				('81c778a7-858a-11e1-b0c4-0800200c9a66','skosxl','http://www.w3.org/2008/05/skos-xl#'),
				('81c778a8-858a-11e1-b0c4-0800200c9a66','grddl','http://www.w3.org/2003/g/data-view#'),
				('81c778a9-858a-11e1-b0c4-0800200c9a66','sd','http://www.w3.org/ns/sparql-service-description#'),
				('81c778aa-858a-11e1-b0c4-0800200c9a66','wdr','http://www.w3.org/2007/05/powder#'),
				('81c778ab-858a-11e1-b0c4-0800200c9a66','wdrs','http://www.w3.org/2007/05/powder-s#'),
				('81c778ac-858a-11e1-b0c4-0800200c9a66','sioc','http://rdfs.org/sioc/ns#'),
				('81c778ad-858a-11e1-b0c4-0800200c9a66','cc','http://creativecommons.org/ns#'),
				('81c778ae-858a-11e1-b0c4-0800200c9a66','vcard','http://www.w3.org/2006/vcard/ns#'),
				('81c778af-858a-11e1-b0c4-0800200c9a66','void','http://rdfs.org/ns/void#'),
				('81c778b0-858a-11e1-b0c4-0800200c9a66','dc','http://purl.org/dc/elements/1.1/'),
				('81c778b1-858a-11e1-b0c4-0800200c9a66','dcterms','http://purl.org/dc/terms/'),
				('81c778b2-858a-11e1-b0c4-0800200c9a66','dbr','http://dbpedia.org/resource/'),
				('81c778b3-858a-11e1-b0c4-0800200c9a66','dbp','http://dbpedia.org/property/'),
				('81c778b4-858a-11e1-b0c4-0800200c9a66','dbo','http://dbpedia.org/ontology/'),
				('81c778b5-858a-11e1-b0c4-0800200c9a66','foaf','http://xmlns.com/foaf/0.1/'),
				('81c778b6-858a-11e1-b0c4-0800200c9a66','geo','http://www.w3.org/2003/01/geo/wgs84_pos#'),
				('81c778b7-858a-11e1-b0c4-0800200c9a66','gr','http://purl.org/goodrelations/v1#'),
				('81c778b8-858a-11e1-b0c4-0800200c9a66','cal','http://www.w3.org/2002/12/cal/ical#'),
				('81c778b9-858a-11e1-b0c4-0800200c9a66','og','http://ogp.me/ns#'),
				('81c778ba-858a-11e1-b0c4-0800200c9a66','v','http://rdf.data-vocabulary.org/#'),
				('81c778bb-858a-11e1-b0c4-0800200c9a66','bibo','http://purl.org/ontology/bibo/'),
				('81c778bc-858a-11e1-b0c4-0800200c9a66','t3o','http://typo3.org/ontology/core#'),
				('81c778bd-858a-11e1-b0c4-0800200c9a66','cnt','http://www.w3.org/2011/content#');");
	}

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function down(Schema $schema) {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
	}
}

?>