<?php

require_once (dirname(__DIR__). '/services/facultyService.php');
class FacultyController{
    private $method;
    public function startMethod($method){
        switch ($method){
            case 'getFaculty':
                $facultyServiceCore = new FacultyService();
                echo json_encode($facultyServiceCore->getFaculty(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                break;
            case 'insertFaculty':
                require_once (dirname(__DIR__). '/repositories/facultyDTO.php');
                $params = [
                    'facultyName' => $_POST['facultyName']
                ];
                $paramsDTO = new FacultyDTO(null, $params['facultyName']);
                $facultyServiceCore = new FacultyService();
                $facultyServiceCore->insertFaculty($paramsDTO);
                break;
            case 'updateFaculty':
                require_once (dirname(__DIR__). '/repositories/facultyDTO.php');
                $params = [
                    'id' => $_POST['id'],
                    'facultyName' => $_POST['facultyName'],
                ];
                $paramsDTO = new FacultyDTO($params['id'], $params['facultyName']);
                $facultyServiceCore = new FacultyService();
                $facultyServiceCore->updateFaculty($paramsDTO);
                break;
            case 'deleteFaculty':
                require_once (dirname(__DIR__). '/repositories/facultyDTO.php');
                $params = [
                    'id' => $_POST['id']
                ];
                $paramsDTO = new FacultyDTO($params['id']);
                $facultyServiceCore = new FacultyService();
                $facultyServiceCore->deleteFaculty($paramsDTO);
                break;
        }
    }
}
