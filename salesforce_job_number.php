<?php 

ini_set('soap.wsdl_cache_enabled', '0');
require_once('api.php');

/***************************************Enterprise**********************************************/
require_once ('soapclient/SforceEnterpriseClient.php');
	try{
		$EnterpriseConnection = new SforceEnterpriseClient();
		$EnterpriseConnection->createConnection("soapclient/enterprise.wsdl.xml");
		$EnterpriseConnection->login(USERNAME, PASSWORD.SECURITY_TOKEN);

	} catch (Exception $e) {
		echo $e;
	} 
/*************************************************************************************/

/*****************************************Partner********************************************/
require_once('soapclient/SforcePartnerClient.php');


	try {
		$mySforceConnection = new SforcePartnerClient();
		$mySforceConnection->createConnection("soapclient/partner.wsdl.xml");
		$mySforceConnection->login(USERNAME, PASSWORD . SECURITY_TOKEN);   
	}
	catch (Exception $e) {
		echo $e;
	} 
/*************************************************************************************/
//$query = "SELECT Id,name,ProfileId,IsActive FROM User WHERE IsActive=true";
//$response = $mySforceConnection->query($query);

//$querydeactive = "SELECT Id,name,ProfileId,IsActive FROM User WHERE IsActive=false";
//$response1 = $mySforceConnection->query($querydeactive);

$jobNumber = $_POST['jobNumber'];

$jobnodetailsopp = "SELECT Id,Name,Job_Number1__c,Prepress_Print_On_Inside_Covers__c,Country_of_Origin_Statement__c,Prepress_Binding_Type__c,PRN_width__c,PRN_height__c,PRN_insidepagecount__c,PRN_endsheets__c,Prepress_Printing_Color__c,PRN_insidepaperweight__c,PRN_coverpaperweight__c,Specialty_Options_Book__c,PRN_variantcovers__c,Prepress_Spot_Colors__c,Prepress_Cover_Pages__c,PrePress_Spine__c,Prepress_French_Fold_Flap_Width__c,Prepress_Cover_Media_Box_Width__c,Prepress_Cover_Media_Box_Height__c,Prepress_Cover_Die_Line_Width__c,Prepress_Cover_Die_Line_Height__c,Prepress_Hinge_Width__c,Prepress_Dust_Jacket_Pages__c,Prepress_Dust_Jacket_Spine__c,PrePress_Dust_Jacket_Flap_Width__c,Prepress_Dust_Jacket_Media_Box_Width__c,Prepress_Dust_Jacket_Media_Box_Height__c,Prepress_Dust_Jacket_Die_Line_Width__c,Prepress_Dust_Jacket_Die_Line_Height__c,Prepress_Dust_Jacket_Flap_Die_Line__c,Prepress_Total_Pages__c,Prepress_Total_Spreads__c,MediaBox_Width__c,MediaBox_Height__c,Spread_Width__c,MediaBox_Spread_Height__c,Prepress_Media_Box_Width_First_Last__c,Prepress_Media_Box_Height_First_Last__c,Ordered_ISBN__c FROM Opportunity WHERE Job_Number1__c LIKE '%$jobNumber%'";

$jobnodetailsopp_res = $mySforceConnection->query($jobnodetailsopp);

$jobnoDetailsopp = $jobnodetailsopp_res->current();

//echo "<pre>"; print_r($jobnoDetailsopp);exit;
//echo "<pre>"; print_r($_POST);exit;

if($jobnoDetailsopp->Id)
{
	//$UpdateOpportunities = array();
	$UpdateOpportunities[0] = new stdclass();
	//$UpdateOpportunities[0]->Prepress_Print_On_Inside_Covers__c = 1;
	$UpdateOpportunities[0]->Prepress_Print_On_Inside_Covers__c = $_POST['printingCheckbox'];
	$UpdateOpportunities[0]->Country_of_Origin_Statement__c = $_POST['countryOrigin'];
	
	$UpdateOpportunities[0]->Id = $jobnoDetailsopp->Id;
	
	//echo "<pre>"; print_r($UpdateOpportunities); exit;
	
	try{
		$result = $EnterpriseConnection->update($UpdateOpportunities, 'Opportunity');
		
		if ($result[0]->success)
			$rStatus = $result[0]->id;
		else
			$rStatus = false;
			
	} catch (Exception $e) {
		echo $e;
	}
}

//$jobnodetails = "SELECT Id,Name,Job_Number__c,PRN_width__c,PRN_height__c,PRN_insidepagecount__c,PRN_printingcolor__c FROM Quote WHERE Job_Number__c LIKE '%$jobNumber%'";
//$jobnodetails = "SELECT Id,Name,PRN_width__c,PRN_height__c,PRN_insidepagecount__c,PRN_printingcolor__c FROM Quote WHERE Job_Number__c LIKE '%PRN1705-22405%'";
//$jobnodetails = "SELECT Id, Name FROM Quote";
//$jobnodetails_res = $mySforceConnection->query($jobnodetails);

//$jobnoDetails = $jobnodetails_res->current();

//echo "<pre>"; print_r($jobnoDetails); exit;

/*$test = array();
	
$test['name'] =	$jobnoDetails->fields->Name;
$test['PRN_width__c'] =	$jobnoDetails->fields->PRN_width__c;
$test['PRN_height__c'] = $jobnoDetails->fields->PRN_height__c;
$test['PRN_insidepagecount__c'] = $jobnoDetails->fields->PRN_insidepagecount__c;
$test['PRN_printingcolor__c']= $jobnoDetails->fields->PRN_printingcolor__c;
$test['Job_Number__c']= $jobnoDetails->fields->Job_Number__c; */

//echo "<pre>"; print_r($test); exit;
//$jobnodetails_res1 = $jobnodetails_res->current();

$testOpp = array();
	
$testOpp['name'] =	$jobnoDetailsopp->fields->Name;
$testOpp['PRN_width__c'] =	$jobnoDetailsopp->fields->PRN_width__c;
$testOpp['PRN_height__c'] = $jobnoDetailsopp->fields->PRN_height__c;
$testOpp['PRN_insidepagecount__c'] = $jobnoDetailsopp->fields->PRN_insidepagecount__c;
//$testOpp['PRN_printingcolor__c'] = $jobnoDetailsopp->fields->PRN_printingcolor__c;
$testOpp['Prepress_Printing_Color__c'] = $jobnoDetailsopp->fields->Prepress_Printing_Color__c;
$testOpp['Job_Number1__c'] = $jobnoDetailsopp->fields->Job_Number1__c;
$testOpp['Prepress_Binding_Type__c'] = $jobnoDetailsopp->fields->Prepress_Binding_Type__c;
$testOpp['PRN_endsheets__c'] = $jobnoDetailsopp->fields->PRN_endsheets__c;
$testOpp['PRN_insidepaperweight__c'] = $jobnoDetailsopp->fields->PRN_insidepaperweight__c;
$testOpp['PRN_coverpaperweight__c'] = $jobnoDetailsopp->fields->PRN_coverpaperweight__c;
$testOpp['Specialty_Options_Book__c'] = $jobnoDetailsopp->fields->Specialty_Options_Book__c;
$testOpp['PRN_variantcovers__c'] = $jobnoDetailsopp->fields->PRN_variantcovers__c;

/*** hidden fields ***/
$testOpp['Prepress_Spot_Colors__c'] = $jobnoDetailsopp->fields->Prepress_Spot_Colors__c;
$testOpp['Prepress_Cover_Pages__c'] = $jobnoDetailsopp->fields->Prepress_Cover_Pages__c;
$testOpp['PrePress_Spine__c'] = $jobnoDetailsopp->fields->PrePress_Spine__c;
$testOpp['Prepress_French_Fold_Flap_Width__c'] = $jobnoDetailsopp->fields->Prepress_French_Fold_Flap_Width__c;
$testOpp['Prepress_Cover_Media_Box_Width__c'] = $jobnoDetailsopp->fields->Prepress_Cover_Media_Box_Width__c;
$testOpp['Prepress_Cover_Media_Box_Height__c'] = $jobnoDetailsopp->fields->Prepress_Cover_Media_Box_Height__c;
$testOpp['Prepress_Cover_Die_Line_Width__c'] = $jobnoDetailsopp->fields->Prepress_Cover_Die_Line_Width__c;
$testOpp['Prepress_Cover_Die_Line_Height__c'] = $jobnoDetailsopp->fields->Prepress_Cover_Die_Line_Height__c;
$testOpp['Prepress_Hinge_Width__c'] = $jobnoDetailsopp->fields->Prepress_Hinge_Width__c;
$testOpp['Prepress_Dust_Jacket_Pages__c'] = $jobnoDetailsopp->fields->Prepress_Dust_Jacket_Pages__c;
$testOpp['Prepress_Dust_Jacket_Spine__c'] = $jobnoDetailsopp->fields->Prepress_Dust_Jacket_Spine__c;
$testOpp['PrePress_Dust_Jacket_Flap_Width__c'] = $jobnoDetailsopp->fields->PrePress_Dust_Jacket_Flap_Width__c;
$testOpp['Prepress_Dust_Jacket_Media_Box_Width__c'] = $jobnoDetailsopp->fields->Prepress_Dust_Jacket_Media_Box_Width__c;
$testOpp['Prepress_Dust_Jacket_Media_Box_Height__c'] = $jobnoDetailsopp->fields->Prepress_Dust_Jacket_Media_Box_Height__c;
$testOpp['Prepress_Dust_Jacket_Die_Line_Width__c'] = $jobnoDetailsopp->fields->Prepress_Dust_Jacket_Die_Line_Width__c;
$testOpp['Prepress_Dust_Jacket_Die_Line_Height__c'] = $jobnoDetailsopp->fields->Prepress_Dust_Jacket_Die_Line_Height__c;
$testOpp['Prepress_Dust_Jacket_Flap_Die_Line__c'] = $jobnoDetailsopp->fields->Prepress_Dust_Jacket_Flap_Die_Line__c;
$testOpp['Prepress_Total_Pages__c'] = $jobnoDetailsopp->fields->Prepress_Total_Pages__c;
$testOpp['Prepress_Total_Spreads__c'] = $jobnoDetailsopp->fields->Prepress_Total_Spreads__c;
$testOpp['MediaBox_Width__c'] = $jobnoDetailsopp->fields->MediaBox_Width__c;
$testOpp['MediaBox_Height__c'] = $jobnoDetailsopp->fields->MediaBox_Height__c;
$testOpp['Spread_Width__c'] = $jobnoDetailsopp->fields->Spread_Width__c;
$testOpp['MediaBox_Spread_Height__c'] = $jobnoDetailsopp->fields->MediaBox_Spread_Height__c;
$testOpp['Prepress_Media_Box_Width_First_Last__c'] = $jobnoDetailsopp->fields->Prepress_Media_Box_Width_First_Last__c;
$testOpp['Prepress_Media_Box_Height_First_Last__c'] = $jobnoDetailsopp->fields->Prepress_Media_Box_Height_First_Last__c;
$testOpp['Ordered_ISBN__c'] = $jobnoDetailsopp->fields->Ordered_ISBN__c;
/**** EDO ****/


$testOpp1 = array();
$testOpp1['name'] =	$jobnoDetailsopp->fields->Name;
$testOpp1['Page Width'] =	$jobnoDetailsopp->fields->PRN_width__c;
$testOpp1['Page Height'] = $jobnoDetailsopp->fields->PRN_height__c;
$testOpp1['Page Count'] = $jobnoDetailsopp->fields->PRN_insidepagecount__c;
$testOpp1['Printing Color']= $jobnoDetailsopp->fields->PRN_printingcolor__c;
$testOpp1['Job Number']= $jobnoDetailsopp->fields->Job_Number1__c;


$queryResult = new QueryResult($jobnodetails_res);
foreach ($queryResult->records as $record) {
    // echo "<pre>";print_r($record);
    /*echo "<br>";
    echo $record->Product_Experience_Report__c->Id[0];
    echo "<br>";*/
}
//echo "<pre>"; print_r($jobnodetails_res);

/*--------------XML-----------------------------*/

$xmlstr = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<field-list>
 <field>
  <tag>Job Number</tag>
  <type>String</type>
  <required>false</required>
  <value></value>
 </field>
 <field>
  <tag>Page Count</tag>
  <type>String</type>
  <required>false</required>
  <value></value>
 </field>
 <field>
  <tag>Page Width</tag>
  <type>String</type>
  <required>false</required>
  <value></value>
 </field>
 <field>
  <tag>Page Height</tag>
  <type>String</type>
  <required>false</required>
  <value></value>
 </field>
 <field>
  <tag>Printing Color</tag>
  <type>String</type>
  <required>false</required>
  <value></value>
 </field>
</field-list>
XML;


$fieldlist = new SimpleXMLElement($xmlstr);

$fieldlist->field[0]->value = $testOpp1['Job Number'];
$fieldlist->field[1]->value = $testOpp1['Page Count'];
$fieldlist->field[2]->value = $testOpp1['Page Width'];
$fieldlist->field[3]->value = $testOpp1['Page Height'];
$fieldlist->field[4]->value = $testOpp1['Printing Color'];


//$fieldlist->field->tag->type->required = 'Job Number';


//echo $fieldlist->asXML();

$result = $fieldlist->asXML('xml/PrintNinja.xml');

//echo "File Created";
//exit;



// function defination to convert array to xml
/*function array_to_xml( $data, &$xml_data ) {
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
} */

// initializing or creating array
//$data = array('tag' => 'Job Numbaer','type' => 'string','required' => 'false','value' => 'PNR1702-18315');
//$str1 = htmlspecialchars('<field><tag>Job Number</tag><type>String</type><required>false</required><value>'.$testOpp['Job_Number1__c'].'</value></field>');
		

/*$intData = array();
foreach($testOpp1 as $key => $value){
	$str2 = htmlspecialchars('<field><tag>'.$key.'</tag><type>String</type><required>false</required><value>'.$value.'</value></field>');
	$str1 .= $str2;
} */

//echo "<pre>";
//echo str_replace(' ' , '' ,$str1);
///echo "</pre>";



// creating object of SimpleXMLElement
/* $xml_data = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><field-list></field-list>'); */

// function call to convert array to xml
//array_to_xml($finalData,$xml_data);

//saving generated xml file; 
//$result = $xml_data->asXML('xml/PrintNinja.xml');

/*---------------End----------------------------- */


?>

<div><!--<hr style="border-width: 1.5px; border-style: dotted;" />-->
<?php if($jobNumber = $testOpp['Job_Number1__c'] && $jobNumber != '') { ?>

<form action="http://" name="EnfocusConnectMetadata" enctype="application/x-wwwform-urlencoded">
  <!--<fieldset>-->
        
  <div class="titleMainsales textfldBox1" style="margin-bottom: 10px;"><span>Your Project Specifications:</span></div>
         
		  <div id="MF_1" class="textfldBox1">
            <label for="Binding" title="" class="titleLab">Binding</label><br>
            <input class="textbox" value="<?php echo $testOpp['Prepress_Binding_Type__c']; ?>" name="Binding" id="Binding" readonly="" type="text">
         </div>
		 
		 <div id="MF_2" class="textfldBox1">
            <label for="PageWidth" title="" class="titleLab">Page Width</label><br>
            <input class="textbox" value="<?php echo floatval($testOpp['PRN_width__c']); ?>" name="PageWidth" id="PageWidth" readonly="" type="text">
         </div>
        
         <div id="MF_3" class="textfldBox1">
            <label for="PageHeight" title="" class="titleLab">Page Height</label><br>
            <input class="textbox" value="<?php echo floatval($testOpp['PRN_height__c']); ?>" name="PageHeight" id="PageHeight" readonly="" type="text">
         </div>
        
         <div id="MF_4" class="textfldBox1">
            <label for="InsidePageCount" title="" class="titleLab">Inside Page Count</label><br>
            <input class="textbox" value="<?php echo floatval($testOpp['PRN_insidepagecount__c']); ?>" name="InsidePageCount" id="InsidePageCount" readonly="" type="text">
         </div>
		 <?php if($testOpp['Prepress_Binding_Type__c'] == 'Case (Hardcover) with Dust Jacket' || $testOpp['Prepress_Binding_Type__c'] == 'Case (Hardcover)' && $testOpp['PRN_endsheets__c'] =="") { ?>
		  <div id="MF_5" class="textfldBox1">
            <label for="Endsheets" title="" class="titleLab">Endsheets</label><br>
            <input class="textbox" value="<?php echo $testOpp['PRN_endsheets__c']; ?>" name="Endsheets" id="Endsheets" readonly="" type="text">
         </div>
		 <?php } else { ?>
		 <input type="hidden" name="Endsheets" id="Endsheets" value="<?php echo $testOpp['PRN_endsheets__c']; ?>"/>
		 <?php } ?>
         
         <div id="MF_6" class="textfldBox1">
            <label for="PrintingColor" title="" class="titleLab">Printing Color</label><br>
            <input class="textbox" value="<?php echo $testOpp['Prepress_Printing_Color__c']; ?>" name="PrintingColor" id="PrintingColor" readonly="" type="text">
         </div>
		 
		  <div id="MF_8" class="textfldBox1">
            <label for="InsidePaperWeight" title="" class="titleLab">Inside Paper Weight</label><br>
            <input class="textbox" value="<?php echo $testOpp['PRN_insidepaperweight__c']; ?>" name="InsidePaperWeight" id="InsidePaperWeight" readonly="" type="text">
         </div>
		 
		  <div id="MF_9" class="textfldBox1">
            <label for="CoverPaperWeight" title="" class="titleLab">Cover Paper Weight</label><br>
            <input class="textbox" value="<?php echo $testOpp['PRN_coverpaperweight__c']; ?>" name="CoverPaperWeight" id="CoverPaperWeight" readonly="" type="text">
         </div>
		 
		  <?php if($testOpp['Specialty_Options_Book__c'] != '') { ?>
		  <div id="MF_10" class="textfldBox1">
            <label for="SpecialtyOptions" title="" class="titleLab">Specialty Options</label><br>
            <input class="textbox" value="<?php echo str_replace(';', ";&nbsp;",$testOpp['Specialty_Options_Book__c']); ?>" name="SpecialtyOptions" id="SpecialtyOptions" readonly="" type="text">
         </div>
		 <?php } else { ?>
		 <input type="hidden" name="SpecialtyOptions" id="SpecialtyOptions" value="<?php echo $testOpp['Specialty_Options_Book__c']; ?>"/>
		 <?php } ?>
		 
		 <?php if($testOpp['PRN_variantcovers__c'] != '' && $testOpp['PRN_variantcovers__c'] != 0) { ?>
		 <div id="MF_11" class="textfldBox1">
            <label for="VariantCovers" title="" class="titleLab">Variant Covers</label><br>
            <input class="textbox" value="<?php echo floatval($testOpp['PRN_variantcovers__c']); ?>" name="VariantCovers" id="VariantCovers" readonly="" type="text">
         </div>
		 <?php } else { ?>
		 <input type="hidden" name="VariantCovers" id="VariantCovers" value="<?php echo $testOpp['PRN_variantcovers__c']; ?>"/>
		 <?php } ?>
		 
		 <!-- Hidden fields -->
		 <input type="hidden" name="JobNumber" id="JobNumber" value="<?php echo $testOpp['Job_Number1__c']; ?>"/>
         <input type="hidden" name="SpotColors" id="SpotColors" value="<?php echo floatval($testOpp['Prepress_Spot_Colors__c']); ?>"/>
		 <input type="hidden" name="CoverPageCount" id="CoverPageCount" value="<?php echo floatval($testOpp['Prepress_Cover_Pages__c']); ?>"/>
		 <input type="hidden" name="CoverSpineWidth" id="CoverSpineWidth" value="<?php echo floatval($testOpp['PrePress_Spine__c']); ?>"/>
		 <input type="hidden" name="FrenchFoldFlapWidth" id="FrenchFoldFlapWidth" value="<?php echo floatval($testOpp['Prepress_French_Fold_Flap_Width__c']); ?>"/>
		 <input type="hidden" name="CoverMediaBoxWidth" id="CoverMediaBoxWidth" value="<?php echo floatval($testOpp['Prepress_Cover_Media_Box_Width__c']); ?>"/>
		 <input type="hidden" name="CoverMediaBoxHeight" id="CoverMediaBoxHeight" value="<?php echo floatval($testOpp['Prepress_Cover_Media_Box_Height__c']); ?>"/>
		 <input type="hidden" name="CoverDieLineWidth" id="CoverDieLineWidth" value="<?php echo floatval($testOpp['Prepress_Cover_Die_Line_Width__c']); ?>"/>
		 <input type="hidden" name="CoverDieLineHeight" id="CoverDieLineHeight" value="<?php echo floatval($testOpp['Prepress_Cover_Die_Line_Height__c']); ?>"/>
		 <input type="hidden" name="CoverHingeWidth" id="CoverHingeWidth" value="<?php echo floatval($testOpp['Prepress_Hinge_Width__c']); ?>"/>
		 <input type="hidden" name="DustJacketPageCount" id="DustJacketPageCount" value="<?php echo floatval($testOpp['Prepress_Dust_Jacket_Pages__c']); ?>"/>
		 <input type="hidden" name="DustJacketSpineWidth" id="DustJacketSpineWidth" value="<?php echo floatval($testOpp['Prepress_Dust_Jacket_Spine__c']); ?>"/>
		 <input type="hidden" name="DustJacketFlapWidth" id="DustJacketFlapWidth" value="<?php echo floatval($testOpp['PrePress_Dust_Jacket_Flap_Width__c']); ?>"/>
		 <input type="hidden" name="DustJacketMediaBoxWidth" id="DustJacketMediaBoxWidth" value="<?php echo floatval($testOpp['Prepress_Dust_Jacket_Media_Box_Width__c']); ?>"/>
		 <input type="hidden" name="DustJacketMediaBoxHeight" id="DustJacketMediaBoxHeight" value="<?php echo floatval($testOpp['Prepress_Dust_Jacket_Media_Box_Height__c']); ?>"/>
		 <input type="hidden" name="DustJacketDieLineWidth" id="DustJacketDieLineWidth" value="<?php echo floatval($testOpp['Prepress_Dust_Jacket_Die_Line_Width__c']); ?>"/>
		 <input type="hidden" name="DustJacketDieLineHeight" id="DustJacketDieLineHeight" value="<?php echo floatval($testOpp['Prepress_Dust_Jacket_Die_Line_Height__c']); ?>"/>
		 <input type="hidden" name="DustJacketFlapDieLine" id="DustJacketFlapDieLine" value="<?php echo floatval($testOpp['Prepress_Dust_Jacket_Flap_Die_Line__c']); ?>"/>
		 <input type="hidden" name="TotalPages" id="TotalPages" value="<?php echo floatval($testOpp['Prepress_Total_Pages__c']); ?>"/>
		 <input type="hidden" name="TotalSpreads" id="TotalSpreads" value="<?php echo floatval($testOpp['Prepress_Total_Spreads__c']); ?>"/>
		 <input type="hidden" name="MediaBoxWidth" id="MediaBoxWidth" value="<?php echo floatval($testOpp['MediaBox_Width__c']); ?>"/>
		 <input type="hidden" name="MediaBoxHeight" id="MediaBoxHeight" value="<?php echo floatval($testOpp['MediaBox_Height__c']); ?>"/>
		 <input type="hidden" name="SpreadMediaBoxWidth" id="SpreadMediaBoxWidth" value="<?php echo floatval($testOpp['Spread_Width__c']); ?>" />
		 <input type="hidden" name="SpreadMediaBoxHeight" id="SpreadMediaBoxHeight" value="<?php echo floatval($testOpp['MediaBox_Spread_Height__c']); ?>" />
		 <input type="hidden" name="FirstLastMediaBoxWidth" id="FirstLastMediaBoxWidth" value="<?php echo floatval($testOpp['Prepress_Media_Box_Width_First_Last__c']); ?>" />
         <input type="hidden" name="FirstLastMediaBoxHeight" id="FirstLastMediaBoxHeight" value="<?php echo floatval($testOpp['Prepress_Media_Box_Height_First_Last__c']); ?>" />
		 <input type="hidden" name="OrderedISBN" id="OrderedISBN" value="<?php echo $testOpp['Ordered_ISBN__c']; ?>" />		 
         <!-- Hidden Fields EDO -->		 
		 
		 
         <div id="MF_7" class="subbtnCont" style="margin: 17px 0px 65px 56px;">
         <input value="Continue &raquo;" name="Submit" class="controls submbtn" type="Submit">
		 </div>
   <!--</fieldset>-->
 
</form>


<!--<table>
  <tr>
    <th>Page Width</th>
    <th>Page Height</th>
    <th>Page Count</th>
	<th>Printing Color</th>
  </tr>
    <tr>
    <td><?php //echo $testOpp['PRN_width__c']; ?></td>
    <td><?php //echo $testOpp['PRN_height__c']; ?></td>
    <td><?php //echo $testOpp['PRN_insidepagecount__c']; ?></td>
	<td><?php //echo $testOpp['PRN_printingcolor__c']; ?></td>
  </tr>
</table> --->
<?php } else { ?>
<div id="MF_T" class="errjobnumer"> 
Invalid job number. Please re-enter your job number.
</div>
<?php } ?>

</div>
<!--<div style="float: right;margin-top: 30px;"><input type="submit" name="submit" value="Submit"><a target="_blank" href='/customapi/xml/PrintNinja.xml'><img src="/customapi/button_submit.png" /></a></div>-->
