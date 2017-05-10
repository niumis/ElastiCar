<?php

namespace AppBundle\Command;

use AppBundle\Entity\Brand;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AppInsertCommand extends ContainerAwareCommand
{
    /**
     * @var ObjectManager
     */
    private $entityManager;

    private $brand_json;

    protected function configure()
    {
        $this
            ->setName('app:insert')
            ->setDescription('Issaugo duomenis i DB is API')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description');
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->entityManager = $this->getContainer()->get('doctrine')->getManager();
        $this->brand_json = $this->getContainer()->get('app.auto_api')->getBrands();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $argument = $input->getArgument('argument');

        $data = json_decode($this->brand_json, true);

        foreach ($data as $row) {
            $id = $row['brand_id'];
            $title = $row['brand_name'];

            $brand = new Brand();
            $brand->setBrandId($id);
            $brand->setTitle($title);

            $this->entityManager->persist($brand);
            $this->entityManager->flush();
        }


        if ($input->getOption('option')) {
            // ...
        }

        $output->writeln('Komanda sekminga.');
    }

}
