<?php

namespace App\Factory;

use App\Entity\Peinture;
use App\Repository\PeintureRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Peinture>
 *
 * @method        Peinture|Proxy create(array|callable $attributes = [])
 * @method static Peinture|Proxy createOne(array $attributes = [])
 * @method static Peinture|Proxy find(object|array|mixed $criteria)
 * @method static Peinture|Proxy findOrCreate(array $attributes)
 * @method static Peinture|Proxy first(string $sortedField = 'id')
 * @method static Peinture|Proxy last(string $sortedField = 'id')
 * @method static Peinture|Proxy random(array $attributes = [])
 * @method static Peinture|Proxy randomOrCreate(array $attributes = [])
 * @method static PeintureRepository|RepositoryProxy repository()
 * @method static Peinture[]|Proxy[] all()
 * @method static Peinture[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Peinture[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Peinture[]|Proxy[] findBy(array $attributes)
 * @method static Peinture[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Peinture[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class PeintureFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'Hauteur' => self::faker()->randomFloat(),
            'Nom' => self::faker()->text(15),
            'date_realisation' => self::faker()->dateTime(),
            'description' => self::faker()->text(),
            'en_vente' => self::faker()->boolean(),
            'largeur' => self::faker()->randomFloat(),
            'prix' => self::faker()->randomFloat(),

            'listeCategoire' => CatégoireFactory::randomOrCreate(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Peinture $peinture): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Peinture::class;
    }
    public function createMany(int $count, array $attributes = []): array
    {
        return parent::createMany($count, $attributes + [
            'Hauteur' => self::faker()->randomFloat(),
            'Nom' => self::faker()->text(15),
            'date_realisation' => self::faker()->dateTime(),
            'description' => self::faker()->text(),
            'en_vente' => self::faker()->boolean(),
            'largeur' => self::faker()->randomFloat(),
            'prix' => self::faker()->randomFloat(),
            'listeCategoire' => CatégoireFactory::new()->createMany(3),
            // ... autres attributs
        ]);
    }
}
