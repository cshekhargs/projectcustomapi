<?php
// function defination to convert array to xml
function array_to_xml( $data, &$xml_data ) {
    foreach( $data as $key => $value ) {
        if( is_numeric($key) ){
            $key = 'item'.$key; //dealing with <0/>..<n/> issues
        }
        if( is_array($value) ) {
            $subnode = $xml_data->addChild($key);
            array_to_xml($value, $subnode);
        } else {
            $xml_data->addChild("$key",htmlspecialchars("$value"));
        }
     }
}

// initializing or creating array
$data = array('tag' => 'Job Numbaer','type' => 'string','required' => 'false','value' => 'PNR1702-18315');

// creating object of SimpleXMLElement
$xml_data = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><field-list></field-list>');

// function call to convert array to xml
array_to_xml($data,$xml_data);

//saving generated xml file; 
$result = $xml_data->asXML('xml/PrintNinja.xml');

?>