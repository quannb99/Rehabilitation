<?php

namespace App\Repositories;

use App\Models\Specialist;

class SpecialistRepository extends BaseRepository
{
    public function __construct(Specialist $model)
    {
        parent::__construct($model);
    }
}
