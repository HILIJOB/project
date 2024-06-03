<?php

namespace Services;

use Repositories;
use DTO;

require_once(dirname(__DIR__) . "/vendor/doctrine/orm/bootstrap.php");
require_once(dirname(__DIR__) . "/vendor/doctrine/orm/src/Faculty.php");
require_once(dirname(__DIR__) . '/repositories/facultyRepository.php');
class FacultyService 
{
    public function getFaculty() 
    {
        global $entityManager;
        $faculties = new Repositories\FacultyRepository($entityManager);
        foreach ($faculties->getFaculty() as $faculty) {
            $faculty = get_object_vars($faculty);
            $facultiesDTO[] = new DTO\FacultyDTO($faculty['id'],$faculty['facultyName']);
        }
        return $facultiesDTO;

    }
    public function insertFaculty($paramsDTOfromController)
    {
        require_once(dirname(__DIR__) . '/repositories/facultyDTO.php');
        $params = get_object_vars($paramsDTOfromController);
        global $entityManager;
        $faculties = new Repositories\FacultyRepository($entityManager);
        $facultyName = $params['facultyName'];
        $paramsDTOtoRepository = new DTO\FacultyDTO(null, $facultyName);
        $faculties->insertFaculty($paramsDTOtoRepository);
    }
    public function updateFaculty($paramsDTOfromController)
    {
        require_once(dirname(__DIR__) . '/repositories/facultyDTO.php');
        $params = get_object_vars($paramsDTOfromController);
        global $entityManager;
        $faculties = new Repositories\FacultyRepository($entityManager);
        $id = $params['id'];
        $facultyName = $params['facultyName'];
        if (ctype_digit($id)) {
            $paramsDTOtoRepository = new DTO\FacultyDTO($id, $facultyName);
            $faculties->updateFaculty($paramsDTOtoRepository);
        } else {
            echo 'Неверный ввод';
        }
    }
    public function deleteFaculty($paramsDTOfromController)
    {
        require_once(dirname(__DIR__) . '/repositories/facultyDTO.php');
        $params = get_object_vars($paramsDTOfromController);
        global $entityManager;
        $faculties = new Repositories\FacultyRepository($entityManager);
        $id = $params['id'];
        if (ctype_digit($id)) {
            $paramsDTOtoRepository = new DTO\FacultyDTO($id);
            $faculties->deleteFaculty($paramsDTOtoRepository);
        } else {
            echo 'Неверный ввод';
        }
    }
}