<?php
    // echo '<pre>';
    // print_r($instance);
?>
<div class="social-widget-description clr">
    <?= !empty($instance['content']) 
                ? $instance['content'] 
                : 'Feel like getting on touch or staying upto date with out latest news and updates?' 
    ?>
</div>
<ul class="clr color flat">
    <?php
    if (!empty($instance['twitter'])) { ?>
        <li class="twitter">
            <a href="<?=$instance['twitter']?>" title="Twitter" target="_blank">
                <span class="fa fa-twitter"></span>
            </a>
        </li>
    <?php } ?>

    <?php
    if (!empty($instance['facebook'])) { ?>
        <li class="facebook">
            <a href="<?=$instance['twitter']?>" title="Facebook" target="_blank">
                <span class="fa fa-facebook"></span>
            </a>
        </li>
    <?php } ?>

    <?php
    if (!empty($instance['google'])) { ?>
        <li class="google-plus">
            <a href="<?=$instance['twitter']?>" title="Google+" target="_blank">
                <span class="fa fa-google-plus"></span>
            </a>
        </li>
    <?php } ?>

    <?php
        if (!empty($instance['dribbble'])) { ?>
        <li class="dribbble">
            <a href="<?=$instance['twitter']?>" title="Dribbble" target="_blank">
                <span class="fa fa-dribbble"></span>
            </a>
        </li>
    <?php } ?>

    <?php
    if (!empty($instance['rss'])) { ?>
        <li class="rss">
            <a href="<?=$instance['twitter']?>" title="RSS" target="_blank">
                <span class="fa fa-rss"></span>
            </a>
        </li>
    <?php } ?>

</ul>