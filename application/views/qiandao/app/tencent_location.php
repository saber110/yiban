<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>正在获取您的位置</title>
	<script type="text/javascript" src="<?=base_url().'js/qiandao/geolocation.min.js'?>"></script>

	<script type="text/javascript" src="<?=base_url().'js/qiandao/jquery-1.8.3.min.js'?>"></script>
	<script src="<?=base_url().'js/qiandao/jquery.min.js'?>" type="text/javascript"></script> 

	<script type="text/JavaScript">

	var geolocation = new qq.maps.Geolocation("OB4BZ-D4W3U-B7VVO-4PJWW-6TKDJ-WPB77", "myapp");

//	document.getElementById("pos-area").style.height = (document.body.clientHeight - 110) + 'px';

	var options =  { timeout: 6000 } ;
	function submitLocation()
	{
		if(Tlocation == '')
		{
			geolocation.getLocation(showPosition, showErr, options);
			console.log('重新获取');
		}
		else
		{
			$.get("./insertLocation?addr=" + Tlocation)
		}


	}
	function showPosition(position) {
	    
	    Tlocation = ((JSON.stringify(position, null, 4)).match("addr.*"));
		//console.log(Tlocation);

	    // document.getElementById("demo").appendChild(document.createElement('pre')).innerHTML = Tlocation;
	    submitLocation();
	    // document.getElementById("demo").appendChild(document.createElement('pre')).innerHTML = (JSON.stringify(position, null, 4));
	    
	};




	function showErr() {
	    // positionNum ++;
	    // document.getElementById("demo").innerHTML += "序号：" + positionNum;
	    document.getElementById("demo").appendChild(document.createElement('p')).innerHTML = "定位失败！";
	    // document.getElementById("pos-area").scrollTop = document.getElementById("pos-area").scrollHeight;
	};
</script>
</head>
<body onload="geolocation.getLocation(showPosition, showErr, options)">
<div  height = "10px"></div>
</body>
</html>
