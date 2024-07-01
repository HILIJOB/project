<?php

namespace app\services;

use app\repositories\DepartmentRepository;
use app\repositories\DepartmentDTO;

class DepartmentService
{
    private DepartmentRepository $departmentRepository;
    public function __construct()
    {
        global $entityManager;
        $this->departmentRepository = new DepartmentRepository($entityManager);
    }
    public function getDepartment() 
    {
        $departmentsDTO = [];
        foreach ($this->departmentRepository->getDepartment() as $department) {
            $departmentsDTO[] = new DepartmentDTO($department->getId(),$department->getDepartmentName(),$department->getFaculty()->getId());
        }
        return $departmentsDTO;
    }
    public function insertDepartment(DepartmentDTO $paramsDTOfromController)
    {
        $params = get_object_vars($paramsDTOfromController);
        $departmentName = $params['departmentName'];
        $facultyId = $params['facultyId'];
        $paramsDTOtoRepository = new DepartmentDTO(null, $departmentName, $facultyId);
        $this->departmentRepository->insertDepartment($paramsDTOtoRepository);
    }
    public function updateDepartment(DepartmentDTO $paramsDTOfromController)
    {
        $params = get_object_vars($paramsDTOfromController);
        $id = $params['id'];
        $departmentName = $params['departmentName'];
        $facultyId = $params['facultyId'];
        if (ctype_digit($id)) {
            $paramsDTOtoRepository = new DepartmentDTO($id, $departmentName,$facultyId);
            $this->departmentRepository->updateDepartment($paramsDTOtoRepository);
        } else {
            echo 'Неверный ввод';
        }
    }
    public function deleteDepartment(DepartmentDTO $paramsDTOfromController)
    {
        $params = get_object_vars($paramsDTOfromController);
        $id = $params['id'];
        if (ctype_digit($id)) {
            $paramsDTOtoRepository = new DepartmentDTO($id,null,null);
            $this->departmentRepository->deleteDepartment($paramsDTOtoRepository);
        } else {
            echo 'Неверный ввод';
        }
    }
}