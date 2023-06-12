<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * @method static create(mixed $validated)
 * @method static findOrFail(string $id)
 * @method static where(string $string, $id)
 */
class Setting extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'fiscal_code',
        'vat',
        'address',
        'city',
        'area',
        'region',
        'state',
        'phone',
        'email',
        'post_code',
        'bank',
        'iban'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return Attribute
     */
    /*protected function city(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value)
        );
    }*/

    /**
     * @return Attribute
     */
    /*protected function region(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value)
        );
    }*/

    /**
     * @return Attribute
     */
    /*protected function state(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value)
        );
    }*/

    /**
     * @return Attribute
     */
    /*protected function iban(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value)
        );
    }*/

    /**
     * @return Attribute
     */
    /*protected function bank(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value)
        );
    }*/
}
