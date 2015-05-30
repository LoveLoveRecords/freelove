<?php
/**
 * Created by PhpStorm.
 * User: keef
 * Date: 24/05/15
 * Time: 19:27
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CMSController extends Controller
{
    public function indexAction()
    {
        return new Response('CMS Login');
    }
}