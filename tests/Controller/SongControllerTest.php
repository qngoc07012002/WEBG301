<?php

namespace App\Test\Controller;

use App\Entity\Song;
use App\Repository\SongRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SongControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private SongRepository $repository;
    private string $path = '/song/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Song::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Song index');

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
            'song[Name]' => 'Testing',
            'song[Price]' => 'Testing',
            'song[Song_URL]' => 'Testing',
            'song[Category]' => 'Testing',
            'song[Artist]' => 'Testing',
        ]);

        self::assertResponseRedirects('/song/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Song();
        $fixture->setName('My Title');
        $fixture->setPrice('My Title');
        $fixture->setSong_URL('My Title');
        $fixture->setCategory('My Title');
        $fixture->setArtist('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Song');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Song();
        $fixture->setName('My Title');
        $fixture->setPrice('My Title');
        $fixture->setSong_URL('My Title');
        $fixture->setCategory('My Title');
        $fixture->setArtist('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'song[Name]' => 'Something New',
            'song[Price]' => 'Something New',
            'song[Song_URL]' => 'Something New',
            'song[Category]' => 'Something New',
            'song[Artist]' => 'Something New',
        ]);

        self::assertResponseRedirects('/song/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getPrice());
        self::assertSame('Something New', $fixture[0]->getSong_URL());
        self::assertSame('Something New', $fixture[0]->getCategory());
        self::assertSame('Something New', $fixture[0]->getArtist());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Song();
        $fixture->setName('My Title');
        $fixture->setPrice('My Title');
        $fixture->setSong_URL('My Title');
        $fixture->setCategory('My Title');
        $fixture->setArtist('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/song/');
    }
}
