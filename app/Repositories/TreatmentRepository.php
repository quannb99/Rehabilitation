<?php

namespace App\Repositories;

use App\Models\Treatment;

class TreatmentRepository extends BaseRepository
{
    public function __construct(Treatment $model)
    {
        parent::__construct($model);
    }
}
