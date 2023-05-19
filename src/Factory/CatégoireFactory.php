<?php
// CatégoireFactory.php

namespace App\Factory;

use App\Entity\Catégoire;
use App\Repository\CatégoireRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Catégoire>
 *
 * @method        Catégoire|Proxy create(array|callable $attributes = [])
 * @method static Catégoire|Proxy createOne(array $attributes = [])
 * @method static Catégoire|Proxy find(object|array|mixed $criteria)
 * @method static Catégoire|Proxy findOrCreate(array $attributes)
 * @method static Catégoire|Proxy first(string $sortedField = 'id')
 * @method static Catégoire|Proxy last(string $sortedField = 'id')
 * @method static Catégoire|Proxy random(array $attributes = [])
 * @method static Catégoire|Proxy randomOrCreate(array $attributes = [])
 * @method static CatégoireRepository|RepositoryProxy repository()
 * @method static Catégoire[]|Proxy[] all()
 * @method static Catégoire[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Catégoire[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Catégoire[]|Proxy[] findBy(array $attributes)
 * @method static Catégoire[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Catégoire[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class CatégoireFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'désignation' => self::faker()->text(20),
            'listePeintures' => PeintureFactory::randomOrCreate(),
        ];
    }

    protected function initialize(): self
    {
        return $this->afterInstantiate(function(Catégoire $catégorie) {
            foreach ($catégorie->getListePeintures() as $peinture) {
                $catégorie->addListePeinture($peinture);
            }
        });
    }

    protected static function getClass(): string
    {
        return Catégoire::class;
    }

    public function createMany(int $count, array $attributes = []): array
    {
        return parent::createMany($count, $attributes + [
            'désignation' => self::faker()->text(20),
            'listePeintures' => PeintureFactory::new()->createMany(3),
        ]);
    }
}
