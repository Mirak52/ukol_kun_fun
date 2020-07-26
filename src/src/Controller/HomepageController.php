<?php

namespace App\Controller;

use App\Entity\ChessPosition;
use App\Form\ChessType;
use App\model\PathModel;
use ContainerBPNXIp6\getVarDumper_Command_ServerDumpService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{

    private PathModel $pathModel;

    public function __construct(PathModel $pathModel)
    {
        $this->pathModel = $pathModel;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function index(Request $request)
    {

        $form = $this->createForm(ChessType::class, new ChessPosition());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $chessPositon = $form->getData();

            if(!$this->pathModel->checkDataInput($chessPositon)){
                $form->addError(new FormError("Prosím zkontrulujte input (čísla, písmena)"));
            }
            if($chessPositon->getStartY() === $chessPositon->getEndY() && $chessPositon->getStartX() === $chessPositon->getEndX()){
                $form->addError(new FormError("Byly zadané stejné souřadnice"));
            }
            if($form->getErrors()->count() === 0){
                $fastestWay = $this->pathModel->getFastestPath($chessPositon);
                return $this->render('homepage/index.html.twig', [
                    "form" => $form->createView(),
                    "path" => $fastestWay[0],
                    "jspath" => $fastestWay[1],
                ]);
            }
        }
        return $this->render('homepage/index.html.twig', [
            "form" => $form->createView()
        ]);
    }
}
