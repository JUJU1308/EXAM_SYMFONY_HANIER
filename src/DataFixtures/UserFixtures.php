<?php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->  setEmail('admin@deloitte.com');
        $user->  setPassword('admin123@');
        $user-> setRoles(['ADMIN']);
        $manager->persist($user);
        $manager->flush();
    }
}
