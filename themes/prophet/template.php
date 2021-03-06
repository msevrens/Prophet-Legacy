<?php

/**
 * @file
 * template.php
 */

 /**
  * Implements hook_theme().
  */
  
function prophet_theme() {
  return array( 'thought_form' => array(
    'render element' => 'form',
    'path' => drupal_get_path('theme', 'prophet') . '/templates',
    'template' => 'thought-form',
    ),
  );
}

/**
  * Implements hook_preprocess_page().
  */

function prophet_preprocess_page(&$vars, $hook = null){

    if (isset($vars['node'])) {
        switch ($vars['node']->type) {
            case 'thought':
                drupal_add_js('https://d3js.org/d3.v4.min.js', 'external');
                drupal_add_js(drupal_get_path('module', 'thought_quantifier') . '/UI/gradient/gradient.js');
                drupal_add_css(drupal_get_path('module', 'thought_quantifier') . '/UI/gradient/gradient.css');
                break;
        }
    }

    if (isset($vars['node']->type)) {
        $nodetype = $vars['node']->type;
        $vars['theme_hook_suggestions'][] = 'page__' . $nodetype;
    }

}

/**
  * Implements template_preprocess_views_view().
  */

function prophet_preprocess_views_view(&$vars) {

  $view = &$vars['view'];

  if ($view->name == 'front_page_redesign') {
    drupal_add_js('https://d3js.org/d3.v4.min.js', 'external');
    drupal_add_js(drupal_get_path('module', 'thought_quantifier') . '/UI/gradient/gradient.js');
    drupal_add_css(drupal_get_path('module', 'thought_quantifier') . '/UI/gradient/gradient.css');
  }

}

function prophet_form_views_exposed_form_alter(&$form, &$form_state) {
  if (!isset($form_state['view']->exposed_input['thought_type'])) {
    $form_state['input']['thought_type'] = 'All';
  }
}

drupal_add_js(drupal_get_path('theme', 'prophet') . '/js/script.js', array(
  'type' => 'file',
  'group' => JS_THEME,
));