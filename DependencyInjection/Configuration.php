<?php

namespace Rz\CalendarBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $node = $treeBuilder->root('rz_calendar')->children();

        $supportedManagerTypes = array('orm', 'mongodb');

        $node
            ->scalarNode('manager_type')
                ->defaultValue('orm')
                ->validate()
                    ->ifNotInArray($supportedManagerTypes)
                    ->thenInvalid('The manager type %s is not supported. Please choose one of '.json_encode($supportedManagerTypes))
                ->end()
            ->end()
            ->arrayNode('class')
                ->addDefaultsIfNotSet()
                ->children()
                    ->scalarNode('event')->defaultValue('Application\\Rz\\CalendarBundle\\Entity\\Event')->end()
                    ->scalarNode('category')->defaultValue('Application\\Rz\\CalendarBundle\\Entity\\Category')->end()
                    ->scalarNode('setting')->defaultValue('Application\\Rz\\CalendarBundle\\Entity\\Settings')->end()
                ->end()
            ->end()

            ->arrayNode('admin')
                ->addDefaultsIfNotSet()
                ->children()
                    ->arrayNode('event')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('class')->cannotBeEmpty()->end()
                            ->scalarNode('controller')->cannotBeEmpty()->defaultValue('SonataAdminBundle:CRUD')->end()
                            ->scalarNode('translation')->cannotBeEmpty()->defaultValue('RzCalendarBundle')->end()
                            ->arrayNode('templates')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->scalarNode('list')->defaultValue('SonataAdminBundle:CRUD:list.html.twig')->cannotBeEmpty()->end()
                                    ->scalarNode('show')->defaultValue('SonataAdminBundle:CRUD:show.html.twig')->cannotBeEmpty()->end()
                                    ->scalarNode('edit')->defaultValue('SonataAdminBundle:CRUD:edit.html.twig')->cannotBeEmpty()->end()
                                    ->scalarNode('preview')->defaultValue('SonataAdminBundle:CRUD:preview.html.twig')->cannotBeEmpty()->end()
                                    ->scalarNode('history')->defaultValue('SonataAdminBundle:CRUD:history.html.twig')->cannotBeEmpty()->end()
                                    ->scalarNode('history_revision')->defaultValue('RzAdminBundle:CRUD:history_revision.html.twig')->cannotBeEmpty()->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('category')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('class')->cannotBeEmpty()->end()
                            ->scalarNode('controller')->cannotBeEmpty()->defaultValue('SonataAdminBundle:CRUD')->end()
                            ->scalarNode('translation')->cannotBeEmpty()->defaultValue('RzCalendarBundle')->end()
                            ->arrayNode('templates')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->scalarNode('list')->defaultValue('SonataAdminBundle:CRUD:list.html.twig')->cannotBeEmpty()->end()
                                    ->scalarNode('show')->defaultValue('SonataAdminBundle:CRUD:show.html.twig')->cannotBeEmpty()->end()
                                    ->scalarNode('edit')->defaultValue('SonataAdminBundle:CRUD:edit.html.twig')->cannotBeEmpty()->end()
                                    ->scalarNode('preview')->defaultValue('SonataAdminBundle:CRUD:preview.html.twig')->cannotBeEmpty()->end()
                                    ->scalarNode('history')->defaultValue('SonataAdminBundle:CRUD:history.html.twig')->cannotBeEmpty()->end()
                                    ->scalarNode('history_revision')->defaultValue('RzAdminBundle:CRUD:history_revision.html.twig')->cannotBeEmpty()->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('setting')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('class')->cannotBeEmpty()->end()
                            ->scalarNode('controller')->cannotBeEmpty()->defaultValue('SonataAdminBundle:CRUD')->end()
                            ->scalarNode('translation')->cannotBeEmpty()->defaultValue('RzCalendarBundle')->end()
                            ->arrayNode('templates')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->scalarNode('list')->defaultValue('SonataAdminBundle:CRUD:list.html.twig')->cannotBeEmpty()->end()
                                    ->scalarNode('show')->defaultValue('SonataAdminBundle:CRUD:show.html.twig')->cannotBeEmpty()->end()
                                    ->scalarNode('edit')->defaultValue('SonataAdminBundle:CRUD:edit.html.twig')->cannotBeEmpty()->end()
                                    ->scalarNode('preview')->defaultValue('SonataAdminBundle:CRUD:preview.html.twig')->cannotBeEmpty()->end()
                                    ->scalarNode('history')->defaultValue('SonataAdminBundle:CRUD:history.html.twig')->cannotBeEmpty()->end()
                                    ->scalarNode('history_revision')->defaultValue('RzAdminBundle:CRUD:history_revision.html.twig')->cannotBeEmpty()->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;

    }
}
