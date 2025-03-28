<?php

namespace YDTBPatches\Patches;

/**
 * Class JetEngineQBuilder
 *
 * This class provides a patch for integrating JetEngine Query Builder queries 
 * with the Elementor Pro Loop Grid widget. It enables the use of custom 
 * queries created in JetEngine Query Builder within Elementor Pro's Loop Grid.
 *
 * @package YDTB\Patches
 * @subpackage Server\Patches
 * @since 0.0.9
 *
 * @link https://github.com/MjHead/jet-engine-query-builder-for-epro-loop
 * @link https://www.youtube.com/watch?v=mTlqg9thgVE
 *
 * @license GPL-2.0-or-later
 *
 * @see https://github.com/MjHead/jet-engine-query-builder-for-epro-loop
 *
 */


use YDTBPatches\Interfaces\Provider;
class JetEngineQBuilder implements Provider
{

    protected $base_id = 'jet-query-';
    public function register()
    {
        add_filter('elementor/query/query_args', [$this, 'apply_query_args'], 10, 2);
    }


    /**
     * Apply Query Builder arguments for EPro Queries
     * 
     * @param  array  $query_args 
     * @param  object $widget     [description]
     * @return array
     */
    public function apply_query_args($query_args, $widget)
    {

        $query = $this->get_widget_query($widget);

        if ($query) {
            $query_args = $this->maybe_add_paged($query->get_query_args());
        }

        return $query_args;
    }

    /**
     * Try to get Query Builder query for given widget
     * 
     * @param  object $widget EPro posts widget
     * @return mixed
     */
    public function get_widget_query($widget)
    {

        $query_id = $widget->get_settings('post_query_query_id');

        if (!$query_id) {
            return false;
        }

        $query_builder_id = false;

        if ($query_id && false !== strpos($query_id, $this->base_id)) {
            $query_builder_id = absint(str_replace($this->base_id, '', $query_id));
        }
        if (!$query_builder_id) {
            return false;
        }
        if (class_exists('\Jet_Engine\Query_Builder\Manager')) {
            return \Jet_Engine\Query_Builder\Manager::instance()->get_query_by_id($query_builder_id);
        }
        return false;

    }

    /**
     * Check if we need to add a paged argument to the query
     * 
     * @param  array  $query_args Current query args
     * @return array
     */
    public function maybe_add_paged($query_args = [])
    {

        global $wp;
        if (!empty($wp->query_vars['page'])) {
            $query_args['paged'] = absint($wp->query_vars['page']);
        }
        return $query_args;
    }
}