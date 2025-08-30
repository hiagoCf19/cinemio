<?php

namespace App\Entities;

class Account
{
  private ?string $id = null;
  private ?string $email = null;
  private ?string $external_id = null;
  private ?string $holder_name = null;
  private ?string $holder_date_of_birth = null; // YYYY-MM-DD
  private ?string $holder_phone = null;
  private bool $active = true;
  private bool $is_email_verified = false;
  private ?string $created_at = null;
  private ?string $updated_at = null;

  // 🔹 Builder fluente
  public static function builder(): self
  {
    return new self();
  }
  public function getId(): ?string
  {
    return $this->id;
  }

  public function getEmail(): ?string
  {
    return $this->email;
  }

  public function getExternalId(): ?string
  {
    return $this->external_id;
  }

  public function getHolderName(): ?string
  {
    return $this->holder_name;
  }

  public function getHolderDateOfBirth(): ?string
  {
    return $this->holder_date_of_birth;
  }

  public function getHolderPhone(): ?string
  {
    return $this->holder_phone;
  }

  public function isActive(): bool
  {
    return $this->active;
  }

  public function isEmailVerified(): bool
  {
    return $this->is_email_verified;
  }

  public function getCreatedAt(): ?string
  {
    return $this->created_at;
  }

  public function getUpdatedAt(): ?string
  {
    return $this->updated_at;
  }

  public function setId(string $id): self
  {
    $this->id = $id;
    return $this;
  }
  public function setEmail(string $email): self
  {
    $this->email = $email;
    return $this;
  }
  public function setExternalId(string $external_id): self
  {
    $this->external_id = $external_id;
    return $this;
  }
  public function setHolderName(string $name): self
  {
    $this->holder_name = $name;
    return $this;
  }
  public function setHolderDateOfBirth(?string $dob): self
  {
    $this->holder_date_of_birth = $dob;
    return $this;
  }
  public function setHolderPhone(?string $phone): self
  {
    $this->holder_phone = $phone;
    return $this;
  }
  public function setActive(bool $active): self
  {
    $this->active = $active;
    return $this;
  }
  public function setEmailVerified(bool $verified): self
  {
    $this->is_email_verified = $verified;
    return $this;
  }
  public function setCreatedAt(?string $created_at): self
  {
    $this->created_at = $created_at;
    return $this;
  }
  public function setUpdatedAt(?string $updated_at): self
  {
    $this->updated_at = $updated_at;
    return $this;
  }

  // 🔹 Converte para array pronto para salvar no DB
  public function toArray(): array
  {
    return [
      'id' => $this->id,
      'email' => $this->email,
      'external_id' => $this->external_id,
      'holder_name' => $this->holder_name,
      'holder_date_of_birth' => $this->holder_date_of_birth,
      'holder_phone' => $this->holder_phone,
      'active' => $this->active,
      'is_email_verified' => $this->is_email_verified,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
    ];
  }
}
