<?php

echo form_open();

echo form_label('Spotcode :', 'spotcode');

$attributes = array(
    'name' => 'spotcode',
    'placeholder' => 'Please Enter Spotcode',
    'class' => 'form-control'
);

echo form_input($attributes);


echo form_label('Title:', 'title');

$attributes = array(
    'name' => 'title',
    'placeholder' => 'Please Enter Title',
    'class' => 'form-control'
);

echo form_input($attributes);


echo form_label('Description:', 'description');

$attributes = array(
    'name' => 'description',
    'placeholder' => 'Please Enter  Description',
    'class' => 'form-control'
);

echo form_textarea($attributes);

echo form_label('Category Id:', 'cat_id');

$attributes = array(
    'name' => 'cat_id',
    
    'class' => 'form-control ckeditor'
);

echo form_input($attributes);

echo form_label(' Tags:', 'tage');

$data = array(
    'name' => 'tage',
    'placeholder' => 'Please Enter  tage',
    'class' => 'form-control'
);

echo form_input($data);

echo form_label('Sort_order:', 'sort_order');

$data = array(
    'name' => 'sort_order',
    'placeholder' => 'Please Enter Sort_order',
    'class' => 'form-control'
);

echo form_input($data);

$data = array(
    'name' => 'sub',
    'id' => 'sub',
    'value' => 'Add',
    'type' => 'submit',
    'content' => 'Add',
    'class' => "btn btn-primary"
);

echo form_button($data);
echo form_close();
?>