<?php

namespace App\Controller;

use App\registration;
use App\Entity\Adresse;
use App\Entity\User;
use App\Form\adressFormType;
use App\Form\RegistrationFormType;
use App\Security\UserAuthAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, UserAuthAuthenticator $authenticator): Response
    {
        $allData = new registration();
        $form = $this->createForm(RegistrationFormType::class, $allData);
        $form->handleRequest($request);

        $adresse = new Adresse();
        $user = new User();
//        $formadresse = $this->createForm(adressFormType::class, $adresse);
//        $formadresse->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() ) {
            // encode the plain password
            $user->setEmail($allData->getEmail());
            $user->setBirthdate($allData->getBirthdate());
            $user->setCin($allData->getCin());
            $user->setFullname($allData->getFullname());
//            $user->setPassword($allData->getPassword());
            $user->setTelephone($allData->getTelephone());
            $user->setUsername($allData->getUsername());

            $adresse->setNumeroDeResidance($allData->getNumeroDeResidance());
            $adresse->setPays($allData->getPays());
            $adresse->setQuartier($allData->getQuartier());
            $adresse->setVille($allData->getVille());
            $adresse->setZipcode($allData->getZipcode());
            $adresse->setUser($user);


            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->persist($adresse);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }



        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),

        ]);
    }
}
