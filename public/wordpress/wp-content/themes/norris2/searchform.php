<div class="searchform">
	<form role="search" method="get" class="" action="<?php echo home_url();?>">
		<div class="searchdiv">
			<input type="text" value="<?php echo get_search_query();?>" name="s" class="s" />
			<button type="submit" class="submit" title="<?php _e('Search','wi');?>"><i class="icon-search"></i></button>
		</div><!-- .searchdiv -->
	</form>
</div><!-- .searchform -->