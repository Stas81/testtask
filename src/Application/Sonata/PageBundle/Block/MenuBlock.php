<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuBlock
 *
 * @author develop1
 */

namespace Application\Sonata\PageBundle\Block;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\AdminBundle\Form\FormMapper;

class MenuBlock extends BaseBlockService {
    //put your code here
    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'template' => 'ApplicationSonataPageBundle::menu.html.twig',
        ));
    }
    
    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
        $formMapper->add('settings', 'sonata_type_immutable_array', array(
            'keys' => array(                
                array('title', 'text', array('required' => false)),
            )
        ));
    }
    
    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
        $errorElement
            ->with('settings.title')
                ->assertMaxLength(array('limit' => 50))
            ->end();
    }
    
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        // merge settings
        $settings = $blockContext->getSettings();

//        $feeds = false;
//        if ($settings['url']) {
//            $options = array(
//                'http' => array(
//                    'user_agent' => 'Sonata/RSS Reader',
//                    'timeout' => 2,
//                )
//            );
//
//            // retrieve contents with a specific stream context to avoid php errors
//            $content = @file_get_contents($settings['url'], false, stream_context_create($options));
//
//            if ($content) {
//                // generate a simple xml element
//                try {
//                    $feeds = new \SimpleXMLElement($content);
//                    $feeds = $feeds->channel->item;
//                } catch (\Exception $e) {
//                    // silently fail error
//                }
//            }
//        }

        return $this->renderResponse($blockContext->getTemplate(), array(
            'block'     => $blockContext->getBlock(),
            'settings'  => $settings
        ), $response);
    }
    
        /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Main menu';
    }
}
