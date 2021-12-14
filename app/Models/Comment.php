<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Comment
 *
 * @property int $id
 * @property string $text
 * @property int $user_id
 * @property int $post_id
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUserId($value)
 * @mixin \Eloquent
 */
class Comment extends Model
{
    use HasFactory;

    public function posts()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function allowComment()
    {
        $this->status = 1;
        $this->save();
    }

    public function disallowComment()
    {
        $this->status = 0;
        $this->save();
    }

    public function toggleCommentStatus()
    {
        if ($this->status == 0){
           return $this->allowComment();
        }

        return $this->disallowComment();
    }

    public function remove()
    {
        $this->delete();
    }

    public static function newCommentsCount()
    {
        return self::where('status', '=', 0)->count();
    }
}
