
<?php // Search Form in Front Page of Theme ?>

<form method="get" id="searchform" class="site-searchform" action="<?=get_site_url()?>" role="search">
    <input type="search" class="field" name="s" value="" id="s" placeholder="Search...">
    <button type="submit">
        <span class="fa fa-search"></span>
    </button>
</form>



<?php  
/*
Search Form o Front Page do Widget he thong lam ra

<form role="search" method="get" action="http://wordpress_project.test/" 
        class="wp-block-search__button-outside wp-block-search__text-button wp-block-search">
    <label class="wp-block-search__label" for="wp-block-search__input-1">Search</label>
    <div class="wp-block-search__inside-wrapper ">
        <input class="wp-block-search__input" id="wp-block-search__input-1" 
                placeholder="" value="" type="search" name="s" required="">
        <button aria-label="Search" class="wp-block-search__button wp-element-button" type="submit">Search</button>
    </div>
</form>

*/
?>