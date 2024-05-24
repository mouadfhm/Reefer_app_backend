<?php

namespace App\Modules\ActionHistory\Models;

use App\Modules\Reefer\Models\Reefer;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ActionHistory extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'reefer_id',
        'housekeeping_id',
        'type',
    ];
    public function reefer()
    {
        return $this->belongsTo(Reefer::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
