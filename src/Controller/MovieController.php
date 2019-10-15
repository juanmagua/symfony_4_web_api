<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Entity\Movie;
use App\Repository\MovieRepository;
use FOS\RestBundle\View\View;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;


class MovieController extends FOSRestController
{
    /**
     * Creates an Movie resource
     * @Rest\Post("/addmovie/{title}/{releaseYear}")
     **/
    public function addMovie(EntityManagerInterface $em,MovieRepository $movieRepository, string $title, int $releaseYear): View
    {
        $movie = new Movie();
        $movie->setTitle($title);
        $movie->setReleaseYear($releaseYear);
        $em->persist($movie);
        $em->flush();

        $movieRepository = $movieRepository->findOneByTitle($title);

        // In case our POST was a success we need to return a 201 HTTP CREATED response
        return View::create($movieRepository, Response::HTTP_CREATED);
        
    }

    /**
     * Remove Movie
     * * @Rest\Delete("/removemovie/{title}")
     */
    public function removeMovie(EntityManagerInterface $em,MovieRepository $movieRepository, string $title): View
    {
    
        $movie = $movieRepository->findOneByTitle($title);

        if ($movie) {
            $em->remove($movie);
            $em->flush();
        }

        // In case our DELETE was a success we need to return a 204 HTTP NO CONTENT response. The object is deleted.
        return View::create([], Response::HTTP_NO_CONTENT);
    }
}