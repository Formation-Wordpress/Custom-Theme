<?php

class MyThemeProject_Image_Support
{
        public function handleImage($post_content, $post, $width, $height)
        {
            $imageUrl = '';
            $defaultUrl = THEME_DEFAULT_IMAGE_DIRECTORY_URL;
            $postImage_url = $this->getImageUrl($post_content);

            $imageUrl = has_post_thumbnail($post) ? get_the_post_thumbnail_url($post) : $postImage_url;

            // only resize images of this siteweb, not link from other sites
            $siteUrl = home_url();
            if (str_contains($imageUrl, $siteUrl)) {
                
                $imageSize = getimagesize($imageUrl);
                // width = $imageSize[0]; height = $imageSize[1];
                if ($imageSize[0] > $width && $imageSize[1] > $height) {
                    $imageUrl = $this->get_new_img_url($imageUrl, $width, $height);
                }
            }
            return !empty($imageUrl) ? $imageUrl : $defaultUrl;
        }

        // get the image url inside the post's content
        public function getImageUrl($post_content = '')
        {
            $pattern = '/<img.*?src=[\'"](.*?)[\'"].*?\/>/i';        /* '|<img.*?src=[\'"](.*?)[\'"].*?>|i'  */
    
            if (!empty($post_content)) {
                preg_match_all( $pattern, $post_content, $matches );
            }
            // return $matches;
            if ( !empty($matches[1][0]) ) return $matches[1][0];
            
            return THEME_DEFAULT_IMAGE_DIRECTORY_URL;
                    // image mac dinh
        }
    
        // resize lai image
        // https://developer.wordpress.org/reference/functions/wp_get_image_editor/
        public function get_new_img_url($imgUrl, $width = 0, $height = 0 ,	$suffixes = '-mythemeproject-slider-')
        {
            $suffixes = $suffixes . $width . 'x'. $height;
        
            //Lay ten tap tin hinh anh hien tai
            preg_match("/[^\/|\\\]+$/", $imgUrl, $currentName);
            $currentName = $currentName[0];
        
            //Tạo tên mới cho hình ảnh dựa trên tên cũ
            $tmpFileName = explode('.', $currentName);
            $newFileName = $tmpFileName[0] . $suffixes . '.' . $tmpFileName[1];
        
            //Chuyển từ đường dẫn URL sang PATH
            $tmp 	= explode('/wp-content/', $imgUrl);
            $imgDir = ABSPATH.'wp-content/' . $tmp[1];
        
            $newImgDir = str_replace($currentName, $newFileName, $imgDir);
            // echo '<br>' . $newImgDir;
    
            if(!file_exists($newImgDir)){			
                $wpImageEditor =  wp_get_image_editor( $imgDir);    // dua file goc vao editor duoi ten file trung gian
                if ( ! is_wp_error( $wpImageEditor ) ) {
                    $wpImageEditor->resize($width, $height, array('center','center'));   // resize file trung gian
                    $wpImageEditor->save( $newImgDir);              // luu lai duoi ten file newImage (path = newImgDir)
                }
            }
            
            $newImgUrl= str_replace($currentName, $newFileName, $imgUrl);
            return $newImgUrl;
        }
}