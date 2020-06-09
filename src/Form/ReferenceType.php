<?php

namespace App\Form;

use App\Entity\Reference;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ReferenceType
 * @package App\Form
 */
class ReferenceType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("title", TextType::class, [
                "label" => "Intitulé de votre poste",
                "attr" => [
                    "placeholder" => "Entrez l'intitulé de votre poste..."
                ]
            ])
            ->add("company", TextType::class, [
                "label" => "Nom de l'entreprise",
                "attr" => [
                    "placeholder" => "Entrez le nom de l'entreprise..."
                ]
            ])
            ->add("description", TextareaType::class, [
                "label" => "Description de l'expérience pro",
                "attr" => [
                    "placeholder" => "Entrez la description de votre expérience..."
                ]
            ])
            ->add("startedAt", DateType::class, [
                "label" => "Début",
                "input" => "datetime_immutable",
                "widget" => "single_text"
            ])
            ->add("endedAt", DateType::class, [
                "label" => "Fin",
                "input" => "datetime_immutable",
                "widget" => "single_text",
                "required" => false
            ])
            ->add("medias", CollectionType::class, [
                "entry_type" => MediaType::class,
                "entry_options" => [
                    "label" => false,
                ],
                "allow_add" => true,
                "allow_delete" => true,
                "by_reference" => false
            ])
        ;
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault("data_class", Reference::class);
    }
}
