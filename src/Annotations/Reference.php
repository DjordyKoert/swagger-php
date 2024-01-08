<?php declare(strict_types=1);

/**
 * @license Apache 2.0
 */

namespace OpenApi\Annotations;

use OpenApi\Generator;

/**
 * @see [OAI Security Scheme Object](https://github.com/OAI/OpenAPI-Specification/blob/main/versions/3.1.0.md#reference-object).
 *
 * @Annotation
 */
class Reference extends AbstractAnnotation
{
    /**
     * @see [Using refs](https://swagger.io/docs/specification/using-ref/)
     *
     * @var string|class-string|object
     */
    public $ref = Generator::UNDEFINED;

    /**
     * A short summary which overrides that of the referenced component.
     * If the referenced object-type does not allow a summary field, then this field has no effect.
     *
     * @see [Added in OpenApi 3.1.0](https://github.com/OAI/OpenAPI-Specification/blob/main/versions/3.1.0.md#reference-object)
     *
     * @var string
     */
    public $summary = Generator::UNDEFINED;

    /**
     * A short description which overrides that of the referenced component.
     * If the referenced object-type does not allow a description field, then this field has no effect.
     *
     * @see [Added in OpenApi 3.1.0](https://github.com/OAI/OpenAPI-Specification/blob/main/versions/3.1.0.md#reference-object)
     *
     * @var string
     */
    public $description = Generator::UNDEFINED;

    /**
     * @inheritdoc
     */
    public static $_types = [
        'summary' => 'string',
        'description' => 'string',
    ];

    /**
     * Allows to type-hint a specific parent annotation class.
     *
     * Container to allow custom annotations that are limited to a subset of potential parent
     * annotation classes.
     *
     * @return array<class-string>|null List of valid parent annotation classes. If `null`, the default nesting rules apply.
     */
    public function allowedParents(): ?array
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function validate(array $stack = [], array $skip = [], string $ref = '', $context = null): bool
    {
        $valid = parent::validate($stack, $skip, $ref, $context);

        if (Generator::isDefault($this->ref)) {
            $this->_context->logger->warning($this->identity() . ' Ref is required');
            $valid = false;
        }

        if (!$this->_context->root()->isVersion(OpenApi::VERSION_3_1_0)) {
            if (!Generator::isDefault($this->summary)) {
                $this->_context->logger->warning($this->identity() . ' Summary property is only supported in OpenAPI 3.1.0');
                $valid = false;
            }

            if (!Generator::isDefault($this->description)) {
                $this->_context->logger->warning($this->identity() . ' Description property is only supported in OpenAPI 3.1.0');
                $valid = false;
            }
        }

        return $valid;
    }
}
