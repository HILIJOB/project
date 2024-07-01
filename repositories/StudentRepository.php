<?php

namespace app\repositories;

use app\entities\GroupEntity;
use app\repositories\StudentDTO;
use app\entities\StudentEntity;
use Doctrine\ORM\EntityRepository;

class StudentRepository extends EntityRepository
{
    private $entityManager;
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function getStudent()
    {            
        $groups = $this->entityManager->getRepository(StudentEntity::class);   
        return $groups->findAll();
    }
    public function insertStudent(StudentDTO $paramsDTO)
    {
        $params = get_object_vars($paramsDTO);
        $student = new StudentEntity();
        $student->setStudentFirstName($params['studentFirstName'])
                ->setStudentLastName($params['studentLastName'])
                ->setStudentPatronimic($params['studentPatronimic'])
                ->setStudentBirthday($params['studentBirthday'])
                ->setGroup($this->entityManager->getRepository(GroupEntity::class)->find($params['groupId']));
        $this->entityManager->persist($student);
        $this->entityManager->flush();
    }
    public function updateStudent(StudentDTO $paramsDTO)
    {
        $params = get_object_vars($paramsDTO);
        $student = $this->entityManager->getRepository(StudentEntity::class)->find($params['id']);
        $student->setStudentFirstName($params['studentFirstName'])
                ->setStudentLastName($params['studentLastName'])
                ->setStudentPatronimic($params['studentPatronimic'])
                ->setStudentBirthday($params['studentBirthday'])
                ->setGroup($this->entityManager->getRepository(GroupEntity::class)->find($params['groupId']));
        $this->entityManager->persist($student);
        $this->entityManager->flush();
    }
    public function deleteStudent(StudentDTO $paramsDTO)
    {
        $params = get_object_vars($paramsDTO);
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder
            ->delete(StudentEntity::class,'s')
            ->where('s.id = :id')
            ->setParameter('id',$params['id'])
            ->getQuery()
            ->getResult();
    }
}
