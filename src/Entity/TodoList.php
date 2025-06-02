<?php

namespace App\Entity;

use App\Repository\TodoListRepository;
use Doctrine\ORM\Mapping as ORM;

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

}
