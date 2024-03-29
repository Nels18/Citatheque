<?php

namespace App\Factory;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Author>
 *
 * @method static Author|Proxy createOne(array $attributes = [])
 * @method static Author[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Author[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Author|Proxy find(object|array|mixed $criteria)
 * @method static Author|Proxy findOrCreate(array $attributes)
 * @method static Author|Proxy first(string $sortedField = 'id')
 * @method static Author|Proxy last(string $sortedField = 'id')
 * @method static Author|Proxy random(array $attributes = [])
 * @method static Author|Proxy randomOrCreate(array $attributes = [])
 * @method static Author[]|Proxy[] all()
 * @method static Author[]|Proxy[] findBy(array $attributes)
 * @method static Author[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Author[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static AuthorRepository|RepositoryProxy repository()
 * @method Author|Proxy create(array|callable $attributes = [])
 */
final class AuthorFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'lastName' => self::faker()->name(),
            'firstName' => self::faker()->name(),
            'createdAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Author $author): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Author::class;
    }
}
