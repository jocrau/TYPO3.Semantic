<?php
namespace TYPO3\FLOW3\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
	Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20120413152654 extends AbstractMigration {

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function up(Schema $schema) {
			// this up() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

		$this->addSql("CREATE TABLE typo3_semantic_domain_model_rdf_rdfnamespace (flow3_persistence_identifier VARCHAR(40) NOT NULL, prefix VARCHAR(255) DEFAULT NULL, iri VARCHAR(255) DEFAULT NULL, PRIMARY KEY(flow3_persistence_identifier)) ENGINE = InnoDB");
		$this->addSql("CREATE TABLE typo3_semantic_domain_model_sparql_endpoint (flow3_persistence_identifier VARCHAR(40) NOT NULL, name VARCHAR(255) DEFAULT NULL, iri VARCHAR(255) DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, PRIMARY KEY(flow3_persistence_identifier)) ENGINE = InnoDB");
		$this->addSql("CREATE TABLE typo3_semantic_domain_model_sparql_queryresult (flow3_persistence_identifier VARCHAR(40) NOT NULL, query VARCHAR(40) DEFAULT NULL, queryresultparser VARCHAR(40) DEFAULT NULL, variables VARCHAR(255) DEFAULT NULL, results VARCHAR(255) DEFAULT NULL, isinitialized TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_B912762124BDB5EB (query), UNIQUE INDEX UNIQ_B912762187B0DE62 (queryresultparser), PRIMARY KEY(flow3_persistence_identifier)) ENGINE = InnoDB");
		$this->addSql("CREATE TABLE typo3_semantic_domain_model_sparql_queryresultparser (flow3_persistence_identifier VARCHAR(40) NOT NULL, PRIMARY KEY(flow3_persistence_identifier)) ENGINE = InnoDB");
		$this->addSql("CREATE TABLE typo3_semantic_domain_model_sparql_query (flow3_persistence_identifier VARCHAR(40) NOT NULL, endpoint VARCHAR(40) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, body LONGTEXT NOT NULL, quoted_limit VARCHAR(255) NOT NULL, quoted_offset VARCHAR(255) NOT NULL, INDEX IDX_98876A7FC4420F7B (endpoint), PRIMARY KEY(flow3_persistence_identifier)) ENGINE = InnoDB");
		$this->addSql("CREATE TABLE typo3_semantic_domain_model_sparql_query_namespaces_join (semantic_sparql_query VARCHAR(40) NOT NULL, semantic_rdf_rdfnamespace VARCHAR(40) NOT NULL, INDEX IDX_527F4F87EFD6E980 (semantic_sparql_query), INDEX IDX_527F4F87988D1565 (semantic_rdf_rdfnamespace), PRIMARY KEY(semantic_sparql_query, semantic_rdf_rdfnamespace)) ENGINE = InnoDB");
		$this->addSql("ALTER TABLE typo3_semantic_domain_model_sparql_queryresult ADD CONSTRAINT FK_B912762124BDB5EB FOREIGN KEY (query) REFERENCES typo3_semantic_domain_model_sparql_query (flow3_persistence_identifier)");
		$this->addSql("ALTER TABLE typo3_semantic_domain_model_sparql_queryresult ADD CONSTRAINT FK_B912762187B0DE62 FOREIGN KEY (queryresultparser) REFERENCES typo3_semantic_domain_model_sparql_queryresultparser (flow3_persistence_identifier)");
		$this->addSql("ALTER TABLE typo3_semantic_domain_model_sparql_query ADD CONSTRAINT FK_98876A7FC4420F7B FOREIGN KEY (endpoint) REFERENCES typo3_semantic_domain_model_sparql_endpoint (flow3_persistence_identifier)");
		$this->addSql("ALTER TABLE typo3_semantic_domain_model_sparql_query_namespaces_join ADD CONSTRAINT FK_527F4F87EFD6E980 FOREIGN KEY (semantic_sparql_query) REFERENCES typo3_semantic_domain_model_sparql_query (flow3_persistence_identifier)");
		$this->addSql("ALTER TABLE typo3_semantic_domain_model_sparql_query_namespaces_join ADD CONSTRAINT FK_527F4F87988D1565 FOREIGN KEY (semantic_rdf_rdfnamespace) REFERENCES typo3_semantic_domain_model_rdf_rdfnamespace (flow3_persistence_identifier)");
	}

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function down(Schema $schema) {
			// this down() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

		$this->addSql("ALTER TABLE typo3_semantic_domain_model_sparql_query_namespaces_join DROP FOREIGN KEY FK_527F4F87988D1565");
		$this->addSql("ALTER TABLE typo3_semantic_domain_model_sparql_query DROP FOREIGN KEY FK_98876A7FC4420F7B");
		$this->addSql("ALTER TABLE typo3_semantic_domain_model_sparql_queryresult DROP FOREIGN KEY FK_B912762187B0DE62");
		$this->addSql("ALTER TABLE typo3_semantic_domain_model_sparql_queryresult DROP FOREIGN KEY FK_B912762124BDB5EB");
		$this->addSql("ALTER TABLE typo3_semantic_domain_model_sparql_query_namespaces_join DROP FOREIGN KEY FK_527F4F87EFD6E980");
		$this->addSql("DROP TABLE typo3_semantic_domain_model_rdf_rdfnamespace");
		$this->addSql("DROP TABLE typo3_semantic_domain_model_sparql_endpoint");
		$this->addSql("DROP TABLE typo3_semantic_domain_model_sparql_queryresult");
		$this->addSql("DROP TABLE typo3_semantic_domain_model_sparql_queryresultparser");
		$this->addSql("DROP TABLE typo3_semantic_domain_model_sparql_query");
		$this->addSql("DROP TABLE typo3_semantic_domain_model_sparql_query_namespaces_join");
	}
}

?>