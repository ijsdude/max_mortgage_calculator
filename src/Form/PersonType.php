<?php declare(strict_types=1);

namespace App\Form;

use App\DTO\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('income');
        $builder->add('age');
        $builder->add('dateOfBirth');
        $builder->add('alimony');
        $builder->add('loans');
        $builder->add('studentLoans');
        $builder->add('studentLoanStartDate');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => Person::class,
            ]
        );
    }
}
