<?php

namespace App\TestBundle\DataFixtures\ORM;

use App\TestBundle\TestBundle;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\TestBundle\Entity\Answer;


class LoadAnswerData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        // Test 1
        // Question 1 Как можно обращаться к методу класса?
        $test1_question1_answer1 = new Answer();
        $test1_question1_answer1->setText('ClassName::methodName()');
        $test1_question1_answer1->setCorrect(true);
        $test1_question1_answer1->setQuestion($em->merge($this->getReference('test-1-question-1')));

        $test1_question1_answer2 = new Answer();
        $test1_question1_answer2->setText('$classObj.methodName()');
        $test1_question1_answer2->setCorrect(false);
        $test1_question1_answer2->setQuestion($em->merge($this->getReference('test-1-question-1')));

        $test1_question1_answer3 = new Answer();
        $test1_question1_answer3->setText('$classObj->methodName()');
        $test1_question1_answer3->setCorrect(true);
        $test1_question1_answer3->setQuestion($em->merge($this->getReference('test-1-question-1')));

        // Question 2 Какое слово требуется для указания реализации интерфейса классом?
        $test1_question2_answer1 = new Answer();
        $test1_question2_answer1->setText('include');
        $test1_question2_answer1->setCorrect(false);
        $test1_question2_answer1->setQuestion($em->merge($this->getReference('test-1-question-2')));

        $test1_question2_answer2 = new Answer();
        $test1_question2_answer2->setText('implements');
        $test1_question2_answer2->setCorrect(true);
        $test1_question2_answer2->setQuestion($em->merge($this->getReference('test-1-question-2')));

        $test1_question2_answer3 = new Answer();
        $test1_question2_answer3->setText('extends');
        $test1_question2_answer3->setCorrect(false);
        $test1_question2_answer3->setQuestion($em->merge($this->getReference('test-1-question-2')));

        // Question 3 Какое ключевое слово нужно для объявления константы?
        $test1_question3_answer1 = new Answer();
        $test1_question3_answer1->setText('const');
        $test1_question3_answer1->setCorrect(true);
        $test1_question3_answer1->setQuestion($em->merge($this->getReference('test-1-question-3')));

        // Test 2
        // Question 1 Каким тегом обрамляется тело страницы?
        $test2_question1_answer1 = new Answer();
        $test2_question1_answer1->setText('body');
        $test2_question1_answer1->setCorrect(true);
        $test2_question1_answer1->setQuestion($em->merge($this->getReference('test-2-question-1')));

        // Question 2 Что не является строчным элементом?
        $test2_question2_answer1 = new Answer();
        $test2_question2_answer1->setText('span');
        $test2_question2_answer1->setCorrect(false);
        $test2_question2_answer1->setQuestion($em->merge($this->getReference('test-2-question-2')));

        $test2_question2_answer2 = new Answer();
        $test2_question2_answer2->setText('small');
        $test2_question2_answer2->setCorrect(false);
        $test2_question2_answer2->setQuestion($em->merge($this->getReference('test-2-question-2')));

        $test2_question2_answer3 = new Answer();
        $test2_question2_answer3->setText('div');
        $test2_question2_answer3->setCorrect(true);
        $test2_question2_answer3->setQuestion($em->merge($this->getReference('test-2-question-2')));

        // Question 3 Какие теги относятся к таблицам?
        $test2_question3_answer1 = new Answer();
        $test2_question3_answer1->setText('tbody');
        $test2_question3_answer1->setCorrect(true);
        $test2_question3_answer1->setQuestion($em->merge($this->getReference('test-2-question-3')));

        $test2_question3_answer2 = new Answer();
        $test2_question3_answer2->setText('td');
        $test2_question3_answer2->setCorrect(true);
        $test2_question3_answer2->setQuestion($em->merge($this->getReference('test-2-question-3')));

        $test2_question3_answer3 = new Answer();
        $test2_question3_answer3->setText('tt');
        $test2_question3_answer3->setCorrect(false);
        $test2_question3_answer3->setQuestion($em->merge($this->getReference('test-2-question-3')));

        // Test 3
        // Question 1 Какой селектор указывает на div с индетификатором block?
        $test3_question1_answer1 = new Answer();
        $test3_question1_answer1->setText('div.block');
        $test3_question1_answer1->setCorrect(false);
        $test3_question1_answer1->setQuestion($em->merge($this->getReference('test-3-question-1')));

        $test3_question1_answer2 = new Answer();
        $test3_question1_answer2->setText('div>#block');
        $test3_question1_answer2->setCorrect(false);
        $test3_question1_answer2->setQuestion($em->merge($this->getReference('test-3-question-1')));

        $test3_question1_answer3 = new Answer();
        $test3_question1_answer3->setText('div#block');
        $test3_question1_answer3->setCorrect(true);
        $test3_question1_answer3->setQuestion($em->merge($this->getReference('test-3-question-1')));

        // Question 2 Какие значения position существуют?
        $test3_question2_answer1 = new Answer();
        $test3_question2_answer1->setText('absolute');
        $test3_question2_answer1->setCorrect(true);
        $test3_question2_answer1->setQuestion($em->merge($this->getReference('test-3-question-2')));

        $test3_question2_answer2 = new Answer();
        $test3_question2_answer2->setText('top');
        $test3_question2_answer2->setCorrect(false);
        $test3_question2_answer2->setQuestion($em->merge($this->getReference('test-3-question-2')));

        $test3_question2_answer3 = new Answer();
        $test3_question2_answer3->setText('fixed');
        $test3_question2_answer3->setCorrect(true);
        $test3_question2_answer3->setQuestion($em->merge($this->getReference('test-3-question-2')));

        // Question 3 Какое значение нужно написать для подчёркивания строки (text-decoration)?
        $test3_question3_answer1 = new Answer();
        $test3_question3_answer1->setText('underline');
        $test3_question3_answer1->setCorrect(true);
        $test3_question3_answer1->setQuestion($em->merge($this->getReference('test-3-question-3')));

        $em->persist($test1_question1_answer1);
        $em->persist($test1_question1_answer2);
        $em->persist($test1_question1_answer3);
        $em->persist($test1_question2_answer1);
        $em->persist($test1_question2_answer2);
        $em->persist($test1_question2_answer3);
        $em->persist($test1_question3_answer1);
        $em->persist($test2_question1_answer1);
        $em->persist($test2_question2_answer1);
        $em->persist($test2_question2_answer2);
        $em->persist($test2_question2_answer3);
        $em->persist($test2_question3_answer1);
        $em->persist($test2_question3_answer2);
        $em->persist($test2_question3_answer3);
        $em->persist($test3_question1_answer1);
        $em->persist($test3_question1_answer2);
        $em->persist($test3_question1_answer3);
        $em->persist($test3_question2_answer1);
        $em->persist($test3_question2_answer2);
        $em->persist($test3_question2_answer3);
        $em->persist($test3_question3_answer1);

        $em->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}