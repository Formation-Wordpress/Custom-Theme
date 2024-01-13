<?php

if (!class_exists('WP_Customize_Control')) {
    return;
}

class WP_Customize_Category_List_Control extends WP_Customize_Control
{
    private $arguments = [];

    public function __construct($manager, $id, $args = [])
    {
        parent::__construct($manager, $id, $args);
        $this->arguments = $args;
        // echo '<pre>';
        // print_r($args);
    }

    public function render_content()
    {
        // get the arguments of the class
        $args = $this->arguments;

        // get the selected values => setup the 'selected'
        $values = is_array($this->value()) ? $this->value() : [$this->value()];
        // $this->value();      // tra ve Array. neu ko phai multiple thi return 1 so integer
        // echo '<pre>';
        // print_r($values);

        // get all categories and setup the options
        $categories = get_categories();
        // $optionStr = '<option value="0" selected="selected">--Select--</option>';
        $optionStr = '';
        if (count($categories) > 0) {
            foreach ($categories as $category) {
                $selected = '';
                if (in_array($category->cat_ID, $values)) {
                    $selected = ' selected="selected"';
                }
                $optionStr .= '<option value="'.$category->cat_ID.'"'.$selected.'>'.$category->name.'</option>';                
            }
        }

        // set 'id' and 'for' of <select> and <label> tags
        $selectID = !empty($args['settings']) ? $args['settings'] : '_customize-input-'.__CLASS__;

        // handle 'multiple'
        if (!empty($args['multiple']) && $args['multiple'] == true) {
            $multiple = ' multiple="multiple"';
        } else {
            $multiple = '';
        }

        // handle 'size'
        if (!empty($args['size']) && $args['size'] > 1) {
            $size = ' size="'.$args['size'].'"';
            $style = ' style="height:auto"';    // css da co roi, nen co hay ko cung dc
        } else {
            $size = '';
            $style = '';    // css da co roi, nen co hay ko cung dc
        }

        // handle label
        $label = !empty($this->label)
                            ? '<label for="'.$selectID.'" class="customize-control-title">'.$this->label.'</label>'
                            : '';

        // handle 'description'
        $description = !empty($this->description)
                            ? '<span class="description customize-control-description">'.$this->description.'</span>'
                            : '';
        
        echo $label 
            . $description 
            . '<select id="'.$selectID.'"'.$this->get_link() . $size . $style . $multiple .'>'
            . $optionStr
            . '</select>';
    }
}


// <label class="customize-control-title">Select Category</label>

// <span class="description customize-control-description">Select the category</span>

// <select id="_customize-input-MyThemeProject_Theme_General_dropdown_select_Category" 
        // aria-describedby="_customize-description-MyThemeProject_Theme_General_dropdown_select_Category" 
        // data-customize-setting-link="MyThemeProject_Theme_General[dropdown_select_Category]">
// 					<option value="0" selected="selected">--Select--</option>
                // <option value="33">Asia</option>
                // <option value="16">Category 1.1.1</option>
                // <option value="43">Travel</option>
                // <option value="1">Uncategorized</option>				
                // </select>