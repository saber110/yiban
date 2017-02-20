
  <div class="jumbotron">
    <h1>出错了</h1>
    <br/>
    <p class="lead">程序出错了,以下是出错原因:</p>
    <p class="lead" th:text="${reason}">未知错误</p>
    <a class="btn btn-danger" href="javascript:history.go(-1);">返回</a>
  </div>

