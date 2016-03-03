<?php
namespace pdt256\article\RepositoryHydration\Entity;

use Doctrine\ORM\Mapping as ORM;
use pdt256\article\Common\Entity\IdTrait;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class Company
{
    use IdTrait;

    /** @ORM\Column(type="string", length=100, nullable=false, options={"default": ""}) */
    protected $name;

    /** @ORM\Column(type="boolean", nullable=false, options={"default": 0}) */
    protected $isActive;

    public function __construct()
    {
        $this->isActive = false;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive)
    {
        $this->isActive = $isActive;
    }
}
