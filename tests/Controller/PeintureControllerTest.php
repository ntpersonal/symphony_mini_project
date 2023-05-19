<?php

namespace App\Test\Controller;

use App\Entity\Peinture;
use App\Repository\PeintureRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PeintureControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private PeintureRepository $repository;
    private string $path = '/peinture/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Peinture::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Peinture index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'peinture[Nom]' => 'Testing',
            'peinture[largeur]' => 'Testing',
            'peinture[Hauteur]' => 'Testing',
            'peinture[en_vente]' => 'Testing',
            'peinture[prix]' => 'Testing',
            'peinture[date_realisation]' => 'Testing',
            'peinture[description]' => 'Testing',
            'peinture[listeCategoire]' => 'Testing',
        ]);

        self::assertResponseRedirects('/peinture/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Peinture();
        $fixture->setNom('My Title');
        $fixture->setLargeur('My Title');
        $fixture->setHauteur('My Title');
        $fixture->setEn_vente('My Title');
        $fixture->setPrix('My Title');
        $fixture->setDate_realisation('My Title');
        $fixture->setDescription('My Title');
        $fixture->setListeCategoire('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Peinture');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Peinture();
        $fixture->setNom('My Title');
        $fixture->setLargeur('My Title');
        $fixture->setHauteur('My Title');
        $fixture->setEn_vente('My Title');
        $fixture->setPrix('My Title');
        $fixture->setDate_realisation('My Title');
        $fixture->setDescription('My Title');
        $fixture->setListeCategoire('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'peinture[Nom]' => 'Something New',
            'peinture[largeur]' => 'Something New',
            'peinture[Hauteur]' => 'Something New',
            'peinture[en_vente]' => 'Something New',
            'peinture[prix]' => 'Something New',
            'peinture[date_realisation]' => 'Something New',
            'peinture[description]' => 'Something New',
            'peinture[listeCategoire]' => 'Something New',
        ]);

        self::assertResponseRedirects('/peinture/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getLargeur());
        self::assertSame('Something New', $fixture[0]->getHauteur());
        self::assertSame('Something New', $fixture[0]->getEn_vente());
        self::assertSame('Something New', $fixture[0]->getPrix());
        self::assertSame('Something New', $fixture[0]->getDate_realisation());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getListeCategoire());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Peinture();
        $fixture->setNom('My Title');
        $fixture->setLargeur('My Title');
        $fixture->setHauteur('My Title');
        $fixture->setEn_vente('My Title');
        $fixture->setPrix('My Title');
        $fixture->setDate_realisation('My Title');
        $fixture->setDescription('My Title');
        $fixture->setListeCategoire('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/peinture/');
    }
}
