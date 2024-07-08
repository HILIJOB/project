<?php

namespace app\services;

use app\repositories\TreeRepository;

class TreeService 
{

    const FACULTY_LEVEL = 1;

    const DEPARTMENT_LEVEL = 2;

    const GROUP_LEVEL = 3;

    const STUDENT_LEVEL = 4;

    private TreeRepository $treeRepository;

    private $studentData;

    private $groupData;

    private $departmentData;

    private $facultyData;
    private array $recursionCompareData;
    
    public function __construct()
    {
        global $entityManager;
        $this->treeRepository = new TreeRepository($entityManager);
        $this->studentData = array_map('get_object_vars',$this->treeRepository->getStudentData());
        $this->groupData = array_map('get_object_vars',$this->treeRepository->getGroupData());
        $this->departmentData = array_map('get_object_vars',$this->treeRepository->getDepartmentData());
        $this->facultyData = array_map('get_object_vars',$this->treeRepository->getFacultyData());
        $this->recursionCompareData = [
            self::FACULTY_LEVEL => [0, $this->facultyData],
            self::DEPARTMENT_LEVEL => ["facultyId", $this->departmentData],
            self::GROUP_LEVEL => ["departmentId", $this->groupData],
            self::STUDENT_LEVEL => ["groupId", $this->studentData]
        ];
    }

    public function getTree(int|null $parentId, int $level): array
    {
        foreach ($this->recursionCompareData[$level][1] as $row) {
            if ($row[$this->recursionCompareData[$level][0]] == $parentId) {
                if ($level != self::STUDENT_LEVEL) {
                    $row["children"] = $this->getTree($row['id'],$level+1);
                }
                $tree[] = $row;
            }
        }
        return $tree;
    }
}
