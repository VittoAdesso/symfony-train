<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{

    #[Route(path: '/register', name: 'register')]
    public function newUser(Request $request, EntityManagerInterface $em, 
    UserPasswordHasherInterface $passwordHasher)

    {
        $form = $this->createForm(UserType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        $user = $form->getData();
        $user->setPassword($passwordHasher->hashPassword($user, $user->getPassword()));
   
        $user->setRoles(['ROLE_USER']);
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('app_login');
        }
        return $this->renderForm('/users/createuser.html.twig', ['userForm' => $form]);         
    }

    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
      
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    }
