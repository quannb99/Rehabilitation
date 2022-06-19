<?php

namespace App\Repositories;

use App\Models\Message;

class MessageRepository extends BaseRepository
{
    public function __construct(Message $msg)
    {
        parent::__construct($msg);
    }
}
