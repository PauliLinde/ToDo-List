<?php
namespace App\Entity;

use App\Repository\ActionRepository;
use JsonSerializable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ActionRepository::class)]
class Action implements JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?string $action = null;

    #[ORM\Column(type: 'datetime')]
    #[Assert\NotBlank]
    #[Assert\Type(DateTimeInterface::class)]
    private ?DateTimeInterface $dueDate = null;

    public function getId(): ?int {
        return $this->id;
    }

    public function getAction(): ?string {
        return $this->action;
    }

    public function setAction(?string $action):self {
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

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'action' => $this->action,
            'dueDate' => $this->dueDate ? $this->dueDate->format('Y-m-d') : null,
        ];
    }
}
