<?php

// app/Models/Orders.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'status',
        'payment_method',
    ];

    // Quan hệ một-nhiều với OrderItems
    public function items()
    {
        return $this->hasMany(OrderItems::class, 'order_id'); // Chú ý tham chiếu đúng cột 'order_id'
    }

    // Quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function products()
{
    return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id')
                ->withPivot('quantity', 'price')
                ->withTimestamps();
}
}
