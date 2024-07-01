<?php

namespace app\entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\JoinColumn;

#[ORM\Entity]
#[ORM\Table(name: 'Student')]
class StudentEntity
{
    #[ORM\Id]
    #[ORM\Column(name:"id",type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(name:"studentFirstName", type: Types::STRING)]
    private string $studentFirstName;

    #[ORM\Column(name:"studentLastName", type: Types::STRING)]
    private string $studentLastName;

    #[ORM\Column(name:"studentPatronimic", type: Types::STRING)]
    private string $studentPatronimic;
    
    #[ORM\Column(name:"studentBirthday", type: Types::STRING)]
    private $studentBirthday;

    #[ORM\ManyToOne(targetEntity: GroupEntity::class, inversedBy: 'students')]
    #[JoinColumn(name: 'groupId', referencedColumnName: 'id')]
    private GroupEntity $group;
    public function getId() 
    {
        return $this->id;
    }
    public function getStudentFirstName() 
    {
        return $this->studentFirstName;
    }
    public function getStudentLastName() 
    {
        return $this->studentLastName;
    }
    public function getStudentPatronimic() 
    {
        return $this->studentPatronimic;
    }
    public function getStudentBirthday()
    {
        return $this->studentBirthday;
    }
    public function setStudentFirstName($studentFirstName):StudentEntity
    {
        $this->studentFirstName = $studentFirstName;
        return $this;
    }
    public function setStudentLastName($studentLastName):StudentEntity 
    {
        $this->studentLastName = $studentLastName;
        return $this;
    }
    public function setStudentPatronimic($studentPatronimic):StudentEntity 
    {
        $this->studentPatronimic = $studentPatronimic;
        return $this;
    }
    public function setStudentBirthday($studentBirthday):StudentEntity 
    {
        $this->studentBirthday = $studentBirthday;
        return $this;
    }
    public function getGroup(): ?GroupEntity
    {
        return $this->group;
    }
    public function setGroup(?GroupEntity $group): self
    {
        $this->group = $group;
        return $this;
    }
}
