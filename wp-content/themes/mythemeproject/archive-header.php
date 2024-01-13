<?php
    if (is_category()) {
        $prefix = translate('Category', 'mythemeproject') . ': ';
        $title = single_cat_title($prefix, false);
    }

    if (is_tag()) {
        $prefix = translate('Tags', 'mythemeproject') . ': ';
        $title = single_tag_title($prefix, false);
    }

    if (is_search()) {
        $prefix = translate('Search Results for', 'mythemeproject') . ': ';
        $title = $prefix . get_search_query();
    }

    if (is_date()) {  // ko dc kiem tra is_archive vi category, tags, ... deu la archive
        $title = translate('Archives for', 'mythemeproject') . ': ' . single_month_title('', false);
    }
?>

<header class="archive-header clr">
    <h1 class="archive-header-title"><?= $title ?></h1>
    <div class="layout-toggle">
        <span class="fa fa-bars"></span> <?php // bieu tuong phan cot ben phai, su dung javascript?>
    </div>
    <!-- .layout-toggle -->
</header>
<!-- .archive-header -->