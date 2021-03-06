<?php
declare(strict_types=1);

namespace Leviy\ReleaseTool\ReleaseAction;

use Leviy\ReleaseTool\Versioning\Version;

interface ReleaseAction
{
    /**
     * @param Version  $version
     * @param string[] $changeset
     *
     * @return void
     */
    public function execute(Version $version, array $changeset): void;
}
