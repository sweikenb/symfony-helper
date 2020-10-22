<?php

namespace Sweikenb\Symfony\Helper\Console;

use Symfony\Component\Console\Exception\RuntimeException;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;

trait InputAwareTrait
{
    /**
     * @var \Symfony\Component\Console\Input\InputInterface|null
     */
    protected ?InputInterface $input = null;

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $output
     *
     * @return $this
     */
    public function setInput(InputInterface $output): self
    {
        $this->input = $output;

        return $this;
    }

    /**
     * @return \Symfony\Component\Console\Input\InputInterface
     */
    protected function getInput(): InputInterface
    {
        if (!$this->input) {
            $this->input = $input = new ArgvInput();
        }

        return $this->input;
    }

    /**
     * Returns the first argument from the raw parameters (not parsed).
     *
     * @return string|null The value of the first argument or null otherwise
     */
    public function getFirstArgument(): ?string
    {
        return $this->getInput()->getFirstArgument();
    }

    /**
     * Returns true if the raw parameters (not parsed) contain a value.
     *
     * This method is to be used to introspect the input parameters
     * before they have been validated. It must be used carefully.
     * Does not necessarily return the correct result for short options
     * when multiple flags are combined in the same option.
     *
     * @param string|array $values The values to look for in the raw parameters (can be an array)
     * @param bool $onlyParams Only check real parameters, skip those following an end of options (--) signal
     *
     * @return bool true if the value is contained in the raw parameters
     */
    public function hasParameterOption($values, bool $onlyParams = false): bool
    {
        return (bool)$this->getInput()->hasParameterOption($values, $onlyParams);
    }

    /**
     * Returns the value of a raw option (not parsed).
     *
     * This method is to be used to introspect the input parameters
     * before they have been validated. It must be used carefully.
     * Does not necessarily return the correct result for short options
     * when multiple flags are combined in the same option.
     *
     * @param string|array $values The value(s) to look for in the raw parameters (can be an array)
     * @param mixed $default The default value to return if no result is found
     * @param bool $onlyParams Only check real parameters, skip those following an end of options (--) signal
     *
     * @return mixed The option value
     */
    public function getParameterOption($values, $default = false, bool $onlyParams = false)
    {
        return $this->getInput()->getParameterOption($values, $default, $onlyParams);
    }

    /**
     * Binds the current Input instance with the given arguments and options.
     *
     * @param \Symfony\Component\Console\Input\InputDefinition $definition
     */
    public function bind(InputDefinition $definition): void
    {
        $this->getInput()->bind($definition);
    }

    /**
     * Validates the input.
     *
     * @throws RuntimeException When not enough arguments are given
     */
    public function validate(): void
    {
        $this->getInput()->validate();
    }

    /**
     * Returns all the given arguments merged with the default values.
     *
     * @return array
     */
    public function getArguments(): array
    {
        return (array)$this->getInput()->getArguments();
    }

    /**
     * Returns the argument value for a given argument name.
     *
     * @param string $name
     *
     * @return string|string[]|null The argument value
     */
    public function getArgument(string $name)
    {
        return $this->getInput()->getArgument($name);
    }

    /**
     * Sets an argument value by name.
     *
     * @param string $name
     * @param string|string[]|null $value The argument value
     *
     */
    public function setArgument(string $name, $value): void
    {
        $this->getInput()->setArgument($name, $value);
    }

    /**
     * Returns true if an InputArgument object exists by name or position.
     *
     * @param string|int $name The InputArgument name or position
     *
     * @return bool true if the InputArgument object exists, false otherwise
     */
    public function hasArgument($name): bool
    {
        return (bool)$this->getInput()->hasArgument($name);
    }

    /**
     * Returns all the given options merged with the default values.
     *
     * @return array
     */
    public function getOptions(): array
    {
        return (array)$this->getInput()->getOptions();
    }

    /**
     * Returns the option value for a given option name.
     *
     * @param string $name
     *
     * @return string|string[]|bool|null The option value
     *
     */
    public function getOption(string $name)
    {
        return $this->getInput()->getOption($name);
    }

    /**
     * Sets an option value by name.
     *
     * @param string $name
     * @param string|string[]|bool|null $value The option value
     *
     */
    public function setOption(string $name, $value): void
    {
        $this->getInput()->setOption($name, $value);
    }

    /**
     * Returns true if an InputOption object exists by name.
     *
     * @param string $name
     *
     * @return bool true if the InputOption object exists, false otherwise
     */
    public function hasOption(string $name): bool
    {
        return (bool)$this->getInput()->hasOption($name);
    }

    /**
     * Is this input means interactive?
     *
     * @return bool
     */
    public function isInteractive(): bool
    {
        return (bool)$this->getInput()->isInteractive();
    }

    /**
     * Sets the input interactivity.
     *
     * @param bool $interactive
     */
    public function setInteractive(bool $interactive): void
    {
        $this->getInput()->setInteractive($interactive);
    }
}
