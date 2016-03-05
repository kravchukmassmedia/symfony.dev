<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class FindfileCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('findfile')
            ->setDescription("Search file by it's content")
            ->addArgument('keyword', InputArgument::REQUIRED, 'Search keyword')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $keyword = $input->getArgument('keyword');
        $results = $this->getContainer()->get('search')->findFileByContent($keyword);
        if(count($results) > 0){
            $output->writeln('Search command results:');
            foreach($results as $file){
                $output->writeln('File name - '.$file->getFilename());
                $output->writeln('File real path - '.$file->getRealPath());
                $output->writeln('');
            }
        }else{
            $output->writeln('No results... type another keyword');
        }
    }

}
