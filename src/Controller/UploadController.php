<?php

namespace App\Controller;

use App\Entity\File;
use Doctrine\ORM\EntityManagerInterface;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

class UploadController extends AbstractController
{
    public function __construct(
        protected EntityManagerInterface $entityManager,
        protected Filesystem $filesystem,
        protected string $uploadPath,
    ) {
    }

    #[Route('/upload-file', name: 'upload_file', methods: ['POST'])]
    public function upload(Request $request): Response
    {
        $file = $request->files->get('file');

        if (!$file instanceof UploadedFile) {
            throw new LogicException('invalid file');
        }

        $entityFile = new File();
        $entityFile->setFile($file);

        $fileName = str_replace('.', '', uniqid('', true));
        $file->move($this->uploadPath, $fileName);
        $entityFile->setFilePath($this->uploadPath.$fileName);

        $this->entityManager->persist($entityFile);
        $this->entityManager->flush();

        return new JsonResponse([
            'url' => 'download_link/'.$entityFile->getFilePath(),
            'content' => $this->renderView('component/_drop_zone_file.html.twig', ['file' => $entityFile]),
        ]);
    }

    #[Route('/remove-file/{file}', name: 'remove_file', methods: ['GET'])]
    public function remove(File $file): Response
    {
        $this->filesystem->remove($file->getFilePath());

        $this->entityManager->remove($file);
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Suppression OK']);
    }

    #[Route('/download-file/{file}', name: 'download_file', methods: ['GET'])]
    public function download(File $file): Response
    {
        $response = new BinaryFileResponse($file->getFilePath());
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $file->getOriginalName());

        return $response;
    }
}
