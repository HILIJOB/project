<?php

namespace app\repositories;

use app\entities\DepartmentEntity;
use app\repositories\GroupDTO;
use app\entities\GroupEntity;
use app\entities\StudentEntity;
use Doctrine\ORM\EntityRepository;

class GroupRepository extends EntityRepository
{
    private $entityManager;
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function getGroup()
    {            
        $groups = $this->entityManager->getRepository(GroupEntity::class);   
        return $groups->findAll();
    }
    public function insertGroup(GroupDTO $paramsDTO)
    {
        $params = get_object_vars($paramsDTO);
        $group = new GroupEntity();
        $group->setGroupName($params['groupName'])
              ->setDepartment($this->entityManager->getRepository(DepartmentEntity::class)->find($params['departmentId']));
        $this->entityManager->persist($group);
        $this->entityManager->flush();
    }
    public function updateGroup(GroupDTO $paramsDTO)
    {
        $params = get_object_vars($paramsDTO);
        $group = $this->entityManager->getRepository(GroupEntity::class)->find($params['id']);
        $group->setGroupName($params['groupName']);
        $group->setDepartment($this->entityManager->getRepository(DepartmentEntity::class)->find($params['departmentId']));
        $this->entityManager->persist($group);
        $this->entityManager->flush();
    }
    public function deleteGroup(GroupDTO $paramsDTO)
    {
        $params = get_object_vars($paramsDTO);
        $group = $this->entityManager->getRepository(GroupEntity::class)->find($params['id']);
            if ($group != null) {
                    $studentsCascade = $this->entityManager->getRepository(StudentEntity::class)->findByGroup($group->getId());
                    if ($studentsCascade != null && !empty($studentsCascade)) {
                        foreach ($studentsCascade as $student) {
                            $this->entityManager->remove($student);
                            $this->entityManager->flush();
                        }
                    }
            $this->entityManager->remove($group);
            $this->entityManager->flush();
            }
    }
}