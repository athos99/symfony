<?php

namespace AppBundle\Controller;

use AppBundle\Form\TaskType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Task;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Response;


/**
 * Category controller.
 *
 * @Route("/")
 */
class FormController extends Controller
{
    /**
     * @Route("/form", name="form")
     */
    public function indexAction(Request $request)
    {
        return new Response('form');
    }

    /**
     * @Route("/form1", name="form1")
     */
    public function indexAction1(Request $request)
    {
        // create a task and give it some dummy data for this example
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
            ->add('task', TextType::class)
            ->add('codeReference', TextType::class, ['required' => false])
            ->add(
                'gender',
                ChoiceType::class,
                [
                    'choices' => [
                        'Male' => 'M',
                        'Female' => 'F',
                        '' => null,
                    ],
                ]
            )
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->add('saveAndAdd', SubmitType::class, array('label' => 'Save and Add'))
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // ... perform some action, such as saving the task to the database
            $nextAction = $form->get('saveAndAdd')->isClicked()
                ? 'task_new'
                : 'form';

            return $this->redirectToRoute($nextAction);
        }

        return $this->render(
            'AppBundle:default:form.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    /**
     * @Route("/form2", name="form2")
     */
    public function indexAction2(Request $request)
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            return $this->redirectToRoute('form');
        }

        return $this->render(
            'AppBundle:task:form.html.twig',
            array(
                'task' => $task,
                'form' => $form->createView(),
            )
        );

    }
}