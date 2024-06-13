<?php

namespace app\controllers;

use app\repositories\FacultyDTO;
use app\services\FacultyService;

class FacultyController
{
    private FacultyService $facultyService;
    public function __construct() {
        $this->facultyService = new FacultyService();
    }
    public function getFaculty()
    {
        echo json_encode($this->facultyService->getFaculty(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    public function insertFaculty()
    {
        $params = [
            'facultyName' => $_POST['facultyName']
        ];
        $paramsDTO = new FacultyDTO(null, $params['facultyName']);
        $this->facultyService->insertFaculty($paramsDTO);
    }
    public function updateFaculty()
    {
        $params = [
            'id' => $_POST['id'],
            'facultyName' => $_POST['facultyName'],
        ];
        $paramsDTO = new FacultyDTO($params['id'], $params['facultyName']);
        $this->facultyService->updateFaculty($paramsDTO);
    }
    public function deleteFaculty()
    {
        $params = [
            'id' => $_POST['id']
        ];
        $paramsDTO = new FacultyDTO($params['id']);
        $this->facultyService->deleteFaculty($paramsDTO);
    }         
}
