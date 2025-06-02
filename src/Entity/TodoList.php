<?php

namespace App\Entity;

use App\Repository\TodoListRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Collection;
use function Sodium\add;

#[ORM\Entity(repositoryClass: TodoListRepository::class)]
class TodoList
{
    #[ORM\ID]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?String $name = null;

    #[ORM\OneToMany(targetEntity: Action::class, mappedBy: 'todoList')]
    private Collection $actions;

    public function __construct()
    {
        $this->actions = new ArrayCollection();
    }

    public function getActions():Collection {
        return $this->actions;
    }

    /*public function addAction(?Action $action){
        $this->actions.add($action);
    }*/

    public function getName() {
        $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }
}
