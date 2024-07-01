<?php

namespace app\controllers;

use app\repositories\StudentDTO;
use app\services\StudentService;
use app\core\Request;

class StudentController
{
    
    public function __construct(
        private readonly StudentService $groupService
    ) 
    {  
    }
    public function getStudent()
    {
        echo json_encode($this->groupService->getStudent(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    public function insertStudent(Request $request)
    {
        $params = [
            'studentFirstName' => $request->getParams('studentFirstName'),
            'studentLastName' => $request->getParams('studentLastName'),
            'studentPatronimic' => $request->getParams('studentPatronimic'),
            'studentBirthday' => $request->getParams('studentBirthday'),
            'groupId' => $request->getParams('groupId'),
        ];
        $paramsDTO = new StudentDTO(null, $params['studentFirstName'], $params['studentLastName'],$params['studentPatronimic'],
            $params['studentBirthday'], $params['groupId']);
        $this->groupService->insertStudent($paramsDTO);
    }
    public function updateStudent(Request $request)
    {
        $params = [
            'id' => $request->getParams('id'),
            'studentFirstName' => $request->getParams('studentFirstName'),
            'studentLastName' => $request->getParams('studentLastName'),
            'studentPatronimic' => $request->getParams('studentPatronimic'),
            'studentBirthday' => $request->getParams('studentBirthday'),
            'groupId' => $request->getParams('groupId'),
        ];
        $paramsDTO = new StudentDTO($params['id'], $params['studentFirstName'], $params['studentLastName'],$params['studentPatronimic'],
            $params['studentBirthday'], $params['groupId']);
        $this->groupService->updateStudent($paramsDTO);
    }
    public function deleteStudent(Request $request)
    {
        $params = [
            'id' => $request->getParams('id')
        ];
        $paramsDTO = new StudentDTO($params['id'],null,null,null,null,null);
        $this->groupService->deleteStudent($paramsDTO);
    }         
}
