<?php

namespace Rz\CalendarBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

use Sonata\EasyExtendsBundle\Mapper\DoctrineCollector;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class RzCalendarExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
        $loader->load('admin_orm.xml');
        $loader->load('doctrine_orm.xml');

        $config = $this->addDefaults($config);
        $this->registerDoctrineMapping($config);
        $this->configureClass($config, $container);
        $this->configureAdminClass($config, $container);
        $this->configureRzTemplates($config, $container);
    }

    /**
     * @param array $config
     *
     * @return array
     */
    public function addDefaults(array $config)
    {
        if ('orm' === $config['manager_type']) {
            $modelType = 'Entity';
        } elseif ('mongodb' === $config['manager_type']) {
            $modelType = 'Document';
        }

        $defaultConfig['class']['event'] = sprintf('Application\\Rz\\CalendarBundle\\%s\\Event', $modelType);
        $defaultConfig['class']['category'] = sprintf('Application\\Rz\\CalendarBundle\\%s\\Category', $modelType);
        $defaultConfig['class']['setting'] = sprintf('Application\\Rz\\CalendarBundle\\%s\\Setting', $modelType);

        $defaultConfig['admin']['event']['class'] = sprintf('Rz\\CalendarBundle\\Admin\\%s\\EventAdmin', $modelType);
        $defaultConfig['admin']['category']['class'] = sprintf('Rz\\CalendarBundle\\Admin\\%s\\CategoryAdmin', $modelType);
        $defaultConfig['admin']['setting']['class'] = sprintf('Rz\\CalendarBundle\\Admin\\%s\\SettingAdmin', $modelType);

        return array_replace_recursive($defaultConfig, $config);
    }

    /**
     * @param array                                                   $config
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     *
     * @return void
     */
    public function configureClass($config, ContainerBuilder $container)
    {
        if ('orm' === $config['manager_type']) {
            $modelType = 'entity';
        } elseif ('mongodb' === $config['manager_type']) {
            $modelType = 'document';
        }

        $container->setParameter(sprintf('rz_calendar.calendar.event.%s', $modelType), $config['class']['event']);
        $container->setParameter(sprintf('rz_calendar.calendar.category.%s', $modelType), $config['class']['category']);
        $container->setParameter(sprintf('rz_calendar.calendar.setting.%s', $modelType), $config['class']['setting']);
    }

    /**
     * @param array                                                   $config
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function configureAdminClass($config, ContainerBuilder $container)
    {

        $container->setParameter('rz_calendar.calendar.admin.event.class',  $config['admin']['event']['class']);
        $container->setParameter('rz_calendar.calendar.admin.event.controller',         $config['admin']['event']['controller']);
        $container->setParameter('rz_calendar.calendar.admin.event.translation_domain', $config['admin']['event']['translation']);

        $container->setParameter('rz_calendar.calendar.admin.category.class',  $config['admin']['category']['class']);
        $container->setParameter('rz_calendar.calendar.admin.category.controller',         $config['admin']['category']['controller']);
        $container->setParameter('rz_calendar.calendar.admin.category.translation_domain', $config['admin']['category']['translation']);

        $container->setParameter('rz_calendar.calendar.admin.setting.class',  $config['admin']['setting']['class']);
        $container->setParameter('rz_calendar.calendar.admin.setting.controller',         $config['admin']['setting']['controller']);
        $container->setParameter('rz_calendar.calendar.admin.setting.translation_domain', $config['admin']['setting']['translation']);

    }

    /**
     * @param array                                                   $config
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     *
     * @return void
     */
    public function configureRzTemplates($config, ContainerBuilder $container)
    {
        $container->setParameter('rz_calendar.configuration.event.templates', $config['admin']['event']['templates']);
        $container->setParameter('rz_calendar.configuration.category.templates', $config['admin']['category']['templates']);
        $container->setParameter('rz_calendar.configuration.setting.templates', $config['admin']['setting']['templates']);
    }

    /**
     * Registers doctrine mapping on concrete page entities
     *
     * @param array $config
     */
    public function registerDoctrineMapping(array $config)
    {
        $collector = DoctrineCollector::getInstance();

        $collector->addAssociation($config['class']['event'], 'mapManyToOne', array(
            'fieldName' => 'category',
            'targetEntity' => $config['class']['category'],
            'cascade' => array(
                'persist',
            ),
            'mappedBy' => null,
            'inversedBy' => 'events',
            'joinColumns' => array(
                array(
                    'name' => 'category_id',
                    'referencedColumnName' => 'id',
                    'onDelete' => 'CASCADE',
                ),
            ),
            'orphanRemoval' => false,
        ));
    }
}
