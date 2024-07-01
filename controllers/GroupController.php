<?php

namespace app\controllers;

use app\repositories\GroupDTO;
use app\services\GroupService;
use app\core\Request;

class GroupController
{
    
    public function __construct(
        private readonly GroupService $groupService
    ) 
    {  
    }
    public function getGroup()
    {
        echo json_encode($this->groupService->getGroup(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    public function insertGroup(Request $request)
    {
        $params = [
            'groupName' => $request->getParams('groupName'),
            'departmentId' => $request->getParams('departmentId')
        ];
        $paramsDTO = new GroupDTO(null, $params['groupName'], $params['departmentId']);
        $this->groupService->insertGroup($paramsDTO);
    }
    public function updateGroup(Request $request)
    {
        $params = [
            'id' => $request->getParams('id'),
            'groupName' => $request->getParams('groupName'),
            'departmentId' => $request->getParams('departmentId')
        ];
        $paramsDTO = new GroupDTO($params['id'], $params['groupName'], $params['departmentId']);
        $this->groupService->updateGroup($paramsDTO);
    }
    public function deleteGroup(Request $request)
    {
        $params = [
            'id' => $request->getParams('id')
        ];
        $paramsDTO = new GroupDTO($params['id'],null,null);
        $this->groupService->deleteGroup($paramsDTO);
    }         
}
