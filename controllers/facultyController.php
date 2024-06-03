<?php

namespace Controllers;

use Services;
use DTO;

require_once(dirname(__DIR__) . '/services/facultyService.php');
class FacultyController{
    public function getFaculty()
    {
        $facultyServiceCore = new Services\FacultyService();
        echo json_encode($facultyServiceCore->getFaculty(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    public function insertFaculty()
    {
        require_once(dirname(__DIR__) . '/repositories/facultyDTO.php');
        $params = [
            'facultyName' => $_POST['facultyName']
        ];
        $paramsDTO = new DTO\FacultyDTO(null, $params['facultyName']);
        $facultyServiceCore = new Services\FacultyService();
        $facultyServiceCore->insertFaculty($paramsDTO);
    }
    public function updateFaculty()
    {
        require_once(dirname(__DIR__) . '/repositories/facultyDTO.php');
        $params = [
            'id' => $_POST['id'],
            'facultyName' => $_POST['facultyName'],
        ];
        $paramsDTO = new DTO\FacultyDTO($params['id'], $params['facultyName']);
        $facultyServiceCore = new Services\FacultyService();
        $facultyServiceCore->updateFaculty($paramsDTO);
    }
    public function deleteFaculty()
    {
        require_once(dirname(__DIR__) . '/repositories/facultyDTO.php');
        $params = [
            'id' => $_POST['id']
        ];
        $paramsDTO = new DTO\FacultyDTO($params['id']);
        $facultyServiceCore = new Services\FacultyService();
        $facultyServiceCore->deleteFaculty($paramsDTO);
    }         
}
