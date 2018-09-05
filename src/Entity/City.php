<?php

namespace ModulusCore\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * City
 *
 * Municipalities of Federative Units
 *
 * @ORM\Table(name="bc_cidade")
 * @ORM\Entity
 */
class City
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_cidade", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nm_cidade", type="string", length=120, nullable=false)
     */
    protected $name;

    /**
     * @var State
     *
     * @ORM\ManyToOne(targetEntity="ModulusCore\Entity\State")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado", referencedColumnName="id_estado")
     * })
     */
    protected $state;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return City
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set state
     *
     * @param State $state
     *
     * @return City
     */
    public function setState(State $state = null)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return State $state
     */
    public function getState()
    {
        return $this->state;
    }
}