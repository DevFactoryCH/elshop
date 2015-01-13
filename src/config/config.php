<?php
return array(
  'route_prefix' => 'admin',
  'layout_extend' => 'elshop::layout',
  'section' => 'content',
  'vocabulary_name' => 'Rubrics',
  /*
  |--------------------------------------------------------------------------
  | El Shop filter before
  |--------------------------------------------------------------------------
  |
  | You can set the filter who will be used to display the page
  |
  */
  'filter_before' => 'admin-auth',
);