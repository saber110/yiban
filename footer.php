

  <div class="footer">
    <p><span class="glyphicon glyphicon-heart"></span> 中南易班 <!-- | theme by <a href="https://github.com/upcyiban/SignName">upcyiban</a> --></p>
  </div>
</div>
</body>
<!-- build:js(.) scripts/vendor.js -->
<!-- bower:js -->
<script src="<?php echo base_url();?>/bower_components/jquery/dist/jquery.js"></script>
<script src="<?php echo base_url();?>/bower_components/bootstrap/dist/js/bootstrap.js"></script>
<!-- tencent location -->
<script type="text/javascript" src="https://3gimg.qq.com/lightmap/components/geolocation/geolocation.min.js"></script>
<script type="text/JavaScript">
    var geolocation = new qq.maps.Geolocation("OB4BZ-D4W3U-B7VVO-4PJWW-6TKDJ-WPB77", "myapp");

    document.getElementById("pos-area").style.height = (document.body.clientHeight - 110) + 'px';

    var positionNum = 0;
    var options = {timeout: 8000};
    function showPosition(position) {
        positionNum ++;
        // document.getElementById("demo").innerHTML += "序号：" + positionNum;
        var string = JSON.stringify(position, null, 4).match('addr.*')[0].split('addr": "')[1];
        console.log(string);
        console.log(string[0]);
        document.getElementById("demo").appendChild(document.createElement('pre')).innerHTML = string.split('"')[0];//.split('addr')[1]
        document.getElementById("pos-area").scrollTop = document.getElementById("pos-area").scrollHeight;
    };

    function showErr() {
        positionNum ++;
        document.getElementById("demo").innerHTML += "序号：" + positionNum;
        document.getElementById("demo").appendChild(document.createElement('p')).innerHTML = "定位失败！";
        document.getElementById("pos-area").scrollTop = document.getElementById("pos-area").scrollHeight;
    };

    function showWatchPosition() {
        document.getElementById("demo").innerHTML += "开始监听位置！<br /><br />";
        geolocation.watchPosition(showPosition);
        document.getElementById("pos-area").scrollTop = document.getElementById("pos-area").scrollHeight;
    };

    function showClearWatch() {
        geolocation.clearWatch();
        document.getElementById("demo").innerHTML += "停止监听位置！<br /><br />";
        document.getElementById("pos-area").scrollTop = document.getElementById("pos-area").scrollHeight;
    };
</script>

<!-- end tencent location -->
<script type="text/javascript">
function submitLocation()
{
	//alert(JSON.stringify(document.getElementById("yibanhtml5").innerHTML, null, 4).match("address.*"));
		$.get("./insertLocation?addr=" +(JSON.stringify(document.getElementById("yibanhtml5").innerHTML, null, 4)).match("address.*") )
}

</script>
<script src = "<?php echo base_url();?>/js/qiandao/location.js"></script>
<!-- endbower -->
<!-- endbuild -->

<!-- build:js(.tmp) scripts/main.js -->
<script src="<?php echo base_url();?>/js/qiandao/main.js"></script>
<!-- endbuild -->

<!-- Baidu Analytics-->
<script>

</script>

</html>
