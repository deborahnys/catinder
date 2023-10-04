<?php

namespace App\EntityListener;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsEntityListener(event: Events::prePersist, method: 'encodePassword', entity: User::class)]
#[AsEntityListener(event: Events::preUpdate, method: 'encodePassword', entity: User::class)]
class UserListener
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    public function encodePassword(User $user)
    {
        if ($user->getPlainPassword() === null) {
            return;
        }

        $user->setPassword(
            $this->hasher->hashPassword(
                $user,
                $user->getPlainPassword()
            )
        );
    }
}
