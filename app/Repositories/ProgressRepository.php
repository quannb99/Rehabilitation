<?php

namespace App\Repositories;

use App\Models\Progress;

class ProgressRepository extends BaseRepository
{
    public function __construct(Progress $model)
    {
        parent::__construct($model);
    }
}
