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
        $test1->setImage('https://cdn.pixabay.com/photo/2018/04/05/23/30/nature-3294543_1280.jpg');

        // Test 2
        $test2 = new Test();
        $test2->setName('Основы HTML');
        $test2->setDescription('Тест на знание тегов HTML');
        $test2->setImage('https://cdn.pixabay.com/photo/2018/11/07/23/51/chess-3801531_1280.jpg');

        // Test 3
        $test3 = new Test();
        $test3->setName('Основы CSS');
        $test3->setDescription('Разбираемся с CSS');
        $test3->setImage('https://cdn.pixabay.com/photo/2014/09/24/14/29/mac-459196_1280.jpg');

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