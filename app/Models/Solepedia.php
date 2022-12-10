<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid as Generator;

class Solepedia extends Model
{
    protected $table = "solepedia";
    protected $guarded = ['id'];
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    public function city()
    {
        return $this->belongsTo(Cities::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            try {
                $model->uuid = Generator::uuid4()->toString();
            } catch (UnsatisfiedDependencyException $e) {
                abort(500, $e->getMessage());
            }
        });
    }
}
