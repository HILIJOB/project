<?php
global $conn;
require_once('connection.php');
$getfacultysql = file_get_contents('sql/faculty/getFaculty.sql');
$getfacultyquery = $conn->prepare($getfacultysql);
$getfacultyquery->execute();
$facultydata = $getfacultyquery->fetchAll(PDO::FETCH_ASSOC);
$getdepartmentsql = file_get_contents('sql/department/getDepartment.sql');
$getdepartmentquery = $conn->prepare($getdepartmentsql);
$getdepartmentquery->execute();
$departmentdata = $getdepartmentquery->fetchAll(PDO::FETCH_ASSOC);
$getgroupsql = file_get_contents('sql/group/getGroup.sql');
$getgroupquery = $conn->prepare($getgroupsql);
$getgroupquery->execute();
$groupdata = $getgroupquery->fetchAll(PDO::FETCH_ASSOC);
$getstudentsql = file_get_contents('sql/student/getStudent.sql');
$getstudentquery = $conn->prepare($getstudentsql);
$getstudentquery->execute();
$studentdata = $getstudentquery->fetchAll(PDO::FETCH_ASSOC);
$data = [];
define("FACULTY_LEVEL", 1);
define("DEPARTMENT_LEVEL",2);
define("GROUP_LEVEL",3);
define("STUDENT_LEVEL",4);
$parentiddata = array(
    DEPARTMENT_LEVEL => "facultyId",
    GROUP_LEVEL => "departmentId",
    STUDENT_LEVEL => "groupId"
);
$databases = array(
    DEPARTMENT_LEVEL => $departmentdata,
    GROUP_LEVEL => $groupdata,
    STUDENT_LEVEL => $studentdata
);
function getTree($tree, $parentid, $level){
    global $facultydata;
    global $parentiddata;
    global $databases;
    if($level == FACULTY_LEVEL){
        foreach($facultydata as $faculty){
            $tree[] = $faculty;
            $parentid = $faculty['id'];
            $tree[] = getTree($tree,$parentid,DEPARTMENT_LEVEL);
        }
    } else{
        $children = [];
        foreach($databases[$level] as $row){
            if($row[$parentiddata[$level]] == $parentid){
                $children[] = $row;
                if($level == DEPARTMENT_LEVEL || $level == GROUP_LEVEL){
                    $addchildren = getTree($tree,$row['id'],$level+1);
                    if(!empty($addchildren)){
                        $children[] = $addchildren;
                    }
                }
            }
        }
        return $children;
    }
    return $tree;
}
echo json_encode(gettree($data,null,FACULTY_LEVEL), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);