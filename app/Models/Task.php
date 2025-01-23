<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(int $id)
 * @method static create(array $all)
 * @method static simplePaginate()
 * @method static limit(int $limit)
 */
class Task extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_done',
        'done_at',
    ];

    protected function casts(): array
    {
        return [
            'done_at' => 'datetime'
        ];
    }
}
