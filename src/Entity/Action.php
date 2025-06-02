<?php
namespace App\Entity;

use App\Repository\ActionRepository;
use Doctrine\ORM\Mapping as ORM;

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

}
