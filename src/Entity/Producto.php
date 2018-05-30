<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductoRepository")
 */
class Producto
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Nombre;

    /**
     * @ORM\Column(type="float")
     */
    private $Precio;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $Descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categoria", inversedBy="productos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoria;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cantidad", mappedBy="productos")
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

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->Precio;
    }

    public function setPrecio(float $Precio): self
    {
        $this->Precio = $Precio;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->Descripcion;
    }

    public function setDescripcion(string $Descripcion): self
    {
        $this->Descripcion = $Descripcion;

        return $this;
    }

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): self
    {
        $this->categoria = $categoria;

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
            $cantidade->setProductos($this);
        }

        return $this;
    }

    public function removeCantidade(Cantidad $cantidade): self
    {
        if ($this->cantidades->contains($cantidade)) {
            $this->cantidades->removeElement($cantidade);
            // set the owning side to null (unless already changed)
            if ($cantidade->getProductos() === $this) {
                $cantidade->setProductos(null);
            }
        }

        return $this;
    }
}
