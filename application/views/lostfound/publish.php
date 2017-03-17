<section class="container">
    <div class="post">
        <article class="post-block">
            <h1 class="post-title">发布</h1>
            <!-- <div class="post-info">时间</div> -->
            <div class="post-content">
<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 
<!--Font Awesome (added because you use icons in your prepend/append)-->
<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="{base_url()}plugin/fex-team-webuploader/dist/webuploader.css">
    <!-- <link rel="stylesheet" type="text/css" href="../../css/webuploader.css" /> -->
    <link rel="stylesheet" type="text/css" href="{base_url()}plugin/fex-team-webuploader/examples/image-upload/style.css" />


<!-- Inline CSS based on choices in "Settings" tab -->
{literal}
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: #000000}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: #ffffff !important;} .asteriskField{color: red;}</style>
{/literal}

<!-- HTML Form (wrapped in a .bootstrap-iso div) -->
<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-12 col-sm-6 col-xs-12">
    <form action="{base_url()}LostFound/publish" method="post" enctype="multipart/form-data">
    <div class="form-group ">
      <label class="control-label " for="lf_title">
       标题
      </label>
      <input class="form-control" id="lf_title" name="lf_title" type="text"/>
      <input name="lf_type" type="radio" value="1" checked/>找物品
      <input name="lf_type" type="radio" value="2"/>找失主
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="lf_detail">
       详情
       <span class="asteriskField">
        *
       </span>
      </label>
      <textarea class="form-control" cols="40" id="lf_detail" name="lf_detail" rows="10"></textarea>
     </div>
     <div class="form-group ">
      <label class="control-label" for="lf_upload">
       上传图片
      </label>
        <div id="uploader">
                <div class="queueList">
                    <div id="dndArea" class="placeholder">
                        <div id="filePicker"></div>
                        <p>或将图片拖到这里，单次最多可选300张</p>
                    </div>
                </div>
                <div class="statusBar" style="display:none;">
                    <div class="progress">
                        <span class="text">0%</span>
                        <span class="percentage"></span>
                    </div><div class="info"></div>
                    <div class="btns">
                        <div id="filePicker2"></div><div class="uploadBtn">开始上传</div>
                    </div>
                </div>
            </div>
     </div>
     <div class="form-group ">
      <label class="control-label " for="lf_name">
       姓名
      </label>
      <input class="form-control" id="lf_name" name="lf_name" type="text" value="{$user_info.yb_username|default:'谁啊这是'}" />
      <input name="lf_anonymous" type="checkbox" value="TRUE"/>
        匿名发布
     </div>

     <div class="form-group ">
      <label class="control-label requiredField" for="lf_contact">
       联系电话
       <span class="asteriskField">
        *
       </span>
      </label>
      <div class="input-group">
       <div class="input-group-addon">
        <i class="fa fa-phone">
        </i>
       </div>
       <input class="form-control" id="lf_contact" name="lf_contact" type="text"/>
      </div>
     </div>
    <div class="form-group ">
      <label class="control-label " for="lf_address">
       联系地址
      </label>
      <div class="input-group">
       <div class="input-group-addon">
        <i class="fa fa-building-o">
        </i>
       </div>
       <input class="form-control" id="lf_address" name="lf_address" placeholder="请输入您的详细联系地址（可不填）" type="text"/>
      </div>
     </div>
     <div class="form-group">
      <div>
       <button class="btn btn-success " type="submit">
        发布
       </button>
      </div>
     </div>
    </form>
   </div>
  </div>
 </div>
</div>

            </div>
        </article>
    </div>
</section>

<script type="text/javascript" src="{base_url()}plugin/fex-team-webuploader/examples/image-upload/jquery.js"></script>
<script type="text/javascript" src="{base_url()}plugin/fex-team-webuploader/dist/webuploader.js"></script>
    <script type="text/javascript" src="{base_url()}plugin/fex-team-webuploader/examples/image-upload/upload.js"></script>
