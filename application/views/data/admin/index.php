
<section style="margin-top: 20px">
<form action="<?php echo base_url();?>data/admin/add" method = "post">
	<table align="center" class="table table-bordered">
		<th>易班id</th>
		<th>用户名</th>
		<th>权限</th>
		<th>动作</th>
		<tr align="center">
			<td><input type="text" name="yb_userid"/></td>
			<td><input type="text" name="yb_username"/></td>
			<td><input type="text" name="privilege"/></td>
			<td><button class="button  button-action button-rounded button-small">添加管理员</button></td>
		</tr>
	</table>
</form>
<table class="table table-bordered">
	<th>原文件名</th>
	<th>目的文件名</th>
	<th>权限</th>
	<th>动作</th>
	<tr>
		<td><input type="text" name="filename" id="filename" value="原文件名" onfocus="document.getElementById('filename').value=''"/></td>
		<td><input type="text" name="old_filename" id="edited_filename" value="目的文件名" onfocus="document.getElementById('edited_filename').value=''"/></td>
		<td><input type="text" name="privilege"value="别碰我，我怕疼" disabled/></td>
		<td><a class="button  button-action button-rounded button-small" onclick=updatefilename(document.getElementById('edited_filename').value,document.getElementById('filename').value)>修改文件名</button></td>
	</tr>
</table>

<section style="margin-top: 20px">
<table align="center" class="table table-bordered">
	<th>易班id</th>
	<th>用户名</th>
	<th>权限</th>
	<th>更改权限</th>
	<th>删除管理</th>
	<?php
		// print_r($managers);
		foreach ($managers as $tmp) {
			echo "<tr align='center'>";
			echo "<td>".$tmp['yb_userid']."</td>";
			echo "<td>".$tmp['yb_username']."</td>";
			echo "<td id = privilege".$tmp['yb_userid'].">".$tmp['privilege']."</td></a>";
			echo "<td><button class='button  button-action button-rounded button-small' onclick = update(".$tmp['yb_userid'].")>设为超级管理员</button></td>";
			echo "<td id = delete".$tmp['yb_userid']."><button class='button  button-action button-rounded button-small' onclick = delete_id(".$tmp['yb_userid'].")>删除</button></td>";
			echo "</tr>";
		}
	?>
</table>


</section>
