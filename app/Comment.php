<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zttp\Zttp;

class Comment extends Model
{
    protected $guarded = [];

    public static function moderate($comment)
    {
        $response = Zttp::withoutVerifying()->post("https://commentator.now.sh", [
            'comment' => $comment,
            'limit' => -3,
        ])->json();
        if ($response['commentate']) {
            abort(400, "Comment not allowed");
        }
    }
}
