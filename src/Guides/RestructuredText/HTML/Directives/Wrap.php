<?php

declare(strict_types=1);

namespace phpDocumentor\Guides\RestructuredText\HTML\Directives;

use phpDocumentor\Guides\Nodes\Node;
use phpDocumentor\Guides\Nodes\RawNode;
use phpDocumentor\Guides\RestructuredText\Directives\SubDirective;
use phpDocumentor\Guides\RestructuredText\Parser;
use function uniqid;

/**
 * Wraps a sub document in a div with a given class
 */
class Wrap extends SubDirective
{
    public function getName() : string
    {
        return 'note';
    }

    /**
     * @param string[] $options
     */
    public function processSub(
        Parser $parser,
        ?Node $document,
        string $variable,
        string $data,
        array $options
    ) : ?Node {
        $id = uniqid('note', true);

        $environment = $parser->getEnvironment();

        return new RawNode(
            function () use ($id, $environment, $document) {
                $environment->getRenderer()->render(
                    'div.html.twig',
                    [
                        'id' => $id,
                        'class' => 'note',
                        'node' => $document,
                    ]
                );
            }
        );
    }
}
