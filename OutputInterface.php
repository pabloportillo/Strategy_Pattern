<?php
    /**
     * Using the defined interface to provide a common structure for our output types
     * Interface OutputInterface
     */
    interface OutputInterface {
        public function __construct($arrayOfData);
        public function load();
    }