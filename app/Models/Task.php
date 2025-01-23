<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(int $id)
 * @method static create(array $all)
 * @method static orderBy(string $string, string $string1)
 */
class Task extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'is_done',
        'done_at',
    ];

    protected function casts(): array
    {
        return [
            'done_at' => 'date'
        ];
    }
}
