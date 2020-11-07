<?php

declare(strict_types=1);

namespace Patterns\NullObject\Episode;

use Patterns\NullObject\Character\Action\ActionInterface;

interface EpisodeInterface
{
    public function getDescription(): string;
    public function getAction(): ActionInterface;
}
