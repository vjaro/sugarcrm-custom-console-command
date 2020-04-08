<?php
namespace Sugarcrm\Sugarcrm\custom\Console\Command;;

use Sugarcrm\Sugarcrm\Console\CommandRegistry\Mode\InstanceModeInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;

//Create the file in custom/src/Console/Command/CaseStatusCommand.php
class CaseStatusCommand extends Command implements InstanceModeInterface
{

    protected function configure()
    {
        $this
            ->setName('case:status')
            ->setDescription('Display the number of New, Assigned, and Resolved cases in the system.')
            ->setHelp('Display case statistics in the system.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $result = $this->getQuery()->execute();
        $table = new Table($output);
        $table->setHeaders(array("Status", "Count"));
        foreach ($result as $item) {
            $table->addRow(array($item["status"], $item["record_count"]));
        }

        $table->render();
    }

    protected function getQuery()
    {
        $q = new \SugarQuery();
        $q->from(\BeanFactory::getBean("Cases"));
        $q->select(array("status"))
            ->setCountQuery();
        $q->where()
            ->in("status", array("Pending", "Assigned", "Resolved"));
        $q->groupBy("status");

        return $q;
    }
}
