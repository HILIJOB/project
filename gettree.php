<?php
global $conn;
require_once('connection.php');
$getfacultysql = file_get_contents('sql/faculty/getfaculty.sql');
$getfacultyquery = $conn->prepare($getfacultysql);
$getfacultyquery->execute();

$facultydata = $getfacultyquery->fetchAll(PDO::FETCH_ASSOC);
$getdepartmentsql = file_get_contents('sql/department/getdepartment.sql');
$getdepartmentquery = $conn->prepare($getdepartmentsql);
$getdepartmentquery->execute();

$departmentdata = $getdepartmentquery->fetchAll(PDO::FETCH_ASSOC);
$getgroupsql = file_get_contents('sql/group/getgroup.sql');
$getgroupquery = $conn->prepare($getgroupsql);
$getgroupquery->execute();
$groupdata = $getgroupquery->fetchAll(PDO::FETCH_ASSOC);

$getstudentsql = file_get_contents('sql/student/getstudent.sql');
$getsudentquery = $conn->prepare($getstudentsql);
$getsudentquery->execute();
$studentdata = $getsudentquery->fetchAll(PDO::FETCH_ASSOC);

$data = [];
function gettree($tree, $parentid, $level){
    global $facultydata;
    global $departmentdata;
    global $groupdata;
    global $studentdata;
    if($level == 1){
        foreach($facultydata as $faculty){
            $tree[] = $faculty;
            $parentid = $faculty['id'];
            $tree[] = gettree($tree,$parentid,2);
        }

    }
    if($level == 2){
        $childdepartments=[];
        foreach($departmentdata as $department){
            if($department['facultyId'] == $parentid){
                $childdepartments[] = $department;
                $depid = $department['id'];
                $addgroups = gettree($tree,$depid,3);
                if (!empty($addgroups)){
                    $childdepartments[] = $addgroups;
                }
            }
        }
        return $childdepartments;
    }
    if($level == 3){
        $childgroups = [];
        foreach ($groupdata as $group){
            if($group['departmentId'] == $parentid){
                $childgroups[] = $group;
                $grid = $group['id'];
                $addstudents = gettree($tree,$grid,4);
                if (!empty($addstudents)){
                    $childgroups[] = $addstudents;
                }
            }
        }
        return $childgroups;
    }
    if($level == 4){
        $childstudents = [];
        foreach ($studentdata as $student){
            if($student['groupId'] == $parentid){
                $childstudents[] = $student;
            }
        }
        return $childstudents;
    }
    return $tree;
}
echo json_encode(gettree($data,1,1), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

