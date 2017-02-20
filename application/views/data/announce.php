

	<div class="score_back">
		<div class="score_div">
			<div class="row">
				<div>
					<h2><?php if(isset($title))
					echo $title ?></h2>
					<!-- <p><?php echo $subtitle ?></p> -->

					<br><?php
					if(isset($score))
					echo $score ?><br>
					<button class="score-ok"><a href="<?php echo base_url() ?>data/upload">OK</a></button>
				</div>
			</div>
		</div>
	</div>
