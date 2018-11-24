<?php

namespace App\TestBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\TestBundle\Entity\Test;

class LoadTestData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        // Test 1
        $test1 = new Test();
        $test1->setName('Знание снов PHP');
        $test1->setDescription('В этом тесте представлены вопросы на знание стандартных конструкций языка PHP');

        // Test 2
        $test2 = new Test();
        $test2->setName('Основы HTML');
        $test2->setDescription('Тест на знание тегов HTML');

        // Test 3
        $test3 = new Test();
        $test3->setName('Основы CSS');
        $test3->setDescription('Разбираемся с CSS');

        $em->persist($test1);
        $em->persist($test2);
        $em->persist($test3);

        $em->flush();

        $this->addReference('test-1', $test1);
        $this->addReference('test-2', $test2);
        $this->addReference('test-3', $test3);
    }

    public function getOrder()
    {
        return 1;
    }
}