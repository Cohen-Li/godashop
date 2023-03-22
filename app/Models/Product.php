<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\returnSelf;

class Product extends Model
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

    // relationship 1 1 with Category
    public function category()
    { 
        return $this->belongsTo(Category::class);         
    }

    // relationship 1 N with attachment with type Morph
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    // relationship 1 N with attachment with type Morph
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    // get Feature Product

    public function scopeIsFeature($query)
    {
        $query->where('is_feature', true);
    }

    // get slug

    public function getSlugUrlAttribute()
    {
        return $this->slug . '-product-' . $this->id . '.html';
    }

    // get price

    public function getPriceLabelAttribute()                // đặt tên hàm phải đúng chuẩn
    {
        return number_format($this->price) . 'đ';
    }

    // get sale price

    public function getPriceSaleLabelAttribute()            // đặt tên hàm phải đúng chuẩn
    {
        return number_format($this->sale_price) . 'đ';
    }

    // get image

    public function getFeatureImageAttribute()
    {
        if ($this->attachments->count() === 0 ) {
            return './img/frontend/beaumoreSecretWhiteningCream10g.jpg';
        }
        return $this->attachments->first()->file_name;
    }
}
