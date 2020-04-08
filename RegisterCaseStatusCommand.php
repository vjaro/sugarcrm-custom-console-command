<?php
//define in custom/Extension/application/Ext/Console/RegisterCaseStatusCommand.php
Sugarcrm\Sugarcrm\Console\CommandRegistry\CommandRegistry::getInstance()
    ->addCommand(new Sugarcrm\Sugarcrm\custom\Console\Command\CaseStatusCommand())
;

