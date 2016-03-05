<?php

use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use AppBundle\Command\FindfileCommand;

class FindfileCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        $kernel = $this->createKernel();
        $kernel->boot();

        $application = new Application($kernel);
        $application->add(new FindfileCommand());

        $command = $application->find('findfile');
        $commandTester = new CommandTester($command);
        $commandTester->execute(
            array('keyword'    => 'qwe')
        );
        $this->assertRegExp('/Search command results/', $commandTester->getDisplay());

        $commandTester = new CommandTester($command);
        $commandTester->execute(
            array('keyword'    => 'asdasdasdasdasd')
        );
        $this->assertRegExp('/No results/', $commandTester->getDisplay());
    }
}