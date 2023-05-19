<?php

namespace App\Test\Controller;

use App\Entity\Catégoire;
use App\Repository\CatégoireRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CatégoireControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private CatégoireRepository $repository;
    private string $path = '/cat/goire/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Catégoire::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Catégoire index');

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
            'cat_goire[désingnation]' => 'Testing',
            'cat_goire[listePeintures]' => 'Testing',
        ]);

        self::assertResponseRedirects('/cat/goire/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Catégoire();
        $fixture->setDésingnation('My Title');
        $fixture->setListePeintures('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Catégoire');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Catégoire();
        $fixture->setDésingnation('My Title');
        $fixture->setListePeintures('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'cat_goire[désingnation]' => 'Something New',
            'cat_goire[listePeintures]' => 'Something New',
        ]);

        self::assertResponseRedirects('/cat/goire/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getDésingnation());
        self::assertSame('Something New', $fixture[0]->getListePeintures());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Catégoire();
        $fixture->setDésingnation('My Title');
        $fixture->setListePeintures('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/cat/goire/');
    }
}
