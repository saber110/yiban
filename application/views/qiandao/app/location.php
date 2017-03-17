 <!DOCTYPE html>
 <html>
 <head>
 	<title>please confirm your location</title>
 	<meta charset="utf-8">
	<script type="text/javascript" src="<?=base_url().'js/qiandao/jquery-1.8.3.min.js'?>"></script>
	<script type="text/javascript">
	function submitLocation()
	{
		//alert(JSON.stringify(document.getElementById("yibanhtml5").innerHTML, null, 4).match("address.*"));
			$.get("./insertLocation?addr=" +(JSON.stringify(document.getElementById("yibanhtml5").innerHTML, null, 4)).match("address.*") )
		
	}

	</script>
 	<script src = "<?php echo base_url();?>/js/qiandao/location.js"></script>

 </head>
 <body onload="gethtml5location_fun(); ">
	  <div id="yibanhtml5" ></div>
	  <a onclick="submitLocation();" href="">yes</a>
 </body>


 </html>
