<?php

namespace AppBundle\Command;

use AppBundle\Entity\Brand;
use AppBundle\Entity\Model;
use AppBundle\Service\AutoAPI;
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

    /**
     * @var AutoAPI
     */
    private $autoApi;


    protected function configure()
    {
        $this
            ->setName('app:insert')
            ->setDescription('Saves data to DB from API.')
            ->addArgument('type', InputArgument::OPTIONAL, 'Type: (brand|model)');
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->entityManager = $this->getContainer()->get('doctrine')->getManager();
        $this->autoApi = $this->getContainer()->get('app.auto_api');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $type = $input->getArgument('type');
        if (!in_array($type, ['brand', 'model'])){

            $output->writeln('Wrong type!');
            return;
        }

        if ($type === 'brand') {
            $data = json_decode($this->autoApi->getBrands(), true);

            foreach ($data as $row) {
                $id = $row['brand_id'];
                $title = $row['brand_name'];

                $brand = new Brand();
                $brand->setBrandId($id);
                $brand->setTitle($title);

                $this->entityManager->persist($brand);
                $this->entityManager->flush();
            }
        } else if ($type === 'model') {
            $data = json_decode($this->autoApi->getModels(), true);

            foreach ($data as $brand_id => $models){

                foreach ($models as $model){
                    $row = new Model();
                    $row->setBrandId($brand_id);
                    $row->setModelId($model['model_id']);
                    $row->setTitle($model['model_name']);

                    $this->entityManager->persist($row);
                    $this->entityManager->flush();

                }

            }

        }

        $output->writeln('Finished!');
    }

}
