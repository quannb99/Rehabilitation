<?php

namespace App\Repositories;

use App\Models\Like;

class LikeRepository extends BaseRepository
{
    public function __construct(Like $like)
    {
        parent::__construct($like);
    }
}
