<?php declare(strict_types=1);

namespace App\DTO;

use JetBrains\PhpStorm\Deprecated;
use Symfony\Contracts\Service\Attribute\Required;
use Symfony\Component\Validator\Constraints as Assert;

// TODO:: Add more assertions for form validation
class Person
{
    #[Required]
    #[Assert\NotBlank]
    private float $income;

    #[Deprecated]
    private int $age = 18;

    private ?\DateTime $dateOfBirth = null;

    private ?float $alimony = null;

    private ?float $loans = null;

    private ?float $studentLoans = null;

    private ?\DateTime $studentLoanStartDate = null;

    public function getIncome(): float
    {
        return $this->income;
    }

    public function setIncome(float $income): void
    {
        $this->income = $income;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): void
    {
        $this->age = $age;
    }

    public function getDateOfBirth(): ?\DateTime
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(?\DateTime $dateOfBirth): void
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getAlimony(): ?float
    {
        return $this->alimony;
    }

    public function setAlimony(?float $alimony): void
    {
        $this->alimony = $alimony;
    }

    public function getLoans(): ?float
    {
        return $this->loans;
    }

    public function setLoans(?float $loans): void
    {
        $this->loans = $loans;
    }

    public function getStudentLoans(): ?float
    {
        return $this->studentLoans;
    }

    public function setStudentLoans(?float $studentLoans): void
    {
        $this->studentLoans = $studentLoans;
    }

    public function getStudentLoanStartDate(): ?\DateTime
    {
        return $this->studentLoanStartDate;
    }

    public function setStudentLoanStartDate(?\DateTime $studentLoanStartDate): void
    {
        $this->studentLoanStartDate = $studentLoanStartDate;
    }
}
