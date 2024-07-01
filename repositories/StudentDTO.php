<?php

namespace app\repositories;

class StudentDTO
{
    public $id;
    public $studentFirstName;
    public $studentLastName;
    public $studentPatronimic;
    public $studentBirthday;
    public $groupId;
    public function __construct($id, $studentFirstName, $studentLastName,$studentPatronimic,$studentBirthday,$groupId)
    {
        $this->id = $id;
        $this->studentFirstName = $studentFirstName;
        $this->studentLastName = $studentLastName;
        $this->studentPatronimic = $studentPatronimic;
        $this->studentBirthday = $studentBirthday;
        $this->groupId = $groupId;
    }
}