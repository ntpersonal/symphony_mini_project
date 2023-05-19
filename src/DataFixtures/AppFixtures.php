<?php
// AppFixtures.php

namespace App\DataFixtures;

use App\Service\FixtureLoaderService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
private FixtureLoaderService $loader;

public function __construct(FixtureLoaderService $loader)
{
    $this->loader = $loader;
}

public function load(ObjectManager $manager): void
{
    $this->loader->loadFixtures();
}
}