<?php

namespace app\services;

use app\repositories\GroupRepository;
use app\repositories\GroupDTO;

class GroupService
{
    private GroupRepository $groupRepository;
    public function __construct()
    {
        global $entityManager;
        $this->groupRepository = new GroupRepository($entityManager);
    }
    public function getGroup() 
    {
        $groupsDTO = [];
        foreach ($this->groupRepository->getGroup() as $group) {
            $groupsDTO[] = new GroupDTO($group->getId(),$group->getGroupName(),$group->getDepartment()->getId());
        }
        return $groupsDTO;
    }
    public function insertGroup(GroupDTO $paramsDTOfromController)
    {
        $params = get_object_vars($paramsDTOfromController);
        $groupName = $params['groupName'];
        $departmentId = $params['departmentId'];
        $paramsDTOtoRepository = new GroupDTO(null, $groupName, $departmentId);
        $this->groupRepository->insertGroup($paramsDTOtoRepository);
    }
    public function updateGroup(GroupDTO $paramsDTOfromController)
    {
        $params = get_object_vars($paramsDTOfromController);
        $id = $params['id'];
        $groupName = $params['groupName'];
        $departmentId = $params['departmentId'];
        if (ctype_digit($id)) {
            $paramsDTOtoRepository = new GroupDTO($id, $groupName,$departmentId);
            $this->groupRepository->updateGroup($paramsDTOtoRepository);
        } else {
            echo 'Неверный ввод';
        }
    }
    public function deleteGroup(GroupDTO $paramsDTOfromController)
    {
        $params = get_object_vars($paramsDTOfromController);
        $id = $params['id'];
        if (ctype_digit($id)) {
            $paramsDTOtoRepository = new GroupDTO($id,null,null);
            $this->groupRepository->deleteGroup($paramsDTOtoRepository);
        } else {
            echo 'Неверный ввод';
        }
    }
}