<?php
use App\Models\categories;



function get_category()
{
    return categories::orderBy('id','ASC')
                    ->with('sub_category')
                    ->where('status','=','1')
                    ->get();
}
?>