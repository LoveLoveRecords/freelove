<?php
/**
 * Created by PhpStorm.
 * User: keef
 * Date: 4/23/15
 * Time: 2:05 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Release;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ReleaseController extends Controller{

    public function indexAction()
    {
        return $this->render('cms/addRel.html.twig');
    }

    public function createAction($artist, $title, $length, $genre, $description, $tracks, $download, $thumb, $art)
    {
        $release = new Release();
        $release->setSerial('FREELOV'.$release->getId());
        $release->setArtist($artist);
        $release->setTitle($title);
        $release->setLength($length);
        $release->setGenre($genre);
        $release->setDescription($description);
        $release->setTracks($tracks);
        $release->setDownload($download);
        $release->setThumnail($thumb);
        $release->setArtwork($art);

        $em = $this->getDoctrine()->getManager();

        $em->persist($release);
        $em->flush();


        return new Response('New release added: '.$release->getArtist().' - '.$release->getTitle());

    }


}