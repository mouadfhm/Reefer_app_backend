<?php

namespace App\Modules\Fonction\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Modules\User\Models\User;
use App\Modules\Department\Models\Department;

class Fonction extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fontion_id',
        'department_id',
        'name',
    ];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
