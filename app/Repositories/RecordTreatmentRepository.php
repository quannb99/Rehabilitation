<?php

namespace App\Repositories;

use App\Models\RecordTreatment;

class RecordTreatmentRepository extends BaseRepository
{
    public function __construct(RecordTreatment $model)
    {
        parent::__construct($model);
    }
}
