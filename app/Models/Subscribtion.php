<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Models\Subscribtion
 *
 * @property int $id
 * @property string $email
 * @property string|null $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribtion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribtion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribtion query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribtion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribtion whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribtion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribtion whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscribtion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Subscribtion extends Model
{
    use HasFactory;

    public static function add($email)
    {
        $sub = new static();
        $sub->email = $email;
        $sub->token = Str::random(100);
        $sub->save();

        return $sub;
    }

    public function remove()
    {
        $this->delete();
    }
}
