<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Vich\UploaderBundle\Form\Type\VichFileType;

final class PlaylistAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
			->add('id')
			->add('lib')
			;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
			->add('id')
			->add('lib')
            ->add('imageName', null, array('label' => 'Images', 'template' => 'admin/fields/image.html.twig') )
			->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
			->add('lib')
            ->add('imageFile', VichFileType::class)
			;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
			->add('id')
			->add('lib')
			;
    }
}
