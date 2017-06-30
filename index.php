<html xmlns:EnfocusConnectNS="http://www.enfocus.com/2013/EnfocusConnectMetadataPreset">
<head>
 <title> PrintNinja Full Salesforce Job number details</title>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="/customapi/css/PrintNinja-Salesforce.css" rel="stylesheet">
<link href="/customapi/css/fonts.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://511qa.katdev.com/calculator/theme/Printninja/css/prepress.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
<style>
.ajax-loader {
  position: absolute;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
  margin: auto; /* presto! */
}
</style>
</head>
<body>
<div id="AjaxLoader"><img src="/customapi/ajax-loader.gif" class="ajax-loader"></div>
<div class="formMainctr">
 <div  style="margin: 65px 0px 45px;"><a href="/customapi/"><img width="274px" style="display: block; margin: 0px auto;" src="/customapi/img/print-ninja-logo-form.png"></a></div>
  <div id="MF_T" class="textfldBox">
  <label for="MF_1_text" title="" class="titleLab titleTwosame">Enter Your PrintNinja Job Number</label><br />
              <input class="textbox" name="JobNumber" id="jobNumber" placeholder="i.e. PRN1234-56789" type="text"><br />
			  
			  <label for="MF_1_text" title="" class="titleLab titleTwosame">Enter the PDF Page the Country<br /> of Origin Statement is on <a href="#" data-toggle="tooltip" data-placement="right" title ='This is your "Printed in China" or "Printed in PRC" statement that must be included on your project in order to print.'><i class="fa fa-lightbulb-o fa-1" aria-hidden="true"></i></a></label><br />
			  <input name="PrintedInChina" class="textbox" type="text" value="" placeholder="i.e. PDF Page 5" id="PrintedInChina" tabindex="8" ><br />
			  <input name="PrintInsideCovers" type="checkbox" value="0"  id="PrintInsideCovers" tabindex="8" style="margin-left: -1px;" >
			  <label for="MF_1_text" title="" class="titleLab titleCheckbox">Yes, I will be printing on my inside <p style="margin-top: 2px;margin-left: 18px;">cover and/or endsheets.</p></label>
              <input style="margin-bottom: 67px;" class="nextBtnsm" name="submit" value="Next &raquo;" onclick="javascript:sendData();" type="button" >
  <div id="displayData" style="margin-left: -66px;"></div>
  </div>
</div>
<script  type="text/javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
function sendData()
	{
		$('#AjaxLoader').show();
		$.ajax({
				  type: "POST",
				  url: "salesforce_job_number.php",
				  dataType: "html",
				  data: 'jobNumber='+ $("#jobNumber").val() + '&countryOrigin='+ $("#PrintedInChina").val() + '&printingCheckbox='+ $("#PrintInsideCovers").val(),
				  success: function(data){
					$('#AjaxLoader').hide();
					 $('.nextBtnsm').prop('disabled', true).css('background-color', 'gray');
					 $('#displayData').css("display", "block");
					 $("#displayData").html(data);
					 console.log($("#wrapper").html());
				  },
				  error:function(){
					alert("Error");
				  }
		});
	}
	// Enable input jobnuber on key up
	$(document).ready(function () {
		$('#AjaxLoader').hide();
		
		$('#jobNumber').keyup(function() {
			//alert( "Handler for .keyup() called." );
			$('.nextBtnsm').prop('disabled', false).css('background-color', '');
			$('#displayData').css("display", "none");
		});
		
		$('#PrintedInChina').keyup(function() {
			$('.nextBtnsm').prop('disabled', false).css('background-color', '');
			$('#displayData').css("display", "none");
		});
		
		$('#PrintInsideCovers').change(function() {
			$('.nextBtnsm').prop('disabled', false).css('background-color', '');
			$('#displayData').css("display", "none");
		});
		
	});
	/* $('#PrintInsideCovers').change(function () {
    if ($(this).attr("checked")) {
        // checked 
		alert(1);
        return;
    }
    // not checked
	alert(2);
   }); */
 
  
 $("#PrintInsideCovers").on('change',function(){
		 if(this.checked) {
        //Do stuff 
		$(this).attr("value",1);
    }
	else{
	//alert("Not Checked");
	$(this).attr("value",0);
	}
  });
</script>
<!-- end #footer -->
<script>
$(document).ready(function(){
 $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<!--<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script> --->
</body>
</html>
