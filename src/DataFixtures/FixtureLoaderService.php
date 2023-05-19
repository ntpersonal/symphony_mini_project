<?php
// FixtureLoaderService.php

namespace App\Service;

use App\Factory\CatégoireFactory;
use App\Factory\CatégorieFactory;
use App\Factory\UserFactory;
use App\Factory\PersonneFactory;
use App\Factory\CommentaireFactory;
use App\Factory\PeintureFactory;
use Doctrine\Persistence\ObjectManager;
use Zenstruck\Foundry\Proxy;
use Doctrine\ORM\EntityManagerInterface;

class FixtureLoaderService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function loadFixtures(): void
    {
        // Create users
        $users = UserFactory::createMany(10);
        foreach ($users as $user) {
            $this->entityManager->persist($user instanceof Proxy ? $user->__subject() : $user);
        }

        // Create other entities
        $people = PersonneFactory::createMany(10);
        foreach ($people as $person) {
            $this->entityManager->persist($person instanceof Proxy ?$person->__subject():$person);
        }

        $comments = CommentaireFactory::createMany(10);
        foreach ($comments as $comment) {
            $this->entityManager->persist($comment instanceof Proxy ?$comment->__subject():$comment);
        }

        $paintings = PeintureFactory::createMany(10);
        foreach ($paintings as $painting) {
            $this->entityManager->persist($painting instanceof Proxy ?$painting->__proxySubject():$painting);
        }

        $categories = CatégoireFactory::createMany(10);
        foreach ($categories as $category) {
            $this->entityManager->persist($category instanceof Proxy ?$category->__subject():$category);
        }

        $this->entityManager->flush();
    }
}
