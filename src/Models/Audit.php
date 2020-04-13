<?php

namespace Mmidu\Auditable\Models;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $table = 'audit';
    protected $fillable = [
        'field', 'old_value', 'new_value', 'action', 'table', 'model', 'user', 'date'
    ];
    public $timestamps = false;
}
