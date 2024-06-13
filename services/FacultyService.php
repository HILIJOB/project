<?php

namespace app\services;

use app\controllers\FacultyController;
use app\repositories\FacultyDTO;
use app\repositories\FacultyRepository;

class FacultyService
{
    private FacultyRepository $facultyRepository;
    public function __construct()
    {
        global $entityManager;
        $this->facultyRepository = new FacultyRepository($entityManager);
    }
    public function getFaculty() 
    {
        foreach ($this->facultyRepository->getFaculty() as $faculty) {
            $faculty = get_object_vars($faculty);
            $facultiesDTO[] = new FacultyDTO($faculty['id'],$faculty['facultyName']);
        }
        return $facultiesDTO;
    }
    public function insertFaculty(FacultyDTO $paramsDTOfromController)
    {
        $params = get_object_vars($paramsDTOfromController);
        $facultyName = $params['facultyName'];
        $paramsDTOtoRepository = new FacultyDTO(null, $facultyName);
        $this->facultyRepository->insertFaculty($paramsDTOtoRepository);
    }
    public function updateFaculty(FacultyDTO $paramsDTOfromController)
    {
        $params = get_object_vars($paramsDTOfromController);
        $id = $params['id'];
        $facultyName = $params['facultyName'];
        if (ctype_digit($id)) {
            $paramsDTOtoRepository = new FacultyDTO($id, $facultyName);
            $this->facultyRepository->updateFaculty($paramsDTOtoRepository);
        } else {
            echo 'Неверный ввод';
        }
    }
    public function deleteFaculty(FacultyDTO $paramsDTOfromController)
    {
        $params = get_object_vars($paramsDTOfromController);
        $id = $params['id'];
        if (ctype_digit($id)) {
            $paramsDTOtoRepository = new FacultyDTO($id);
            $this->facultyRepository->deleteFaculty($paramsDTOtoRepository);
        } else {
            echo 'Неверный ввод';
        }
    }
}