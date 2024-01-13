
<aside id="secondary" class="sidebar-container" role="complementary">
    <div class="sidebar-inner">
        <div class="widget-area">

            <?php 
                if (is_active_sidebar('primary_widget_area')) {
                    dynamic_sidebar('primary_widget_area');
                }
            ?>

        </div>
    </div>
</aside>