<?php
    require_once ('config.php');
    require_once ('Offers.php');
    require_once ('OutputSetter.php');
    require_once ('OutputTypes.php');

    //generate offers dinamically
    $o = new Offers();
    $offers = $o->generateOffers();

    //use the client class to specify the output
    $outputSetter = new OutputSetter();

    defined('OUTPUT_WRITING') ? null : define('OUTPUT_WRITING',1);
    switch(OUTPUT_WRITING) {
        case '1' :
            $outputSetter->setOutput(new SerializedOutput($offers));
            $output = $outputSetter->loadOutput();
            echo $output;
        break;
        case '2':
            $outputSetter->setOutput(new JsonOutput($offers));
            $output = $outputSetter->loadOutput();
            echo $output;
        break;
        case '3':
            $outputSetter->setOutput(new ArrayOutput($offers));
            $output = $outputSetter->loadOutput();

            echo "<pre>";
            print_r($output,false);
            echo "</pre>";
        break;
        case '4':
            header('Content-Type: text/xml');

            $outputSetter->setOutput(new XmlOutput($offers));
            $output = $outputSetter->loadOutput();
            echo $output;
        break;
        default:
            $outputSetter->setOutput(new ArrayOutput($offers));
            $output = $outputSetter->loadOutput();

            echo "<pre>";
            print_r($output,false);
            echo "</pre>";
        break;
    }

