<?php

class MyThemeProject_Content_Support
{
    // get the excerpt
    public function getExcerpt($post_excerpt = '', $charNum = 40)
    {
        if (!empty($post_excerpt)) {
            if (strlen($post_excerpt) > ($charNum + 10)) {
                $end_word = strpos($post_excerpt, ' ', $charNum);
                if (!empty($end_word)) return substr($post_excerpt, 0, $end_word) . '...';
            }
            else return $post_excerpt;            
        }
        return ' ...';
    }

    // get the first image inside the content of the post
    public function getFirstImage($content = '')
    {
        $pattern = '#\<img.*>#imU';
        preg_match($pattern, $content, $matches);
        if (!empty($matches[0])) {
            return $matches[0];
        }
        return '';
    }

    // remove the first image from the content
    public function removeFirstImage($content = '')
    {
        if (!empty($content)) {
			$firstImage = $this->getFirstImage($content);
			if (!empty($firstImage)) {
                $pattern = "#\<figure.*$firstImage.*\</figure>#mUi";
                $content = preg_replace($pattern, '', $content, 1);
			}
		}
        return $content;
    }


    // get the first audio inside the content of the post
    public function getFirstAudio($content = '')
    {
        $pattern = '#\<audio.*\<\/audio\>#imU';
        preg_match($pattern, $content, $matches);
        if (!empty($matches[0])) {
            return $matches[0];
        }
        return '';
    }

    // remove the first audio from the content
    public function removeFirstAudio($content = '')
    {
        if (!empty($content)) {
            $firstAudio = $this->getfirstAudio($content);
            if (!empty($firstAudio)) {
                $pattern = "#\<figure.*$firstAudio.*\</figure>#mUi";
                $content = preg_replace($pattern, '', $content, 1);
            }
        }
        return $content;
    }


    // get the first video inside the content of the post
    public function getFirstVideo($content = '')
    {   
        // echo $content;       // doi voi video : tra ve 1 link ma thoi. sau do filter de tao ra iframe
        // lap pattern lay luon ca the figure ben ngoai
        $externalVideo_pattern = '#\<figure.*wp-block-embed.*is-type-video.*>(\r\n|\r|\n).*\</figure>#miUs';
        preg_match($externalVideo_pattern, $content, $externalVideo);

        $video_pattern = "#\<figure.*\<video.*>\</video>.*\</figure>#miU";
        preg_match($video_pattern, $content, $video);

        if ( !empty($externalVideo[0]) && !empty($video[0]) ) {
            if ( strpos($content, $externalVideo[0]) < strpos($content, $video[0]) ) return $externalVideo[0];
            else return $video[0];
        } else {
            if ( !empty($externalVideo[0]) ) return $externalVideo[0];
            if ( !empty($video[0]) ) return $video[0];
        }

        return '';
    }

    // remove the first audio from the content
    public function removeFirstVideo($content = '')
    {
        if (!empty($content)) {
            $firstVideo = $this->getFirstVideo($content);
            if (!empty($firstVideo)) {
                $content = str_replace($firstVideo, '', $content);
            }
        }
        return $content;
    }

    /***************************************** GALLERY *******************************************************/

    // get the first gallery inside the content of the post
    public function getFirstGallery($content = '')
    {   
        // lap pattern lay ra toan bo phan gallery dau tien ben trong post_content
        $gallery_pattern = '#\<\!-- wp:gallery.*(\r\n|\r|\n).*/wp:gallery -->#misU';
        preg_match($gallery_pattern, $content, $matches);

        if ( !empty($matches[0]) ) return $matches[0];

        return '';
    }

    public function createFirstGalleryHTML($content = '')
    {   
        if ( !empty($content) ) {

            $firstGallery = $this->getFirstGallery($content);

            if ( !empty($firstGallery) ) {
                $ids = $this->getImgLinks($firstGallery);
                $html = $this->createGalleryHTML($ids);
                if ( !empty($html) ) return $html;
            }
        }
        
        return '';
    }

    // get all src links ben trong gallery
    public function getImgLinks($gallery = '')
    {   
        if ( !empty($gallery) ) {
            $links_pattern = '#"id":.*\,"#miUs';
            preg_match_all($links_pattern, $gallery, $matches);
    
            if ( !empty($matches[0]) ) {
                $ids = [];
                foreach ($matches[0] as $id) {
                    $id = str_replace(['"id":', ',"'], ['',''], $id);
                    $ids[] = (int)$id;
                }
                return $ids;
            }
        }

        return [];
    }

    // tao html cho Gallery co array of image ids 
    public function createGalleryHTML($ids = [])
    {   
        $html = '';
        if ( !empty($ids) ) {
            foreach ($ids as $id) {
                $src = wp_get_attachment_url($id);
                $html .= '<div class="owl-item">
                            <div data-dot="<img src=\''. $src. '\' alt=\'\'>">
                                <figure>
                                    <a title="" href="'. $src . '">
                                        <img width="620" height="350" alt="" src="'. $src .'">
                                        <span class="overlay"></span>
                                    </a>
                                </figure>
                            </div>
                        </div>';
            }

            $html = '<div class="single-post-media clr">
                        <div class="post-gallery owl-carousel wpex-gallery-lightbox owl-loaded owl-drag">
                        '. $html .'
                        </div>
                    </div>';
        }

        return $html;
    }

    // remove the first gallery from the content
    public function removeFirstGallery($content = '')
    {
        if (!empty($content)) {
            $firstGallery = $this->getFirstGallery($content);
            if (!empty($firstGallery)) {
                $content = str_replace($firstGallery, '', $content);
            }
        }
        return $content;
    }

    // after remove the first gallery from the content, get all galleries in the post
    public function modifyLeftGalleries($content = '')
    {
        if ( !empty($content) ) {
            // $content = $this->removeFirstGallery($content);

            $gallery_pattern = '#\<\!-- wp:gallery.*(\r\n|\r|\n).*/wp:gallery -->#misU';
            preg_match_all($gallery_pattern, $content, $matches);

            $galleryHTML = [];

            if ( !empty($matches[0]) ) {
                foreach ($matches[0] as $key => $gallery) {
                    $ids = $this->getImgLinks($gallery);
                    $galleryHTML[$key] = $this->createGalleryHTML($ids);

                    $galleryMark = "[PostGallery-$key]";
                    $content = str_replace($gallery, $galleryMark, $content);
                }

                // filter the content sauf gallery
                $content = apply_filters( 'the_content', $content );
                $content = str_replace( ']]>', ']]&gt;', $content );

                // sau khi filter content thi ta thay the gallery carrousel html vao
                foreach ($galleryHTML as $key => $gallery) {
                    $galleryMark = "[PostGallery-$key]";
                    $content = str_replace($galleryMark, $gallery, $content);
                }
            }
        }
                
        return $content;
    }

}





