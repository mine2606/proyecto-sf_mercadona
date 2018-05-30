<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PedidoRepository")
 */
class Pedido
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cliente", inversedBy="pedidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cliente;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fcompra;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fentrega;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cantidad", mappedBy="pedidos")
     */
    private $cantidades;

    public function __construct()
    {
        $this->cantidades = new ArrayCollection();
    }

   

    public function getId()
    {
        return $this->id;
    }

    


    

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getFcompra(): ?\DateTimeInterface
    {
        return $this->fcompra;
    }

    public function setFcompra(\DateTimeInterface $fcompra): self
    {
        $this->fcompra = $fcompra;

        return $this;
    }

    public function getFentrega(): ?\DateTimeInterface
    {
        return $this->fentrega;
    }

    public function setFentrega(\DateTimeInterface $fentrega): self
    {
        $this->fentrega = $fentrega;

        return $this;
    }

    /**
     * @return Collection|Cantidad[]
     */
    public function getCantidades(): Collection
    {
        return $this->cantidades;
    }

    public function addCantidade(Cantidad $cantidade): self
    {
        if (!$this->cantidades->contains($cantidade)) {
            $this->cantidades[] = $cantidade;
            $cantidade->setPedidos($this);
        }

        return $this;
    }

    public function removeCantidade(Cantidad $cantidade): self
    {
        if ($this->cantidades->contains($cantidade)) {
            $this->cantidades->removeElement($cantidade);
            // set the owning side to null (unless already changed)
            if ($cantidade->getPedidos() === $this) {
                $cantidade->setPedidos(null);
            }
        }

        return $this;
    }
}
