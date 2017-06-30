<?php
  # Create new DOM object
  $domOb = new DOMDocument();

  # Grab your HTML file
  $html = $domOb->loadHTMLFile(salesforce_job_number.html);

  # Remove whitespace
  $domOb->preserveWhiteSpace = false; 

  # Set the container tag
  $container = $domOb->getElementsByTagName('tr'); 

  # Loop through UL values
  foreach ($container as $row) 
  { 
      # Grab all <li>
      $items = $row->getElementsByTagName('td'); 

      # echo the values  
      echo $items->item(0)->nodeValue.'<br />'; 
      echo $items->item(1)->nodeValue.'<br />'; 
      echo $items->item(2)->nodeValue;

      # You could write to your XML file, store in a string, anything here
    } 

?>












/* $c='<p>test<font>two</p>';
    $dom=new DOMDocument('1.0', 'UTF-8');

$n=$dom->appendChild($dom->createElement('info')); // make a root element

if( $valueXml=tryToXml($dom,$c) ) {
  $n->appendChild($valueXml);
}
  echo '<pre/>'. htmlentities($dom->saveXml($n)). '</pre>';
*/
?>