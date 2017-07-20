<?php
/**
 * Created by PhpStorm.
 * User: monika
 * Date: 17.07.17
 * Time: 15:58
 */

namespace AppBundle\Form;

use AppBundle\Entity\Rating;
use AppBundle\Entity\Website;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


/**
 * Class RatingType.
 *
 * @package AppBundle\Form
 */
class RatingType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add(
            'rating',
            RatingType::class, [
            'label' => 'Rating'
        ])
            ->add('save', SubmitType::class)
        ;

/**
        $ratings = array(
            'star1' => '1',
            'star2' => '2',
            'star3' => '3',
            'star4' => '4',
            'star5' => '5'
        );



        $builder->add(
            'name',
            'choice',
            array(
                'choices' => $ratings,

                'choices_as_values' => true,
                'multiple' => false,
                'expanded' => true

            )

        );

        $builder->add(
            'label',
            'choice',
            array(
                'choices' => $ratings,

                'choices_as_values' => true,
                'multiple' => false,
                'expanded' => true

            )
        );

        $builder->add(
            'heading',
            'choice',
            array(
                'choices' => $ratings,

                'choices_as_values' => true,
                'multiple' => false,
                'expanded' => true

            )
        );

        $builder->add(
            'paragraph',
            'choice',
            array(
                'choices' => $ratings,

                'choices_as_values' => true,
                'multiple' => false,
                'expanded' => true

            )
        );

        $builder->add(
            'keyword',
            'choice',
            array(
                'choices' => $ratings,

                'choices_as_values' => true,
                'multiple' => false,
                'expanded' => true

            )
        );*/

       /* $builder->add(
            'submit',
            array(
                'label' => 'Oceń'
                // 'attr' => array('class' => 'btn btn-success btn-save')
            )
        );*/

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Rating::class,
                'data_class' => Website::class,
                'validation_groups' => 'rating-default',
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'rating_type';
    }
}