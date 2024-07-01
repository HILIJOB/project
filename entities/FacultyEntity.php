<?php

namespace app\entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\OneToMany;

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
    #[OneToMany(targetEntity: DepartmentEntity::class, mappedBy: 'faculty')]
    private Collection $departments;
    public function __construct() 
    {
        $this->departments = new ArrayCollection();
    }
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
