<form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url( '/' ); ?>">
    <div>
        <label for="s" class="screen-reader-text visually-hidden"><?php _e('Search for:','bonestheme'); ?></label>
        <input type="search" id="s" name="s" value="" placeholder="Search COBE" style="width: auto;" />

        <button type="submit" id="searchsubmit" ><?php _e('Search','bonestheme'); ?></button>
    </div>
</form>