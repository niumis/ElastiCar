<?php

namespace AppBundle\Command;

use AppBundle\Entity\Auto;
use AppBundle\Service\AutoAPI;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AppCrawlCommand extends ContainerAwareCommand
{
    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * @var AutoAPI
     */
    private $autoApi;


    protected function configure()
    {
        $this
            ->setName('app:crawl')
            ->setDescription('Crawls and saves car ads based on Watchlist entries.');
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->em = $this->getContainer()->get('doctrine')->getManager();
        $this->autoApi = $this->getContainer()->get('app.auto_api');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Starting crawler...');
        $em = $this->getEm();
        $autoApi = $this->getAutoApi();

        $watchlistRepository = $em->getRepository('AppBundle:Watchlist');
        $autoRepository = $em->getRepository('AppBundle:Auto');

        $queries = $watchlistRepository
            ->findAll();

        if (!empty($queries)) {
            $output->writeln('Executing queries...');

            /*
            $map = array();
            foreach($a as $val) $map[$val] = 1;
            foreach($b as $val) unset($map[$val]);
            var_dump(array_keys($map));
            */

            foreach ($queries as $query) {
                $brandId = $query->getBrandId();
                $modelId = $query->getModelId();
                $email = $query->getEmail();
                $watchlistId = $query->getId();

                $ads = json_decode($autoApi->getAds($brandId, $modelId));
                $oldAds = $this
                    ->em
                    ->getRepository('AppBundle:Auto')
                    ->findByWatchlistId($watchlistId, ['adId'], 200);

                $output->writeln('Found ' . count($ads) . ' ads for ' . $email . '.');

                $uniqueIds = $this->getUniqueIds($ads, $oldAds);

                $i = 0;
                foreach ($ads as $ad) {
                    if (!in_array($ad->id, $uniqueIds)) {
                        continue;
                    }

                    $adCreatedAt = new \DateTime();
                    $adCreatedAt = $adCreatedAt->setTimestamp($ad->inserted_on);

                    $newAd = new Auto();
                    $newAd->setWebUrl($ad->url);
                    $newAd->setImageUrl($ad->img_url);
                    $newAd->setMileage($ad->mileage);
                    $newAd->setPower($ad->power);
                    $newAd->setPrice($ad->price);
                    $newAd->setYear($ad->year);
                    $newAd->setGearbox($ad->gearbox);
                    $newAd->setCity($ad->city);
                    $newAd->setTitle($ad->title);
                    $newAd->setFuel($ad->fuel);
                    $newAd->setWatchlistId($watchlistId);
                    $newAd->setAdId($ad->id);
                    $newAd->setAdCreatedAt($adCreatedAt);

                    $this->em->persist($newAd);
                }

                $this->em->flush();
                $this->em->clear();

                $output->writeln('Inserted ' . count($uniqueIds) . ' new ads.');
            }
        } else {
            $output->writeln('No queries found.');
        }

        $output->writeln('Finished crawler.');
    }

    /**
     * @param $watchlistId
     * @param $ads
     * @return array
     */
    private function getUniqueIds($ads, $oldAds)
    {
        $newAdsIds = array_column($ads, 'id');
        $oldAdsIds = array_column($oldAds, 'adId');

        return $this->newArrayDiff($newAdsIds, $oldAdsIds);
    }

    /**
     * @param $newAdsIds
     * @param $oldAdsIds
     * @return array
     */
    private function newArrayDiff($newAdsIds, $oldAdsIds)
    {

        $map = array();
        foreach ($newAdsIds as $val) {
            $map[$val] = 1;
        }
        foreach ($oldAdsIds as $val) {
            unset($map[$val]);
        }

        return array_keys($map);
    }

    /**
     * @return ObjectManager
     */
    public function getEm()
    {
        return $this->em;
    }

    /**
     * @return AutoAPI
     */
    public function getAutoApi()
    {
        return $this->autoApi;
    }
}
