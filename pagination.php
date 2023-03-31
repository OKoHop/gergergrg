<div class="flex items-center py-8">

	<a class="h-10 w-10 font-semibold text-gray-800 hover:text-gray-900 text-sm flex items-center justify-center mr-3" href="<?php 
		$prevpage = $page - 1;
		if ($page <= 1) {
			echo '#';
		} elseif ($prevpage == 1) {
			echo '/';
		} else {
			echo "?page=".($page - 1);
		} ?>"><i class="fas fa-arrow-left mr-2"></i> Prev
	</a>
	
	<a class="h-10 w-10 font-semibold text-gray-800 hover:text-gray-900 text-sm flex items-center justify-center ml-3 <?php if ($page >= $total_pages) {
		echo 'disabled';
		} ?>"
		href="<?php if ($page >= $total_pages) {
		echo '#';
		} else {
		echo "?page=".($page + 1);
		} ?>">Next <i class="fas fa-arrow-right ml-2"></i>
	</a>
	
</div>