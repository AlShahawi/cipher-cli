<?php

namespace Cipher\Console;

use Cipher\CipherFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;

class CipherCommand extends Command
{
    /**
     * @var string|null The default command name
     */
    protected static $defaultName = 'cipher';

    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $help = 'This command allows you to ecrypt or decrypt a given string with different encryption implementations.';

        $this
            ->setDescription('Encrypt/Decrypt a string.')
            ->setHelp($help);
    }

    /**
     * Executes the current command.
     *
     * @param  InputInterface  $input
     * @param  OutputInterface  $output
     * @return int|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Keep asking to encrypt/decrypt until the user exit.
        while (true) {
            $this->askForEncryptOrDecrypt($input, $output);
        }
    }

    /**
     * @param  InputInterface  $input
     * @param  OutputInterface  $output
     * @throws \Exception
     */
    private function askForEncryptOrDecrypt(InputInterface $input, OutputInterface $output): void
    {
        $cipherFactory = new CipherFactory;

        $helper = $this->getHelper('question');

        $stringQuestion = new Question("<question>Enter a string:</question>\n");
        $stringQuestion->setValidator(function ($string) {
            if (is_null($string)) {
                throw new \RuntimeException(
                    'The string to be encrypted/decrypted cannot be empty.'
                );
            }

            return $string;
        });
        $string = $helper->ask($input, $output, $stringQuestion);

        $algorithmQuestion = new ChoiceQuestion(
            '<question>Please select algorithm:</question>',
            array_keys($cipherFactory->getCiphers()),
            0
        );
        $algorithm = $helper->ask($input, $output, $algorithmQuestion);

        $methodQuestion = new ChoiceQuestion(
            '<question>Please select method:</question>',
            ['encrypt', 'decrypt'],
            0
        );
        $method = $helper->ask($input, $output, $methodQuestion);

        $cipher = $cipherFactory->makeCipher($algorithm);
        $result = $cipher->{$method}($string);

        $output->writeln('<info>Result:</info> '.$result);
    }
}
