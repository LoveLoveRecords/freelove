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
                    ->add('Tracks', 'hidden')
                    ->add('addTrack', 'button', array('label'=>'+'))
                    ->add('Download', 'file') # Download URL string    }
                    ->add('Thumbnail', 'file') # Thumbnail URL string  } On form submission these three move the files the correct place and then the URLs of each is called for the createAction() arguments
                    ->add('Artwork', 'file') # Full Size Art URL string}
                    ->add('save', 'submit', array('label' => 'Add Release'))
                    ->getForm();

        $form->handleRequest($request);

        if($form->isValid()){
/*            $tracks = explode(',', $release->getTracks());
            $bool = false;
            #FIXME: Needs to work properly, for some reason always gets the last two values without dropping
            foreach($tracks as $t){

            }

            var_dump($tracks);die;*/

            $dl = $this->uploadAction($form, 'Download');
            $thumb = $this->uploadAction($form, 'Artwork');
            $art = $this->uploadAction($form, 'Thumbnail');
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

    public function uploadAction($form, $file)
    {
        $fileString = $this->generateRandomString(10);

        switch($file)
        {
            case 'Download':
                $fileString = $fileString.'.wav';
            break;
            case 'Thumbnail':
            case 'Artwork':
                $fileString = $fileString.'.jpg';
            break;
        }

        $dir = 'bin/'; #FIXME: Needs to be directory for file uploads (maybe definable in the parameters.yml?)
        $form[''.$file]->getData()->move($dir, $fileString);
        return $dir.$fileString;
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function addToDB(Release $release)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($release);
        $em->flush();
        return new Response('New release added: '.$release->getArtist().' - '.$release->getTitle());
    }



}