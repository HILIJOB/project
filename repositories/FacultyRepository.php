<?php

namespace app\repositories;

use app\repositories\FacultyDTO;
use app\entities\FacultyEntity;
use app\entities\DepartmentEntity;
use app\entities\GroupEntity;
use app\entities\StudentEntity;
use Doctrine\ORM\EntityRepository;

class FacultyRepository extends EntityRepository
{
    private $entityManager;
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function getFaculty()
    {
        $faculties = $this->entityManager->getRepository(FacultyEntity::class);   
        return $faculties->findAll();
    }
    public function insertFaculty(FacultyDTO $paramsDTO)
    {
        $params = get_object_vars($paramsDTO);
        $faculty = new FacultyEntity();
        $faculty->setFacultyName($params['facultyName']);
        $this->entityManager->persist($faculty);
        $this->entityManager->flush();
    }
    public function updateFaculty(FacultyDTO $paramsDTO)
    {
        $params = get_object_vars($paramsDTO);
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder
            ->update(FacultyEntity::class,'f')
            ->set('f.facultyName',':facultyName')
            ->where('f.id = :id')
            ->setParameter('id',$params['id'])
            ->setParameter('facultyName',$params['facultyName'])
            ->getQuery()
            ->getResult();
    }
    public function deleteFaculty(FacultyDTO $paramsDTO)
    {
        $params = get_object_vars($paramsDTO);
        $faculty = $this->entityManager->getRepository(FacultyEntity::class)->find($params['id']);
        if ($faculty != null) {
            $departmentsCascade = $this->entityManager->getRepository(DepartmentEntity::class)->findByFaculty($faculty->getId());
            if ($departmentsCascade != null && !empty($departmentsCascade)) {
                foreach ($departmentsCascade as $department) {
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
        $this->entityManager->remove($faculty);
        $this->entityManager->flush();
        }
    }
}