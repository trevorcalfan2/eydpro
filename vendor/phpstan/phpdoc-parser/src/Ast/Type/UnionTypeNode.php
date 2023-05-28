<?php declare(strict_types = 1);

namespace PHPStan\PhpDocParser\Ast\Type;

use PHPStan\PhpDocParser\Ast\NodeAttributes;
use function implode;

class UnionTypeNode implements TypeNode
{

	use NodeAttributes;

	/** @var TypeNode[] */
	public $types;

	/**
	 * @param TypeNode[] $types
	 */
	public function __construct(array $types)
	{
		$this->types = $types;
	}


	public function __toString(): string
	{
		return '(' . implode(' | ', $this->types) . ')';
	}

}
