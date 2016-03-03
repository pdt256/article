<?php
namespace pdt256\article\Common\Entity;

trait IdTrait
{
    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned": true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function __clone()
    {
        $this->id = null;
    }
}
