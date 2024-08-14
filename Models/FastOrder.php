<?php

namespace Modules\FastOrder\Models;

use App\Traits\HasStatus;
use App\Traits\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FastOrder extends Model
{
    use HasFactory;
    use HasStatus;
    use HasTimestamps;

    protected $fillable = ['name', 'phone', 'product_id', 'status'];

    public static function getDb(): string
    {
        return 'fast_orders';
    }
}
