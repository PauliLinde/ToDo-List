<?php

namespace App\Tests\Controller;

use App\Entity\Action;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    private $client;
    private $entityManager;

    protected function setUp():void {
        parent::setUp();
        $this->client = static::createClient();
        $this->entityManager = $this->client->getContainer()->get('doctrine.orm.entity_manager');
    }


    protected static function getKernelClass(): string
    {
        return \App\Kernel::class;
    }

    public function testGetActions(): void
    {
        $action1 = new Action();
        $action2 = new Action();

        $action1->setAction("Buy milk");
        $action1->setDueDate(new \DateTime("2025-07-12"));
        $action2->setAction("Go to gym");
        $action2->setDueDate(new \DateTime("2025-06-30"));

        $this->entityManager->persist($action1);
        $this->entityManager->persist($action2);
        $this->entityManager->flush();

        $crawler = $this->client->request('GET', '/actions');

        $actions = $this->entityManager->getRepository(Action::class)->findAll();

        $this->assertResponseIsSuccessful();
        $this->assertStringContainsString('Buy milk', $this->client->getResponse()->getContent());
        $this->assertCount(2, $actions);
        $this->assertSelectorTextContains('h2', 'My todo-list');
    }

    public function testAddAction(): void{
        $crawler = $this->client->request('GET', '/actions/add');
        $form = $crawler->selectButton('Submit me')->form();

        $form['action[action]'] = 'Cut grass';
        $form['action[dueDate]'] = '2025-06-17';

        $this->client->submit($form);

        $this->assertResponseRedirects('/actions');

        $this->client->followRedirect();
        $this->assertResponseIsSuccessful();
        $this->assertStringContainsString('Cut grass', $this->client->getResponse()->getContent());
    }

    public function testEditAction(): void{
        $action = new Action();
        $action->setAction('Grocery shopping');
        $action->setDueDate(new \DateTime('2025-06-01'));

        $this->entityManager->persist($action);
        $this->entityManager->flush();

        $id = $action->getId();

        $crawler = $this->client->request('GET', "/actions/edit/$id");
        $form = $crawler->selectButton('Submit me')->form();

        $form['action[action]'] = 'Cut hair';
        $form['action[dueDate]'] = '2025-06-12';

        $this->client->submit($form);

        $this->assertResponseRedirects('/actions');

        $this->client->followRedirect();
        $this->assertResponseIsSuccessful();
        $this->assertStringContainsString('Cut hair', $this->client->getResponse()->getContent());
    }

    public function testRemoveAction(): void{
        $action = new Action();
        $action->setAction('Pick up from school');
        $action->setDueDate(new \DateTime('2025-06-15'));

        $this->entityManager->persist($action);
        $this->entityManager->flush();

        $id = $action->getId();

        $crawler = $this->client->request('GET', "/actions/remove/$id");

        $this->assertResponseRedirects('/actions');

        $this->client->followRedirect();
        $this->assertResponseIsSuccessful();
        $this->assertStringNotContainsString('Pick up from school', $this->client->getResponse()->getContent());
    }

    protected function tearDown(): void
    {
        $actions = $this->entityManager->getRepository(Action::class)->findAll();

        foreach ($actions as $action) {
            $this->entityManager->remove($action);
        }

        $this->entityManager->flush();
        parent::tearDown();
    }



    //C:\xampp\php\php.exe vendor/bin/phpunit --configuration phpunit.xml tests/Controller/PostControllerTest.php
}
