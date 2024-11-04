<?php

declare(strict_types=1);

namespace Freyr\Panda\QA\Scheduling\Application;

use Freyr\Panda\QA\Scheduling\Core\Order\NewOrder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends AbstractController
{
    public function new(OrderService $service): Response
    {
        /** @var NewOrder | NewOrderForm $form */
        $form = $this->createForm(NewOrderForm::class);
        if ($form->handleRequest()) {
            $service->createOrder($form);
        }

        return $this->redirectToRoute('order_list');
    }
}