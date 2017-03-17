

<?php echo form_open_multipart('./question_bank/admin');?>

<!-- <?php echo $error;?> -->

<br /><br />
<nav class="navbar navbar-default">
    <div class="container-fluid">
      <div id="navbar" class="navbar-collapse collapse">
      	<ul class="nav navbar-nav navbar-left">
      		<li><input type="file" name="userfile" size="20"  class="button  button-action button-rounded button-small"/></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><input type="submit" value="上传题库"  class="button  button-action button-rounded button-small"/></li>
          <li><a href="<?php echo base_url()?>question_bank/export"  class="button  button-action button-rounded button-small">导出成绩 </a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
<hr/>
<p align="right">目前参与考试总人数:<font size="3" color="red"><?php echo $num;?></font></p>
<div class="column-chart">
    <ul class="plot-container">
        50分以下<li data-cp-size="<?php echo round(100*$score[0]/($score[0]+$score[1]+$score[2]+$score[3]+$score[4]+$score[5])); ?>"><?php echo round(100*$score[0]/($score[0]+$score[1]+$score[2]+$score[3]+$score[4]+$score[5])); ?>%</li>
        50-60<li data-cp-size="<?php echo round(100*$score[1]/($score[0]+$score[1]+$score[2]+$score[3]+$score[4]+$score[5])); ?>"><?php echo round(100*$score[1]/($score[0]+$score[1]+$score[2]+$score[3]+$score[4]+$score[5])); ?>%</li>
        60-70<li data-cp-size="<?php echo round(100*$score[2]/($score[0]+$score[1]+$score[2]+$score[3]+$score[4]+$score[5])); ?>"><?php echo round(100*$score[2]/($score[0]+$score[1]+$score[2]+$score[3]+$score[4]+$score[5])); ?>%</li>
        70-80<li data-cp-size="<?php echo round(100*$score[3]/($score[0]+$score[1]+$score[2]+$score[3]+$score[4]+$score[5])); ?>"><?php echo round(100*$score[3]/($score[0]+$score[1]+$score[2]+$score[3]+$score[4]+$score[5])); ?>%</li>
        80-90<li data-cp-size="<?php echo round(100*$score[4]/($score[0]+$score[1]+$score[2]+$score[3]+$score[4]+$score[5])); ?>"><?php echo round(100*$score[4]/($score[0]+$score[1]+$score[2]+$score[3]+$score[4]+$score[5])); ?>%</li>
        90-100<li data-cp-size="<?php echo round(100*$score[5]/($score[0]+$score[1]+$score[2]+$score[3]+$score[4]+$score[5])); ?>"><?php echo round(100*$score[5]/($score[0]+$score[1]+$score[2]+$score[3]+$score[4]+$score[5])); ?>%</li>
    </ul>
</div>
<!-- <section style="margin-top: 20px">
  <p align="right">目前参与考试总人数:<?php echo $num;?></p>
	<table class="table table-bordered">
	<title>已考试人员得分情况</title>
		<thead>
			<tr>
				<td>姓名</td>
				<td>易班id</td>
				<td>得分</td>
			</tr>
		</thead>
		<?php
		foreach ($score as $value)
		{
			echo "<tbody>";
				echo "<tr>";
						echo "<td>".$value['name'] ."</td>";
						echo "<td>".$value['yb_userid'] ."</td>";
						echo "<td>".$value['score'] ."</td>";
				echo "</tr>";
			echo "</tbody>";
		}
		?>
	</table>
</section> -->
</nav>
</nav>
</form>
