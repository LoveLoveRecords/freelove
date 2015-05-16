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
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Acl\Exception\Exception;

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
                    ->add('Tracks', 'text', array('attr' => array('style' => 'display:none')))
                    ->add('Length', 'text', array('label' => ' ', 'attr' => array('style' => 'display:none')))
                    ->add('addTrack', 'button', array('label'=>'+'))
                    ->add('Download', 'file') # Download URL string    }
                    ->add('Thumbnail', 'file') # Thumbnail URL string  } On form submission these three move the files the correct place and then the URLs of each is called for the createAction() arguments
                    ->add('Artwork', 'file') # Full Size Art URL string}
                    ->add('save', 'submit', array('label' => 'Add Release'))
                    ->getForm();

        $form->handleRequest($request);

        if($form->isValid()){
            $rel = $this->createAction($form);
            $this->addToDB($rel);
            return new Response('New release added: '.$release->getArtist().' - '.$release->getTitle());
        }

        return $this->render('cms/addRel.html.twig', array(
            'form' => $form->createView(),
        ));

    }



    public function createAction(Form $form)
    {
        $release = new Release();

        $id = $this->getDoctrine()->getManager()->getConnection()->lastInsertId();
        $id = (int)$id;
        $id = $id + 1;

        $release->setSerial('FREELOV'.$id);

        $artist = $form->get('Artist')->getData();
        $title = $form->get('Title')->getData();
        $genre = $form->get('Genre')->getData();
        $description = $form->get('Description')->getData();
        $tracks = $form->get('Tracks')->getData();
        $length = $form->get('Length')->getData();
        $download = $this->uploadAction($form, 'Download', $release);
        $thumb = $this->uploadAction($form, 'Artwork', $release);
        $art = $this->uploadAction($form, 'Thumbnail', $release);


        $release->setArtist($artist);
        $release->setTitle($title);
        $release->setLength($length);
        $release->setGenre($genre);
        $release->setDescription($description);
        $release->setTracks($tracks);
        $release->setDownload($download);
        $release->setThumbnail($thumb);
        $release->setArtwork($art);

        return $release;
    }

    public function uploadAction($form, $file, Release $rel)
    {
        $fileString = $rel->getSerial();

        #TODO: Needs to include error checking, use preg_match and $form[]->getData to make sure files are the right type
        switch($file)
        {
            case 'Download':
                $fileString = $fileString.'.zip';
            break;
            case 'Thumbnail':
                $fileString = $fileString.'Thumb.jpg';
                break;
            case 'Artwork':
                $fileString = $fileString.'.jpg';
            break;
        }

        $dir = 'bin/'; #FIXME: Needs to be directory for file uploads (maybe definable in the parameters.yml?)

        $form[''.$file]->getData()->move($dir, $fileString);
        return $fileString;
    }


    public function addToDB(Release $release)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($release);
        $em->flush();
    }




}