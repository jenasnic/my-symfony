<?php

namespace App\DataFixtures;

use App\Entity\MyModel;
use App\Enum\MyEnum;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MyModelFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $value = 0;
        foreach (MyEnum::cases() as $code) {

            $myModel = new MyModel();
            $myModel->setCode($code);
            $myModel->setLabel($code->name.' label');
            $myModel->setValue(++$value);
            $myModel->setDate(new DateTime('+'.$value.' days'));

            $manager->persist($myModel);
        }

        $manager->flush();
    }
}
