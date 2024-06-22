<?php

namespace app\repositories;

use app\repositories\FacultyDTO;
use app\entities\FacultyEntity;
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
        $queryBuilder = $this->entityManager->createQueryBuilder();
        return($queryBuilder
                    ->select(sprintf(
                        'NEW %s(f.id, f.facultyName)',
                        FacultyDTO::class
                    ))
                    ->from(FacultyEntity::class,'f'
                    )
                    ->getQuery()
                    ->getResult()
                    );      
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
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder
            ->delete(FacultyEntity::class,'f')
            ->where('f.id = :id')
            ->setParameter('id',$params['id'])
            ->getQuery()
            ->getResult();
    }
}
