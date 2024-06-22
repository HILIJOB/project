<?php

namespace app\entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity]
#[ORM\Table(name: 'Faculty')]
class FacultyEntity
{
    #[ORM\Id]
    #[ORM\Column(name:"id",type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    private int $id;
    #[ORM\Column(name:"facultyName", type: Types::STRING)]
    private string $facultyName;

    public function setFacultyName($facultyName):FacultyEntity 
    {
        $this->facultyName = $facultyName;
        return $this;
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
