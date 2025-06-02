<?php
namespace App\Entity;

use App\Repository\ActionRepository;
use Doctrine\ORM\Mapping as ORM;
use function Sodium\add;

#[ORM\Entity(repositoryClass: ActionRepository::class)]
#[ORM]
class Action
{
    #[ORM\ID]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?String $action = null;

    #[ORM\ORM\Column("todoList_id")]
    #[ORM\ManyToOne(targetEntity: TodoList::class, inversedBy: 'actions')]
    private ?TodoList $todoList = null;

    public function getAction(): ?Action {
        return $this->action;
    }

    public function setAction(?TodoList $action){
        $this->action = $action;
    }

    public function getTodoList(): ?TodoList{
        return $this->todoList;
    }

    public function setTodoList(?TodoList $todoList){
        $this->todoList = $todoList;
    }


}
