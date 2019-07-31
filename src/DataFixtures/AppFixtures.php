<?php

namespace App\DataFixtures;

use Psr\Log\LoggerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Cliente;
use App\Entity\Usuario;

class AppFixtures extends Fixture {

    private $passwordEncoder;
    private $logger;

    function __construct(UserPasswordEncoderInterface $passwordEncoder, LoggerInterface $logger) {
        $this->passwordEncoder = $passwordEncoder;
        $this->logger = $logger;
    }

    public function load(ObjectManager $manager) {        
        $usuarios = $this->getUsuarios();
        $clientes = $this->getClientes();
        $objetos = array_merge(
                $usuarios,
                $clientes
        );
        
        foreach ($objetos as $k => $o) {
            $manager->persist($o);
        }
        
        $manager->flush();
    }

    public function getUsuarios(): array {
        $usuarios = array();
        $usuario1 = new Usuario();
        $usuario1
                ->setUsuario('roberto')
                ->setPassword($this->passwordEncoder->encodePassword($usuario1, 'abcd'))
        ;
        $usuario2 = new Usuario();
        $usuario2
                ->setUsuario('andres')
                ->setPassword($this->passwordEncoder->encodePassword($usuario1, 'dcba'))
        ;

        $usuarios[] = $usuario1;
        $usuarios[] = $usuario2;
        return $usuarios;
    }

    public function getClientes(): array {
        $clientes = array();

        $cliente = new Cliente();
        $cliente
                ->setNombre("Hernán Hormazabal")
                ->setEmail('admin@123.cl')
                ->setPassword(
                        $this->passwordEncoder->encodePassword($cliente, '1234')
                )
                ->setRut('12345678-5')
        ;

        $cliente2 = new Cliente();
        $cliente2
                ->setNombre('Juanito Pericotes')
                ->setEmail('admin@terra.cl')
                ->setPassword(
                        $this->passwordEncoder->encodePassword($cliente, '4321')
                )
                ->setRut('9871321-K')
        ;

        $clientes[] = $cliente;
        $clientes[] = $cliente2;
        return $clientes;
    }

}
