<?php

namespace App\Form\User;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class UserFormType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('baccalaureat', ChoiceType::class, [
                'choices' => [
                    'Scientifique' => 'Scientifique',
                    'Littéraire' => 'Littéraire',
                    'Economique' => 'Economique',
                    'Autre' => 'Autre',
                ],
                'placeholder' => 'Choisissez votre baccalaureat',
                'required' => true,
            ])
            ->add('candidaterAutresFormations', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'expanded' => true,
                'multiple' => false,
                'label' => 'Avez-vous candidater pour d\'autres formations ?',
                'required' => true,
            ])
            ->add('stageEntreprise', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'expanded' => true,
                'multiple' => false,
                'label' => 'Avez-vous déjà effectué un stage en entreprise ?',
            ])
            ->add('adresseDesParents')
            ->add('premierAnnee', ChoiceType::class, [
                'choices' => [
                    'L1 informatique' => 'L1 informatique',
                    'L1 scientifique : SPS, Chimie, Physique etc' => 'L1 scientifique : SPS, Chimie, Physique etc',
                    'Autre' => 'Autre',
                ],
                'placeholder' => 'Quelle est votre première année ? Si vous avez fait un BTS ou un DUT, selectionnez "Autre"',
                'required' => true,
            ])
            ->add('deuxiemeAnnee', ChoiceType::class, [
                'choices' => [
                    'L2 informatique' => 'L2 informatique',
                    'L2 scientifique : SPS, Chimie, Physique etc' => 'L2 scientifique : SPS, Chimie, Physique etc',
                    'Autre' => 'Autre',
                ],
                'placeholder' => 'Quelle est votre deuxième année ? Si vous avez fait un BTS ou un DUT, selectionnez "Autre"',
                'required' => true,
            ])
            ->add('diplomeObtenu', ChoiceType::class, [
                'choices' => [
                    'Baccalaureat' => 'Baccalaureat',
                    'CAP' => 'CAP',
                    'Licence' => 'Licence',
                    'Master' => 'Master',
                    'Doctorat' => 'Doctorat',
                ],
                'placeholder' => 'Quelle est le plus haut diplôme que vous avez pu obtenir ? Si vous avez fait un BTS ou un DUT, selectionnez "Autre"',
                'required' => true,
            ])

            ->add('etreBts', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'expanded' => true,
                'multiple' => false,
                'label' => 'Venez-vous de faire un BTS ou un DUT ?',
                'required' => true,
            ])
            ->add('contactEntreprise', TextEditorType::class, [
                'label' => 'Veuillez nous indiquer les différentes entreprises que vous avez pu contacter. Sinon, laissez ce champs vide.',
                'required' => false,

            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add("submit", SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }

}