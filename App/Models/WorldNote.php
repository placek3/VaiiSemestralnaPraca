<?php

namespace App\Models;

use Framework\Core\Model;

class WorldNote extends Model
{
    protected static ?string $tableName = 'world_notes';

    public $id;
    public $worldEntityId;
    public $title;
    public $content;
}
