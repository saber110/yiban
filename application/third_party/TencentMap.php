     <script type="text/javascript" src="https://3gimg.qq.com/lightmap/components/geolocation/geolocation.min.js"></script>

     <script type="text/javascript" src="<?=base_url().'js/qiandao/jquery-1.8.3.min.js'?>"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script> 

      <script type="text/JavaScript">

        var geolocation = new qq.maps.Geolocation("OB4BZ-D4W3U-B7VVO-4PJWW-6TKDJ-WPB77", "myapp");
        //var Tlocation;
        document.getElementById("pos-area").style.height = (document.body.clientHeight - 110) + 'px';
        
        var options =  { timeout: 8000 } ;
        function submitLocation()
        {
            $.get("./insertLocation?addr=" + Tlocation)
        }
        function showPosition(position) {
            
            Tlocation = ((JSON.stringify(position, null, 4)).match("addr.*"));


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
      <div id="pos-area">
            <p id="demo"></p>
        </div>
     
<!--         <div id="btn-area" onclick="geolocation.getLocation(showPosition, showErr, options)" >
            <button onclick="geolocation.getLocation(showPosition, showErr, options)">获取精确定位信息</button>
            <button onclick="geolocation.getIpLocation(showPosition, showErr)">获取粗糙定位信息</button>

        </div> -->