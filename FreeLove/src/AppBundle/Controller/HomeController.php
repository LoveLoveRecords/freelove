<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Release;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        var_dump($this->releaseAction(1));
        return $this->render('home/index.html.twig');
    }

    public function releaseAction($id)
    {
        $release = $this->getDoctrine()->getRepository('AppBundle:Release')->find($id);

        return $this->prepareRelease($release);
    }

    private function prepareRelease(Release $release)
    {
        $tracks = $release->getTracks();

        list($k, $v) = explode('=>', $tracks);
        $tracksArray[ $k ] = $v;

        $releaseInfo = [
            'artist' => $release->getArtist(),
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
