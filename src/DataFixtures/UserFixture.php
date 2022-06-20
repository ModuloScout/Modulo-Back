<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Enum\Gender;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserFixture extends GeneratedFixture
{
    public const REFERENCE_NAME = User::class;
    public const MAX_COUNT = 100;
    private const DEFAULT_PASSWORD = 'password';

    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
        string                                       $locale
    )
    {
        parent::__construct($locale);
    }

    protected function generate(): User
    {
        $user = new User();
        $user->setEmail($this->faker->email())
            ->setLastName($this->faker->lastName())
            ->setPassword($this->passwordHasher->hashPassword($user, self::DEFAULT_PASSWORD))
            ->setGenre($this->faker->boolean() ? Gender::Men : Gender::Woman)
            ->setFirstName(
                $user->getGenre() === Gender::Men ? $this->faker->firstNameMale() : $this->faker->firstNameFemale()
            );

        return $user;
    }
}
