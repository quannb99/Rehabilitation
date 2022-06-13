<?php

namespace App\Repositories;

use App\Models\MedicalRecord;

class MedicalRecordRepository extends BaseRepository
{
    public function __construct(MedicalRecord $model)
    {
        parent::__construct($model);
    }
}
