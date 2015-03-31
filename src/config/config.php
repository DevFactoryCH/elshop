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

   /*
  |--------------------------------------------------------------------------
  | El Shop parcel type
  |--------------------------------------------------------------------------
  |
  | FALSE => parcel is calculate with the total price
  | TRUE => parcel is calculate with the total weight
  |
   */
  'parcel_type' => TRUE,
);