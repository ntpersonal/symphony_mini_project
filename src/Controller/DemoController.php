<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
    #[Route('/demo', name: 'app_demo')]
    public function index(): Response
    {
        return $this->render('demo/index.html.twig', [
            'controller_name' => 'DemoController',
        
        ]);
    }
    
   

/*@Route("/test", name="test")*/


public function test()

{

return $this->render('demo/test.html.twig', [

'title' => 'Les amies',

'age' => 13,

]);
}
/*@Route("/demo", name="test")*/
public function inde()

{
    return new response ("envoie une réponse brute");
}

}