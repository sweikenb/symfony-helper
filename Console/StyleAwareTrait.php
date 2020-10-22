<?php

namespace Sweikenb\Symfony\Helper\Console;

use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\StyleInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

trait StyleAwareTrait
{
    /**
     * @var \Symfony\Component\Console\Style\StyleInterface|null
     */
    protected ?StyleInterface $style = null;

    /**
     * @param \Symfony\Component\Console\Style\StyleInterface $style
     *
     * @return $this
     */
    public function setStyle(StyleInterface $style): self
    {
        $this->style = $style;

        return $this;
    }

    /**
     * @return \Symfony\Component\Console\Style\StyleInterface
     */
    protected function getStyle(): StyleInterface
    {
        if (!$this->style) {
            $input = null;
            if (method_exists($this, 'getInput')) {
                $input = $this->getInput();
            }
            if (!$input || !$input instanceof InputInterface) {
                $input = new ArgvInput();
            }

            $output = null;
            if (method_exists($this, 'getOutput')) {
                $output = $this->getOutput();
            }
            if (!$output || !$output instanceof OutputInterface) {
                $output = new ConsoleOutput();
            }

            $this->style = new SymfonyStyle($input, $output);
        }

        return $this->style;
    }

    /**
     * @param string $message
     */
    public function title(string $message): void
    {
        $this->getStyle()->title($message);
    }

    /**
     * Formats a section title.
     *
     * @param string $message
     */
    public function section(string $message): void
    {
        $this->getStyle()->section($message);
    }

    /**
     * Formats a list.
     *
     * @param array $elements
     */
    public function listing(array $elements): void
    {
        $this->getStyle()->listing($elements);
    }

    /**
     * Formats informational text.
     *
     * @param string|array $message
     */
    public function text($message): void
    {
        $this->getStyle()->text($message);
    }

    /**
     * Formats a success result bar.
     *
     * @param string|array $message
     */
    public function success($message): void
    {
        $this->getStyle()->success($message);
    }

    /**
     * Formats an error result bar.
     *
     * @param string|array $message
     */
    public function error($message): void
    {
        $this->getStyle()->error($message);
    }

    /**
     * Formats an warning result bar.
     *
     * @param string|array $message
     */
    public function warning($message): void
    {
        $this->getStyle()->warning($message);
    }

    /**
     * Formats a note admonition.
     *
     * @param string|array $message
     */
    public function note($message): void
    {
        $this->getStyle()->note($message);
    }

    /**
     * Formats a caution admonition.
     *
     * @param string|array $message
     */
    public function caution($message): void
    {
        $this->getStyle()->caution($message);
    }

    /**
     * Formats a table.
     *
     * @param array $headers
     * @param array $rows
     */
    public function table(array $headers, array $rows): void
    {
        $this->getStyle()->table($headers, $rows);
    }

    /**
     * Asks a question.
     *
     * @param string $question
     * @param string|null $default
     * @param callable|null $validator
     *
     * @return mixed
     */
    public function ask(string $question, ?string $default = null, callable $validator = null)
    {
        return $this->getStyle()->ask($question, $default, $validator);
    }

    /**
     * Asks a question with the user input hidden.
     *
     * @param string $question
     * @param callable|null $validator
     *
     * @return mixed
     */
    public function askHidden(string $question, callable $validator = null)
    {
        return $this->getStyle()->askHidden($question, $validator);
    }

    /**
     * Asks for confirmation.
     *
     * @param string $question
     * @param bool $default
     *
     * @return bool
     */
    public function confirm(string $question, bool $default = true): bool
    {
        return (bool)$this->getStyle()->confirm($question, $default);
    }

    /**
     * Asks a choice question.
     *
     * @param string $question
     * @param array $choices
     * @param string|int|null $default
     *
     * @return mixed
     */
    public function choice(string $question, array $choices, $default = null)
    {
        return $this->getStyle()->choice($question, $choices, $default);
    }

    /**
     * Add newline(s).
     *
     * @param int $count
     */
    public function newLine(int $count = 1): void
    {
        $this->getStyle()->newLine($count);
    }

    /**
     * Starts the progress output.
     *
     * @param int $max
     */
    public function progressStart(int $max = 0): void
    {
        $this->getStyle()->progressStart($max);
    }

    /**
     * Advances the progress output X steps.
     *
     * @param int $step
     */
    public function progressAdvance(int $step = 1): void
    {
        $this->getStyle()->progressAdvance($step);
    }

    /**
     * Finishes the progress output.
     */
    public function progressFinish(): void
    {
        $this->getStyle()->progressFinish();
    }
}
