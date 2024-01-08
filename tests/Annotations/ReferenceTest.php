<?php declare(strict_types=1);

/**
 * @license Apache 2.0
 */

namespace OpenApi\Tests\Annotations;

use OpenApi\Tests\OpenApiTestCase;

class ReferenceTest extends OpenApiTestCase
{
    public function testRefIsNotSet(): void
    {
        $annotations = $this->annotationsFromDocBlockParser('@OA\Reference()');
        $this->assertOpenApiLogEntryContains('@OA\Reference() $ref property is required');
        $annotations[0]->validate();
    }

    public function testSummaryIsSetOnIncorrectVersion(): void
    {
        $annotations = $this->annotationsFromDocBlockParser('@OA\Reference(ref="#/components/schemas/Example", summary="Example")');
        $this->assertOpenApiLogEntryContains('@OA\Reference() $summary property is only supported in OpenAPI 3.1.0');
        $annotations[0]->validate();
    }

    public function testSummaryIsSetOnCorrectVersion(): void
    {
        $annotations = $this->annotationsFromDocBlockParser('@OA\Reference(ref="#/components/schemas/Example", summary="Example")');
        $annotations[0]->_context->version = '3.1.0';

        $annotations[0]->validate();
    }

    public function testDescriptionIsSetOnIncorrectVersion(): void
    {
        $annotations = $this->annotationsFromDocBlockParser('@OA\Reference(ref="#/components/schemas/Example", description="Example")');
        $this->assertOpenApiLogEntryContains('@OA\Reference() $description property is only supported in OpenAPI 3.1.0');
        $annotations[0]->validate();
    }

    public function testDescriptionIsSetOnCorrectVersion(): void
    {
        $annotations = $this->annotationsFromDocBlockParser('@OA\Reference(ref="#/components/schemas/Example", description="Example")');
        $annotations[0]->_context->version = '3.1.0';

        $annotations[0]->validate();
    }
}
