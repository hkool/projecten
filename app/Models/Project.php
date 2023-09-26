<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';

    protected $fillable = [
        'id',
        'name',
        'code',
        'start_date',
        'end_date',
        'max_hours'
    ];


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
