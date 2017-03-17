

<?php echo form_open_multipart('./data/upload');?>
<nav class="navbar navbar-default">
  <p> REMARK :<?php echo $error;?></p>
  <table border="0">
    <tr>
      <td>
		      <input type="file" name="userfile" size="20" class="button  button-action button-rounded button-small"/>
      </td>
      <td>
          <button class="button  button-action button-rounded button-small">上传资料</button>
      </td>
    </tr>
  </table>
</form>
