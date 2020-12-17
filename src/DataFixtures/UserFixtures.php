<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setEmail("marcruel.ruel23@gmail.com");
        $userAdmin->setRoles(["ROLE_ADMIN"]);        
        $userAdmin->setPassword($this->passwordEncoder->encodePassword(
            $userAdmin,
            'admin'
        ));
        $manager->persist($userAdmin);

        // --------------------------------------------------------

        $user = new User();
        $user->setEmail("kuuroww@gmail.com");
        $user->setRoles(["ROLE_USER"]);        
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'user'
        ));
        $manager->persist($user);

        $manager->flush();
    }
}
