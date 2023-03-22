<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    // protected $table =  'cms_products_manufacture';     // trường hợp tên table đặt tên khác với tên Models (insert file SQL vào)
    
    // protected $fillable = [             // khai báo trường nào thì cho trường đó sử dụng        
    //     'parent_id',
    //     'name',
    //     'slug',
    //     'meta_title',
    //     'meta_keyword',
    //     'meta_description',
    // ];

    // protected $guarded = ['id'];            // $guarded  đối ngược với fillable là khai báo trường nào thì khoá trường đó lại => thường hay sử dụng        
        
    // public $timestamps = false;         // Nếu không thêm 2 trường create_at và update_date (báo lỗi)
}
