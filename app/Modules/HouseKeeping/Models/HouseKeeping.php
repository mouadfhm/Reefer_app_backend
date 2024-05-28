<?php

namespace App\Modules\HouseKeeping\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Modules\Reefer\Models\Reefer;


class HouseKeeping extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'houseKeeping';
    protected $fillable = [
        'HK_id',
        'reefer_id',
        'plan_position',
        'HK_time',
    ];
    public function reefer()
    {
        return $this->belongsTo(Reefer::class);
    }

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:00',
    ];
}
