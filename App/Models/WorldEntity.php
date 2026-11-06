<?php

namespace App\Models;

use Framework\Core\Model;

class WorldEntity extends Model
{
    protected static ?string $tableName = 'world_entities';

    public $id;
    public $type;
    public $name;
    public $description;
}
