@extends('common.app')

@section('content')
<link rel="stylesheet" href="css/schedule.css">
<script src="js/schedule.js"></script>
<div id="search_bar" style="width:100%;height:34px;" >
	<input type="text" class="form-control" placeholder="Filter..." />
</div>
<div id="main_div" style="width:100%; overflow-y: hidden; overflow-x: hidden;">
	<div id="left_top" class="frame_container frame_container_no_scroll"></div>
	<div id="right_top" class="frame_container frame_container_no_scroll">
		<div id="right_top_inner_wrap" style="height:40px;"></div>
	</div>
	<div id="left_bottom" class="frame_container frame_container_no_scroll"></div>
	<div id="right_bottom" class="frame_container" style="overflow: auto;">
		<?php
		/*
		for ($j = 1; $j <= 20; $j++) {
			?>
			<div style="width:2000px;height:100px;">
				<?php
				for ($i = 1; $i <= 20; $i++) {
					?>
					<div class="schedule_box" >
						<?php
						if ($i == 2 && ($j == 3 || $j == 5)) {
							?>
							<div class="dragme" style="width:290px;height:30px;background-color: steelblue;"></div>
							<?php
						}
						?>
					</div>
					<?php
				}
				?>
			</div>
			<?php
		}
		*/
		?>
	</div>
</div>
@endsection
