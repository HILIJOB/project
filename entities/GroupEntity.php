<?php

namespace app\entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToMany;

#[ORM\Entity]
#[ORM\Table(name: 'Groupp')]
class GroupEntity
{
    #[ORM\Id]
    #[ORM\Column(name:"id",type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    private int $id;
    #[ORM\Column(name:"groupName", type: Types::STRING)]
    private string $groupName;
    #[ORM\ManyToOne(targetEntity: DepartmentEntity::class, inversedBy: 'groups')]
    #[JoinColumn(name: 'departmentId', referencedColumnName: 'id')]
    private DepartmentEntity $department;
    #[OneToMany(targetEntity: StudentEntity::class, mappedBy: 'group')]
    private Collection $students;
    public function __construct() 
    {
        $this->students = new ArrayCollection();
    }
    public function setGroupName($groupName):GroupEntity 
    {
        $this->groupName = $groupName;
        return $this;
    }
    public function getId(): int 
    {
        return $this->id;
    }
    public function getGroupName(): string 
    {
        return $this->groupName;
    }
    public function getDepartment(): DepartmentEntity
    {
        return $this->department;
    }
    public function setDepartment(?DepartmentEntity $department)
    {
        $this->department = $department;
        return $this;
    }
}
