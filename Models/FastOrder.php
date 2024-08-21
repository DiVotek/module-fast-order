<?php

namespace Modules\FastOrder\Models;

use App\Traits\HasStatus;
use App\Traits\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FastOrder extends Model
{
    use HasFactory;
    use HasTimestamps;
    use SoftDeletes;

    protected $fillable = ['name', 'phone', 'product_id', 'status'];

    public static function getDb(): string
    {
        return 'fast_orders';
    }

    public const OFF = 0;

    public const ON = 1;

    public const STATUSES = [
        self::ON => 'Viewed',
        self::OFF => 'Not viewed',
    ];
}
