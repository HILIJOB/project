<?php

namespace app\controllers;

use app\repositories\DepartmentDTO;
use app\services\DepartmentService;
use app\core\Request;

class DepartmentController
{
    
    public function __construct(
        private readonly DepartmentService $departmentService
    ) 
    {  
    }
    public function getDepartment()
    {
        echo json_encode($this->departmentService->getDepartment(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    public function insertDepartment(Request $request)
    {
        $params = [
            'departmentName' => $request->getParams('departmentName'),
            'facultyId' => $request->getParams('facultyId')
        ];
        $paramsDTO = new DepartmentDTO(null, $params['departmentName'], $params['facultyId']);
        $this->departmentService->insertDepartment($paramsDTO);
    }
    public function updateDepartment(Request $request)
    {
        $params = [
            'id' => $request->getParams('id'),
            'departmentName' => $request->getParams('departmentName'),
            'facultyId' => $request->getParams('facultyId')
        ];
        $paramsDTO = new DepartmentDTO($params['id'], $params['departmentName'], $params['facultyId']);
        $this->departmentService->updateDepartment($paramsDTO);
    }
    public function deleteDepartment(Request $request)
    {
        $params = [
            'id' => $request->getParams('id')
        ];
        $paramsDTO = new DepartmentDTO($params['id'],null,null);
        $this->departmentService->deleteDepartment($paramsDTO);
    }         
}
