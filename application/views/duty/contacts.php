<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title> 选项卡</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/duty/dutytel.css">
    </head>

    <body>
    <div class="container">
            <div class="content">

                <ul id="nav">
                    <li><a href="#" class="current">部门选择</a>
                        <ul class="subs">
                            <li><a href="#">技术部</a></li>
                            <li><a href="#">运营部</a></li>
                            <li><a href="#">宣传部</a></li>
                            <li><a href="#">行政部</a></li>
                        </ul>
                    </li>

                </ul>

            </div>
        </div>

    <img src="<?php echo base_url(); ?>images/duty/logo.png">
    <h1>通讯录</h1>
    <div class="tabs" id="tabs">
      <input checked id="one" name="tabs" type="radio">
      <label for="one">美工组</label>
      <input id="two" name="tabs" type="radio">
      <label for="two">研发组</label>
      <input id="three" name="tabs" type="radio">
      <label for="three">网络组</label>
      <div class="panels">
        <div class="panel">
              <div id="firstPage">
                <table class="bordered">
                    <thead>
                        <tr>
                            <th>姓名</th>
                            <th>电话</th>
                            <th>邮箱</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>13333334747</td>
                            <td>123456@qq.com</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>346728728732</td>
                            <td>123456@qq.com</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>2321421412</td>
                            <td>123456@qq.com</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>23829832983</td>
                            <td>123456@qq.com</td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td>13333334747</td>
                          <td>123456@qq.com</td>
                        </tr>
                        <tr>
                          <td>6</td>
                          <td>13333334747</td>
                          <td>123456@qq.com</td>
                        </tr>
                    </tbody>
                </table>
        </div>
        </div>
        <div class="panel">
            <div id="secondPage" >
                   <table class="bordered">
                    <thead>
                        <tr>
                            <th>姓名</th>
                            <th>电话</th>
                            <th>邮箱</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>13333334747</td>
                            <td>123456@qq.com</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>346728728732</td>
                            <td>123456@qq.com</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>2321421412</td>
                            <td>123456@qq.com</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>23829832983</td>
                            <td>123456@qq.com</td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td>13333334747</td>
                          <td>123456@qq.com</td>
                        </tr>
                        <tr>
                          <td>6</td>
                          <td>13333334747</td>
                          <td>123456@qq.com</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel">
                    <table class="bordered">
                    <thead>
                        <tr>
                            <th>姓名</th>
                            <th>电话</th>
                            <th>邮箱</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>13333334747</td>
                            <td>123456@qq.com</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>346728728732</td>
                            <td>123456@qq.com</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>2321421412</td>
                            <td>123456@qq.com</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>23829832983</td>
                            <td>123456@qq.com</td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td>13322344747</td>
                          <td>123456@qq.com</td>
                        </tr>
                        <tr>
                          <td>6</td>
                          <td>13333334747</td>
                          <td>123456@qq.com</td>
                        </tr>
                    </tbody>
                </table>
        </div>
      </div>
  </div>
    </body>
</html>
