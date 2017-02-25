
	<div class="header">
		<img id="image-hh"  src="<?php echo base_url(); ?>images/duty/hh.png"/>
	</div>
	<div class="content">
		<div class="content-left">
			<div class="content-left-top">
				<a class="show-layer" onclick="False()" data-show-layer="hw-layer" role="button">
					<img id="image-tuan"  src="<?php echo base_url(); ?>images/duty/tuan.png" onclick="False()" />
				</a>
			</div>
			<div class="hw-overlay" id="hw-layer">
				<div class="hw-layer-wrap">
					<button type="button" class="close hwLayer-close" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<div class="row">
						<div class="images-icon"></div>
						<div class="content-left-foot">
							<ul>
								<li><a href="#"><div class="mulu">抢班</div></a></li>
								<li><a href="#"><div class="mulu">签到</div></a></li>
								<li><a href="#"><div class="mulu">通讯录</div></a></li>
								<li><a href="#"><div class="mulu">个人信息</div></a></li>
								<li><a href="#"><div class="mulu">值班统计</div></a></li>
								<li><a href="#"><div class="mulu">退班申请</div></a></li>
								<li><a href="#"><div class="mulu">交流论坛</div></a></li>
								<li><a href="#"><div class="mulu">行政排班</div></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="content-left-time">
				<dl>
					<dd>&nbsp;8:00 10:00</dd>
					<dd>10:00 12:00</dd>
					<dd>12:00 14:00</dd>
					<dd>14:00 16:00</dd>
					<dd>16:00 18:00</dd>
					<dd>18:00 21:00</dd>
				</dl>
			</div>
		</div>
		<div class="content-right">
			<div class="content-right-top">
				<img id="image-week"  src="<?php echo base_url(); ?>images/duty/week.png" />
			</div>
			<div class="content-right-foot">
				<?php
				echo '<div class="baoban">';
				$num = 1;
				$index = array('1' => 'monday',
			 								'2'  => 'Tuesday',
											'3'  => 'Wednesday',
											'4'  => 'Thursday',
											'5'  => 'Friday',
											'6'  => 'Saturday',
											'7'  => 'Sunday');
				foreach ($data['first'] as $key => $value) {
					// var_dump($num++);
					echo "<p class='choice' onclick="."select"."('".$index[$num++]."',1)><span>$value</span></p>";
				}
				echo '</div>';
				echo '<div class="baoban">';$num = 1;
				foreach ($data['second'] as $key => $value) {
					// var_dump($value);
					echo "<p class='choice' onclick="."select"."('".$index[$num++]."',2)><span>$value</span></p>";
				}
				echo '</div>';
				echo '<div class="baoban">';$num = 1;
				foreach ($data['third'] as $key => $value) {
					// var_dump($value);
					echo "<p class='choice' onclick="."select"."('".$index[$num++]."',3)><span>$value</span></p>";
				}
				echo '</div>';
				echo '<div class="baoban">';$num = 1;
				foreach ($data['forth'] as $key => $value) {
					// var_dump($value);
					echo "<p class='choice' onclick="."select"."('".$index[$num++]."',4)><span>$value</span></p>";
				}
				echo '</div>';
				echo '<div class="baoban">';$num = 1;
				foreach ($data['fifth'] as $key => $value) {
					// var_dump($value);
					echo "<p class='choice' onclick="."select"."('".$index[$num++]."',5)><span>$value</span></p>";
				}
				echo '</div>';
				echo '<div class="baoban">';$num = 1;
				foreach ($data['sixth'] as $key => $value) {
					// var_dump($value);
					echo "<p class='choice' onclick="."select"."('".$index[$num++]."',6)><span>$value</span></p>";
				}
				echo '</div>';
				?>
			</div>

		</div>
	</div>
	<div class="foot">
		<div class="foot-left">
			<p id="tongzhi">注意通知：</p>
		</div>
		<div class="foot-right">
			<p id="zhuyi">每天分为六个班次，每次值班时间为2~3小时,每次报班人数最多三人。寒暑假及特殊周期值班时按学校易班领导小组统一决定。</p>
		</div>
	</div>
