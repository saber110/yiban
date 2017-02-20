

	<div class="score_back">
		<div class="score_div">
			<div class="row">
				<div>
					<h2><?php if(isset($title))
					echo $title ?></h2>
					<h5><?php if(isset($subtitle))
					echo $subtitle ?></h5>
					<!-- <p><?php echo $subtitle ?></p> -->

					<br><?php
					if(isset($score))
					echo $score ?><br>
					<a href="<?php echo base_url('question_bank') ?>" class="score-ok">OK</a>
					<br /><br/>
					<h6><?php if(isset($remark))
					echo $remark ?></h6>
				</div>
			</div>
		</div>
	</div>
