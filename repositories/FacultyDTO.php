<?php

namespace app\repositories;

class FacultyDTO
{
    public $id;
    public $facultyName;
    public function __construct($id, $facultyName = null)
    {
        $this->id = $id;
        $this->facultyName = $facultyName;
    }
}