<?php

namespace SprykerCommunity\Zed\CustomerOrderSearch\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use SprykerCommunity\Zed\CustomerOrderSearch\Business\CustomerOrderSearchFacadeInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

/**
 * Console command to publish orders into Elasticsearch.
 *
 * Usage:
 *   - Publish all orders:  console order:search:publish
 *   - Publish specific IDs: console order:search:publish 1 2 3
 *
 * @method CustomerOrderSearchFacadeInterface getFacade()
 */
class CustomerOrderSearchPublishConsole extends Console
{
    protected const COMMAND_NAME = 'order:search:publish';
    protected const COMMAND_DESCRIPTION = 'Publishes orders to Elasticsearch (all or specific IDs).';

    protected const ARG_ORDER_IDS = 'order-ids';

    protected function configure(): void
    {
        $this
            ->setName(static::COMMAND_NAME)
            ->setDescription(static::COMMAND_DESCRIPTION)
            ->addArgument(
                static::ARG_ORDER_IDS,
                InputArgument::IS_ARRAY | InputArgument::OPTIONAL,
                'List of order IDs to publish (leave empty for full publish).'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var array<int> $orderIds */
        $orderIds = $input->getArgument(static::ARG_ORDER_IDS);

        if (empty($orderIds)) {
            $output->writeln('');
            $output->writeln('<fg=red;options=bold>WARNING: You are about to publish ALL orders to Elasticsearch!</>');
            $output->writeln('<comment>This may take a long time and put load on your system.</comment>');
            $output->writeln('');

            $helper = $this->getHelper('question');
            $question = new ConfirmationQuestion(
                '<question>Do you really want to continue? [y/N]</question> ',
                false
            );

            if (!$helper->ask($input, $output, $question)) {
                $output->writeln('<comment>Aborted by user.</comment>');
                return static::CODE_SUCCESS;
            }

            $this->getFacade()->publishOrders();
        } else {
            $output->writeln(sprintf(
                '<info>Publishing %d orders to Elasticsearch: %s</info>',
                count($orderIds),
                implode(', ', $orderIds)
            ));

            $this->getFacade()->publishOrders($orderIds);
        }

        $output->writeln('<info>Done.</info>');
        return static::CODE_SUCCESS;
    }
}
