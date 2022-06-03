<?php

namespace App\Test\Controller;

use App\Entity\Warrior;
use App\Repository\WarriorRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WarriorControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private WarriorRepository $repository;
    private string $path = '/warrior/old/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Warrior::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Warrior index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'warrior[name]' => 'Testing',
            'warrior[description]' => 'Testing',
            'warrior[Experience]' => 'Testing',
            'warrior[Strength]' => 'Testing',
            'warrior[Speed]' => 'Testing',
            'warrior[Dexterity]' => 'Testing',
            'warrior[Constitution]' => 'Testing',
            'warrior[Intelligence]' => 'Testing',
            'warrior[Will]' => 'Testing',
            'warrior[victories]' => 'Testing',
            'warrior[loss]' => 'Testing',
            'warrior[Coach]' => 'Testing',
            'warrior[FightStyle]' => 'Testing',
            'warrior[Breed]' => 'Testing',
            'warrior[skills]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Warrior();
        $fixture->setName('My Title');
        $fixture->setDescription('My Title');
        $fixture->setExperience('My Title');
        $fixture->setStrength('My Title');
        $fixture->setSpeed('My Title');
        $fixture->setDexterity('My Title');
        $fixture->setConstitution('My Title');
        $fixture->setIntelligence('My Title');
        $fixture->setWill('My Title');
        $fixture->setVictories('My Title');
        $fixture->setLoss('My Title');
        $fixture->setCoach('My Title');
        $fixture->setFightStyle('My Title');
        $fixture->setBreed('My Title');
        $fixture->setSkills('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Warrior');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Warrior();
        $fixture->setName('My Title');
        $fixture->setDescription('My Title');
        $fixture->setExperience('My Title');
        $fixture->setStrength('My Title');
        $fixture->setSpeed('My Title');
        $fixture->setDexterity('My Title');
        $fixture->setConstitution('My Title');
        $fixture->setIntelligence('My Title');
        $fixture->setWill('My Title');
        $fixture->setVictories('My Title');
        $fixture->setLoss('My Title');
        $fixture->setCoach('My Title');
        $fixture->setFightStyle('My Title');
        $fixture->setBreed('My Title');
        $fixture->setSkills('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'warrior[name]' => 'Something New',
            'warrior[description]' => 'Something New',
            'warrior[Experience]' => 'Something New',
            'warrior[Strength]' => 'Something New',
            'warrior[Speed]' => 'Something New',
            'warrior[Dexterity]' => 'Something New',
            'warrior[Constitution]' => 'Something New',
            'warrior[Intelligence]' => 'Something New',
            'warrior[Will]' => 'Something New',
            'warrior[victories]' => 'Something New',
            'warrior[loss]' => 'Something New',
            'warrior[Coach]' => 'Something New',
            'warrior[FightStyle]' => 'Something New',
            'warrior[Breed]' => 'Something New',
            'warrior[skills]' => 'Something New',
        ]);

        self::assertResponseRedirects('/warrior/old/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getExperience());
        self::assertSame('Something New', $fixture[0]->getStrength());
        self::assertSame('Something New', $fixture[0]->getSpeed());
        self::assertSame('Something New', $fixture[0]->getDexterity());
        self::assertSame('Something New', $fixture[0]->getConstitution());
        self::assertSame('Something New', $fixture[0]->getIntelligence());
        self::assertSame('Something New', $fixture[0]->getWill());
        self::assertSame('Something New', $fixture[0]->getVictories());
        self::assertSame('Something New', $fixture[0]->getLoss());
        self::assertSame('Something New', $fixture[0]->getCoach());
        self::assertSame('Something New', $fixture[0]->getFightStyle());
        self::assertSame('Something New', $fixture[0]->getBreed());
        self::assertSame('Something New', $fixture[0]->getSkills());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Warrior();
        $fixture->setName('My Title');
        $fixture->setDescription('My Title');
        $fixture->setExperience('My Title');
        $fixture->setStrength('My Title');
        $fixture->setSpeed('My Title');
        $fixture->setDexterity('My Title');
        $fixture->setConstitution('My Title');
        $fixture->setIntelligence('My Title');
        $fixture->setWill('My Title');
        $fixture->setVictories('My Title');
        $fixture->setLoss('My Title');
        $fixture->setCoach('My Title');
        $fixture->setFightStyle('My Title');
        $fixture->setBreed('My Title');
        $fixture->setSkills('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/warrior/old/');
        self::assertSame(0, $this->repository->count([]));
    }
}
