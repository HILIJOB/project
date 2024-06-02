<?php

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'Faculty')]
class Faculty
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int $id;
    #[ORM\Column(type: 'string')]
    private string $facultyName;

    public function setFacultyName($facultyName) 
    {
        $this->facultyName = $facultyName;
    }
    public function getId() 
    {
        return $this->id;
    }
    public function getFacultyName() 
    {
        return $this->facultyName;
    }
}
