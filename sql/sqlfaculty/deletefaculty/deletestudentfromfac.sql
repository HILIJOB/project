DELETE university.Student FROM university.Faculty
LEFT JOIN Department ON Faculty.id = facultyId
LEFT JOIN university.Group on Department.id = university.Group.departmentId
LEFT JOIN university.Student on university.Group.id = university.Student.groupId
WHERE Faculty.id = :id