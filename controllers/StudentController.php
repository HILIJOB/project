<?php

namespace app\controllers;

use app\repositories\StudentDTO;
use app\services\StudentService;
use app\core\Request;

class StudentController
{
    
    public function __construct(
        private readonly StudentService $studentService
    ) 
    {  
    }
    public function getStudent()
    {
        echo json_encode($this->studentService->getStudent(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function insertStudent(Request $request)
    {
        $params = $request->getParams(['studentFirstName','studentLastName','studentPatronimic','studentBirthday','groupId']);
        $paramsDTO = new StudentDTO(null, $params['studentFirstName'], $params['studentLastName'],$params['studentPatronimic'],
            $params['studentBirthday'], $params['groupId']);
        $this->studentService->insertStudent($paramsDTO);
    }

    public function updateStudent(Request $request)
    {
        $params = $request->getParams(['id','studentFirstName','studentLastName','studentPatronimic','studentBirthday','groupId']);
        $paramsDTO = new StudentDTO($params['id'], $params['studentFirstName'], $params['studentLastName'],$params['studentPatronimic'],
            $params['studentBirthday'], $params['groupId']);
        $this->studentService->updateStudent($paramsDTO);
    }
    
    public function deleteStudent(Request $request)
    {
        $params = $request->getParams(['id']);
        $paramsDTO = new StudentDTO($params['id'],null,null,null,null,null);
        $this->studentService->deleteStudent($paramsDTO);
    }         
}
