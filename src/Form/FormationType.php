<?php

namespace App\Form;

use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FormationType
 * @package App\Form
 */
class FormationType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("name", TextType::class, [
                "label" => "Nom de la formation",
                "attr" => [
                    "placeholder" => "Entrez le nom de votre formation..."
                ]
            ])
            ->add("school", TextType::class, [
                "label" => "Nom de l'école",
                "attr" => [
                    "placeholder" => "Entrez le nom de l'école..."
                ]
            ])
            ->add("gradeLevel", ChoiceType::class, [
                "label" => "Niveau d'étude",
                "choices" => [
                    "BAC" => 0,
                    "BAC+1" => 1,
                    "BAC+2" => 2,
                    "BAC+3" => 3,
                    "BAC+4" => 4,
                    "BAC+5" => 5,
                    "BAC+8" => 8
                ]
            ])
            ->add("description", TextareaType::class, [
                "label" => "Description de la formation",
                "attr" => [
                    "placeholder" => "Entrez la description de votre formation..."
                ]
            ])
            ->add("startedAt", DateType::class, [
                "label" => "Début de la formation",
                "input" => "datetime_immutable",
                "widget" => "single_text"
            ])
            ->add("endedAt", DateType::class, [
                "label" => "Fin de la formation",
                "input" => "datetime_immutable",
                "widget" => "single_text",
                "required" => false
            ])
        ;
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault("data_class", Formation::class);
    }
}
