<?php

namespace app\repositories;

use app\entities\FacultyEntity;
use app\repositories\DepartmentDTO;
use app\entities\DepartmentEntity;
use app\entities\GroupEntity;
use app\entities\StudentEntity;
use Doctrine\ORM\EntityRepository;

class DepartmentRepository extends EntityRepository
{
    private $entityManager;
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function getDepartment()
    {
        $departments = $this->entityManager->getRepository(DepartmentEntity::class);   
        return $departments->findAll();
    }
    public function insertDepartment(DepartmentDTO $paramsDTO)
    {
        $params = get_object_vars($paramsDTO);
        $department = new DepartmentEntity();
        $department->setDepartmentName($params['departmentName'])
                   ->setFaculty($this->entityManager->getRepository(FacultyEntity::class)->find($params['facultyId']));
        $this->entityManager->persist($department);
        $this->entityManager->flush();
    }
    public function updateDepartment(DepartmentDTO $paramsDTO)
    {
        $params = get_object_vars($paramsDTO);
        $department = $this->entityManager->getRepository(DepartmentEntity::class)->find($params['id']);
        $department->setDepartmentName($params['departmentName']);
        $department->setFaculty($this->entityManager->getRepository(FacultyEntity::class)->find($params['facultyId']));
        $this->entityManager->persist($department);
        $this->entityManager->flush();
    }
    public function deleteDepartment(DepartmentDTO $paramsDTO)
    {
        $params = get_object_vars($paramsDTO);
        $department = $this->entityManager->getRepository(DepartmentEntity::class)->find($params['id']);
            if ($department != null) {
                $groupsCascade = $this->entityManager->getRepository(GroupEntity::class)->findByDepartment($department->getId());
                    if ($groupsCascade != null && !empty($groupsCascade)) {
                        foreach ($groupsCascade as $group) {
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
                $this->entityManager->remove($department);
                $this->entityManager->flush();
            }
    }
}
