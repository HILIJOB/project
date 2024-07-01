<?php

namespace app\repositories;

class DepartmentDTO
{
    public $id;
    public $departmentName;
    public $facultyId;
    public function __construct($id, $departmentName, $facultyId)
    {
        $this->id = $id;
        $this->departmentName = $departmentName;
        $this->facultyId = $facultyId;
    }
}