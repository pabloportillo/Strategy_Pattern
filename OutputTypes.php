<?php
    require_once ('OutputInterface.php');

    /**
     * Class SerializedOutputArray
     * used to serialize an array
     */
    class SerializedOutput implements OutputInterface {
        private $arrayOfData;
        public function __construct($arrayOfData)
        {
            $this->arrayOfData = $arrayOfData;
        }

        public function load() {
            return serialize($this->arrayOfData);
        }
    }

    /**
     * Class JsonStringOutput
     * Used to transform an array to json
     */
    class JsonOutput implements OutputInterface {
        private $arrayOfData;
        public function __construct($arrayOfData)
        {
            $this->arrayOfData = $arrayOfData;
        }
        public function load() {
            return json_encode($this->arrayOfData);
        }
    }

    /**
     * Class ArrayOutput
     * Simply return the array
     */
    class ArrayOutput implements OutputInterface {
        private $arrayOfData;
        public function __construct($arrayOfData)
        {
            $this->arrayOfData = $arrayOfData;
        }
        public function load() {
            return $this->arrayOfData;
        }
    }

    /**
     * Class XmlOutput
     * Return an xml format from an array
     */
    class XmlOutput implements OutputInterface {
        private $arrayOfData;
        public function __construct($arrayOfData)
        {
            $this->arrayOfData = $arrayOfData;
        }
        public function load() {
            $xml = $this->validArrayToXml($this->arrayOfData);
            return $xml;
        }
        /****************************************************
         * Xml helpers
        /****************************************************/

        /**
         * Method used to write a valid xml from an array
         * @param $array
         * @param string $node_block
         * @param string $node_name
         * @return string
         */
        private function validArrayToXml($array, $node_block='nodes', $node_name='node') {
            $xml = '<?xml version="1.0" encoding="UTF-8" ?>' . "\n";

            $xml .= '<' . $node_block . '>' . "\n";
            $xml .= $this->ArrayToXml($array, $node_name);
            $xml .= '</' . $node_block . '>' . "\n";

            return $xml;
        }

        /**
         * Methods used to create transform array to xml
         * @param $array
         * @param $node_name
         * @return string
         */
        private function ArrayToXml($array, $node_name) {
            $xml = '';

            if (is_array($array) || is_object($array)) {
                foreach ($array as $key=>$value) {
                    if (is_numeric($key)) {
                        $key = $node_name;
                    }
                    $xml .= '<' . $key . '>' . "\n" . $this->ArrayToXml($value, $node_name) . '</' . $key . '>' . "\n";
                }
            } else {
                $xml = htmlspecialchars($array, ENT_QUOTES) . "\n";
            }

            return $xml;
        }
    }