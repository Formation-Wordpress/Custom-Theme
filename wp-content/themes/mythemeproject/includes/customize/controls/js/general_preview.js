
// console.log(document.querySelector('.customize-section-title'));  tat ca deu tra ve null, ko thay lam dc voi Javascript thong thuong

// if (document.querySelector('#_customize-input-MyThemeProject_Theme_General_date_time') != 'null') {

//     console.log(document.getElementById('_customize-input-MyThemeProject_Theme_General_date_time'))
//     // let dateTimeElement = document.querySelector('#_customize-input-MyThemeProject_Theme_General_date_time');  // => null always
    
// }


/*************************************************************************************************************************/

// khong the su dung Javascript thong thuong o day. Bat buoc su dung ham wp.customize() cua object wp
// wp.customize la 1 ham co san cua wordpress, nam trong tap tin customize-preview(.min.js ?)
// no co 2 tham so: 1 la name cua input (data_link), 2 la function
// value la 1 ham tra ve
wp.customize('MyThemeProject_Theme_General[date_time]', function(value){
    // console.log(value)      // tra ve 1 ham ƒ (){return i.instance.apply(i,arguments)}

    // phuong thuc bind() cua ham value
    value.bind(function(newValue){
        console.log(newValue);  // Chi hien thi newValue khi 'transport'=> 'postMessage', trong add_setting() !!!
                                // neu la 'refresh' thi se ko co gi + message Error
                                // tra ve value cua selectbox : 'yes' hay 'no'
        if (newValue == 'yes') {
            document.querySelector('#topbar-date').style.display = 'block';
        } else {
            document.querySelector('#topbar-date').style.display = 'none';
        }
    });
});


// search-form  id='topbar-search', name="MyThemeProject_Theme_General[search_form]"
wp.customize('MyThemeProject_Theme_General[search_form]', function(value){
    value.bind(function(newValue){
        if (newValue == 'yes') {
            document.querySelector('#topbar-search').style.display = 'block';
        } else {
            document.querySelector('#topbar-search').style.display = 'none';
        }
    });
});


// logo class="site-text-logo"  , name="MyThemeProject_Theme_General[theme_logo]
wp.customize('MyThemeProject_Theme_General[theme_logo]', function(value){
    value.bind(function(newValue){
        document.querySelector('.site-text-logo').innerHTML = newValue;
    });
});


// theme description id="blog-description"  , name="MyThemeProject_Theme_General[theme_description]
wp.customize('MyThemeProject_Theme_General[theme_description]', function(value){
    value.bind(function(newValue){
        document.querySelector('#blog-description').innerHTML = newValue;
    });
});


// theme description text Color id="blog-description"  , name="MyThemeProject_Theme_General[description_color]
wp.customize('MyThemeProject_Theme_General[description_color]', function(value){
    value.bind(function(newValue){
        // console.log('color')
        document.querySelector('#blog-description').style.color = newValue;
    });
});


// copyright id="copyright"  , name="MyThemeProject_Theme_General[copyright]
wp.customize('MyThemeProject_Theme_General[copyright]', function(value){
    value.bind(function(newValue){
        document.querySelector('#copyright').innerHTML = newValue;
    });
});