<?php
declare(strict_types=1);
namespace App\Controller;

use App\Entity\User;
use App\Form\User\UserFormType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\IsTrue;

class UserController extends AbstractController
{
    /**
     * @Route("/formulaire/user", name="app_formulaire")
     */
    public function formulaire(FormFactoryInterface $factory, Request $request): Response
    {
        $builder = $factory->createBuilder();
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
            ->add("submit", SubmitType::class);
        $form = $builder->getForm();
        $form -> handleRequest($request);

        if($form->isSubmitted()){
            $data = $form->getData();
            // existing user
            $user = $this->getUser();
            $user->setBaccalaureat($data['baccalaureat']);
            $user->setCandidaterAutresFormations($data['candidaterAutresFormations']);
            $user->setStageEntreprise($data['stageEntreprise']);
            $user->setAdresseDesParents($data['adresseDesParents']);
            $user->setPremierAnnee($data['premierAnnee']);
            $user->setDeuxiemeAnnee($data['deuxiemeAnnee']);
            $user->setDiplomeObtenu($data['diplomeObtenu']);
            $user->setEtreBts($data['etreBts']);
            $user->setContactEntreprise($data['contactEntreprise']);

            $em = $this->getDoctrine()->getManager();

            try {
                $em->persist($user);
                $em->flush();
            } catch (OptimisticLockException $e) {
                return $this->render('user/index.html.twig', [
                    'form' => $form->createView(),
                    'error' => 'Une erreur est survenue lors de la mise à jour de vos informations. Veuillez réessayer.',
                ]);
            }
        }

        $formView = $form->createView();

        return $this->render('user/index.html.twig', [
            'formulaireForm' => $formView,
        ]);
    }



}
