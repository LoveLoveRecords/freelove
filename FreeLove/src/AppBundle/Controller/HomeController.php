<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Release;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {

        $rels = $this->prepReleases();
        return $this->render('home/index.html.twig', array('releases' => $rels));
    }

    private function prepReleases()
    {
        $rels = $this->getDoctrine()->getRepository('AppBundle:Release')->findAll();
        $releases = array();

        foreach($rels as $release)
        {
            array_push($releases, $this->prepareRelease($release));
        }

        dump($releases);

        return $releases;
    }

    private function prepareRelease(Release $release)
    {
        $tracks = $release->getTracks();

        $ts = explode(',', $tracks);

        foreach($ts as $t) {
            list($k, $v) = explode('=>', $t);
            $tracksArray[$k] = $v;
        }

        $releaseInfo = [
            'artist' => $release->getArtist(),
            'title' => $release->getTitle(),
            'genre' => $release->getGenre(),
            'serial' => $release->getSerial(),
            'artwork' => $release->getArtwork(),
            'description' => $release->getDescription(),
            'download' => $release->getDownload(),
            'length' => $release->getLength(),
            'thumb' => $release->getThumbnail(),
            'tracks' => $tracksArray
        ];

        return $releaseInfo;
    }

}
