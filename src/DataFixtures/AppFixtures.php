<?php

namespace App\DataFixtures;

use App\Entity\Course;
use App\Entity\Lesson;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private $courses = [
        [
            'name'=> 'Информационная безопасность',
            'description'=> 'Основы информационной безопасности',
            'code'=> 'information_security',
            'lessons'=> [
                [
                    'name'=>'Криптография',
                    'description' => 'Основы криптографии',
                    'sort'=>1
                ],
                [
                    'name'=>'Антивирусы',
                    'description' => 'Необходимое ПО для защиты от троянов',
                    'sort'=>2
                ]
            ]
        ]
    ];
    public function load(ObjectManager $manager): void
    {
        foreach ($this->courses as $course){
            $courseEntity = new Course();
            $courseEntity->setName($course['name']);
            $courseEntity->setDescription($course['description']);
            $courseEntity->setCode($course['code']);
            $manager->persist($courseEntity);
            $manager->flush();
            foreach ($course['lessons'] as $lesson){
                $entityLesson = new Lesson();
                $entityLesson->setName($lesson['name']);
                $entityLesson->setCourse($courseEntity);
                $entityLesson->setSort($lesson['sort']);
                $entityLesson->setDescription($lesson['description']);
                $manager->persist($entityLesson);
            }
            $manager->flush();
        }

    }
}
