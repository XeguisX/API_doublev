<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'usuario_id',
        'estado',
    ];

    protected $dates = ['deleted_at'];

    public $with = ['usuario'];


    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
