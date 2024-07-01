<?php

namespace app\entities;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use app\entities\FacultyEntity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity]
#[ORM\Table(name: 'Department')]
class DepartmentEntity
{
    #[ORM\Id]
    #[ORM\Column(name:"id",type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    private int $id;
    #[ORM\Column(name:"departmentName", type: Types::STRING)]
    private string $departmentName;
    #[ORM\ManyToOne(targetEntity: FacultyEntity::class, inversedBy: 'departments')]
    #[JoinColumn(name: 'facultyId', referencedColumnName: 'id')]
    private FacultyEntity $faculty;
    #[OneToMany(targetEntity: GroupEntity::class, mappedBy: 'department')]
    private Collection $groups;
    public function __construct() 
    {
        $this->groups = new ArrayCollection();
    }
    public function getId(): int 
    {
        return $this->id;
    }
    public function getDepartmentName(): string 
    {
        return $this->departmentName;
    }
    public function getFaculty(): FacultyEntity
    {
        return $this->faculty;
    }
    public function setFaculty(?FacultyEntity $faculty)
    {
        $this->faculty = $faculty;
        return $this;
    }
    public function setDepartmentName($departmentName):DepartmentEntity 
    {
        $this->departmentName = $departmentName;
        return $this;
    }
}
