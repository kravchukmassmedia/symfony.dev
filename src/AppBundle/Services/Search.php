<?php

namespace AppBundle\Services;

use Symfony\Component\Finder\Finder;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class: Search
 *
 */
class Search
{
    /**
     * container
     *
     * @var mixed
     */
    private $container;

    /**
     * __construct
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * findFileByContent
     *
     * @param string $keyword
     *
     * @return mixed
     */
    public function findFileByContent($keyword) {
        $ds = DIRECTORY_SEPARATOR;
        $dir = $this->container->getParameter('kernel.root_dir') . $ds . '..' . $ds . 'web';// directory can be changed

        if($keyword){
            $finder = new Finder();
            $finder->in($dir)
                ->ignoreUnreadableDirs()
                ->contains('/' . $keyword . '/iu')
                ->depth('<5')
//                ->size('<1g')
                ->files();
            // functionality can be extended depending on the task, but max-file-size must be less than memory_limit
        }else{
            $finder = null;
        }
        return $finder;
    }

}
