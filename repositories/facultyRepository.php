<?php

require_once (dirname(__DIR__). "/vendor/doctrine/orm/bootstrap.php");
require_once (dirname(__DIR__). "/vendor/doctrine/orm/src/Faculty.php");
require_once "facultyDTO.php";
global $entityManager;
class FacultyRepository{
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
                    ->from(Faculty::class,'f'
                    )
                    ->getQuery()
                    ->getResult()
                    );
                    
    }
    public function insertFaculty($paramsDTO)
    {
        $params = get_object_vars($paramsDTO);
        $faculty = new Faculty();
        $faculty->setFacultyName($params['facultyName']);
        $this->entityManager->persist($faculty);
        $this->entityManager->flush();
    }
    public function updateFaculty($paramsDTO)
    {
        $params = get_object_vars($paramsDTO);
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder
            ->update(Faculty::class,'f')
            ->set('f.facultyName',':facultyName')
            ->where('f.id = :id')
            ->setParameter('id',$params['id'])
            ->setParameter('facultyName',$params['facultyName'])
            ->getQuery()
            ->getResult();
    }
    public function deleteFaculty($paramsDTO)
    {
        $params = get_object_vars($paramsDTO);
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder
            ->delete(Faculty::class,'f')
            ->where('f.id = :id')
            ->setParameter('id',$params['id'])
            ->getQuery()
            ->getResult();
    }
}


