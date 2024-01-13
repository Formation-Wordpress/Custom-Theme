<div class="tagcloud">
    <?php
    if (count($tags_by_getTags) > 0) {
        foreach ($tags_by_getTags as $tag) {
            echo "<a href='".get_tag_link($tag)."' title='".$tag->name."'>".$tag->name."</a>";


            // <a href='#' title='7 topics'>Adrenaline</a>
            // <a href='#' title='11 topics'>Adventure</a>
            // <a href='#' title='6 topics'>Artistic</a>
            // <a href='#' title='9 topics'>Beautiful</a>
            // <a href='#' title='6 topics'>Classic</a>
            // <a href='#' title='5 topics'>Creative</a>
            // <a href='#' title='5 topics'>Diet</a>
            // <a href='#' title='1 topic'>Forest</a>
            // <a href='#' title='2 topics'>Japan</a>
            // <a href='#' title='8 topics'>Modern</a>
            // <a href='#' title='2 topics'>Mountain</a>
            // <a href='#' title='7 topics'>Perspective</a>
            // <a href='#' title='5 topics'>Photography</a>
            // <a href='#' title='14 topics'>Thoughts</a>
            // <a href='#' title='8 topics'>Tips</a>
            // <a href='#' title='6 topics'>Vintage</a>
        }
    }
    ?>

</div>