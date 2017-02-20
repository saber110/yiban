
	<form action = "<?php echo base_url();?>data/search" method = "post" name = "search">
		<div>
			<p align="right">
				<input type = "text" name = "search" id = "search" style="height: 34px;
				  width: 65%;
				  border-radius: 10px;
				  border: 5px solid transparent;
				  border-top: none;
				  border-bottom: 2px solid #DDD;
				  box-shadow: inset 0 2px 2px rgba(0,0,0,.39), 0 -1px 1px #FFF, 0 5px 0 #FFF;" value="易班" onfocus="document.getElementById('search').value=''" />
				<button  class="button  button-action button-rounded button-small"> search</button>
			</p>
		</div>
	</form>
<section style="margin-top: 20px">
	<table align="center" class="table table-bordered">		
			<th>YiBanid</th>
			<th>UserName</th>
			<th>FileName</th>
	<?php

	// print_r($lists);
	foreach ($lists as $tmp) {
		echo "<tr align='center'>";
		echo "<td>".$tmp['yb_userid']."</td>";
		echo "<td>".$tmp['yb_username']."</td>";
		echo "<td><a href=".base_url()."data/view/".$tmp['uuid']."  target='view_window'>".$tmp['title']."</a></td>";
	}
	?>
	</table>

</section>
	<div>
		<form name="gotopage" action="<?php echo base_url();?>data/index" method = "post">
			<p  align="right">
				<input type="text" name="page" id = "page" style="height: 34px;
				  width: 70%;
				  border-radius: 10px;
				  border: 5px solid transparent;
				  border-top: none;
				  border-bottom: 2px solid #DDD;
				  box-shadow: inset 0 2px 2px rgba(0,0,0,.39), 0 -1px 1px #FFF, 0 5px 0 #FFF;" value ="5" onfocus="document.getElementById('page').value=''">
				  <button class="button  button-action button-rounded button-small" >go</button>
			</p>
		</form>
	</div>
	<div align="center">
		<?php
		if(isset($pages))
		echo($pages);
		?>
	</div>


