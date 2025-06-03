<?php
namespace App\Entity;

use App\Repository\ActionRepository;
use App\Repository\TodoListRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ActionRepository::class)]
#[ORM]
class Action
{
    #[ORM\ID]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?String $action = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Type(DateTimeInterface::class)]
    private ?DateTimeInterface $dueDate = null;

    public function getAction(): ?String {
        return $this->action;
    }

    public function setAction(?String $action):self {
        $this->action = $action;
        return $this;
    }

    public function getDueDate(): ?\DateTimeInterface
    {
        return $this->dueDate;
    }

    public function setDueDate(\DateTimeInterface $dueDate): self
    {
        $this->dueDate = $dueDate;
        return $this;
    }
}
