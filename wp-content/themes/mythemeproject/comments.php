<?php

// kiem tra xem post co bi password khong ?
if (post_password_required() == true) return;

// post phai cho phep comment ?
if ( !comments_open() ) return;

$comments = get_comments_number($post);
switch ($comments) {
    case '0'	: $comment_display = 'There is 0 comment for this article'; break;
    case '1'	: $comment_display = 'There is 1 comment for this article'; break;
    default		: $comment_display = "There are $comments comments for this article"; break;
}
?>

<div class="comments-title"> <?= __($comment_display, 'mythemeproject'); ?> </div>

<div class="comments-inner clr">
    <ol class="commentlist">
        <?php 
            // liet ke toan bo Comments
            $commentArgs = [
                'callback'          => 'mythemeproject_comments',
                // thong so type la string, va bat buoc neu ko la error. Va chi co comment la work thoi !
                'type'              => 'all',   //'all', 'comment, pingback, trackback, pings'. 
            ]; 
            wp_list_comments( $commentArgs );


            // pagination cho comment
                // echo 'Comment pages total: ' . get_comment_pages_count() . '<br>';
                // echo 'Option comment pagination: ' . get_option('page_comments');
            if ( get_comment_pages_count() > 1 && get_option('page_comments') == 1 ) { ?>
            
            <nav class="comment-navigation clr" role="navigation">
                <div class="nav-previous span_1_of_2 col col-1">
                    <?php previous_comments_link(); ?>
                </div>
                <div class="nav-next span_1_of_2 col">
                    <?php next_comments_link(); ?>
                </div>
            </nav>

            <?php
            }


            // hien thi form de reply cho comment
            comment_form(['cancel_reply_link'=>'<i class="fa fa-times"></i>Cancel comment reply']);


        ?>
    </ol>
</div>