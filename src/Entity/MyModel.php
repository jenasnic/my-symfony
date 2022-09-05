<?php

namespace App\Entity;

use App\Enum\MyEnum;
use App\Repository\MyModelRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MyModelRepository::class)]
class MyModel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $label = null;

    #[ORM\Column(type: 'string', length: 25, nullable: true, enumType: MyEnum::class)]
    private ?MyEnum $code = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $value = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTime $date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getCode(): ?MyEnum
    {
        return $this->code;
    }

    public function setCode(?MyEnum $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(?int $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getDate(): ?DateTime
    {
        return $this->date;
    }

    public function setDate(?DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }
}
