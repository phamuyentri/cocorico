<?php

/*
 * This file is part of the Cocorico package.
 *
 * (c) Cocolabs SAS <contact@cocolabs.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cocorico\CoreBundle\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Isbn;

class ListingFormSubscriber implements EventSubscriberInterface
{

    public function onListingNewFormBuild(ListingFormBuilderEvent $event)
    {
        $builder = $event->getFormBuilder();
        $builder
            ->add(
                'isbn',
                TextType::class,
                [
                    'label' => 'listing.form.isbn',
                    'constraints' => new Isbn([
                        'message' => 'Invalid ISBN format',
                    ]),
                    'translation_domain' => 'cocorico_listing',
                ]
            );

        return $builder;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            ListingFormEvents::LISTING_NEW_FORM_BUILD => ['onListingNewFormBuild', 1],
        ];
    }

}
