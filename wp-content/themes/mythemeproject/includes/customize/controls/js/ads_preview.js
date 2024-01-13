
/************************************************************************************************
 * Top Banner Ads
************************************************************************************************/

// top Ads banner class= '.header-ad img', name="MyThemeProject_Theme_Ads[top_banner]"
wp.customize('MyThemeProject_Theme_Ads[top_banner]', function(value){
    value.bind(function(newValue){
        document.querySelector('.header-ad img').setAttribute('src', newValue);
    });
});

// top Ads banner link class= '.header-ad a', name="MyThemeProject_Theme_Ads[top_banner_link]"
wp.customize('MyThemeProject_Theme_Ads[top_banner_link]', function(value){
    value.bind(function(newValue){
        document.querySelector('.header-ad a').setAttribute('href', newValue);
    });
});

/************************************************************************************************
 * Content Banner Ads
************************************************************************************************/

// top Ads banner class= '.home-bottom-ad img', name="MyThemeProject_Theme_Ads[content_banner]"
wp.customize('MyThemeProject_Theme_Ads[content_banner]', function(value){
    value.bind(function(newValue){
        document.querySelector('.home-bottom-ad img').setAttribute('src', newValue);
    });
});

// top Ads banner link class= '.home-bottom-ad a', name="MyThemeProject_Theme_Ads[content_banner_link]"
wp.customize('MyThemeProject_Theme_Ads[content_banner_link]', function(value){
    value.bind(function(newValue){
        // console.log(newValue)
        document.querySelector('.home-bottom-ad a').setAttribute('href', newValue);
    });
});


/************************************************************************************************
 * Footer Banner Ads
************************************************************************************************/

// top Ads banner class= '.widget_text img', name="MyThemeProject_Theme_Ads[footer_banner]"
wp.customize('MyThemeProject_Theme_Ads[footer_banner]', function(value){
    // console.log(value)
    value.bind(function(newValue){
        // console.log(newValue)
        document.querySelector('.widget_text img').setAttribute('src', newValue);
    });
});

// top Ads banner link class= '.widget_text a', name="MyThemeProject_Theme_Ads[footer_banner_link]"
wp.customize('MyThemeProject_Theme_Ads[footer_banner_link]', function(value){
    value.bind(function(newValue){
        // console.log(newValue)
        document.querySelector('.widget_text a').setAttribute('href', newValue);
    });
});

/************************************************************************************************
 * Banner Ads in Post
************************************************************************************************/

// top Ads banner class= '.post-top-ad img', name="MyThemeProject_Theme_Ads[post_banner]"
if (document.querySelector('.post-top-ad') != 'null') {
    wp.customize('MyThemeProject_Theme_Ads[post_banner]', function(value){
        // console.log(document.querySelector('.post-top-ad'))
        value.bind(function(newValue){
            // console.log(newValue);
            document.querySelector('.post-top-ad img').setAttribute('src', newValue);            
        });
    });
    
    // top Ads banner link class= '.post-top-ad a', name="MyThemeProject_Theme_Ads[post_banner_link]"
    wp.customize('MyThemeProject_Theme_Ads[post_banner_link]', function(value){
        value.bind(function(newValue){
            // console.log(newValue);
            document.querySelector('.post-top-ad a').setAttribute('href', newValue);
        });
    });
}


/************************************************************************************************
 * Bottom Banner Ads in Post
************************************************************************************************/

// top Ads banner class= '.post-bottom-ad img', name="MyThemeProject_Theme_Ads[bottom_post_banner]"
if (document.querySelector('.post-bottom-ad') != 'null') {
    wp.customize('MyThemeProject_Theme_Ads[bottom_post_banner]', function(value){
        value.bind(function(newValue){
            // console.log(newValue);
            document.querySelector('.post-bottom-ad img').setAttribute('src', newValue);            
        });
    });
    
    // top Ads banner link class= '.post-bottom-ad a', name="MyThemeProject_Theme_Ads[bottom_post_banner_link]"
    wp.customize('MyThemeProject_Theme_Ads[bottom_post_banner_link]', function(value){
        value.bind(function(newValue){
            // console.log(newValue);
            document.querySelector('.post-bottom-ad a').setAttribute('href', newValue);
        });
    });
}


