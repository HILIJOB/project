<?php

namespace app\services;

use app\repositories\StudentRepository;
use app\repositories\StudentDTO;

class StudentService
{
    private StudentRepository $studentRepository;
    public function __construct()
    {
        global $entityManager;
        $this->studentRepository = new StudentRepository($entityManager);
    }
    public function getStudent() 
    {
        $studentsDTO = [];
        foreach ($this->studentRepository->getStudent() as $student) {
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
    public function insertStudent(StudentDTO $paramsDTOfromController)
    {
        $params = get_object_vars($paramsDTOfromController);
        $studentFirstName = $params['studentFirstName'];
        $studentLastName = $params['studentLastName'];
        $studentPatronimic = $params['studentPatronimic'];
        $studentBirthday = $params['studentBirthday'];
        $groupId = $params['groupId'];
        $paramsDTOtoRepository = new StudentDTO(null, $studentFirstName, $studentLastName,$studentPatronimic,$studentBirthday,$groupId);
        $this->studentRepository->insertStudent($paramsDTOtoRepository);
    }
    public function updateStudent(StudentDTO $paramsDTOfromController)
    {
        $params = get_object_vars($paramsDTOfromController);
        $id = $params['id'];
        $studentFirstName = $params['studentFirstName'];
        $studentLastName = $params['studentLastName'];
        $studentPatronimic = $params['studentPatronimic'];
        $studentBirthday = $params['studentBirthday'];
        $groupId = $params['groupId'];
        if (ctype_digit($id)) {
            $paramsDTOtoRepository = new StudentDTO($id, $studentFirstName, $studentLastName,$studentPatronimic,$studentBirthday,$groupId);
            $this->studentRepository->updateStudent($paramsDTOtoRepository);
        } else {
            echo 'Неверный ввод';
        }
    }
    public function deleteStudent(StudentDTO $paramsDTOfromController)
    {
        $params = get_object_vars($paramsDTOfromController);
        $id = $params['id'];
        if (ctype_digit($id)) {
            $paramsDTOtoRepository = new StudentDTO($id,null,null,null,null,null);
            $this->studentRepository->deleteStudent($paramsDTOtoRepository);
        } else {
            echo 'Неверный ввод';
        }
    }
}