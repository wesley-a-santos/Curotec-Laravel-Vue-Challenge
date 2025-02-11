<?php

namespace App\Models;

use App\Models\Scopes\UserClientsScope;
use Database\Factories\ClientFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string $first_name
 * @property string $surname
 * @property string $social_security_number
 * @property int $gender_id
 * @property Carbon|null $birth_date
 * @property Carbon $first_contact_date
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read \App\Models\Gender $gender
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ClientFactory factory($count = null, $state = [])
 * @method static Builder|Client newModelQuery()
 * @method static Builder|Client newQuery()
 * @method static Builder|Client onlyTrashed()
 * @method static Builder|Client query()
 * @method static Builder|Client whereBirthDate($value)
 * @method static Builder|Client whereCreatedAt($value)
 * @method static Builder|Client whereDeletedAt($value)
 * @method static Builder|Client whereFirstContactDate($value)
 * @method static Builder|Client whereFirstName($value)
 * @method static Builder|Client whereGenderId($value)
 * @method static Builder|Client whereId($value)
 * @method static Builder|Client whereSocialSecurityNumber($value)
 * @method static Builder|Client whereSurname($value)
 * @method static Builder|Client whereUpdatedAt($value)
 * @method static Builder|Client whereUserId($value)
 * @method static Builder|Client withTrashed()
 * @method static Builder|Client withoutTrashed()
 * @mixin Eloquent
 */
class Client extends Model
{
    /** @use HasFactory<ClientFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'surname',
        'social_security_number',
        'gender_id',
        'birth_date',
        'first_contact_date',
        'user_id'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'first_contact_date' => 'date',
        'user_id' => 'int'
    ];

    protected static function booted(): void
    {
        static::creating(function (Client $client) {
            $client->user_id = auth()->id();
        });

        static::addGlobalScope(new UserClientsScope());
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
