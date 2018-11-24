<?php

namespace App\TestBundle\DataFixtures\ORM;

use App\TestBundle\TestBundle;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\TestBundle\Entity\Question;

class LoadQuestionData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        // Test 1
        $test1_question1 = new Question();
        $test1_question1->setText('Как можно обращаться к методу класса?');
        $test1_question1->setType(TestBundle::$questionType['many']);
        $test1_question1->setTest($em->merge($this->getReference('test-1')));

        $test1_question2 = new Question();
        $test1_question2->setText('Какое слово требуется для указания реализации интерфейса классом?');
        $test1_question2->setType(TestBundle::$questionType['single']);
        $test1_question2->setTest($em->merge($this->getReference('test-1')));

        $test1_question3 = new Question();
        $test1_question3->setText('Какое ключевое слово нужно для объявления константы?');
        $test1_question3->setType(TestBundle::$questionType['text']);
        $test1_question3->setTest($em->merge($this->getReference('test-1')));

        // Test 2
        $test2_question1 = new Question();
        $test2_question1->setText('Каким тегом обрамляется тело страницы?');
        $test2_question1->setType(TestBundle::$questionType['text']);
        $test2_question1->setTest($em->merge($this->getReference('test-2')));

        $test2_question2 = new Question();
        $test2_question2->setText('Что не является строчным элементом?');
        $test2_question2->setType(TestBundle::$questionType['single']);
        $test2_question2->setTest($em->merge($this->getReference('test-2')));

        $test2_question3 = new Question();
        $test2_question3->setText('Какие теги относятся к таблицам?');
        $test2_question3->setType(TestBundle::$questionType['many']);
        $test2_question3->setTest($em->merge($this->getReference('test-2')));

        // Test 3
        $test3_question1 = new Question();
        $test3_question1->setText('Какой селектор указывает на div с индетификатором block?');
        $test3_question1->setType(TestBundle::$questionType['single']);
        $test3_question1->setTest($em->merge($this->getReference('test-3')));

        $test3_question2 = new Question();
        $test3_question2->setText('Какие значения position существуют?');
        $test3_question2->setType(TestBundle::$questionType['many']);
        $test3_question2->setTest($em->merge($this->getReference('test-3')));

        $test3_question3 = new Question();
        $test3_question3->setText('Какое значение нужно написать для подчёркивания строки (text-decoration)?');
        $test3_question3->setType(TestBundle::$questionType['text']);
        $test3_question3->setTest($em->merge($this->getReference('test-3')));

        $em->persist($test1_question1);
        $em->persist($test1_question2);
        $em->persist($test1_question3);

        $em->persist($test2_question1);
        $em->persist($test2_question2);
        $em->persist($test2_question3);

        $em->persist($test3_question1);
        $em->persist($test3_question2);
        $em->persist($test3_question3);

        $em->flush();

        $this->addReference('test-1-question-1', $test1_question1);
        $this->addReference('test-1-question-2', $test1_question2);
        $this->addReference('test-1-question-3', $test1_question3);

        $this->addReference('test-2-question-1', $test2_question1);
        $this->addReference('test-2-question-2', $test2_question2);
        $this->addReference('test-2-question-3', $test2_question3);

        $this->addReference('test-3-question-1', $test3_question1);
        $this->addReference('test-3-question-2', $test3_question2);
        $this->addReference('test-3-question-3', $test3_question3);
    }

    public function getOrder()
    {
        return 2;
    }
}