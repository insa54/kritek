<?php

namespace App\Entity;

use App\Repository\InvoiceLinesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceLinesRepository::class)]
class InvoiceLines
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Invoice::class)]
    private $invoice;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 2)]
    private $quantity;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 2)]
    private $amount;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 2)]
    private $vat_amount;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 2)]
    private $total_vat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(?Invoice $invoice): self
    {
        $this->invoice = $invoice;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getVatAmount(): ?string
    {
        return $this->vat_amount;
    }

    public function setVatAmount(string $vat_amount): self
    {
        $this->vat_amount = $vat_amount;

        return $this;
    }

    public function getTotalVat(): ?string
    {
        return $this->total_vat;
    }

    public function setTotalVat(string $total_vat): self
    {
        $this->total_vat = $total_vat;

        return $this;
    }
}
