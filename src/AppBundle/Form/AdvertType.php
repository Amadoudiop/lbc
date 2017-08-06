<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Image;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
//use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

use Symfony\Component\HttpFoundation\File\File;
//use Symfony\Component\Validator\Constraints\File;

class AdvertType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('category', EntityType::class, [
                    'class' => 'AppBundle:Category',
                    'choice_label' => 'name',
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ])
                ->add('title')
                ->add('description')
                ->add('published')
                ->add('price')
                ->add('city', EntityType::class, [
                    'class' => 'AppBundle:City',
                    'choice_label' => 'name',
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ])
                ->add('images', CollectionType::class, [
                    'entry_type'   => ImageType::class,
                    'allow_add' => true,
                    //'prototype' => true,
                    //'prototype_data' => 'New Tag Placeholder',
                    'entry_options' => [
                        //'attr' => ['class' => 'file-box'],
                        //'constraints' => [
                        //    new File(['maxSize' => '10k']),
                        //],
                    ],
                ])
                /*->add('images', ImageType::class,[
                    'data_class' => null
                    ])*/
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Advert'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_advert';
    }


}
