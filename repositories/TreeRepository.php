<?php

namespace app\repositories;

use app\entities\StudentEntity;
use app\entities\GroupEntity;
use app\entities\DepartmentEntity;
use app\entities\FacultyEntity;

class TreeRepository 
{

    private $entityManager;
    
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getStudentData() 
    {
        $students = $this->entityManager->getRepository(StudentEntity::class)->findAll();
        $studentsDTO = [];
        foreach ($students as $student) {
            $studentsDTO[] = new StudentDTO(
                $student->getId(),
                $student->getStudentFirstName(),
                $student->getStudentLastName(),
                $student->getStudentPatronimic(),
                $student->getStudentBirthday(),
                $student->getGroup()->getId());
        }
        return $studentsDTO;
    }

    public function getGroupData() 
    {
        $groups = $this->entityManager->getRepository(GroupEntity::class)->findAll();
        $groupsDTO = [];
        foreach ($groups as $group) {
            $groupsDTO[] = new GroupDTO($group->getId(),$group->getGroupName(),$group->getDepartment()->getId());
        }
        return $groupsDTO;
    }

    public function getDepartmentData() 
    {
        $departments = $this->entityManager->getRepository(DepartmentEntity::class)->findAll();
        $departmentsDTO = [];
        foreach ($departments as $department) {
            $departmentsDTO[] = new DepartmentDTO($department->getId(),$department->getDepartmentName(),$department->getFaculty()->getId());
        }
        return $departmentsDTO;
    }

    public function getFacultyData() 
    {
        $faculties = $this->entityManager->getRepository(FacultyEntity::class)->findAll();
        $facultiesDTO = [];
        foreach ($faculties as $faculty) {
            $facultiesDTO[] = new FacultyDTO($faculty->getId(),$faculty->getFacultyName());
        }
        return $facultiesDTO;
    }
}
