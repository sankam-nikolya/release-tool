<?php
declare(strict_types=1);

namespace Leviy\ReleaseTool\Versioning;

use InvalidArgumentException;
use function preg_match;
use function sprintf;

/**
 * See https://semver.org/
 */
final class SemanticVersion
{
    /**
     * @var int
     */
    private $major;

    /**
     * @var int
     */
    private $minor;

    /**
     * @var int
     */
    private $patch;

    public function __construct(int $major, int $minor, int $patch)
    {
        $this->major = $major;
        $this->minor = $minor;
        $this->patch = $patch;
    }

    public static function createFromVersionString(string $version): self
    {
        if (!preg_match('$(\d+)\.(\d+)\.(\d+)$', $version, $matches)) {
            throw new InvalidArgumentException(
                sprintf('Version number "%s" is not a valid semantic version.', $version)
            );
        }

        return new self((int) $matches[1], (int) $matches[2], (int) $matches[3]);
    }

    public function incrementPatchVersion(): self
    {
        $clone = clone $this;
        $clone->patch++;

        return $clone;
    }

    public function incrementMinorVersion(): self
    {
        $clone = clone $this;
        $clone->patch = 0;
        $clone->minor++;

        return $clone;
    }

    public function incrementMajorVersion(): self
    {
        $clone = clone $this;
        $clone->patch = $clone->minor = 0;
        $clone->major++;

        return $clone;
    }

    public function getVersion(): string
    {
        return sprintf('%d.%d.%d', $this->major, $this->minor, $this->patch);
    }

    public function getMajorVersion(): int
    {
        return $this->major;
    }

    public function getMinorVersion(): int
    {
        return $this->minor;
    }

    public function getPatchVersion(): int
    {
        return $this->patch;
    }
}
