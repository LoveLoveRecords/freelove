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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ReleaseController extends Controller{

    public function indexAction(Request $request)
    {
        $release = new Release();

        $form = $this->createFormBuilder($release)
                    ->add('Artist', 'text')
                    ->add('Title', 'text')
                    #->add('Length', 'text') Not needed on account of track times
                    ->add('Genre', 'text')
                    ->add('Description', 'textarea')
                    ->add('Tracks', 'textarea')
                    ->add('save', 'submit', array('label' => 'Add Release'))
                    ->getForm();

        $form->handleRequest($request);

        if($form->isValid()){
            $tracks = explode(',', $release->getTracks());
            $bool = false;
            #FIXME: Needs to work properly, for some reason always gets the last two values without dropping
            for($i=0; $i<count($tracks)-1; $i++){
                if(!$bool){
                    unset($tracks[$i]);
                    $bool = !$bool;
                }else{
                    $bool = !$bool;
                }
            }

            var_dump($tracks);
        }

        return $this->render('cms/addRel.html.twig', array(
            'form' => $form->createView(),
        ));

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
    }

    public function addToDB(Release $release)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($release);
        $em->flush();
        return new Response('New release added: '.$release->getArtist().' - '.$release->getTitle());
    }



}