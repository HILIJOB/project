DELETE university.Student FROM university.Group
LEFT JOIN university.Student on university.Group.id = university.Student.groupId
WHERE Group.id = :id