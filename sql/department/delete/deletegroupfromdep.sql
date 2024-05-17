DELETE university.Group FROM university.Department
LEFT JOIN university.Group on Department.id = university.Group.departmentId
LEFT JOIN university.Student on university.Group.id = university.Student.groupId
WHERE Department.id = :id