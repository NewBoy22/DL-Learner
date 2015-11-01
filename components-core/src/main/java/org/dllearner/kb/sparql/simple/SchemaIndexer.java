package org.dllearner.kb.sparql.simple;

import java.util.HashSet;
import java.util.List;
import java.util.Set;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import com.hp.hpl.jena.ontology.OntModel;
import com.hp.hpl.jena.rdf.model.ModelFactory;
import com.jamonapi.Monitor;
import com.jamonapi.MonitorFactory;

public class SchemaIndexer {
    private static Logger log = LoggerFactory.getLogger(SchemaIndexer.class);
    private OntModel model;

    //static instantiation
    private static ClassIndexer classIndexer = new ClassIndexer();
    //remember ontologies
    private static Set<String> alreadyIndexed = new HashSet<>();
    //set or list of urls for the ontologies
    private List<String> ontologySchemaUrls;

    public SchemaIndexer() {
    }

    public synchronized void init() {

        for (String url : ontologySchemaUrls) {
            log.info("Testing, if indexed: " + url);
            if (alreadyIndexed.add(url)) {
                log.info("Ontology not found, start indexing");
                try {
                    Monitor m0 = MonitorFactory.start("Indexer parsing ontology");
                    model = ModelFactory.createOntologyModel();
                    model.read(url, null);
                    classIndexer.index(model);
                    m0.stop();
                    log.info("indexed ontology in ms: " + m0.getTotal());
                } catch (Exception e) {
                    log.error(e.getMessage(), e);
                }
            } else {
                //not so important output
                log.debug("Already indexed: " + url + " " + alreadyIndexed);
            }
        }


    }

    public OntModel getHierarchyForURI(String classUri) {
        if (classIndexer == null) {
            this.init();
        }
        return classIndexer.getHierarchyForClassURI(classUri);
    }

    public static void main(String... args) {
        SchemaIndexer i = new SchemaIndexer();
        System.out.println(i.getHierarchyForURI("http://dbpedia.org/ontology/Software"));
    }

    public void setOntologySchemaUrls(List<String> ontologySchemaUrls) {
        this.ontologySchemaUrls = ontologySchemaUrls;
    }
}