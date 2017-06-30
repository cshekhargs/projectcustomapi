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
$query = "SELECT Id,name,ProfileId,IsActive FROM User WHERE IsActive=true";
$response = $mySforceConnection->query($query);

$querydeactive = "SELECT Id,name,ProfileId,IsActive FROM User WHERE IsActive=false";
$response1 = $mySforceConnection->query($querydeactive);
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
						 <h1> List of Active Users </h1>
								<a href="javascript:void(0);">							
								<?php
									//echo "Results of query '$query'<br/><br/>\n";
									echo "Total Contact Record is = " . "".count($response->records);
								?>
								</a> <span style="float:right;"><a href="Printcontact.php" target="_blank">Print Contacts </a> | <a href="PrintAccounts.php" target="_blank">Print Accounts </a> | <a href="Printusers.php" target="_blank">Print Users </a></span>  <br /> <br />
							<table>
								<tr>
									<th>User ID </th>
									<th>Name</th>
									<th>ProfileId</th>
									<th>IsActive </th>
								</tr>
								<?php
									//echo "<pre>";print_r($response->records);
									
									foreach ($response->records as $record) { 	 
										echo '<tr> 
													<td>'.$record->Id.'</td>
													<td>'.$record->Name.'</td>
													<td>'.$record->ProfileId.'</td>
													<td>'.$record->IsActive.'</td>
											 </tr>';
										 }
								?>
							</table>
						</div>
						
					</div>
					
					<!-- Deactive Users --->
					<div class="post">
					   
						<div style="clear: both;">&nbsp;</div>
						<div class="entry">
						<h1> List of DeActive User </h1>
								<a href="javascript:void(0);">							
								<?php
									//echo "Results of query '$query'<br/><br/>\n";
									echo "Total Contact Record is = " . "".count($response1->records);
								?>
								</a> <span style="float:right;"><a href="Printcontact.php" target="_blank">Print Contacts </a> | <a href="PrintAccounts.php" target="_blank">Print Accounts </a> | <a href="Printusers.php" target="_blank">Print Users </a></span>  <br /> <br />
							<table>
								<tr>
									<th>User ID </th>
									<th>Name</th>
									<th>ProfileId</th>
									<th>DeActive </th>
								</tr>
								<?php
									//echo "<pre>";print_r($response->records);
									
									foreach ($response1->records as $record) { 	 
										echo '<tr> 
													<td>'.$record->Id.'</td>
													<td>'.$record->Name.'</td>
													<td>'.$record->ProfileId.'</td>
													<td>'.$record->IsActive.'</td>
											 </tr>';
										 }
								?>
							</table>
						</div>
						
					</div>
					<!--- Deactive users --->
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

