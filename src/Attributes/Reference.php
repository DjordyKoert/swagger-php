<?php declare(strict_types=1);

/**
 * @license Apache 2.0
 */

namespace OpenApi\Attributes;

use OpenApi\Generator;

#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_METHOD | \Attribute::TARGET_PROPERTY | \Attribute::IS_REPEATABLE)]
class Reference extends \OpenApi\Annotations\Reference
{
    /**
     * @param string|class-string|object|null $ref
     * @param string|null                     $summary
     * @param string|null                     $description
     * @param array<string,mixed>|null        $x
     */
    public function __construct(
        string|object|null $ref = null,
        ?string $summary = null,
        ?string $description = null,
        ?array $x = null,
    ) {
        parent::__construct([
            'ref' => $ref ?? Generator::UNDEFINED,
            'summary' => $summary ?? Generator::UNDEFINED,
            'description' => $description ?? Generator::UNDEFINED,
        ]);
    }
}
