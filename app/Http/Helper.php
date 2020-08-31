
<?php

if(!function_exists('categories'))
{
    function categories($selected = null, $cat_hide = null)
    {


        $categories = App\Category::all();
        $categories_list = [];
        foreach($categories as $category)
        {
            $list_array = [];
            $list_array['icon'] = '';
            $list_array['li_attr'] = '';
            $list_array['a_attr'] = '';
            $list_array['children'] = '';
            if($selected !== null && $selected == $category->id)
            {

                $list_array['state'] = [
                    'opened' => true,
                    'selected' => true,
                    'disabled' => false,
                ];

            }elseif($cat_hide !== null && $cat_hide == $category->id){

                $list_array['state'] = [
                    'opened' => false,
                    'selected' => false,
                    'disabled' => true,
                    'hidden' => true
                ];
            }
            $list_array['id'] = $category->id;
            $list_array['parent'] = $category->parent_id > 0 ?  $category->parent_id : '#' ;
            $list_array['text'] = $category->title;
            array_push($categories_list, $list_array);
        }

        return json_encode($categories_list,JSON_UNESCAPED_UNICODE);
    }
}

if(!function_exists('get_parent'))
{
    function get_parent($category_id)
    {


        $category = App\Category::findOrfail($category_id);
        if(!empty($category->parent_id) && $category->parent_id > 0)
        {
            // array_push($categories_list, $category->id);
            return get_parent($category->parent_id) . ',' . $category_id;
        }else{
            return $category_id;
        }


        return $categories_list;
    }
}
