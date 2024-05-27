<?php
global $conn;
require_once('connection.php');
$getFacultySql = file_get_contents('sql/faculty/getFaculty.sql');
$getFacultyQuery = $conn->prepare($getFacultySql);
$getFacultyQuery->execute();
$facultyData = $getFacultyQuery->fetchAll(PDO::FETCH_ASSOC);
$getDepartmentSql = file_get_contents('sql/department/getDepartment.sql');
$getDepartmentQuery = $conn->prepare($getDepartmentSql);
$getDepartmentQuery->execute();
$departmentData = $getDepartmentQuery->fetchAll(PDO::FETCH_ASSOC);
$getGroupSql = file_get_contents('sql/group/getGroup.sql');
$getGroupQuery = $conn->prepare($getGroupSql);
$getGroupQuery->execute();
$groupData = $getGroupQuery->fetchAll(PDO::FETCH_ASSOC);
$getStudentSql = file_get_contents('sql/student/getStudent.sql');
$getStudentQuery = $conn->prepare($getStudentSql);
$getStudentQuery->execute();
$studentData = $getStudentQuery->fetchAll(PDO::FETCH_ASSOC);
$data = [];
define("FACULTY_LEVEL", 1);
define("DEPARTMENT_LEVEL", 2);
define("GROUP_LEVEL", 3);
define("STUDENT_LEVEL", 4);
$parentIdData = [
    DEPARTMENT_LEVEL => "facultyId",
    GROUP_LEVEL => "departmentId",
    STUDENT_LEVEL => "groupId"
];
$databases = [
    DEPARTMENT_LEVEL => $departmentData,
    GROUP_LEVEL => $groupData,
    STUDENT_LEVEL => $studentData
];
function getTree($tree, $parentId, $level)
{
    global $facultyData;
    global $parentIdData;
    global $databases;
    if ($level == FACULTY_LEVEL) {
        foreach ($facultyData as $faculty) {
            $faculty["children"] = getTree($tree,$faculty['id'],DEPARTMENT_LEVEL);
            $tree[] = $faculty;
        }
    } else {
        $children = [];
        foreach ($databases[$level] as $row) {
            if ($row[$parentIdData[$level]] == $parentId) {
                if ($level == DEPARTMENT_LEVEL || $level == GROUP_LEVEL) {
                    $row["children"] = getTree($tree,$row['id'],$level+1);
                }
                $children[] = $row;
            }
        }
        return $children;
    }
    return $tree;
}
echo json_encode(gettree($data,null,FACULTY_LEVEL), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);