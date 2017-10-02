<?php
    require_once ('OutputTypes.php');

    /**
     * Class responsible for instantiating new objects / output types
     * Class OutputSetter
     */
    class OutputSetter {
        private $output;

        public function setOutput(OutputInterface $outputType) {
            $this->output = $outputType;
        }

        public function loadOutput() {
            return $this->output->load();
        }
    }