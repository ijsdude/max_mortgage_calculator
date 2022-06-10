<?php declare(strict_types=1);

namespace App\Form;

use App\DTO\MaximumMortgageByIncome;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaximumMortgageByIncomeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('nhg');
        $builder->add('privateLeaseAmount');
        $builder->add('privateLeaseDuration');
        $builder->add('privateLeaseBindingOfferDate');
        $builder->add('duration');
        $builder->add('percentage');
        $builder->add('rateFixation');
        $builder->add('notDeductible');
        $builder->add('groundRent');
        $builder->add('person1', PersonType::class);
        $builder->add('person2', PersonType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => MaximumMortgageByIncome::class,
            ]
        );
    }
}
