<?php

namespace app\controllers;

use app\repositories\FacultyDTO;
use app\services\FacultyService;
use app\core\Request;

class FacultyController
{
    
    public function __construct(
        private readonly FacultyService $facultyService
    ) 
    {  
    }
    public function getFaculty()
    {
        echo json_encode($this->facultyService->getFaculty(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    public function insertFaculty(Request $request)
    {
        $params = [
            'facultyName' => $request->getParams('facultyName')
        ];
        $paramsDTO = new FacultyDTO(null, $params['facultyName']);
        $this->facultyService->insertFaculty($paramsDTO);
    }
    public function updateFaculty(Request $request)
    {
        $params = [
            'id' => $request->getParams('id'),
            'facultyName' => $request->getParams('facultyName'),
        ];
        $paramsDTO = new FacultyDTO($params['id'], $params['facultyName']);
        $this->facultyService->updateFaculty($paramsDTO);
    }
    public function deleteFaculty(Request $request)
    {
        $params = [
            'id' => $request->getParams('id')
        ];
        $paramsDTO = new FacultyDTO($params['id']);
        $this->facultyService->deleteFaculty($paramsDTO);
    }         
}
