<?php

namespace App\DataFixtures;

use App\Entity\Credential;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class CredentialFixture extends GeneratedFixture implements DependentFixtureInterface
{
    public const REFERENCE_NAME = Credential::class;
    public const MAX_COUNT = 10;

    public function getDependencies(): array
    {
        return [FeatureFixture::class, RoleFixture::class];
    }

    protected function generate(): Credential
    {
        return (new Credential())
            ->setFeature($this->getReference('feature_' . random_int(0, 9)))
            ->setRole($this->getRandomRef(RoleFixture::class));
    }

}
