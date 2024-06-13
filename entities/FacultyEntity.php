<?php

namespace app\entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'Faculty')]
class FacultyEntity
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
    public function getId(): int 
    {
        return $this->id;
    }
    public function getFacultyName(): string 
    {
        return $this->facultyName;
    }
}
