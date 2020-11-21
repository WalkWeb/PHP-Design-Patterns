<?php

declare(strict_types=1);

namespace Patterns\Other\NullObject\Episode;

use Patterns\Other\NullObject\Character\Action\ActionInterface;

class Episode implements EpisodeInterface
{
    /**
     * @var string
     */
    private $description;

    /**
     * @var ActionInterface
     */
    private $action;

    public function __construct(string $description, ActionInterface $action)
    {
        $this->description = $description;
        $this->action = $action;
    }

    public function getAction(): ActionInterface
    {
        return $this->action;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
