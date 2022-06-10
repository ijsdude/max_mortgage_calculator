<?php declare(strict_types=1);

namespace App\DTO;

use JetBrains\PhpStorm\Deprecated;
use Symfony\Contracts\Service\Attribute\Required;
use Symfony\Component\Validator\Constraints as Assert;

// TODO:: Add more assertions for form validation
class MaximumMortgageByIncome
{
    private bool $nhg = false;

    #[Deprecated]
    private bool $oldStudentLoanRegulation = false;

    private ?float $privateLeaseAmount = null;

    private int $privateLeaseDuration = 0;

    private ?\DateTime $privateLeaseBindingOfferDate = null;

    private ?int $duration = 360;

    #[Required]
    #[Assert\NotBlank]
    private ?float $percentage = null;

    private int $rateFixation = 10;

    private ?float $notDeductible = null;

    private ?float $groundRent = null;

    #[Assert\NotBlank(message: "You must at least set the income of 1 person")]
    #[Assert\Valid]
    private Person $person1;

    #[Assert\Valid]
    private ?Person $person2 = null;

    public function isNhg(): bool
    {
        return $this->nhg;
    }

    public function setNhg(bool $nhg): void
    {
        $this->nhg = $nhg;
    }

    public function isOldStudentLoanRegulation(): bool
    {
        return $this->oldStudentLoanRegulation;
    }

    public function setOldStudentLoanRegulation(bool $oldStudentLoanRegulation): void
    {
        $this->oldStudentLoanRegulation = $oldStudentLoanRegulation;
    }

    public function getPrivateLeaseAmount(): ?float
    {
        return $this->privateLeaseAmount;
    }

    public function setPrivateLeaseAmount(?float $privateLeaseAmount): void
    {
        $this->privateLeaseAmount = $privateLeaseAmount;
    }

    public function getPrivateLeaseDuration(): int
    {
        return $this->privateLeaseDuration;
    }

    public function setPrivateLeaseDuration(int $privateLeaseDuration): void
    {
        $this->privateLeaseDuration = $privateLeaseDuration;
    }

    public function getPrivateLeaseBindingOfferDate(): ?\DateTime
    {
        return $this->privateLeaseBindingOfferDate;
    }

    public function setPrivateLeaseBindingOfferDate(?\DateTime $privateLeaseBindingOfferDate): void
    {
        $this->privateLeaseBindingOfferDate = $privateLeaseBindingOfferDate;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    public function getPercentage(): ?float
    {
        return $this->percentage;
    }

    public function setPercentage(?float $percentage): void
    {
        $this->percentage = $percentage;
    }

    public function getRateFixation(): int
    {
        return $this->rateFixation;
    }

    public function setRateFixation(int $rateFixation): void
    {
        $this->rateFixation = $rateFixation;
    }

    public function getNotDeductible(): ?float
    {
        return $this->notDeductible;
    }

    public function setNotDeductible(?float $notDeductible): void
    {
        $this->notDeductible = $notDeductible;
    }

    public function getGroundRent(): ?float
    {
        return $this->groundRent;
    }

    public function setGroundRent(?float $groundRent): void
    {
        $this->groundRent = $groundRent;
    }

    public function getPerson1(): Person
    {
        return $this->person1;
    }

    public function setPerson1(Person $person1): void
    {
        $this->person1 = $person1;
    }

    public function getPerson2(): ?Person
    {
        return $this->person2;
    }

    public function setPerson2(?Person $person2): void
    {
        $this->person2 = $person2;
    }
}
