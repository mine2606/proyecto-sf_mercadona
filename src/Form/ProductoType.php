<?php

namespace App\Form;

use App\Entity\Categoria;
use App\Entity\Producto;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;

class ProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nombre')
            ->add('Precio')
            ->add('Descripcion')
            ->add('url')
            ->add('categoria',EntityType::class,array(
                'class' => Categoria::class,
                'choice_label' => function ($categoria) {
                    return $categoria->getNombre();
            }))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Producto::class,
        ]);
    }
}
