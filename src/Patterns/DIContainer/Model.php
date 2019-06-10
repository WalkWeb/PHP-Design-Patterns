<?php

namespace Patterns\DIContainer;

class Model
{
    private $db;

    public function __construct(DBConnection $DBConnection)
    {
        $this->db = $DBConnection;
    }
}
