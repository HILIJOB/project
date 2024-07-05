<?php

namespace app\controllers;

use app\services\TreeService;

class TreeController
{
    
    public function __construct(
        private readonly TreeService $treeService
    ) 
    {  
    }
    
    public function getTree()
    { 
        $data = [];
        echo json_encode($this->treeService->getTree($data,null,$this->treeService::FACULTY_LEVEL), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
          
}
