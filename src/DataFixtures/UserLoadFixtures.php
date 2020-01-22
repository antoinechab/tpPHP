<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserLoadFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // Add super admin user
        $users_super_admin = [
            [
                'username' => "antoine",
                'email' => 'antoine@net15.com',
                'roles' => ['ROLE_USER', 'ROLE_ADMIN']
            ]
        ];

        foreach ($users_super_admin as $user_admin){
        $user = new User();
        $user->hydrate($user_admin);
        $passWord = $this->encoder->encodePassword($user, "root");
        $user->setPassword($passWord);
        $manager->persist($user);
        }
        $manager->flush();
    }
}
