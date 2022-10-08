<?php

namespace App\DataFixtures;

use App\Factory\AuthorFactory;
use App\Factory\CategoryFactory;
use App\Factory\QuoteFactory;
use App\Factory\ReportFactory;
use App\Factory\UserFactory;
use DateTime;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        UserFactory::createOne([
            'name' => 'admin',
            'password' => '$2y$13$jqjyZ6Yb6nsJHgLeqGJope.LkQMkJoTtX40sASWraxSLR88tmv44q',
            'role' => ['ROLE_ADMIN'],
            'createdAt' => DateTimeImmutable::createFromMutable(new DateTime()),
        ]);
        UserFactory::createMany(2,
        function() { // note the callback - this ensures that each of the 5 comments has a different Post
            return [
                'role' => ['ROLE_USER'],
            ]; // each comment set to a random Post from those already in the database
        });
        AuthorFactory::createMany(5);
        CategoryFactory::createMany(6);
        QuoteFactory::createMany(15,
        function() { // note the callback - this ensures that each of the 5 comments has a different Post
            return [
                'author' => AuthorFactory::random(),
                'category' => CategoryFactory::random(),
                'createdBy' => UserFactory::random()
            ]; // each comment set to a random Post from those already in the database
        });
        ReportFactory::createMany(3,
            function() { // note the callback - this ensures that each of the 5 comments has a different Post
                return [
                    'quote' => QuoteFactory::random(),
                    'user' => UserFactory::random()
                ]; // each comment set to a random Post from those already in the database
            });

        $manager->flush();
    }
}
