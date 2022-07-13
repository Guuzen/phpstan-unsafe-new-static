<?php

namespace Guuzen\PhpstanUnsafeNewStatic;

/**
 * @psalm-immutable
 */
abstract class Uuid
{
    /**
     * @var string
     */
    protected $id;

    final public function __construct(string $id)
    {
        if (!\Ramsey\Uuid\Uuid::isValid($id)) {
            throw new \RuntimeException(\sprintf('invalid uuid: %s', $id));
        }

        $this->id = $id;
    }

    final public static function new(): static
    {
        return new static(\Ramsey\Uuid\Uuid::uuid4()->toString());
    }

    /**
     * @template T of static
     * @psalm-param T $uuid
     */
    final public function equals($uuid): bool
    {
        return $this->id === $uuid->id;
    }

    final public function __toString(): string
    {
        return $this->id;
    }
}
