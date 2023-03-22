<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
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

    const STATUS = [
        'created' => 1,
        'in-progress' => 2,
        'delivering' => 3,
        'delivered' => 4,
        'canceled' => 5,
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class);         // relationship  1-1 with Customer
    }

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);         // relationship 1-N with OrderDetail
    }
}
