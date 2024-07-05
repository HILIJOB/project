<?php

namespace app\services;

use app\repositories\TreeRepository;
require_once(dirname(__DIR__) . "/bootstrap.php");
class TreeService 
{

    private TreeRepository $treeRepository;

    private $studentData;

    private $groupData;

    private $departmentData;

    private $facultyData;

    const FACULTY_LEVEL = 1;

    const DEPARTMENT_LEVEL = 2;

    const GROUP_LEVEL = 3;

    const STUDENT_LEVEL = 4;
    
    public function __construct()
    {
        global $entityManager;
        $this->treeRepository = new TreeRepository($entityManager);

        $studentData = [];
        foreach ($this->treeRepository->getStudentData() as $student) {
            $studentData[] = get_object_vars($student);
        }
        $this->studentData = $studentData;

        $groupData = [];
        foreach ($this->treeRepository->getGroupData() as $group) {
            $groupData[] = get_object_vars($group);
        }
        $this->groupData = $groupData;
        
        $departmentData = [];
        foreach ($this->treeRepository->getDepartmentData() as $department) {
            $departmentData[] = get_object_vars($department);
        }
        $this->departmentData = $departmentData;

        $facultyData = [];
        foreach ($this->treeRepository->getFacultyData() as $faculty) {
            $facultyData[] = get_object_vars($faculty);
        }
        $this->facultyData = $facultyData;
    }

    public function getTree($tree, $parentId, $level) 
    {
        //массив чтобы сопоставлять ключи и репозитории в зависимости от уровня рекурсии
        $recursionCompareData = [
            self::DEPARTMENT_LEVEL => ["facultyId", $this->departmentData],
            self::GROUP_LEVEL => ["departmentId", $this->groupData],
            self::STUDENT_LEVEL => ["groupId", $this->studentData]
        ];

        if ($level == self::FACULTY_LEVEL) {
            foreach ($this->facultyData as $faculty) {
                $faculty["children"] = $this->getTree($tree,$faculty['id'],self::DEPARTMENT_LEVEL);
                $tree[] = $faculty;
            }
        } else {
            $children = [];
            foreach ($recursionCompareData[$level][1] as $row) {
                if ($row[$recursionCompareData[$level][0]] == $parentId) {
                    if ($level == self::DEPARTMENT_LEVEL || $level == self::GROUP_LEVEL) {
                        $row["children"] = $this->getTree($tree,$row['id'],$level+1);
                    }
                    $children[] = $row;
                }
            }
            return $children;
        }
        return $tree;
    }
}
