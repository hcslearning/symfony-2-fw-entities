<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController {

    /**
     * @Route("/", name="admin")
     */
    public function index() {

        return $this->render('admin/index.html.twig', [
                    'mensaje' => '',
        ]);
    }

    /**
     * @Route("/saludo", name="admin_saludo")
     */
    public function saludo() {

        return $this->render('admin/index.html.twig', [
                    'mensaje' => 'Holi holi',
        ]);
    }

}
