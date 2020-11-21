<?php

declare(strict_types=1);

namespace Patterns\Other\NullObject\Episode;

use Patterns\Other\NullObject\Character\Action\ActionInterface;

interface EpisodeInterface
{
    public function getDescription(): string;
    public function getAction(): ActionInterface;
}
