<?php

namespace app\core;

use app\controllers\FacultyController;

class Router {
    private Request $request;
    public function __construct() 
    {
        $this->request = new Request($_SERVER['REQUEST_METHOD']);
    }
    public function callFunc()
    {
        switch($this->request->getAct()) {
            case 'faculty':
                $action = new FacultyController;
                switch($this->request->getMethod()){
                    case 'getFaculty': 
                        $action->getFaculty();
                        break;
                    case 'insertFaculty':
                        $action->insertFaculty();
                        break;
                    case 'updateFaculty':
                        $action->updateFaculty();
                        break;
                    case 'deleteFaculty':
                        $action->deleteFaculty();
                        break;    
                }
        }
    }
}