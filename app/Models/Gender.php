<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder|Gender newModelQuery()
 * @method static Builder|Gender newQuery()
 * @method static Builder|Gender onlyTrashed()
 * @method static Builder|Gender query()
 * @method static Builder|Gender whereCreatedAt($value)
 * @method static Builder|Gender whereDeletedAt($value)
 * @method static Builder|Gender whereId($value)
 * @method static Builder|Gender whereName($value)
 * @method static Builder|Gender whereUpdatedAt($value)
 * @method static Builder|Gender withTrashed()
 * @method static Builder|Gender withoutTrashed()
 * @mixin Eloquent
 */
class Gender extends Model
{
    use SoftDeletes;

    const FEMALE = 1;
    const MALE = 2;
    const OTHERS = 3;

}
