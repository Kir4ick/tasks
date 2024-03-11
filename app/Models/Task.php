<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read string $id (uuid)
 * @property string $title
 * @property string $status ('create', 'await', 'processed', 'done') -
 * лучше кншн было б в константы выделить, но пока нет смысла
 * @property string $created_by (uuid)
 * @property string $created_at
 * @property string $updated_at
 */
class Task extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = ['title', 'created_by', 'status'];

}