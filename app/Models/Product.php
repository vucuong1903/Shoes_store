<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Các thuộc tính có thể điền
    protected $fillable = [
        'category_id', // Khóa ngoại
        'name',
        'image',
        'size',
        'description',
        'price',
    ];

    // Thiết lập quan hệ với model Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
