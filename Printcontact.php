<?php 
/*define("USERNAME", "sgangathade@katalysttech.com");
define("PASSWORD", "guruji@#1234");
define("SECURITY_TOKEN", "BzfI3y9TK8VSYFUuaEClNUpv");

require_once ('soapclient/SforcePartnerClient.php');

$mySforceConnection = new SforcePartnerClient();
$mySforceConnection->createConnection("PartnerWSDL.xml");
$mySforceConnection->login(USERNAME, PASSWORD.SECURITY_TOKEN);

$query = "SELECT Id, Name from User";
$response = $mySforceConnection->query($query);

foreach ($response->records as $record)
{
echo '<tr>
	<td>'.$record->Id.'</td>
	<td>'.$record->fields->Name.'</td>
	</tr>';
 } */
?>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<title>Katalyst tech devlopers</title>
</head>
<body>
<?php
require_once ('api.php');

require_once ('soapclient/SforceEnterpriseClient.php');
try{
	$mySforceConnection = new SforceEnterpriseClient();
	$mySforceConnection->createConnection("soapclient/enterprise.wsdl.xml");
	$mySforceConnection->login(USERNAME, PASSWORD.SECURITY_TOKEN);
} catch (Exception $e) {
	echo $e;
}


$query = "SELECT Id, FirstName, LastName, Phone from Contact";
$response = $mySforceConnection->query($query);
?>
<div id="wrapper">
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<div class="post">
					<?php include('header.php'); ?>
						<div style="clear: both;">&nbsp;</div>
						<div class="entry">
								<a href="javascript:void(0);">							
								<?php
									//echo "Results of query '$query'<br/><br/>\n";
									echo "Total Contact Record is = " . "".count($response->records);
								?>
								</a> <span style="float:right;"><a href="Printcontact.php" target="_blank">Print Contacts </a> | <a href="PrintAccounts.php" target="_blank">Print Accounts </a> | <a href="Printusers.php" target="_blank">Print Users </a></span>  <br /> <br />
							<table>
								<tr>
									<!--<th>Contact ID </th> <td>'.$record->Id.'</td>-->
									<th>First Name</th>
									<th> Last Name </th>
									<th>Phone </th>
								</tr>
								<?php
									//echo "<pre>";print_r($response->records);
									
									foreach ($response->records as $record) { 	 
										echo '<tr> 
													
													<td>'.$record->FirstName.'</td>
													<td>'.$record->LastName.'</td>
													<td>'.$record->Phone.'</td>
											 </tr>';
										 }
								?>
							</table>
						</div>
						
					</div>
					<div style="clear: both;">&nbsp;</div>
				</div>
				
				<div style="clear: both;">&nbsp;</div>
			</div>
		</div>
		
		
	</div>
	
	<!-- end #page -->
</div>
<!-- end #footer -->
</body>
</html>

