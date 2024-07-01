<?php

namespace app\repositories;

class GroupDTO
{
    public $id;
    public $groupName;
    public $departmentId;
    public function __construct($id, $groupName, $departmentId)
    {
        $this->id = $id;
        $this->groupName = $groupName;
        $this->departmentId = $departmentId;
    }
}