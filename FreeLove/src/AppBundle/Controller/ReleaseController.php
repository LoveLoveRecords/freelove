<?php
/**
 * Created by PhpStorm.
 * User: keef
 * Date: 4/23/15
 * Time: 2:05 PM
 */

namespace AppBundle\cms\Controller;

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

        $form = $this->createForm($release);

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

    public function createForm($release)
    {
        return $this->createFormBuilder($release)
            ->add('Artist', 'text')
            ->add('Title', 'text')
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
    }

    public function createAction(Form $form)
    {
        $release = new Release();

        $id = $this->getDoctrine()->getManager()->getConnection()->lastInsertId();
        $id = (int)$id;
        $id = $id + 1;

        $release->setSerial('FREELOV'.$id);
        $release->setArtist($form->get('Artist')->getData());
        $release->setTitle($form->get('Title')->getData());
        $release->setLength($form->get('Length')->getData());
        $release->setGenre($form->get('Genre')->getData());
        $release->setDescription($form->get('Description')->getData());
        $release->setTracks($form->get('Tracks')->getData());
        $release->setDownload($this->uploadAction($form, 'Download', $release));
        $release->setThumbnail($this->uploadAction($form, 'Artwork', $release));
        $release->setArtwork($this->uploadAction($form, 'Thumbnail', $release));

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