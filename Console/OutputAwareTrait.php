<?php

namespace Sweikenb\Symfony\Helper\Console;

use Symfony\Component\Console\Formatter\OutputFormatterInterface;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;

trait OutputAwareTrait
{
    /**
     * @var \Symfony\Component\Console\Output\OutputInterface|null
     */
    protected ?OutputInterface $output = null;

    /**
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return $this
     */
    public function setOutput(OutputInterface $output): self
    {
        $this->output = $output;

        return $this;
    }

    /**
     * @return \Symfony\Component\Console\Output\OutputInterface
     */
    protected function getOutput(): OutputInterface
    {
        if (!$this->output) {
            $this->output = new ConsoleOutput();
        }

        return $this->output;
    }

    /**
     * Writes a message to the output.
     *
     * @param string|iterable $messages The message as an iterable of strings or a single string
     * @param bool $newline Whether to add a newline
     * @param int $options A bitmask of options (one of the OUTPUT or VERBOSITY constants), 0 is considered the same as self::OUTPUT_NORMAL | self::VERBOSITY_NORMAL
     */
    protected function write($messages, bool $newline = false, int $options = 0)
    {
        $this->getOutput()->write($messages, $newline, $options);
    }

    /**
     * Writes a message to the output and adds a newline at the end.
     *
     * @param string|iterable $messages The message as an iterable of strings or a single string
     * @param int $options A bitmask of options (one of the OUTPUT or VERBOSITY constants), 0 is considered the same as self::OUTPUT_NORMAL | self::VERBOSITY_NORMAL
     */
    protected function writeln($messages, int $options = 0)
    {
        $this->getOutput()->writeln($messages, $options);
    }

    /**
     * Sets the verbosity of the output.
     *
     * @param int $level
     */
    public function setVerbosity(int $level): void
    {
        $this->getOutput()->setVerbosity($level);
    }

    /**
     * Gets the current verbosity of the output.
     *
     * @return int The current level of verbosity (one of the VERBOSITY constants)
     */
    public function getVerbosity(): int
    {
        return (int)$this->getOutput()->getVerbosity();
    }

    /**
     * Returns whether verbosity is quiet (-q).
     *
     * @return bool true if verbosity is set to VERBOSITY_QUIET, false otherwise
     */
    public function isQuiet(): bool
    {
        return (bool)$this->getOutput()->isQuiet();
    }

    /**
     * Returns whether verbosity is verbose (-v).
     *
     * @return bool true if verbosity is set to VERBOSITY_VERBOSE, false otherwise
     */
    public function isVerbose(): bool
    {
        return (bool)$this->getOutput()->isVerbose();
    }

    /**
     * Returns whether verbosity is very verbose (-vv).
     *
     * @return bool true if verbosity is set to VERBOSITY_VERY_VERBOSE, false otherwise
     */
    public function isVeryVerbose(): bool
    {
        return (bool)$this->getOutput()->isVeryVerbose();
    }

    /**
     * Returns whether verbosity is debug (-vvv).
     *
     * @return bool true if verbosity is set to VERBOSITY_DEBUG, false otherwise
     */
    public function isDebug(): bool
    {
        return (bool)$this->getOutput()->isDebug();
    }

    /**
     * Sets the decorated flag.
     *
     * @param bool $decorated
     */
    public function setDecorated(bool $decorated): void
    {
        $this->getOutput()->setDecorated($decorated);
    }

    /**
     * Gets the decorated flag.
     *
     * @return bool true if the output will decorate messages, false otherwise
     */
    public function isDecorated(): bool
    {
        return (bool)$this->getOutput()->isDecorated();
    }

    /**
     * @param \Symfony\Component\Console\Formatter\OutputFormatterInterface $formatter
     */
    public function setFormatter(OutputFormatterInterface $formatter): void
    {
        $this->getOutput()->setFormatter($formatter);
    }

    /**
     * Returns current output formatter instance.
     *
     * @return OutputFormatterInterface
     */
    public function getFormatter(): OutputFormatterInterface
    {
        return $this->getOutput()->getFormatter();
    }
}